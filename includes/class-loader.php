<?php
/**
 * Registers AstroWay widgets with Elementor's widget manager. Each widget
 * wraps the matching core shortcode via do_shortcode(), so output stays in
 * sync with the AstroWay core plugin.
 */

namespace AstroWay\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Loader {

	private const CATEGORY_SLUG = 'astroway';

	public static function boot(): void {
		add_action( 'elementor/widgets/register', [ __CLASS__, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ __CLASS__, 'register_category' ] );
	}

	public static function register_category( $elements_manager ): void {
		$elements_manager->add_category(
			self::CATEGORY_SLUG,
			[
				'title' => __( 'AstroWay', 'astroway-elementor' ),
				'icon'  => 'eicon-star',
			]
		);
	}

	/**
	 * No Today in Sky or Fortune Cookie: the api has no route behind either
	 * shortcode, so both widgets rendered nothing for visitors. They come
	 * back once the core plugin renders them again.
	 */
	public static function register_widgets( $widgets_manager ): void {
		require_once __DIR__ . '/widget-base.php';
		require_once __DIR__ . '/widget-natal.php';
		require_once __DIR__ . '/widget-daily-horoscope.php';
		require_once __DIR__ . '/widget-moon-phase.php';
		require_once __DIR__ . '/widget-bodygraph.php';
		require_once __DIR__ . '/widget-tarot-card.php';

		$widgets_manager->register( new WidgetNatal() );
		$widgets_manager->register( new WidgetDailyHoroscope() );
		$widgets_manager->register( new WidgetMoonPhase() );
		$widgets_manager->register( new WidgetBodygraph() );
		$widgets_manager->register( new WidgetTarotCard() );
	}

	public static function category(): string {
		return self::CATEGORY_SLUG;
	}
}
