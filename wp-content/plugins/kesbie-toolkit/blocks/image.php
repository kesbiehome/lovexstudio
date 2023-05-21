<?php
$data = wp_parse_args($args, [
	'image' => [],
	'lazyload' => false,
	'size' => 'small',
	'class' => ''
]);

$lazyload = $data['lazyload'];
$size     = $data['size'];
$image 	  = $data['image'];
$class    = $data['class'];
$html 	  = '';

if (empty( $image ) && empty( $class ) ) {
	return;
}

$image_id = false;

if ( ! empty( $image['ID'] ) ) {
	$image_id = $image['ID'];
} elseif ( is_int( (int) $image ) && $image !== 0) {
	$image_id = $image;
} else {
	get_template_part('blocks/image-placeholder', true, [
		'class' => $class,
	]);
	return;
}

ob_start();
?>
<picture class="image <?php echo $class; ?>">
	<?php

	$mobile_image    = wp_get_attachment_image_src( $image_id, 'medium' );
	$tablet_image    = wp_get_attachment_image_src( $image_id, 'large' );
	$full_size_image = wp_get_attachment_image_src( $image_id, 'full' );

	if ( ! $lazyload ) :

		printf( '<source srcset="%1$s" sizes="(max-width: 480px) %2$s" media="(max-width: 480px)">', $mobile_image[0], $mobile_image[1] . 'w' );
		printf( '<source srcset="%1$s" sizes="(max-width: 1024px) %2$s" media="(max-width: 1024px)">', $tablet_image[0], $tablet_image[1] . 'w' );
		printf(
			'<img class="image__img" src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
			$full_size_image[0],
			$full_size_image[1],
			$full_size_image[2],
			$full_size_image[3] ?? ''
		);

	else :

		$image_attributes = array(
			'class' => 'wp-post-image image__img lazyload',
			'loading' => false
		);

		echo wp_get_attachment_image(
			$image_id,
			$size,
			false,
			$image_attributes
		);

	endif; ?>
</picture>
<?php $html = ob_get_clean();

echo $html;

