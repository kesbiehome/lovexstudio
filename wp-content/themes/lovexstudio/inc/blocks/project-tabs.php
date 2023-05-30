<?php

class Project_Tabs extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
   * @var Project_Tabs
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Project_Tabs
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

    $this->block_name = 'project-tabs';
    $this->block_slug = 'project_tabs';
    $this->block_title = __('Project Tabs', 'lovexstudio');
    $this->fields = [
      // Settings
      'title',
      'project_category',
      'number_of_projects',
      'button',
      'load_more'
    ];

    parent::__construct();
  }
}

Project_Tabs::instance();
