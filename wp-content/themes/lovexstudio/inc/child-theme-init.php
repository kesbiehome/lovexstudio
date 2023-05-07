<?php
/**
 * Theme Initialize
 *
 * @link       https://kesbie.com
 * @since      1.0.0
 * @package    Kesbie_Theme
 * @author     KESBIE <kesbie.nguyen@gmail.com>
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Kesbie_Theme
 */
class Kesbie_Theme {
  /**
   * Main instance
   *
   * @var Kesbie_Theme
   */
  private static $instance;

  /**
   * Theme environment
   *
   * @var string
   */
  private $theme_environment;

  /**
   * Get singleton instance
   *
   * @return Kesbie_Theme
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

	/**
	 * Construct
	 */
  public function __construct()
  {
    $this->theme_environment = $this->is_localhost() ? '' : '.min';
    add_action('after_setup_theme', array($this, 'load_child_theme_language'), 99);
    add_action('wp_enqueue_scripts', array($this, 'load_assets'), 30);
  }

	/**
	 * Load child theme language
	 *
	 * @return void
	 */
  public function load_child_theme_language() {
    load_child_theme_textdomain('lovexstudio', get_stylesheet_directory() . '/languages');
  }

	/**
	 * Enqueue assets
	 *
	 * @return void
	 */
  public function load_assets() {
		if (	!$this->is_localhost() ) :
    	wp_enqueue_style('kesbie-theme-frontend-css', THEME_ASSETS_URI . '/css/frontend' . $this->theme_environment . '.css', array(), THEME_VERSION);
		endif;

		wp_enqueue_script('kesbie-theme-frontend-js', THEME_ASSETS_URI . '/js/frontend' . $this->theme_environment . '.js', array(), THEME_VERSION, true);
  }

  /**
   * Check local environment
   *
   * @return bool
   */
  public function is_localhost()
  {
    return !empty($_SERVER['HTTP_X_KESBIE_THEME_HEADER']) && $_SERVER['HTTP_X_KESBIE_THEME_HEADER'] === 'development';
  }
}

Kesbie_Theme::instance();
