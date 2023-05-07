<?php

class Banner extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Banner
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Banner
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

    $this->block_name = 'banner';
    $this->block_slug = 'banner';
    $this->block_title = __('Banner', 'lovexstudio');
    $this->fields = [
      // Settings
    ];

    parent::__construct();
  }
}

Banner::instance();
