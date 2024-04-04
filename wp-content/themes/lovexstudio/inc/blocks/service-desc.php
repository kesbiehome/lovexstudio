<?php

class Service_Desc extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Service_Desc
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Service_Desc
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

    $this->block_name = 'service-desc';
    $this->block_slug = 'service_desc';
    $this->block_title = __('Service Description', 'lovexstudio');
    $this->fields = [
      // Settings
      'desc'
    ];

    parent::__construct();
  }
}

Service_Desc::instance();
