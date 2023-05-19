<?php

$data = wp_parse_args($args, [
	'class' => '',
	'image_url' => ''
]);

$custom_logo_id = get_theme_mod( 'custom_logo' );

$class  = 'image-placeholder image--contain';
$class .= !empty($data['class']) ? ' ' . $data['class'] : '';

$image_html = '';

if ( has_custom_logo() && ! empty( $custom_logo_id ) ) :
	if (!empty($data['image_url'])) {
		$logo_html = sprintf(
			'<img src="%1$s" class="%2$s" width="150" height="150" alt="%3$s">',
			$data['image_url'],
			'image-placeholder__image-logo lazyloaded',
			''
		);

	} else {
		ob_start();
		echo wp_get_attachment_image(
			$custom_logo_id,
			'medium',
			false,
			array(
				'class'   => 'lazyload image-placeholder__image-logo',
				'loading' => false,
			)
		);
		$logo_html = ob_get_clean();

		$logo_html = str_replace( ' src="', ' src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="', $logo_html );
		$logo_html = str_replace( ' srcset="', ' data-srcset="', $logo_html );
	}

	$image_html = sprintf( '<div class="image-placeholder__logo">%s</div>', $logo_html );
else :
	ob_start();
	printf( '<figure class="%s %s">', 'image image--cover image-placeholder__image', ! empty( $image_class ) ? ' ' . $image_class : '' );
	printf( '<img class="image__img lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="%1$s" alt="">', get_template_directory_uri() . '/assets/img/no-image.jpg' );
	echo '</figure>';

	$image_html = ob_get_clean();
endif;
?>

<div class="<?php echo $class; ?>">
  <?php echo $image_html; ?>
</div>
