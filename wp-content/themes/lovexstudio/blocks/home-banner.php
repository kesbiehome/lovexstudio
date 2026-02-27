<?php

$embed_url = !empty($youtube_url) ? getYoutubeEmbedUrl($youtube_url) : false;

if ($embed_url) :
    preg_match('/embed\/([a-zA-Z0-9_-]+)/', $embed_url, $yt_matches);
    $yt_id = !empty($yt_matches[1]) ? $yt_matches[1] : '';
?>
    <div class="hero-banner-video" data-aos="fade-up">
        <?php if (!empty($text)) : ?>
            <div class="home-hero-text__wrapper">
                <div class="home-hero__text">
                    <h1 class="section__title">
                        <?php esc_html_e($text); ?>
                    </h1>
                </div>
            </div>
        <?php endif; ?>
        <div class="hero-banner-video__embed">
            <iframe
                src="<?php echo esc_url($embed_url . '?autoplay=1&mute=1&loop=1&playlist=' . $yt_id . '&controls=0&showinfo=0&playsinline=1&modestbranding=1&rel=0&disablekb=1&iv_load_policy=3&enablejsapi=1'); ?>"
                title="<?php echo esc_attr(get_bloginfo('name')); ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        </div>
    </div>
<?php

elseif (!empty($images)) :
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
                            'size' => 'full',
                            'lazyload' => true
                        ]
                    )
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($text)) : ?>
            <div class="home-hero-text__wrapper">
            <div class="home-hero__text">
                    <h1 class="section__title">
                        <?php esc_html_e($text); ?>
                    </h1>
                </div>
            </div>
        <?php endif; ?>
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
        'pagination' => false,
    ]);

    $content .= ob_get_clean();
    $content .= '</div>';

    echo $content;
endif;
