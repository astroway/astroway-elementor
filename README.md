# AstroWay for Elementor

> **Retired.** Since [AstroWay](https://wordpress.org/plugins/astroway/) 2.5 every AstroWay widget ships in the core plugin as an Elementor widget, a Beaver Builder module and a WPBakery element. Pages built with this addon keep working after you update the core plugin, and the addon can then be removed. This repository is no longer maintained.

Elementor widgets for [AstroWay](https://astroway.info) astrology. Adds five widgets to the
Elementor editor under an **AstroWay** category. Each wraps the matching AstroWay core shortcode,
so output, caching, and rate limits behave exactly like the core plugin.

**Widgets:** Natal Chart · Human Design Bodygraph · Daily Horoscope · Daily Tarot · Moon Phase.

## Requirements

- [AstroWay](https://wordpress.org/plugins/astroway/) core plugin, **0.6.4+** (active)
- [Elementor](https://wordpress.org/plugins/elementor/) (active)

This is an addon: it makes no API calls of its own. Rendering, caching, and tier handling stay in
the core plugin via its public Addon Hooks API.

## Install

1. Activate **AstroWay** and **Elementor**.
2. Activate **AstroWay for Elementor**.
3. Edit any page with Elementor: the AstroWay widgets appear under the **AstroWay** category.

## License

MIT
