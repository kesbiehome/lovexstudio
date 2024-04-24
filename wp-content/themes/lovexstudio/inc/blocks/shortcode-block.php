<?php

class Shortcode_Block extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Shortcode_Block
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Shortcode_Block
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

    $this->block_name = 'shortcode-block';
    $this->block_slug = 'shortcode_block';
    $this->block_title = __('Shortcode Block', 'lovexstudio');
    $this->fields = [
      // Settings
      'shortcode',
    ];

    parent::__construct();
  }
}

Shortcode_Block::instance();
