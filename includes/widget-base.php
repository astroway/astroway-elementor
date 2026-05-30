<?php
/**
 * Shared base class for AstroWay Elementor widgets — keeps icon/category/
 * keywords boilerplate in one place. Subclasses override get_name(),
 * get_title(), register_controls(), and render_shortcode_atts().
 *
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

abstract class WidgetBase extends \Elementor\Widget_Base {

	public function get_icon() {
		return 'eicon-star';
	}

	public function get_categories() {
		return [ Loader::category() ];
	}

	public function get_keywords() {
		return [ 'astroway', 'astrology', 'horoscope' ];
	}

	/**
	 * Subclasses must return [ shortcode_tag, atts_array ].
	 *
	 * @return array{0:string, 1:array<string,string>}
	 */
	abstract protected function render_shortcode_atts(): array;

	protected function render(): void {
		list( $tag, $atts ) = $this->render_shortcode_atts();
		$pairs              = '';
		foreach ( $atts as $k => $v ) {
			if ( '' === (string) $v ) {
				continue;
			}
			$pairs .= ' ' . $k . '="' . esc_attr( (string) $v ) . '"';
		}
		echo do_shortcode( '[' . $tag . $pairs . ']' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode output is already escaped.
	}
}
