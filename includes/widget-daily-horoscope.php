<?php
/**
 * Elementor wrapper for [astroway_daily_horoscope] shortcode.
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

class WidgetDailyHoroscope extends WidgetBase {

	public function get_name() {
		return 'astroway-daily-horoscope';
	}

	public function get_title() {
		return __( 'AstroWay Daily Horoscope', 'astroway-elementor' );
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'astroway_dh_content',
			[
				'label' => __( 'Content', 'astroway-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'sign',
			[
				'label'   => __( 'Zodiac sign', 'astroway-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''            => __( 'Pick a sign', 'astroway-elementor' ),
					'aries'       => __( 'Aries', 'astroway-elementor' ),
					'taurus'      => __( 'Taurus', 'astroway-elementor' ),
					'gemini'      => __( 'Gemini', 'astroway-elementor' ),
					'cancer'      => __( 'Cancer', 'astroway-elementor' ),
					'leo'         => __( 'Leo', 'astroway-elementor' ),
					'virgo'       => __( 'Virgo', 'astroway-elementor' ),
					'libra'       => __( 'Libra', 'astroway-elementor' ),
					'scorpio'     => __( 'Scorpio', 'astroway-elementor' ),
					'sagittarius' => __( 'Sagittarius', 'astroway-elementor' ),
					'capricorn'   => __( 'Capricorn', 'astroway-elementor' ),
					'aquarius'    => __( 'Aquarius', 'astroway-elementor' ),
					'pisces'      => __( 'Pisces', 'astroway-elementor' ),
				],
				'default' => '',
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
			'astroway_daily_horoscope',
			[
				'sign' => (string) ( $s['sign'] ?? '' ),
				'lang' => (string) ( $s['lang'] ?? '' ),
			],
		];
	}
}
