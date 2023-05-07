<?php
/**
 * Main functions
 *
 * @link       https://kesbie.com
 * @since      1.0.0
 * @package    Kesbie_Custom_Theme
 * @author     Kesbie <kesbie.nguyen@gmail.com>
 */

if (!defined('ABSPATH')) exit;

define( 'THEME_INCLUDES_DIR', get_stylesheet_directory() . '/inc' );
define( 'THEME_ASSETS_URI', get_stylesheet_directory_uri() . '/assets' );
define( 'THEME_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );

add_action('after_setup_theme', 'theme_load_dependencies');

/**
 * Load child theme dependencies
 *
 * @return void
 */
function theme_load_dependencies() {
  require_once THEME_INCLUDES_DIR . '/child-theme-init.php';
}
