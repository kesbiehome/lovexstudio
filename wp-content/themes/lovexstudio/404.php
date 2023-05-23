<?php

$background_image = get_field('error_background_image', 'options');
$image = get_field('error_image', 'options');

get_header();

?>
<div class="inside-error-site">
    <div class="error__background">
        <?php the_block('image', [
            'image' => $background_image,
            'size' => 'default',
            'class' => 'image-default',
            'lazyload' => true
        ]); ?>
    </div>
    <div class="content">
        <div class="error__image">
            <?php the_block('image', [
                'image' => $image,
                'size' => [200, 200],
                'class' => 'image--default',
                'lazyload' => true
            ]); ?>
        </div>
        <div class="error__content">
            <h2 class="error__heading"><?php esc_html_e('Oops! Page not found.'); ?></h2>
            <p><?php esc_html_e('Let’s get you to where you need to be.'); ?></h2>
        </div>
    </div>
</div>
<?php

get_footer();
