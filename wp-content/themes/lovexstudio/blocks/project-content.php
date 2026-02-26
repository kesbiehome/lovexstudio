<?php

$gallery = get_field('gallery', get_the_ID());
$youtube_videos = get_field('youtube_videos', get_the_ID());

if (empty($gallery) && empty($youtube_videos)) {
    return;
}

?>
<div class="project-content">
    <?php if (!empty($youtube_videos)): ?>
        <div class="project-videos">
            <?php foreach ($youtube_videos as $video_row): ?>
                <?php
                $embed_url = getYoutubeEmbedUrl($video_row['youtube_url']);
                if (!$embed_url) continue;
                ?>
                <div class="project-videos__item" data-aos="fade-up">
                    <div class="project-videos__embed">
                        <iframe
                            src="<?php echo esc_url($embed_url); ?>"
                            title="<?php echo esc_attr(get_the_title()); ?> - video"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($gallery)): ?>
        <?php foreach ($gallery as $key => $image_id): ?>
            <?php $image_src = wp_get_attachment_image_src($image_id, 'full')[0]; ?>
            <?php $image_title = get_the_title($image_id); ?>
            <?php $project_image_classes = "project-content__image"; ?>
            <?php if ($key < 2)
                $project_image_classes .= " image-full"; ?>
            <a href="<?php echo esc_url($image_src); ?>" class="<?php echo esc_attr($project_image_classes) ?>"
                data-caption="<?php echo ($image_title); ?>" data-fancybox="super" data-aos="fade-up">
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
