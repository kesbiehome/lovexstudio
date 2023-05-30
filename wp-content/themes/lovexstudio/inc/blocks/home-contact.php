<?php

class home_contact extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
     * @var home_contact
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @return home_contact
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

        $this->block_name = 'home-contact';
        $this->block_slug = 'home-contact';
        $this->block_title = __('Home Contact', 'lovexstudio');
        $this->fields = [
            // Settings
        ];

        parent::__construct();
    }
}

home_contact::instance();
