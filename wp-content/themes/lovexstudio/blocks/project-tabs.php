<?php

if (empty($project_category)) {
    return;
}

$tabs = [];

foreach ($project_category as $category) {
    $category_id = $category->term_id;
    $category_name = $category->name;

    $thumbnail_id = get_field('category_thumbnail', 'project_cat_' . $category_id);

    if (empty($thumbnail_id)) {
        continue;
    }

    ob_start();
    the_block('image', [
        'image' => $thumbnail_id,
        'size' => 'thumbnail',
        'class' => 'image--square image--contain tab-thumbnail'
    ])
        ?>
    <div class="tab-title">
        <?php echo $category_name ?>
    </div>
    <?php

    $tab_html = ob_get_clean();

    $tab_content = get_block(
        'project-tabs-item',
        [
            'category_id' => $category_id,
            'posts_per_page' => $number_of_projects,
            'has_load_more' => $load_more
        ]
    );

    $tabs[] = [
        'name' => $tab_html,
        'content' => $tab_content
    ];
}

$content = kesbie_generate_tabs($tabs);

if (!empty($button['title']) && !empty($button['url'])) {
    ob_start(); ?>
    <div class="project-tabs__button">
        <a href="<?php echo esc_url($button['url']) ?>" class="project-tabs__link">
            <span class="project-tabs__link--hover">

            </span>
            <span class="project-tabs__link--text">
                <?php echo esc_html($button['title']); ?>
            </span>
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