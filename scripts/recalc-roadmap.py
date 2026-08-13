#!/usr/bin/env python3
"""Recalculate ROADMAP.md ETA dates after a release.

Moves shipped versions out of next/upcoming into shipped[], promotes the next
queued version, and re-lays ETAs of all remaining dated entries onto the release
cadence slots — so an out-of-cadence (manual) ship doesn't leave the queue
stranded weeks in the future.

Comments/quoting/structure preserved via ruamel.yaml round-trip.

Usage:
  recalc-roadmap.py ROADMAP.md --shipped-version 0.6.5 --shipped-date 2026-06-01 \
      --today 2026-06-04 --cadence mon-thu   # core (default)
  recalc-roadmap.py ROADMAP.md --shipped-version 0.1.0 --shipped-date 2026-06-01 \
      --today 2026-06-04 --cadence weekly    # addon
"""
import argparse, sys, datetime
from ruamel.yaml import YAML

DATED = {"queued", "planned"}        # entries that get an ETA slot
SKIP  = {"gate", "blocked"}          # conditional — leave eta empty


def ver_tuple(v):
    return tuple(int(x) for x in str(v).split("."))


def gen_slots(ship_date, today, cadence, n):
    weekdays = {0} if cadence == "weekly" else {0, 3}   # Mon / Mon+Thu
    first_gap = 7 if cadence == "weekly" else 4
    out, cur = [], max(ship_date, today)
    while len(out) < n:
        cur += datetime.timedelta(days=1)
        if cur.weekday() in weekdays:
            if not out and (cur - ship_date).days < first_gap:
                continue
            out.append(cur)
    return out


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("path")
    ap.add_argument("--shipped-version", required=True)
    ap.add_argument("--shipped-date", required=True)      # YYYY-MM-DD
    ap.add_argument("--today", required=True)             # YYYY-MM-DD
    ap.add_argument("--cadence", choices=["mon-thu", "weekly"], default="mon-thu")
    a = ap.parse_args()

    ship_v = ver_tuple(a.shipped_version)
    ship_d = datetime.date.fromisoformat(a.shipped_date)
    today  = datetime.date.fromisoformat(a.today)
    # Assign date objects (not strings) so ruamel emits unquoted ISO dates,
    # matching the existing roadmap style (eta: 2026-06-08, not '2026-06-08').

    raw = open(a.path, encoding="utf-8").read()
    if not raw.startswith("---\n"):
        sys.exit("no frontmatter")
    _, fm_text, body = raw.split("---\n", 2)

    yaml = YAML()
    yaml.preserve_quotes = True
    yaml.width = 4096
    yaml.indent(mapping=2, sequence=4, offset=2)
    fm = yaml.load(fm_text)

    pipeline = []
    if fm.get("next"):
        pipeline.append(fm["next"])
    pipeline += list(fm.get("upcoming") or [])

    shipped_now = [e for e in pipeline if ver_tuple(e["version"]) <= ship_v]
    remaining   = [e for e in pipeline if ver_tuple(e["version"]) >  ship_v]

    # Promote shipped entries → shipped[] / last_shipped — only when the shipped
    # version is still in the queue. If it was already promoted (e.g. the release
    # cron's sync ran first), this is a recalc-only run: leave last_shipped alone.
    if shipped_now:
        from ruamel.yaml.comments import CommentedSeq, CommentedMap
        shipped_list = fm.get("shipped") or CommentedSeq()
        have = {str(s.get("version")) for s in shipped_list}
        ship_title = ""
        for e in shipped_now:
            v = str(e["version"])
            if v == a.shipped_version:
                ship_title = e.get("title", "")
            if v not in have:
                row = CommentedMap()
                row["version"], row["date"], row["title"] = v, datetime.date.fromisoformat(a.shipped_date), e.get("title", "")
                shipped_list.insert(0, row)
                have.add(v)
        fm["shipped"] = shipped_list

        ls = CommentedMap()
        ls["version"], ls["date"], ls["title"] = a.shipped_version, datetime.date.fromisoformat(a.shipped_date), ship_title
        fm["last_shipped"] = ls

    from ruamel.yaml.comments import CommentedSeq
    if not remaining:
        # Last version shipped — nothing left to schedule.
        fm["next"] = None
        fm["upcoming"] = CommentedSeq()
    else:
        # Re-lay ETAs onto cadence slots (skip gate/blocked).
        to_date = [e for e in remaining if e.get("status") not in SKIP]
        slots = gen_slots(ship_d, today, a.cadence, len(to_date))
        for e, d in zip(to_date, slots):
            e["eta"] = d

        fm["next"] = remaining[0]
        up = CommentedSeq()
        for e in remaining[1:]:
            up.append(e)
        fm["upcoming"] = up

    import io
    buf = io.StringIO()
    yaml.dump(fm, buf)
    open(a.path, "w", encoding="utf-8").write("---\n" + buf.getvalue() + "---\n" + body)
    nxt = remaining[0]["version"] + " @ " + str(remaining[0].get("eta")) if remaining else "(queue empty)"
    print(f"recalc OK: shipped {a.shipped_version}, next {nxt}, {len(remaining)} remaining")


if __name__ == "__main__":
    main()
