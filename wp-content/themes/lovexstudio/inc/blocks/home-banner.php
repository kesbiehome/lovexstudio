<?php

class Home_banner extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Home_banner
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Home_banner
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

    $this->block_name = 'home-banner';
    $this->block_slug = 'home-banner';
    $this->block_title = __('Home Banner', 'lovexstudio');
    $this->fields = [
      // Settings
      'images',
      'text'
    ];

    parent::__construct();
  }
}

Home_banner::instance();
