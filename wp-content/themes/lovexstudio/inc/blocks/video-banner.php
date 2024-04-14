<?php

class Video_Banner extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Video_Banner
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Video_Banner
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

    $this->block_name = 'video-banner';
    $this->block_slug = 'video_banner';
    $this->block_title = __('Video Banner', 'lovexstudio');
    $this->fields = [
      // Settings
      'title',
      'video_thumbnail',
    ];

    parent::__construct();
  }
}

Video_Banner::instance();
