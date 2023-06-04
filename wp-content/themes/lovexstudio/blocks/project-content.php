<?php

$gallery = get_field('gallery', get_the_ID());

?>
<div class="project-content">
    <?php if (!empty($gallery)): ?>
        <?php foreach ($gallery as $image_id): ?>
            <?php
            the_block('image', [
                'image' => $image_id,
                'size' => 'large',
                'class' => 'image--default'
            ]);
            ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no">
            <?php echo __('There are no content!', 'lovexstudio'); ?>
        </p>
    <?php endif; ?>
</div>