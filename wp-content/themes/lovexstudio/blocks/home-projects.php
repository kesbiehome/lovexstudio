<?php

$project_featured = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => 'project',
    'posts_per_page' => 4,
    array(
        'taxonomy' => 'tag',
        'field' => 'slug',
        'terms' => array('featured'),
    )
));

?>

<?php ob_start(); ?>
<div class="home-projects__content">
    <div class="project-grid">
        <?php while ($project_featured->have_posts()) : $project_featured->the_post();
            the_block('project-card', [
                'project_id' => get_the_ID()
            ]);
        ?>
        <?php endwhile; ?>
    </div>
</div>


<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>

<?php if (!empty($button['url']) && !empty($button['url'])) : ?>
    <div class="home-projects-footer">
        <a href="<?php echo esc_url($button['url']) ?>" class="btn projects-footer__link">
            <span class="projects-footer__link--text">
                <?php echo esc_html($button['title']); ?>
            </span>
        </a>
    </div>
<?php endif; ?>

<?php $footer = ob_get_clean(); ?>

<?php

the_block('default-section', [
    'class' => 'section-home-projects',
    'header' => $section_title ?? '',
    'content' => $content,
    'footer' => $footer ?? '',
]);

?>