<?php
/**
 * Elementor wrapper for [astroway_today_in_sky] shortcode.
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

class WidgetTodayInSky extends WidgetBase {

	public function get_name() {
		return 'astroway-today-in-sky';
	}

	public function get_title() {
		return __( 'AstroWay Today in Sky', 'astroway-elementor' );
	}

	public function get_icon() {
		return 'eicon-globe';
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'astroway_tis_content',
			[
				'label' => __( 'Sections', 'astroway-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_signs',
			[
				'label'        => __( 'Show Sun/Moon zodiac signs', 'astroway-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '1',
			]
		);
		$this->add_control(
			'show_retrograde',
			[
				'label'        => __( 'Show Mercury retrograde indicator', 'astroway-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '1',
			]
		);
		$this->add_control(
			'show_planetary_hour',
			[
				'label'        => __( 'Show planetary hour (requires location)', 'astroway-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '0',
			]
		);
		$this->add_control(
			'lat',
			[
				'label'     => __( 'Latitude', 'astroway-elementor' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'show_planetary_hour' => '1' ],
			]
		);
		$this->add_control(
			'lon',
			[
				'label'     => __( 'Longitude', 'astroway-elementor' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'show_planetary_hour' => '1' ],
			]
		);
		$this->add_control(
			'tz',
			[
				'label'     => __( 'IANA timezone', 'astroway-elementor' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'show_planetary_hour' => '1' ],
			]
		);
		$this->add_control(
			'lang',
			[
				'label' => __( 'Language', 'astroway-elementor' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();
	}

	protected function render_shortcode_atts(): array {
		$s = $this->get_settings_for_display();
		return [
			'astroway_today_in_sky',
			[
				'show_signs'          => (string) ( $s['show_signs'] ?? '1' ),
				'show_retrograde'     => (string) ( $s['show_retrograde'] ?? '1' ),
				'show_planetary_hour' => (string) ( $s['show_planetary_hour'] ?? '0' ),
				'lat'                 => (string) ( $s['lat'] ?? '' ),
				'lon'                 => (string) ( $s['lon'] ?? '' ),
				'tz'                  => (string) ( $s['tz'] ?? '' ),
				'lang'                => (string) ( $s['lang'] ?? '' ),
			],
		];
	}
}
