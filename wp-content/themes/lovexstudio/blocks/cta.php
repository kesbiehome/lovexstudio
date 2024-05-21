<?php
if (empty($image)) {
    return;
}
?>

<div class="cta-section" data-aos="fade-up">
    <div class="cta-section__container">
        <div class="cta-section__left">
            <div class="cta-section__content">
                <h2>WE LOVE MAKING ARTS</h2>
                <p class="font-f-bold">Looking for art collaboration?</p>
                <div class="cta-button">
                    <a class="btn" href="/contact">
                        <span>Contact Now</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="cta-section__right">
            <?php
            the_block('image', [
                'class' => 'image--default',
                'image' => $image,
                'size' => 'large',
                'lazyload' => true
            ]);
            ?>
        </div>
    </div>
</div>
