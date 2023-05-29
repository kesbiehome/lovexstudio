<?php
$title = block_value('title');
$replace_url = block_value('replace-url');
$image = block_value('image');
?>


<a class="fancybox-image" data-fancybox="gallery" data-src="<?php echo $replace_url; ?>">
		<?php
		the_block(
			'image',
			[
				'image' => $image,
				'class' => '',
				'size' => 'full'
			]
		);
		?>
</a>
