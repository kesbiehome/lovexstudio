<?php

function get_project_by_term_id($term_id, $posts_per_page = 6, $paged = 1)
{

    $project_args = [
        'post_type' => 'project',
        'posts_per_page' => $posts_per_page,
        'fields' => 'ids',
        'paged' => $paged,
        'tax_query' => [
            [
                'taxonomy' => 'project_cat',
                'field' => 'term_id',
                'terms' => $term_id
            ]
        ]
    ];

    $project_query = new WP_Query($project_args);

    $data = [];

    if ($project_query->have_posts()) {
        $data = [
            'project_ids' => $project_query->posts,
            'max_num_pages' => $project_query->max_num_pages
        ];
    }

    return $data;
}

function get_project_data_by_id($post_id = null)
{
    $id = $post_id;

    if (!$post_id) {
        $id  =  get_the_ID();
    }

    $data = get_post($id);

    if (!$data) {
        return;
    }

    $partner_term_ids = get_the_terms($id, 'partner');

    
    $project_partner = $partner_term_ids ? $partner_term_ids[0] : false;
    $project_title =  $data->post_title;
    $project_thumbnail = get_post_thumbnail_id($id);
    $project_url = get_permalink($id);
    $project_gallery_ids = [];

    $gallery = get_field('gallery', $id);

    if (!empty($gallery)) {
        $project_gallery_ids = array_column($gallery, 'image');
    }

    return [
        'project_title' => $project_title,
        'project_thumbnail' => $project_thumbnail,
        'project_url' => $project_url,
        'project_gallery_ids' => $project_gallery_ids,
        'project_partner' => $project_partner
    ];
}
