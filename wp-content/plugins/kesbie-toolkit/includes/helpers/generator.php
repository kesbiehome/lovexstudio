<?php


function kesbie_generate_swiper_slides($slides, $args = [])
{
	if (empty($slides)) {
		return '';
	}

	$_class = 'swiper';

	if (!empty($args['class'])) :
		$_class .= ' ' . esc_attr($args['class']);
	endif;

	$has_lazyload = isset($args['lazyload']) && $args['lazyload'];

	$markup = sprintf('<div class="%s">', $_class);
	$markup .= '<div class="swiper-wrapper">';

	foreach ($slides as $index => $slide) {
		if (empty($slide['content'])) {
			return;
		}

		$_item_class = 'swiper-slide';

		if (!empty($args['slide_class'])) :
			$_item_class .= ' ' . esc_attr($args['slide_class']);
		endif;

		if (!empty($slide['class'])) :
			$_item_class .= ' ' . esc_attr($slide['class']);
		endif;

		if ($has_lazyload && $index !== 0) {
			$_item_class .= ' is-not-loaded';
		}

		$markup .= sprintf('<div class="%s">', $_item_class);
		$markup .= $has_lazyload && $index !== 0 ? '<noscript>' : '';
		$markup .= $slide['content'];
		$markup .= $has_lazyload && $index !== 0 ? '</noscript>' : '';

		$markup .= '</div>'; // <!-- End .swiper-slide -->
	}

	if (isset($args['pagination']) && $args['pagination']) :
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButton']) && $args['prevNextButton']) :
		ob_start(); ?>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	<?php $markup .= ob_get_clean();
	endif;

	if (isset($args['scrollbar']) && $args['scrollbar']) :
		$markup .= '<div class="swiper-scrollbar"></div>';
	endif;

	$markup .= '</div>'; // <!-- End .swiper-wrapper -->

	if (isset($args['paginationOutSide']) && $args['paginationOutSide']) :
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButtonOutSide']) && $args['prevNextButtonOutSide']) :
		ob_start(); ?>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
		<?php $markup .= ob_get_clean();
	endif;

	if (isset($args['scrollbarOutSide']) && $args['scrollbarOutSide']) :
		$markup .= '<div class="swiper-scrollbar"></div>';
	endif;

	$markup .= '</div>'; // <!-- End .swiper -->

	return $markup;
}

function kesbie_get_svg($type)
{
	switch ($type) {
		case 'paint-brush': {
				ob_start();
		?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
					<path d="M339.3 367.1c27.3-3.9 51.9-19.4 67.2-42.9L568.2 74.1c12.6-19.5 9.4-45.3-7.6-61.2S517.7-4.4 499.1 9.6L262.4 187.2c-24 18-38.2 46.1-38.4 76.1L339.3 367.1zm-19.6 25.4l-116-104.4C143.9 290.3 96 339.6 96 400c0 3.9 .2 7.8 .6 11.6C98.4 429.1 86.4 448 68.8 448H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H208c61.9 0 112-50.1 112-112c0-2.5-.1-5-.2-7.5z" />
				</svg>
<?php return
					ob_get_clean();
			}
		default:
			return;
	}
}
