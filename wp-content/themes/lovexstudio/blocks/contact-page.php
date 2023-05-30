<?php
?>

<div class="section-contact-page">
    <div class="contact-page__wrapper">
        <div class="contact-left">
            <?php
            the_block(
                'image',
                [
                    'image' => $image,
                    'class' => 'image--default',
                    'size' => 'full'
                ]
            );
            ?>
        </div>
        <div class="contact-right">
            <div class="contact-right__wrapper">
                <div class="contact-header">
                    <h2>
                        <?php esc_html_e('Contact'); ?>
                    </h2>
                    <div class="contact-description">
                        <?php echo $description; ?>
                    </div>
                </div>
                <div class="contact-content">
                    <div class="contact-content__right">
                        <div class="contact-logo">
                            <img src="<?php echo THEME_VENDOR_ASSETS_URI . '/images/logo.png'; ?>" alt="Love X Studio">
                        </div>
                        <div class="contact-info">
                            <?php if (!empty($address)) : ?>
                                <p><?php printf('Address: %s', esc_html__($address)); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($phone)) : ?>
                                <p><?php printf('Phone: %s', esc_html__($phone)); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($email)) : ?>
                                <p><?php printf('Email: %s', esc_html__($email)); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="contact-content__left">
                        <div class="contact-form">
                            <?php echo do_shortcode('[gravityform id="1" title="true"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>