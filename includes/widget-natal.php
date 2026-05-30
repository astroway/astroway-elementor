<?php
/**
 * Elementor wrapper for [astroway_natal] shortcode.
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

class WidgetNatal extends WidgetBase {

	public function get_name() {
		return 'astroway-natal';
	}

	public function get_title() {
		return __( 'AstroWay Natal Chart', 'astroway-elementor' );
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'astroway_natal_data',
			[
				'label' => __( 'Birth data', 'astroway-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'date',
			[
				'label'       => __( 'Date (YYYY-MM-DD)', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '1990-05-15',
			]
		);
		$this->add_control(
			'time',
			[
				'label'       => __( 'Time (HH:MM)', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '14:30',
			]
		);
		$this->add_control(
			'lat',
			[
				'label'       => __( 'Latitude', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '50.45',
			]
		);
		$this->add_control(
			'lon',
			[
				'label'       => __( 'Longitude', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '30.52',
			]
		);
		$this->add_control(
			'tz',
			[
				'label'       => __( 'IANA timezone', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'Europe/Kyiv',
			]
		);
		$this->add_control(
			'lang',
			[
				'label'       => __( 'Language (2-letter)', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'auto',
			]
		);

		$this->end_controls_section();
	}

	protected function render_shortcode_atts(): array {
		$s = $this->get_settings_for_display();
		return [
			'astroway_natal',
			[
				'date' => (string) ( $s['date'] ?? '' ),
				'time' => (string) ( $s['time'] ?? '' ),
				'lat'  => (string) ( $s['lat'] ?? '' ),
				'lon'  => (string) ( $s['lon'] ?? '' ),
				'tz'   => (string) ( $s['tz'] ?? '' ),
				'lang' => (string) ( $s['lang'] ?? '' ),
			],
		];
	}
}
