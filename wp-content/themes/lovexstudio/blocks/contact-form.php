<?php

$form = do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');

if (empty($image)) {
    return;
}

?>
<div class="contact-form" data-aos="fade-up">
    <div class="contact-form__container">
        <div class="contact-form__left">
            <?php
            the_block('image', [
                'class' => 'image--default',
                'image' => $image,
                'size' => 'large',
                'lazyload' => true
            ]);
            ?>
        </div>
        <div class="contact-form__right">
            <h2 class="contact-form__heading">You need help? Let us know.</h2>
            <?php echo $form ?>
        </div>
    </div>
</div>