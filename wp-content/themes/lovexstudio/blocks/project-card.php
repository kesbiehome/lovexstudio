<?php

$class = 'project-card';
$class .= isset($is_large_card) ? ' large-card' : '';

$image_class = isset($is_large_card) ? 'image--large image--cover' : 'image--square image--cover';

$data = get_project_data_by_id($project_id);

$partner_id = null;
$partner_name = null;
$partner_avatar_id = null;
if (!empty($data['project_partner'])) {
    $partner_id = $data['project_partner']->term_id;
    $partner_name = $data['project_partner']->name;
    $partner_avatar_id = get_field('image', 'partner_' . $partner_id);
}

?>

<div class="<?php echo esc_attr($class); ?>" data-aos="fade-up">
    <a class="project-card__link" href="<?php echo esc_url($data['project_url']); ?>">
        <?php
        if (!empty($data['project_title'])) :

        ?>
            <div class="project-card__info">
                <div class="project-card__info--right">
                    <div class="project-card__title">
                        <?php echo esc_html($data['project_title']); ?>
                    </div>
                </div>
            </div>
        <?php

        endif;
        the_block('image', [
            'image' => $data['project_thumbnail'],
            'size' => [700, 700],
            'class' => $image_class,
            'lazyload' => true
        ]);
        ?>
    </a>
</div>
