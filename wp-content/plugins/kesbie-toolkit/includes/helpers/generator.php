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



	$markup .= '</div>'; // <!-- End .swiper-wrapper -->
	if (isset($args['pagination']) && $args['pagination']) :
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButton']) && !$args['prevNextButtonOutSide']) :
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path d="M27.4633 42.9102C27.1778 42.7113 27.1778 42.2887 27.4633 42.0898L46.4642 28.8499C46.7956 28.619 47.25 28.8562 47.25 29.2602L47.25 55.7398C47.25 56.1438 46.7956 56.381 46.4642 56.15L27.4633 42.9102Z" stroke="#E3B24C" />
				<path d="M37.1236 43.3109C36.5705 42.9118 36.5705 42.0883 37.1236 41.6891L55.4148 28.4886C56.0762 28.0113 57 28.4839 57 29.2995L57 55.7006C57 56.5162 56.0762 56.9887 55.4148 56.5114L37.1236 43.3109Z" fill="#E3B24C" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z" stroke="#E3B24C" />
				<path d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z" fill="#E3B24C" />
			</svg>
		</div>
	<?php $markup .= ob_get_clean();
	endif;

	if (isset($args['scrollbar']) && $args['scrollbar']) :
		$markup .= '<div class="swiper-scrollbar"></div>';
	endif;

	if (isset($args['paginationOutSide']) && $args['paginationOutSide']) :
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButton']) && $args['prevNextButtonOutSide']) :
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path d="M27.4633 42.9102C27.1778 42.7113 27.1778 42.2887 27.4633 42.0898L46.4642 28.8499C46.7956 28.619 47.25 28.8562 47.25 29.2602L47.25 55.7398C47.25 56.1438 46.7956 56.381 46.4642 56.15L27.4633 42.9102Z" stroke="#E3B24C" />
				<path d="M37.1236 43.3109C36.5705 42.9118 36.5705 42.0883 37.1236 41.6891L55.4148 28.4886C56.0762 28.0113 57 28.4839 57 29.2995L57 55.7006C57 56.5162 56.0762 56.9887 55.4148 56.5114L37.1236 43.3109Z" fill="#E3B24C" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z" stroke="#E3B24C" />
				<path d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z" fill="#E3B24C" />
			</svg>
		</div>
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
