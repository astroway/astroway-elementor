<?php
/**
 * Plugin Name:       AstroWay for Elementor
 * Plugin URI:        https://github.com/astroway/astroway-elementor
 * Description:       Elementor widgets for AstroWay astrology: natal chart, Human Design bodygraph, daily horoscope, Tarot, moon phase. Requires the AstroWay plugin.
 * Version:           0.1.3
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Requires Plugins:  astroway, elementor
 * Author:            AstroWay
 * Author URI:        https://astroway.info
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       astroway-elementor
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ASTROWAY_ELEMENTOR_VERSION', '0.1.0' );
define( 'ASTROWAY_ELEMENTOR_DIR', plugin_dir_path( __FILE__ ) );

// Core version that first exposed the addon hooks + AddonAPI.
define( 'ASTROWAY_ELEMENTOR_MIN_CORE', '0.6.4' );

add_action( 'plugins_loaded', 'astroway_elementor_boot', 20 );

function astroway_elementor_boot() {
	if ( ! defined( 'ASTROWAY_WP_PLUGIN_VERSION' )
		|| version_compare( ASTROWAY_WP_PLUGIN_VERSION, ASTROWAY_ELEMENTOR_MIN_CORE, '<' ) ) {
		add_action( 'admin_notices', 'astroway_elementor_core_notice' );
		return;
	}

	// Loader only adds elementor/* hooks, dormant when Elementor is not running,
	// so no need to gate on Elementor here; the Requires Plugins header enforces it.
	require_once ASTROWAY_ELEMENTOR_DIR . 'includes/class-loader.php';
	\AstroWay\Elementor\Loader::boot();
}

function astroway_elementor_core_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-error"><p>%s</p></div>',
		esc_html__( 'AstroWay for Elementor needs the AstroWay plugin (0.6.4 or newer) active.', 'astroway-elementor' )
	);
}
