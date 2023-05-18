<?php ob_start(); ?>
<div class="home-about-us__top">
    <?php if (!empty($image)) : ?>
        <div class="home-about-us__media">
            <?php
            echo wp_get_attachment_image(
                $image,
                'full',
                false,
                $image_attributes
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($desc)) : ?>
        <div class="home-about-us__desc">
            <?php esc_html_e($desc); ?>
        </div>
    <?php endif; ?>
</div>
<div class="home-about-us__bottom">
    <div class="about-us__row">
        <?php foreach ($rows as $row) : ?>
            <?php if (!empty($row['title'])) : ?>
                <div class="about-us__row-title">
                    <?php esc_html_e($row['title']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($row['subtitle'])) : ?>
                <div class="about-us__row-subtitle">
                    <?php esc_html_e($row['subtitle']); ?>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>
</div>
<?php $content = ob_get_clean();

the_block('default-section', [
    'class' => 'section-about-us',
    'header' => 'About us',
    'content' => $content,
]);

?>