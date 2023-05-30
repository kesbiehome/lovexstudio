<?php ob_start(); ?>
<div class="home-contact__wrapper">
    <?php
    echo do_shortcode('[gravityform id="1" title="false"]');
    ?>
</div>
<?php
$content = ob_get_clean();

the_block('default-section', [
    'class' => 'section-home-contact',
    'header' => 'Contact',
    'content' => $content,
]);
