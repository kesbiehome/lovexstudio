<?php

$gallery = get_field('gallery', get_the_ID());

if (!empty($gallery)) {
    return;
}

?>
<div class="project-content">
    <?php if (!empty($gallery)): ?>
        <?php foreach ($gallery as $key => $image_id): ?>
            <?php $image_src = wp_get_attachment_image_src($image_id, 'full')[0]; ?>
            <?php $image_title = get_the_title($image_id); ?>
            <?php $project_image_classes = "project-content__image"; ?>
            <?php if ($key < 2)
                $project_image_classes .= " image-full"; ?>
            <a href="<?php echo esc_url($image_src); ?>" class="<?php echo esc_attr($project_image_classes) ?>"
                data-caption="<?php echo ($image_title); ?>" data-fancybox="super">
                <?php
                the_block('image', [
                    'image' => $image_id,
                    'size' => 'large',
                    'class' => 'image--default'
                ]);
                ?>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no">
            <?php echo __('There are no content!', 'lovexstudio'); ?>
        </p>
    <?php endif; ?>
</div>