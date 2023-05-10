<?php
$_attrs  = '';
$_attrs .= !empty($id) ? sprintf(' id="%s"', esc_attr($id)) : '';
$_attrs .= !empty($attributes) ? ' ' . $attributes : '';
$_class  = 'default-section';
$_class .= !empty($background_image) ? ' has-bg-image' : '';
$_class .= !empty($class) ? ' ' . $class : '';
$_tag    = !empty($tag) ? $tag : 'div';

// Support lazyload main block
$_lazyload_loader_class = !empty($lazyload_loader_class) ? $lazyload_loader_class : 'loader--dark';
if ($_enable_lazyload) {
	$_attrs .= empty($attributes) ? ' data-block="default-section"' : '';
	$_class .= ' is-loading has-lazyload';
}

ob_start();
if (!empty($content)) {

	echo $content;
}
$_content = ob_get_clean();

if (!empty($content)) : ?>
	<<?php echo $_tag; ?> class="<?php echo $_class; ?>" <?php if (!empty($_attrs)) echo ' ' . $_attrs; ?>>
		<?php
		if (!empty($background_image)) :
			the_block(
				'image',
				array(
					'image'    => $background_image,
					'class'    => 'default-section__background-image',
					'lazyload' => $_enable_lazyload,
					'size'     => 'medium',
				)
			);
		endif;
		?>
		<?php
		if (!empty($before_header)) :
			echo $before_header;
		endif;
		?>
		<?php if (!empty($header)) : ?>
			<div class="default-section__header">
				<div class="section__container section__container--header">
					<div class="section__inner section__inner--header">
						<div class="section__inner-content">
							<?php echo $header; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php
		if (!empty($before_main)) :
			echo $before_main;
		endif;
		?>
		<div class="section__main">
			<div class="section__container--main">
				<div class="section__inner--main">
					<div class="section__inner-content js-main-content">
						<?php
						echo $_content;
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		if (!empty($after_main)) :
			echo $after_main;
		endif;
		?>
		<?php if (!empty($footer)) : ?>
			<div class="section__footer">
				<div class="section__container--footer">
					<div class="section__inner--footer">
						<div class="section__inner-container">
							<?php echo $footer; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php
		if (!empty($after_footer)) :
			echo $after_footer;
		endif;
		?>
	</<?php echo $_tag; ?>>
<?php endif; ?>
