<?php

$class = 'project-card';
$class .= $is_large_card ? ' large-card' : '';

$image_size = $is_large_card ? [350, 450] : [350, 350];
$image_class = $is_large_card ? 'image--large image--cover' : 'image--square image--cover';

$data = get_project_data_by_id($project_id);
?>

<div class="<?php echo esc_attr($class); ?>" data-aos="fade-up">
    <a class="project-card__link" href="<?php echo esc_url($data['project_url']); ?>">
        <?php
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
