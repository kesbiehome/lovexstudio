<?php

function get_project_data_by_id($post_id = null){
    $id = $post_id;

    if (!$post_id) {
        $id =  get_the_ID();
    }

    $data = get_post($id);

    if (!$data) {
        return;
    }

    $title =  $data->post_title;
    $post_url = get_permalink($id);
    $post_gallery_ids = [];

    $gallery = get_field('gallery', $id);

    if (!empty($gallery)) {
        $post_gallery_ids = array_column($gallery, 'image');
    }
}

function get_project_gallery($post_id){

}