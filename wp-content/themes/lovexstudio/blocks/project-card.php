<?php

$class = 'project-card';
$class .= $is_large_card ? ' large-card' : '';

$image_size = $is_large_card ? [350, 450] : [350, 350];
$image_class = $is_large_card ? 'image--large image--cover' : 'image--square image--cover';

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
        if (!empty($data['project_partner']) && !empty($partner_avatar_id)) :

        ?>
            <div class="project-card__overlay">
                <div class="project-card__info">
                    <div class="project-card__info--left">
                        <?php
                        the_block('image', [
                            'image' => $partner_avatar_id,
                            'size' => [60, 60],
                            'class' => 'image--square project-card__partner--image',
                            'lazyload' => true
                        ]);
                        ?>
                    </div>
                    <div class="project-card__info--right">
                        <div class="project-card__title">
                            <?php echo esc_html($data['project_title']); ?>
                        </div>
                        <div class="project-card__name">
                            <?php echo esc_html($partner_name); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php

        endif;
        the_block('image', [
            'image' => $data['project_thumbnail'],
            'size' => $image_size,
            'class' => $image_class,
            'lazyload' => true
        ]);
        ?>
    </a>
    <div class="project-card__decor">
    </div>
</div>