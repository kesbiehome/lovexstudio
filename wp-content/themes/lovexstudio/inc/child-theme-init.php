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
if (!defined('ABSPATH')) exit;

/**
 * Class Kesbie_Theme
 */
class Kesbie_Theme
{
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
		add_action('init', [$this, 'custom_post_type'], 0);
		add_action('init', [$this, 'custom_taxonomy'], 0);
		add_action('acf/init', [$this, 'my_acf_op_init'], 0);
		add_action('after_setup_theme', [$this, 'load_child_theme_language'], 99);
		add_action('wp_enqueue_scripts', [$this, 'load_assets'], 30);
	}

	/**
	 * Load child theme language
	 *
	 * @return void
	 */
	public function load_child_theme_language()
	{
		load_child_theme_textdomain('lovexstudio', get_stylesheet_directory() . '/languages');
	}

	/**
	 * Enqueue assets
	 *
	 * @return void
	 */
	public function load_assets()
	{
		if (!$this->is_localhost()) :
			wp_enqueue_style('kesbie-theme-frontend-css', THEME_ASSETS_URI . '/css/frontend' . $this->theme_environment . '.css', array(), THEME_VERSION);
		endif;

		wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', [], '8.4.7');
		wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper.min.css', [], '9.1.0');

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

	// Register Custom Post Type
	function custom_post_type()
	{
		$labels = array(
			'name'                  => _x('Projects', 'Post Type General Name', 'lovexstudio'),
			'singular_name'         => _x('Project', 'Post Type Singular Name', 'lovexstudio'),
			'menu_name'             => __('Projects', 'lovexstudio'),
			'name_admin_bar'        => __('Project', 'lovexstudio'),
			'archives'              => __('Item Archives', 'lovexstudio'),
			'attributes'            => __('Item Attributes', 'lovexstudio'),
			'parent_item_colon'     => __('Parent Item:', 'lovexstudio'),
			'all_items'             => __('All Items', 'lovexstudio'),
			'add_new_item'          => __('Add New Item', 'lovexstudio'),
			'add_new'               => __('Add New', 'lovexstudio'),
			'new_item'              => __('New Item', 'lovexstudio'),
			'edit_item'             => __('Edit Item', 'lovexstudio'),
			'update_item'           => __('Update Item', 'lovexstudio'),
			'view_item'             => __('View Item', 'lovexstudio'),
			'view_items'            => __('View Items', 'lovexstudio'),
			'search_items'          => __('Search Item', 'lovexstudio'),
			'not_found'             => __('Not found', 'lovexstudio'),
			'not_found_in_trash'    => __('Not found in Trash', 'lovexstudio'),
			'featured_image'        => __('Featured Image', 'lovexstudio'),
			'set_featured_image'    => __('Set featured image', 'lovexstudio'),
			'remove_featured_image' => __('Remove featured image', 'lovexstudio'),
			'use_featured_image'    => __('Use as featured image', 'lovexstudio'),
			'insert_into_item'      => __('Insert into item', 'lovexstudio'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'lovexstudio'),
			'items_list'            => __('Items list', 'lovexstudio'),
			'items_list_navigation' => __('Items list navigation', 'lovexstudio'),
			'filter_items_list'     => __('Filter items list', 'lovexstudio'),
		);

		$args = array(
			'label'                 => __('Project', 'lovexstudio'),
			'description'           => __('About Love X Studio projects', 'lovexstudio'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'menu_icon'           	=> 'dashicons-images-alt2',
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);

		register_post_type('project', $args);
	}

	function my_acf_op_init()
	{
		// Check function exists.
		if (function_exists('acf_add_options_page')) {

			// Register options page.
			$option_page = acf_add_options_page(array(
				'page_title'    => __('Page Options'),
				'menu_title'    => __('Page Options'),
				'menu_slug'     => 'options',
				'capability'    => 'edit_posts',
				'redirect'      => false
			));

			$sub_page = acf_add_options_sub_page(array(
				'page_title'  => __('404 pages'),
				'menu_title'  => __('404 pages'),
				'parent_slug' => $option_page['menu_slug'],
				'menu_slug'	  => 'error_page'
			));
		}
	}

	function custom_taxonomy()
	{
		$labels = array(
			'name'                       => _x('Categories', 'Taxonomy General Name', 'lovexstudio'),
			'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'lovexstudio'),
			'menu_name'                  => __('Category', 'lovexstudio'),
			'all_items'                  => __('All Items', 'lovexstudio'),
			'parent_item'                => __('Parent Item', 'lovexstudio'),
			'parent_item_colon'          => __('Parent Item:', 'lovexstudio'),
			'new_item_name'              => __('New Item Name', 'lovexstudio'),
			'add_new_item'               => __('Add New Item', 'lovexstudio'),
			'edit_item'                  => __('Edit Item', 'lovexstudio'),
			'update_item'                => __('Update Item', 'lovexstudio'),
			'view_item'                  => __('View Item', 'lovexstudio'),
			'separate_items_with_commas' => __('Separate items with commas', 'lovexstudio'),
			'add_or_remove_items'        => __('Add or remove items', 'lovexstudio'),
			'choose_from_most_used'      => __('Choose from the most used', 'lovexstudio'),
			'popular_items'              => __('Popular Items', 'lovexstudio'),
			'search_items'               => __('Search Items', 'lovexstudio'),
			'not_found'                  => __('Not Found', 'lovexstudio'),
			'no_terms'                   => __('No items', 'lovexstudio'),
			'items_list'                 => __('Items list', 'lovexstudio'),
			'items_list_navigation'      => __('Items list navigation', 'lovexstudio'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
		);

		register_taxonomy('project_cat', array('project'), $args);
	}
}

Kesbie_Theme::instance();
