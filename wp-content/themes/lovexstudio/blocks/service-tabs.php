<?php
if (empty($services)) return;

$tab = [];

foreach ($services as $service) :
    $service_id = $service->term_id;
    $service_name = $service->name;
    $desc = $service->description;
    $slug = $service->slug;

    if (empty($service_name) || empty($service_id)) continue;

    ob_start(); ?>

    <span class="service-tab-title" id="<?php esc_attr_e('service_'.$slug) ?>">
        <?php esc_html_e($service_name);  ?>
    </span>

<?php

    $tab_html = ob_get_clean();

    $tab_content = get_block(
        'service-tabs-item',
        [
            'service_id' => $service_id,
            'name' => $service_name,
            'desc' => $desc,
            'slug' => $slug,
        ]
    );

    $tabs[] = [
        'name' => $tab_html,
        'content' => $tab_content
    ];

endforeach;

$content = kesbie_generate_tabs($tabs);

the_block(
    'default-section',
    [
        'attributes' => 'data-aos="fade-up" data-child-block="service-tabs"',
        'class' => 'service-tabs',
        'header' => $title ?? '',
        'content' => $content ?? '',
    ]
);
