<?php

global $post;

$thumbnail_id = get_post_thumbnail_id();
$sub_title = get_field('sub_title', get_the_ID());
$title = $post->post_title;
$excerpt = $post->post_excerpt;
$tags = get_the_terms(get_the_id(), 'tag');
$first_tag = !empty($tags) ? $tags[0]->name : '';

?>

<div class="project-info">
    <div class="project-info__media">
        <?php the_block('image', [
            'image' => $thumbnail_id,
            'type' => 'large',
            'class' => 'image--square image--cover',
            'lazyload' => true
        ]); ?>
    </div>
    <div class="project-info__description">
        <div class="project-info__description--inner">
            <?php if (!empty($sub_title)): ?>

                <h2 class="project-info__sub--title">
                    <?php echo $sub_title; ?>
                </h2>
            <?php endif; ?>
            <h1 class="project-info__title">
                <?php echo $title; ?>
            </h1>
            <?php if (!empty($first_tag)): ?>
                <h3 class="project-info__tag">
                    <?php echo $first_tag; ?>
                </h3>
            <?php endif; ?>
            <?php if (!empty($excerpt)): ?>
                <p class="project-info__excerpt">
                    <?php echo $excerpt; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>