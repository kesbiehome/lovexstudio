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
if (!defined('ABSPATH'))
	exit;

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
		add_action('init', [$this, 'custom_tag'], 0);
		add_action('acf/init', [$this, 'my_acf_op_init'], 0);
		add_action('after_setup_theme', [$this, 'load_child_theme_language'], 99);
		add_action('wp_enqueue_scripts', [$this, 'load_assets'], 30);
		add_action('generate_before_header', [$this, 'render_loader']);
		add_action('generate_inside_slideout_navigation', [$this, 'logo_mobile_header_menu'], 1);
		add_action('generate_inside_slideout_navigation', [$this, 'social_links_shortcode']);
		add_filter('generate_svg_icon', [$this, 'change_svg_icon_slideout_menu'], 10, 2);
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
		if (!$this->is_localhost()):
			wp_enqueue_style('kesbie-theme-frontend-css', THEME_ASSETS_URI . '/css/frontend' . $this->theme_environment . '.css', array(), THEME_VERSION);
		endif;

		wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', [], '2.3.1');
		wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', [], '8.4.7');
		wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper.min.css', [], '9.1.0');
		wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', [], '5.0');

		wp_enqueue_script('kesbie-theme-frontend-js', THEME_ASSETS_URI . '/js/frontend' . $this->theme_environment . '.js', array(), THEME_VERSION, true);
		wp_localize_script('kesbie-theme-frontend-js', 'lovexstudioConfig', [
			'restUrl' => get_rest_url(null, '/'),
			'loadMoreProjectsApi' => 'lovexstudio/v1/loadMoreProjects'
		]);
		wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', [], '5.0');
		wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], '2.3.1');
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
			'name' => _x('Projects', 'Post Type General Name', 'lovexstudio'),
			'singular_name' => _x('Project', 'Post Type Singular Name', 'lovexstudio'),
			'menu_name' => __('Projects', 'lovexstudio'),
			'name_admin_bar' => __('Project', 'lovexstudio'),
			'archives' => __('Item Archives', 'lovexstudio'),
			'attributes' => __('Item Attributes', 'lovexstudio'),
			'parent_item_colon' => __('Parent Item:', 'lovexstudio'),
			'all_items' => __('All Items', 'lovexstudio'),
			'add_new_item' => __('Add New Item', 'lovexstudio'),
			'add_new' => __('Add New', 'lovexstudio'),
			'new_item' => __('New Item', 'lovexstudio'),
			'edit_item' => __('Edit Item', 'lovexstudio'),
			'update_item' => __('Update Item', 'lovexstudio'),
			'view_item' => __('View Item', 'lovexstudio'),
			'view_items' => __('View Items', 'lovexstudio'),
			'search_items' => __('Search Item', 'lovexstudio'),
			'not_found' => __('Not found', 'lovexstudio'),
			'not_found_in_trash' => __('Not found in Trash', 'lovexstudio'),
			'featured_image' => __('Featured Image', 'lovexstudio'),
			'set_featured_image' => __('Set featured image', 'lovexstudio'),
			'remove_featured_image' => __('Remove featured image', 'lovexstudio'),
			'use_featured_image' => __('Use as featured image', 'lovexstudio'),
			'insert_into_item' => __('Insert into item', 'lovexstudio'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'lovexstudio'),
			'items_list' => __('Items list', 'lovexstudio'),
			'items_list_navigation' => __('Items list navigation', 'lovexstudio'),
			'filter_items_list' => __('Filter items list', 'lovexstudio'),
		);

		$args = array(
			'label' => __('Project', 'lovexstudio'),
			'description' => __('About Love X Studio projects', 'lovexstudio'),
			'labels' => $labels,
			'supports' => array('title', 'excerpt', 'thumbnail'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'menu_icon' => 'dashicons-images-alt2',
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'show_in_rest' => true,
		);

		register_post_type('project', $args);
	}

	function my_acf_op_init()
	{
		// Check function exists.
		if (function_exists('acf_add_options_page')) {

			// Register options page.
			$option_page = acf_add_options_page(
				array(
					'page_title' => __('Page Options'),
					'menu_title' => __('Page Options'),
					'menu_slug' => 'options',
					'capability' => 'edit_posts',
					'redirect' => false
				)
			);

			$sub_page = acf_add_options_sub_page(
				array(
					'page_title' => __('404 pages'),
					'menu_title' => __('404 pages'),
					'parent_slug' => $option_page['menu_slug'],
					'menu_slug' => 'error_page'
				)
			);
		}
	}

	function custom_taxonomy()
	{
		$labels = array(
			'name' => _x('Categories', 'Taxonomy General Name', 'lovexstudio'),
			'singular_name' => _x('Category', 'Taxonomy Singular Name', 'lovexstudio'),
			'menu_name' => __('Category', 'lovexstudio'),
			'all_items' => __('All Items', 'lovexstudio'),
			'parent_item' => __('Parent Item', 'lovexstudio'),
			'parent_item_colon' => __('Parent Item:', 'lovexstudio'),
			'new_item_name' => __('New Item Name', 'lovexstudio'),
			'add_new_item' => __('Add New Item', 'lovexstudio'),
			'edit_item' => __('Edit Item', 'lovexstudio'),
			'update_item' => __('Update Item', 'lovexstudio'),
			'view_item' => __('View Item', 'lovexstudio'),
			'separate_items_with_commas' => __('Separate items with commas', 'lovexstudio'),
			'add_or_remove_items' => __('Add or remove items', 'lovexstudio'),
			'choose_from_most_used' => __('Choose from the most used', 'lovexstudio'),
			'popular_items' => __('Popular Items', 'lovexstudio'),
			'search_items' => __('Search Items', 'lovexstudio'),
			'not_found' => __('Not Found', 'lovexstudio'),
			'no_terms' => __('No items', 'lovexstudio'),
			'items_list' => __('Items list', 'lovexstudio'),
			'items_list_navigation' => __('Items list navigation', 'lovexstudio'),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
			'show_in_rest' => true,
		);



		register_taxonomy('project_cat', array('project'), $args);
	}

	// Register Custom Taxonomy
	function custom_tag()
	{

		$labels = array(
			'name' => _x('Tags', 'Taxonomy General Name', 'lovexstudio'),
			'singular_name' => _x('Tag', 'Taxonomy Singular Name', 'lovexstudio'),
			'menu_name' => __('Tag', 'lovexstudio'),
			'all_items' => __('All Items', 'lovexstudio'),
			'parent_item' => __('Parent Item', 'lovexstudio'),
			'parent_item_colon' => __('Parent Item:', 'lovexstudio'),
			'new_item_name' => __('New Item Name', 'lovexstudio'),
			'add_new_item' => __('Add New Item', 'lovexstudio'),
			'edit_item' => __('Edit Item', 'lovexstudio'),
			'update_item' => __('Update Item', 'lovexstudio'),
			'view_item' => __('View Item', 'lovexstudio'),
			'separate_items_with_commas' => __('Separate items with commas', 'lovexstudio'),
			'add_or_remove_items' => __('Add or remove items', 'lovexstudio'),
			'choose_from_most_used' => __('Choose from the most used', 'lovexstudio'),
			'popular_items' => __('Popular Items', 'lovexstudio'),
			'search_items' => __('Search Items', 'lovexstudio'),
			'not_found' => __('Not Found', 'lovexstudio'),
			'no_terms' => __('No items', 'lovexstudio'),
			'items_list' => __('Items list', 'lovexstudio'),
			'items_list_navigation' => __('Items list navigation', 'lovexstudio'),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
			'show_in_rest' => true,
		);
		register_taxonomy('tag', array('project'), $args);

	}

	function logo_mobile_header_menu()
	{
		$logo_id = get_theme_mod('custom_logo');

		if ($logo_id) {
			?>
			<div class="slideout-navigation__logo">
				<?php
				the_block(
					'image',
					[
						'image' => $logo_id,
						'class' => 'image--default',
						'size' => 'small'
					]
				);
				?>
			</div>
			<?php
		}
	}

	function social_links_shortcode()
	{
		$social_links = get_field('socials', 'options');

		if (!empty($social_links)) { ?>
			<div class="slideout-navigation__social-links">
				<?php echo do_shortcode('[social_links]'); ?>
			</div>
			<?php
		}
	}

	function change_svg_icon_slideout_menu($output, $icon)
	{
		if ('pro-close' === $icon) {
			$output = '<svg width="21" class="alolo" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M20.2545 2.93584C20.2484 3.22721 20.1044 3.41079 19.9309 3.58458C18.2415 5.274 16.5546 6.96548 14.8668 8.65593C14.4266 9.09685 13.9926 9.54396 13.5423 9.97353C13.3881 10.1205 13.3896 10.201 13.5407 10.3536C15.6575 12.4963 17.7677 14.6462 19.8795 16.7941C20.371 17.2943 20.371 17.6213 19.8779 18.1231C19.3457 18.6651 18.8144 19.2076 18.2817 19.7485C17.8008 20.2374 17.4757 20.2348 16.9872 19.7387C14.8922 17.6099 12.7958 15.4832 10.708 13.3477C10.5329 13.1683 10.4459 13.176 10.2749 13.3508C8.18203 15.4935 6.08099 17.628 3.98148 19.764C3.52097 20.2328 3.18106 20.2338 2.7231 19.7681C2.17252 19.2086 1.62296 18.648 1.0729 18.0875C0.630197 17.6362 0.628671 17.2778 1.06832 16.8307C3.17394 14.6885 5.28057 12.5474 7.38517 10.4047C7.65283 10.1324 7.65436 10.2056 7.39281 9.9431C5.28414 7.82979 3.17343 5.71698 1.06374 3.60315C0.604755 3.14315 0.602719 2.79093 1.0561 2.32732C1.61635 1.75387 2.17659 1.17938 2.73989 0.608507C3.13018 0.212969 3.51639 0.214001 3.91126 0.609539C6.04079 2.73936 8.17186 4.86763 10.2948 7.00416C10.4561 7.1666 10.5355 7.15835 10.6912 7.00106C12.8004 4.87485 14.9167 2.75586 17.0314 0.635324C17.4706 0.19492 17.8359 0.197499 18.2751 0.643575C18.8434 1.22115 19.4103 1.80131 19.9792 2.37889C20.1405 2.54236 20.2535 2.72698 20.2545 2.93584Z" fill="#E05701"/>
			</svg>
			';
		}
		return $output;
	}

	function render_loader()
	{
		if (is_404()) {
			return;
		}
		?>
		<div id="preloader">
			<div class="txt">
				<p class="txt-perc">0%</p>
				<div class="progress">
					<span></span>
				</div>
			</div>
		</div>
		<?php
	}
}

Kesbie_Theme::instance();
