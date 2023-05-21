<?php

/**
 * Class for Admin UI
 *
 * @package Kesbie_Toolkit
 * @subpackage Kesbie_Toolkit_Assets
 * @author  CODE TOT JSC <dev@codetot.com>
 * @since   1.0.0
 */
class Kesbie_Toolkit_Assets
{
    /**
     * Singleton instance
     *
     * @var Kesbie_Toolkit_Assets
     */
    private static $instance;

    /**
     * @var string
     */
    private $theme_version;

    /**
     * @var string
     */
    private $plugin_environment;

    public final static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->theme_version = $this->is_localhost() ? substr(sha1(rand()), 0, 6) : KESBIE_TOOLKIT_VERSION;
        $this->plugin_environment = $this->is_localhost() ? '' : '.min';

        add_action('wp_enqueue_scripts', array($this, 'load_assets'), 25);
    }

        /**
     * Load assets in admin assets
     *
     * @return void
     */
    public function load_assets()
    {
        if (!$this->is_localhost()) {
            wp_enqueue_style('kesbie-legacy-frontend-style', KESBIE_TOOLKIT_PLUGIN_URI . '/assets/css/legacy-frontend.min.css', array(), $this->theme_version);
        } else {
            wp_enqueue_script('kesbie-legacy-frontend-script', KESBIE_TOOLKIT_PLUGIN_URI . '/assets/js/legacy-frontend' . $this->plugin_environment . '.js', array(), $this->theme_version);
        }
    }

    public function is_localhost()
    {
        return !empty($_SERVER['HTTP_X_KESBIE_TOOLKIT_HEADER']) && $_SERVER['HTTP_X_KESBIE_TOOLKIT_HEADER'] === 'development';
    }
}
