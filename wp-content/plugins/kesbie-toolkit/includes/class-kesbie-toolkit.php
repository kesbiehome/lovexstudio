<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://kesbie.com
 * @since      1.0.0
 *
 * @package    Kesbie_Toolkit
 * @subpackage Kesbie_Toolkit/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Kesbie_Toolkit
 * @subpackage Kesbie_Toolkit/includes
 * @author     Kesbie <kesbie.nguyen@gmail.com>
 */

class Kesbie_Toolkit
{
  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Kesbie_Toolkit_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * @var array
   */
  private $custom_theme_blocks;

  /**
   * @var array
   */
  private $custom_theme_settings;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct()
  {
    $this->plugin_name = KESBIE_TOOLKIT_PLUGIN_NAME;
    $this->version = KESBIE_TOOLKIT_VERSION;
    $this->load_dependencies();

		Kesbie_Toolkit_Admin::instance();
    Kesbie_Toolkit_Templates::instance();

    if (kesbie_is_supported_theme()) {
      $this->custom_theme_settings = $this->get_custom_theme_settings();
      $this->custom_theme_blocks = $this->get_custom_theme_blocks();
    }

    if (kesbie_is_supported_theme() && !empty($this->custom_theme_blocks)) {
      $this->register_custom_theme_block_classes();
    }

    add_action('plugins_loaded', array($this, 'load_all_blocks_paths'));
  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
   * - Plugin_Name_i18n. Defines internationalization functionality.
   * - Plugin_Name_Admin. Defines all hooks for the admin area.
   * - Plugin_Name_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies()
  {
    include_once KESBIE_TOOLKIT_DIR . 'includes/helpers/blocks.php';
    include_once KESBIE_TOOLKIT_DIR . 'includes/helpers/data.php';
    include_once KESBIE_TOOLKIT_DIR . 'includes/helpers/utils.php';
    include_once KESBIE_TOOLKIT_DIR . 'includes/helpers/generator.php';

    require_once KESBIE_TOOLKIT_DIR . 'includes/classes/class-kesbie-toolkit-block.php';
    require_once KESBIE_TOOLKIT_DIR . 'includes/classes/interface-kesbie-toolkit-block.php';

    // ACF
    require_once KESBIE_TOOLKIT_DIR . 'includes/classes/class-kesbie-toolkit-templates.php';
    require_once KESBIE_TOOLKIT_DIR . 'includes/classes/class-kesbie-toolkit-page.php';
    require_once KESBIE_TOOLKIT_DIR . 'includes/classes/class-kesbie-toolkit-admin.php';
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader()
  {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version()
  {
    return $this->version;
  }

  public function load_all_blocks_paths()
  {
    add_filter('kesbie_theme_blocks_paths', array($this, 'update_theme_blocks_paths'));
    add_filter('kesbie_theme_blocks_parts_paths', array($this, 'update_theme_blocks_parts_paths'));
    add_filter('kesbie_theme_blocks_inc_paths', array($this, 'update_theme_blocks_includes_paths'));
  }

  public function get_missing_block_name_message($block_name)
  {
    $error = new WP_Error('404', sprintf(__('Missing block class %s. Please contact Web Administrator.', 'ct-blocks'), $block_name));

    return $error->get_error_message();
  }

  public function get_custom_theme_settings()
  {
    return kesbie_load_json_array(get_stylesheet_directory() . '/blocks.json');
  }

  public function get_custom_theme_blocks()
  {
    return !empty($this->custom_theme_settings['blocks']) ? $this->custom_theme_settings['blocks'] : [];
  }

  public function register_custom_theme_block_classes()
  {

		if (empty($this->custom_theme_blocks)) {
			return;
    }

    foreach ($this->custom_theme_blocks as $block_name) {
      $file_path = get_stylesheet_directory() . '/inc/blocks/' . esc_attr($block_name) . '.php';

      if (file_exists($file_path)) {
        require_once $file_path;
      } else {
        echo $this->get_missing_block_name_message($block_name);
      }
    }
  }

  public function update_theme_blocks_paths($paths)
  {
    if (kesbie_is_supported_theme() && !empty($this->custom_theme_settings['blocks_path'])) {
      $paths[] = get_stylesheet_directory() . '/' . esc_attr($this->custom_theme_settings['blocks_path']);
    }

    // if (is_child_theme()) {
    //   $paths[] = get_template_directory() . '/blocks';
    // }

    $paths[] = KESBIE_TOOLKIT_DIR . 'blocks';

    return $paths;
  }

  public function update_theme_blocks_parts_paths($paths)
  {
    if (kesbie_is_supported_theme() && !empty($this->custom_theme_settings['blocks_part'])) {
      $paths[] = get_stylesheet_directory() . '/' . esc_attr($this->custom_theme_settings['blocks_part']);
    }

    // if (is_child_theme()) {
    //   $paths[] = get_template_directory() . '/block-parts';
    // }

    return $paths;
  }

  public function update_theme_blocks_includes_paths($paths)
  {
    if (kesbie_is_supported_theme() && !empty($this->custom_theme_settings['blocks_inc'])) {
      $paths[] = get_stylesheet_directory() . '/' . $this->custom_theme_settings['blocks_inc'];
    }

    // if (is_child_theme()) {
    //   $paths[] = get_template_directory() . '/inc/blocks';
    // }

    return $paths;
  }
}
