<?php
$title = block_value('title');
$image = block_value('image');

?>

<div class="service-card">
	<div class="service-card__top">
		<img src="<?php echo THEME_VENDOR_ASSETS_URI . '/images/service-1.png' ;?>" alt="">
		<div class="service-card__title"><span><?php echo $title; ?></span></div>
	</div>
	<div class="service-card__image">
		<?php
		the_block(
			'image',
			[
				'image' => $image,
				'class' => 'image--default image__img',
				'size' => 'full'
			]
		);
		?>
	</div>
</div>
