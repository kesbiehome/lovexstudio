<?php

/**
 * Class for Admin UI
 *
 * @package Kesbie_Toolkit
 * @subpackage Kesbie_Toolkit_Admin
 * @author  CODE TOT JSC <dev@codetot.com>
 * @since   1.0.0
 */
class Kesbie_Toolkit_Admin
{
    /**
     * Singleton instance
     *
     * @var Kesbie_Toolkit_Admin
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

    /**
     * Get singleton instance.
     *
     * @return Kesbie_Toolkit_Admin
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
        $this->theme_version = $this->is_localhost() ? substr(sha1(rand()), 0, 6) : KESBIE_TOOLKIT_VERSION;
        $this->plugin_environment = $this->is_localhost() ? '' : '.min';

        add_action('admin_enqueue_scripts', array($this, 'load_assets'), 40);
        add_action('acf/input/admin_enqueue_scripts', array($this, 'load_acf_assets'));
        // add_action('load-post.php', array($this, 'flexible_block_button_metabox'));
        // add_action('load-post-new.php', array($this, 'flexible_block_button_metabox'));

        // add_action('admin_head', array($this, 'setup_admin_head_js_variables'));
    }

    /**
     * Load assets in admin assets
     *
     * @return void
     */
    public function load_assets()
    {
        if (!$this->is_localhost()) {
            wp_enqueue_style('kesbie-admin-acf-style', KESBIE_TOOLKIT_PLUGIN_URI . '/assets/css/admin.min.css', array(), $this->theme_version);
        } else {
            wp_enqueue_script('kesbie-admin-acf-script', KESBIE_TOOLKIT_PLUGIN_URI . '/assets/js/admin' . $this->plugin_environment . '.js', array(), $this->theme_version);
        }
    }

    /**
     * Load assets into acf assets hoosk
     */
    public function load_acf_assets()
    {
        global $pagenow;

        if (
            $pagenow = 'post.php' &&
            !empty($_GET['post']) &&
            !empty($_GET['action']) && $_GET['action'] === 'edit'
        ) {
            wp_enqueue_script('kesbie-admin-acf-scripts', KESBIE_TOOLKIT_PLUGIN_URI . '/assets/js/admin.min.js', array('jquery', 'acf-input', 'acf-pro-input'), KESBIE_TOOLKIT_VERSION, true);
        }
    }

    /**
     * Add hook for register metabox to post editing screen
     */
    public function flexible_block_button_metabox()
    {
        add_action('add_meta_boxes', array($this, 'register_flexible_button_metabox'));
    }

    /**
     * Register metabox block list
     *
     * @return void
     */
    public function register_flexible_button_metabox()
    {
        global $pagenow;

        if ($pagenow = 'post.php' && !empty($_GET['post']) && !empty($_GET['action']) && $_GET['action'] === 'edit') {
            add_meta_box(
                'codetot-flexible-button',
                __('Web Builder Blocks', 'ct-blocks'),
                array($this, 'render_flexible_button_metabox'),
                '',
                'side',
                'high'
            );
        }
    }

    /**
     * Render metabox for display block list
     *
     * @return void
     */
    public function render_flexible_button_metabox()
    {
        $copyright_text = sprintf(
            __('Build with <span class="ct-blocks__metabox__copyright-icon">%1$s</span> by <a href="%2$s" target="_blank">%3$s</a>', 'ct-blocks'),
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="red" d="M12 4.435c-1.989-5.399-12-4.597-12 3.568 0 4.068 3.06 9.481 12 14.997 8.94-5.516 12-10.929 12-14.997 0-8.118-10-8.999-12-3.568z"/></svg>',
            'https://codetot.com',
            esc_html__('Kesbie\'s Home', 'kesbie-toolkit')
        );
?>
        <div class="ct__block-list js-block-list"></div>
        <div class="ct__preview-block js-preview-block">
            <div class="js-preview-block-items"></div>
        </div>
        <div class="ct__svg">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                <?php echo implode(PHP_EOL, apply_filters('kesbie_toolkit_svg_icons', [])); ?>
            </svg>
        </div>
        <div class="ct-blocks__metabox__footer">
            <p class="ct-blocks__metabox__copyright"><?php echo $copyright_text; ?></p>
        </div>
<?php
    }

    /**
     * Setup custom css style inline
     *
     * @return void
     */
    public function setup_admin_head_js_variables()
    {
        $variables_css_file = KESBIE_TOOLKIT_DIR . '/variables.css';
        $block_images = apply_filters('KESBIE_TOOLKIT_preview_images', [
            'page-title' => KESBIE_TOOLKIT_PLUGIN_URI . '/assets/img/page_title.png',
            'page-content' => KESBIE_TOOLKIT_PLUGIN_URI . '/assets/img/page_content.png',
        ]);

        if (file_exists($variables_css_file)) {
            $file_content = file_get_contents($variables_css_file);

            echo '<style id="codetot-acf-variables-css">';
            echo $file_content;
            echo '</style>';
        }

        echo '<script>';
        echo 'var CODETOT_PLUGIN_URL = "' . KESBIE_TOOLKIT_PLUGIN_URI . '";' . PHP_EOL;
        echo 'var KESBIE_TOOLKIT_IMAGES = ' . json_encode($block_images) . ';';
        echo '</script>';
    }

    public function is_localhost()
    {
        return !empty($_SERVER['HTTP_X_KESBIE_TOOLKIT_HEADER']) && $_SERVER['HTTP_X_KESBIE_TOOLKIT_HEADER'] === 'development';
    }
}
