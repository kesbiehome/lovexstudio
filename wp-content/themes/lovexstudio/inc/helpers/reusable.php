<?php

function get_reusable_block($id)
{
    var_dump($id);
    return '';
    $content_post = get_post((int)($id));
    var_dump($content_post);
    return '';

    $content = '';

    if (!empty($content_post)) {
        $content = $content_post->post_content;
    }
    return $content;
}

function display_reusable_block($id)
{
    echo apply_filters('the_content', get_reusable_block($id));
}

function reusable_shortcode($atts)
{
    extract(
        shortcode_atts(
            array(
                'id' => ''
            ),
            $atts
        )
    );

    if (empty($id)) {
        return;
    }

    $content = apply_filters('the_content', get_reusable_block($id));
    return $content;
}

add_shortcode('reusable', 'reusable_shortcode');
