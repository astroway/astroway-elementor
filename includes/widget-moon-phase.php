<?php
/**
 * Elementor wrapper for [astroway_moon_phase] shortcode.
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

class WidgetMoonPhase extends WidgetBase {

	public function get_name() {
		return 'astroway-moon-phase';
	}

	public function get_title() {
		return __( 'AstroWay Moon Phase', 'astroway-elementor' );
	}

	public function get_icon() {
		return 'eicon-circle';
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'astroway_moon_content',
			[
				'label' => __( 'Content', 'astroway-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'date',
			[
				'label'       => __( 'Date (YYYY-MM-DD, blank = today)', 'astroway-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'today',
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
			'astroway_moon_phase',
			[
				'date' => (string) ( $s['date'] ?? '' ),
				'lang' => (string) ( $s['lang'] ?? '' ),
			],
		];
	}
}
