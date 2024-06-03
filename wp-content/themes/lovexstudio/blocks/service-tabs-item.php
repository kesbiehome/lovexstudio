<?php
$term_link = get_term_link($service_id);
$thumbnail = get_field('image', 'service_' . $service_id);
$link = home_url() . '/projects?service=' . $slug;

?>
<div class="service-content">
    <?php if (!empty($name)) : ?>
        <div class="service-title">
            <?php esc_html_e($name); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($desc)) : ?>
        <div class="service-desc">
            <?php esc_html_e($desc); ?>
        </div>
    <?php endif; ?>

    <div class="service-media">
        <?php
        the_block('image', [
            'image' => $thumbnail,
            'class' => 'image--square image__img',
            'lazyload' => true
        ]);
        ?>
    </div>

    <?php if (!empty($link)) : ?>
        <div class="service-link">
            <a href="<?php esc_attr_e($link); ?>" class="btn">
                <span>
                    <?php esc_html_e('See More'); ?>
                </span>
            </a>
        </div>
    <?php endif; ?>
</div>