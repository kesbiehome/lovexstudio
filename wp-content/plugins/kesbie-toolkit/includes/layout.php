<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Kesbie_Toolkit_Theme_Layout {

	/**
	 * Singleton instance
	 *
	 * @var Kesbie_Toolkit_Theme_Layout
	 */
	private static $instance;

	/**
	 * Get singleton instance.
	 *
	 * @return Kesbie_Toolkit_Theme_Layout
	 */
	final public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class constructor
	 */
	private function __construct() {

	}
}
Kesbie_Toolkit_Theme_Layout::instance();
