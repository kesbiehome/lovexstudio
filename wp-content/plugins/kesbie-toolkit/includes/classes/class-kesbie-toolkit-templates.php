<?php
/**
 * @package    Kesbie_Toolkit
 * @subpackage Kesbie_Toolkit_Templates
 * @author     Kesbie <kesbie.nguyen@gmail.com>
 * @since      1.0.0
 */
class Kesbie_Toolkit_Templates {
  /**
   * Singleton instance
   *
   * @var Kesbie_Toolkit_Templates
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Kesbie_Toolkit_Templates
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

	public function __construct() {
		add_action('template_include', array($this, 'template_include'));
		add_action('theme_page_templates', array($this, 'page_templates'));
	}

	/**
	 * Add custom page template to load on frontend
	 *
	 * @param string $template
	 * @return void
	 */
	public function template_include($template) {
	  if (is_page()) {
      $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );

      if ($page_template === 'flexible') {
        $template = KESBIE_TOOLKIT_DIR . '/includes/templates/page-flexible.php';
      }
    }

	  return $template;
  }

	/**
	 * Add custom page template in page editing screen
	 *
	 * @param array $post_templates
	 * @return array
	 */
  public function page_templates($post_templates) {
    $post_templates['flexible'] = __('Block Page', 'kesbie-toolkit');

    return $post_templates;
  }
}
