<?php
if (!empty($images)) :
    foreach ($images as $image) {
        ob_start();
?>
        <div class="home-hero-slider">
            <?php if (!empty($image['image'])) : ?>
                <div class="home-hero-slider__media">
                    <?php
                    the_block(
                        'image',
                        [
                            'image' => $image['image'],
                            'class' => 'image--default',
                            'size' => 'full'
                        ]
                    )
                    ?>
                </div>
            <?php endif; ?>
        </div>
<?php

        $content_html = ob_get_clean();

        $columns[] = [
            'content' => $content_html
        ];
    }

    $content = '<div class="hero-banner-slider" data-aos="fade-up" data-child-block="hero-banner-slider">';

    ob_start();
    echo kesbie_generate_swiper_slides($columns, [
        'class' => 'hero-banner-slider js-hero-slider',
        'slide_class' => 'hero-banner-slide',
        'prevNextButton' => true,
        'lazyload' => true,
        'pagination' => true,
    ]);

    $content .= ob_get_clean();
    $content .= '</div>';

    echo $content;
endif;
