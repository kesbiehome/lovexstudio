<?php
if (empty($services)) return;

ob_start();
?>
<div class="service-list__content">
    <?php

    foreach ($services as $index => $service) :
        $service_id = $service->term_id;
        $service_name = $service->name;
        $desc = $service->description;
        $slug = $service->slug;
        $revert = false;
        if ((($index + 1) % 2) == 0) :
            $revert = true;
        endif;
        if (empty($service_name) || empty($service_id)) continue;

        $tab_content = the_block(
            'service-list-item',
            [
                'service_id' => $service_id,
                'name'      => $service_name,
                'desc'      => $desc,
                'slug'      => $slug,
                'revert'    => $revert
            ]
        );
    endforeach;
    ?>
</div>
<?php

$content = ob_get_clean();

the_block(
    'default-section',
    [
        'class' => 'service-list',
        'content' => $content ?? '',
    ]
);
