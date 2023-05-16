<?php

class About_Us extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var About_Us
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return About_Us
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

    $this->block_name = 'about-us';
    $this->block_slug = 'about_us';
    $this->block_title = __('About Us', 'lovexstudio');
    $this->fields = [
      // Settings
      'image',
      'desc',
      'rows',
    ];

    parent::__construct();
  }
}

About_Us::instance();
