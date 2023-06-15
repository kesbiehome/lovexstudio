<?php ob_start(); ?>
<div class="white-stripes">
    <svg width="123" height="32" viewBox="0 0 123 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.578 32H0L15.422 0H29L13.578 32Z" fill="white" />
        <path d="M36.578 32H23L38.422 0H52L36.578 32Z" fill="white" />
        <path d="M60.578 32H47L62.422 0H76L60.578 32Z" fill="white" />
        <path d="M83.578 32H70L85.422 0H99L83.578 32Z" fill="white" />
        <path d="M107.578 32H94L109.422 0H123L107.578 32Z" fill="white" />
    </svg>
</div>
<div class="home-about-us__top">
    <div class="home-about-us__top-wrapper">
        <?php if (!empty($image)) : ?>
            <div class="home-about-us__media" data-aos="fade-up">
                <?php
                echo wp_get_attachment_image(
                    $image,
                    'large image__img',
                    false,
                    'image__img',
                );
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($desc)) : ?>
            <div class="home-about-us__desc" data-aos="fade-up">
                <span>
                    <?php esc_html_e($desc); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="home-about-us__bottom">
    <div class="home-about-us__bottom-wrapper">
        <?php foreach ($rows as $row) : ?>
            <div class="about-us__row" data-aos="fade-up">
                <?php if (!empty($row['title'])) : ?>
                    <div class="about-us__row-title">
                        <span>
                            <?php esc_html_e($row['title']); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($row['subtitle'])) : ?>
                    <div class="about-us__row-subtitle">
                        <span>
                            <?php esc_html_e($row['subtitle']); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
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
