<?php

class contact_page extends Kesbie_Toolkit_Block implements Kesbie_Toolkit_Block_Interface
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
     * @var contact_page
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @return contact_page
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

        $this->block_name = 'contact-page';
        $this->block_slug = 'contact-page';
        $this->block_title = __('Contact Page', 'lovexstudio');
        $this->fields = [
            "image",
            "description",
            "phone",
            "email",
            "address"
            // Settings
        ];

        parent::__construct();
    }
}

contact_page::instance();
