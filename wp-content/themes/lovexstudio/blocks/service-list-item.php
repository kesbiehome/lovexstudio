<?php
if (empty($service_id)) return;

$term_link = get_term_link($service_id);
$thumbnail = get_field('image', 'service_' . $service_id);
$link = home_url() . '/projects?service=' . $slug;
$class = $revert ? 'service-list-item' : 'service-list-item revert';
$class_wrapper = $revert ? 'service-list-item__wrapper bg-black' : 'service-list-item__wrapper';
?>
<div class="<?php esc_html_e($class_wrapper); ?>">
    <div class="container">
        <div class="<?php esc_html_e($class); ?>" data-aos="fade-up">
            <div class="service-list-right">
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

            <div class="service-list-left">
                <div class="service-list-item__media">
                    <?php
                    the_block('image', [
                        'image' => $thumbnail,
                        'class' => 'image--default image__img',
                        'lazyload' => true
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
