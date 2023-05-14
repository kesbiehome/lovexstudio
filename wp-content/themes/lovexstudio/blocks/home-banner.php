<?php
if (!empty($images)) :
    foreach ($images as $image) {
        ob_start();
?>
        <div class="home-hero-slider">
            <?php if (!empty($image['image'])) : ?>
                <div class="home-hero-slider__media">
                    <picture class="image image--default">
                        <?php
                        $image_attributes = array(
                            'class' => 'wp-post-image image__img lazyload',
                            'loading' => false
                        );

                        echo wp_get_attachment_image(
                            $image['image'],
                            'full',
                            false,
                            $image_attributes
                        );
                        ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
<?php

        $content_html = ob_get_clean();

        $columns[] = [
            'content' => $content_html
        ];
    }

    $content = '<div class="hero-banner-slider" data-child-block="hero-banner-slider">';

    ob_start();
    echo kesbie_generate_swiper_slides($columns, [
        'class' => 'hero-banner-slider js-hero-slider',
        'slide_class' => 'hero-banner-slide',
        'prevNextButton' => true,
        // 'lazyload' => true,
    ]);

    $content .= ob_get_clean();
    $content .= '</div>';

    echo $content;
endif;
