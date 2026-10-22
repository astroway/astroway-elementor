=== AstroWay for Elementor ===
Contributors: astrowayteam
Tags: elementor, astrology, horoscope, natal chart, tarot
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 7.4
Requires Plugins: astroway, elementor
Stable tag: 0.2.0
License: MIT
License URI: https://opensource.org/licenses/MIT

No longer needed: AstroWay 2.5 and newer has every widget in Elementor itself. Deactivate and delete this addon.

== Description ==

**This addon is retired.** Since version 2.5 the free AstroWay plugin adds all of its widgets to Elementor on its own, together with Beaver Builder and WPBakery. With AstroWay 2.5 or newer active, this addon does nothing: deactivate and delete it. Pages built with it keep their widgets, because the core plugin registers them under the same names.

Below is what the addon did for older versions of AstroWay.

Adds five AstroWay widgets to the Elementor editor, grouped under an **AstroWay** category:

* Natal Chart
* Human Design Bodygraph
* Daily Horoscope
* Daily Tarot
* Moon Phase

Each widget wraps the matching AstroWay shortcode, so output and rate limits behave exactly like the core plugin. Drag a widget onto the canvas, fill the controls, and the chart renders in the Elementor preview.

This is an addon: it requires the free **AstroWay** plugin (0.6.4 or newer) and **Elementor** both active. It adds no API calls of its own: rendering, caching, and tier handling stay in the core plugin.

== Installation ==

1. Install and activate **AstroWay** (the core plugin) and **Elementor**.
2. Install and activate **AstroWay for Elementor**.
3. Edit any page with Elementor and the AstroWay widgets appear under the **AstroWay** category in the widget panel.

== Changelog ==

= 0.2.0 =
* Retired: AstroWay 2.5 and newer registers every widget in Elementor itself, under the same names. With it active this addon stays idle and shows a notice that it can be deleted. Pages keep their widgets.

= 0.1.3 =
* Removed: the Today in Sky and Fortune Cookie widgets. Neither ever rendered anything, because the service behind them was never published. A page that still carries one shows nothing in its place, as before.

= 0.1.2 =
* The two placeholder options in the widget controls now read "Pick a sign" and "Any" instead of being wrapped in dashes.
* Prose in the plugin description and this file rewritten without em dashes.

= 0.1.1 =
* Tested against WordPress 7.1: all seven widgets register with Elementor, and the five backed by a live endpoint render on the front end. Today in sky and Fortune cookie stay blank, as they have since 0.1.0, because the service behind them is not published yet.
* Housekeeping: the minimum WordPress version now states 6.5, the release that added the "Requires Plugins" header this add-on depends on.

= 0.1.0 =
* Initial release. Seven Elementor widgets wrapping AstroWay core shortcodes (natal, bodygraph, daily horoscope, Tarot, moon phase, today in sky, fortune cookie).

== Upgrade Notice ==

= 0.2.0 =
AstroWay 2.5 has these widgets built in. After updating AstroWay, you can delete this addon.
