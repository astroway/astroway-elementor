<?php
/**
 * Elementor wrapper for [astroway_tarot_card] shortcode.
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

class WidgetTarotCard extends WidgetBase {

	public function get_name() {
		return 'astroway-tarot-card';
	}

	public function get_title() {
		return __( 'AstroWay Daily Tarot', 'astroway-elementor' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'astroway_tarot_content',
			[
				'label' => __( 'Content', 'astroway-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'deck',
			[
				'label'   => __( 'Deck', 'astroway-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'rider-waite' => 'Rider-Waite',
					'marseille'   => 'Marseille',
					'lenormand'   => 'Lenormand',
				],
				'default' => 'rider-waite',
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
			'astroway_tarot_card',
			[
				'deck' => (string) ( $s['deck'] ?? 'rider-waite' ),
				'lang' => (string) ( $s['lang'] ?? '' ),
			],
		];
	}
}
