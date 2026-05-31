# AstroWay for Elementor — astrology widgets (natal chart, Human Design, horoscope, Tarot)

Elementor widgets powered by the [AstroWay astrology API](https://api.astroway.info). Adds seven
widgets to the Elementor editor under an **AstroWay** category — natal chart, Human Design bodygraph,
daily horoscope, daily Tarot, moon phase, today in sky, fortune cookie — each wraps the matching
AstroWay core shortcode, so output, caching, and rate limits behave exactly like the core plugin.

**Widgets:** Natal Chart · Human Design Bodygraph · Daily Horoscope · Daily Tarot · Moon Phase ·
Today in Sky · Fortune Cookie.

## Requirements

- [AstroWay](https://wordpress.org/plugins/astroway/) core plugin, **0.6.4+** (active)
- [Elementor](https://wordpress.org/plugins/elementor/) (active)

This is an addon — it makes no API calls of its own. Rendering, caching, and tier handling stay in
the core plugin via its public Addon Hooks API.

## Install

1. Activate **AstroWay** and **Elementor**.
2. Activate **AstroWay for Elementor**.
3. Edit any page with Elementor — the AstroWay widgets appear under the **AstroWay** category.

## License

MIT
