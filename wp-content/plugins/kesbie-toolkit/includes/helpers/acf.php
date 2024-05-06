<?php

class ACF_Init
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'register_option_pages']);
        add_action('init', [$this, 'register_blocks']);
    }

    function register_option_pages()
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page(array(
            'page_title'    => __('Page Settings', 'mm-today'),
            'menu_title'    => __('Page Settings', 'mm-today'),
            'menu_slug'     => 'settings',
            'capability'    => 'edit_posts',
			'position'   => 120,
            'redirect'      => false
        ));
    }

    function register_blocks()
    {
        $blocks = array(
            'post-grid',
            'post-list',
            'post-slider',
            'post-news'
        );

        foreach ($blocks as $block) {
            register_block_type(THEME_BLOCKS_DIR . '/' . $block);
        }
    }
}

new ACF_Init();
