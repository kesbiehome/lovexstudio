<?php

$term_link = get_term_link($category_id);

$project_data = get_project_by_term_id($category_id, $posts_per_page);
$project_ids = $project_data['project_ids'] ?? [];
$max_num_pages = $project_data['project_ids'] ?? 0;

$data_set = [
    'termID' => (int) $category_id,
    'postsPerPage' => (int) $posts_per_page,
    'paged' => 1
];

$load_more_available = $has_load_more && $max_num_pages > 1;

?>

<div class="project-tabs__item" <?php echo $load_more_available ? 'data-child-block="load-more-projects"' : '' ?>>
    <?php
    the_block(
        'project-grid',
        [
            'posts_per_page' => $posts_per_page,
            'has_load_more' => $has_load_more,
            'project_ids' => $project_ids
        ]
    );
    if ($load_more_available) {
        ?>
        <div class="project-tabs__item--footer">
            <button class="project-tabs__item--button js-button" data-set='<?php echo json_encode($data_set); ?>'>
                <?php echo esc_html__('Load more', 'lovexstudio'); ?>
            </button>
        </div>
        <?php
    }
    ?>
</div>