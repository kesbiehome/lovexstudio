<?php

if (empty($project_category)) {
    return;
}

$tabs = [];

foreach ($project_category as $category) {
    $category_id = $category->term_id;
    $category_name = $category->name;

    $tab_content = get_block(
        'project-tabs-item',
        [
            'category_id' => $category_id,
            'posts_per_page' => $number_of_projects,
            'has_load_more' => $load_more
        ]
    );

    $tabs[] = [
        'name' => $category_name,
        'content' => $tab_content
    ];
}

$content = kesbie_generate_tabs($tabs);

if (!empty($button['title']) && !empty($button['url'])) {
    ob_start(); ?>
    <div class="project-tabs__button">
        <a href="<?php echo esc_url($button['url']) ?>" class="project-tabs__link">
            <?php echo esc_html($button['title']); ?>
        </a>
    </div>
    <?php
    $footer = ob_get_clean();
}

the_block(
    'default-section',
    [
        'attributes' => 'data-aos="fade-up" data-child-block="project-tabs"',
        'class' => $_class . 'bg-dark project-tabs',
        'header' => $title ?? '',
        'content' => $content ?? '',
        'footer' => $footer ?? ''
    ]
);
