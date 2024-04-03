<?php

class Home_Projects extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
{
  /**
   * @var string
   */
  public $block_name;
  /**
   * @var string|void
   */
  public $block_title;
  /**
   * @var string
   */
  public $block_slug;
  /**
   * @var array
   */
  public $fields;

  /**
   * Singleton instance
   *
   * @var Home_Projects
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Home_Projects
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'home-projects';
    $this->block_slug = 'home-projects';
    $this->block_title = __('Projects', 'lovexstudio');
    $this->fields = [
      // Settings
      'section_title',
      'button',
    ];

    parent::__construct();
  }
}

Home_Projects::instance();
