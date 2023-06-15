<?php


function kesbie_generate_swiper_slides($slides, $args = [])
{
	if (empty($slides)) {
		return '';
	}

	$_class = 'swiper';

	if (!empty($args['class'])):
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

		if (!empty($args['slide_class'])):
			$_item_class .= ' ' . esc_attr($args['slide_class']);
		endif;

		if (!empty($slide['class'])):
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
	if (isset($args['pagination']) && $args['pagination']):
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButton']) && !$args['prevNextButtonOutSide']):
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path
					d="M27.4633 42.9102C27.1778 42.7113 27.1778 42.2887 27.4633 42.0898L46.4642 28.8499C46.7956 28.619 47.25 28.8562 47.25 29.2602L47.25 55.7398C47.25 56.1438 46.7956 56.381 46.4642 56.15L27.4633 42.9102Z"
					stroke="#E3B24C" />
				<path
					d="M37.1236 43.3109C36.5705 42.9118 36.5705 42.0883 37.1236 41.6891L55.4148 28.4886C56.0762 28.0113 57 28.4839 57 29.2995L57 55.7006C57 56.5162 56.0762 56.9887 55.4148 56.5114L37.1236 43.3109Z"
					fill="#E3B24C" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path
					d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z"
					stroke="#E3B24C" />
				<path
					d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z"
					fill="#E3B24C" />
			</svg>
		</div>
		<?php $markup .= ob_get_clean();
	endif;

	if (isset($args['scrollbar']) && $args['scrollbar']):
		$markup .= '<div class="swiper-scrollbar"></div>';
	endif;

	if (isset($args['paginationOutSide']) && $args['paginationOutSide']):
		$markup .= '<div class="swiper-pagination"></div>';
	endif;

	if (isset($args['prevNextButton']) && $args['prevNextButtonOutSide']):
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path
					d="M27.4633 42.9102C27.1778 42.7113 27.1778 42.2887 27.4633 42.0898L46.4642 28.8499C46.7956 28.619 47.25 28.8562 47.25 29.2602L47.25 55.7398C47.25 56.1438 46.7956 56.381 46.4642 56.15L27.4633 42.9102Z"
					stroke="#E3B24C" />
				<path
					d="M37.1236 43.3109C36.5705 42.9118 36.5705 42.0883 37.1236 41.6891L55.4148 28.4886C56.0762 28.0113 57 28.4839 57 29.2995L57 55.7006C57 56.5162 56.0762 56.9887 55.4148 56.5114L37.1236 43.3109Z"
					fill="#E3B24C" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path
					d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z"
					stroke="#E3B24C" />
				<path
					d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z"
					fill="#E3B24C" />
			</svg>
		</div>
		<?php $markup .= ob_get_clean();
	endif;

	if (isset($args['scrollbarOutSide']) && $args['scrollbarOutSide']):
		$markup .= '<div class="swiper-scrollbar"></div>';
	endif;

	$markup .= '</div>'; // <!-- End .swiper -->

	return $markup;
}

function kesbie_generate_tabs_data($items)
{
	$nav_items = [];
	$content_items = [];
	foreach ($items as $index => $item) {
		$tab_id = sanitize_key($item['name'] . '-' . $index);

		if (!empty($item['name']) && !empty($item['content'])) {
			$nav_items[] = [
				'id' => $tab_id,
				'is_active' => $index === 0,
				'name' => $item['name']
			];

			$content_items[] = [
				'id' => $tab_id,
				'is_active' => $index === 0,
				'content' => $item['content']
			];
		}
	}

	return [
		'nav_items' => $nav_items,
		'content_items' => $content_items
	];
}

function kesbie_generate_tabs($items, $args = [])
{
	$_class = 'kesbie-tabs';
	if (!empty($args['class'])):
		$_class .= ' ' . esc_attr($args['class']);
	endif;

	$tab_data = kesbie_generate_tabs_data($items);

	$markup = sprintf('<div class="%s">', esc_attr($_class));

	$lazyload = $args['lazyload'] ?? true;

	/**
	 * Generate nav items
	 */
	ob_start();
	if (!empty($tab_data['nav_items'])):
		echo '<ul class="kesbie-tabs__nav-items" aria-controls="js-tab-contents" role="tablist">';
		foreach ($tab_data['nav_items'] as $nav_item):
			printf(
				'<li class="rel kesbie-tabs__nav-item" role="tab" aria-controls="%1$s" aria-selected="%2$s">%3$s</li>',
				$nav_item['id'],
				var_export($nav_item['is_active'], true),
				$nav_item['name']
			);
		endforeach;
		echo '</ul>';
	endif;
	$markup .= ob_get_clean();

	/**
	 * Generate content tab items
	 */
	ob_start();
	if (!empty($tab_data['content_items'])):
		echo '<div class="kesbie-tabs__tab-contents js-tab-contents">';
		foreach ($tab_data['content_items'] as $index => $content_item):
			$_item_class = 'kesbie-tabs__tab-content js-tab-content';

			if ($lazyload && $index > 0):
				$_item_class .= ' is-not-loaded';
			endif;

			printf(
				'<div class="%s" id="%s" role="tabpanel" aria-expanded="%s">',
				$_item_class,
				$content_item['id'],
				var_export($content_item['is_active'], true)
			);

			if ($lazyload && $index > 0):
				echo '<noscript>';
			endif;

			echo $content_item['content'];

			if ($lazyload && $index > 0):
				echo '</noscript>';
			endif;
			echo '</div>';
		endforeach;
		echo '</div>';
	endif;
	$markup .= ob_get_clean();

	$markup .= '</div>'; // <!-- End -->

	return $markup;
}

function kesbie_get_svg($type)
{
	switch ($type) {
		case 'paint-brush':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
				<path
					d="M339.3 367.1c27.3-3.9 51.9-19.4 67.2-42.9L568.2 74.1c12.6-19.5 9.4-45.3-7.6-61.2S517.7-4.4 499.1 9.6L262.4 187.2c-24 18-38.2 46.1-38.4 76.1L339.3 367.1zm-19.6 25.4l-116-104.4C143.9 290.3 96 339.6 96 400c0 3.9 .2 7.8 .6 11.6C98.4 429.1 86.4 448 68.8 448H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H208c61.9 0 112-50.1 112-112c0-2.5-.1-5-.2-7.5z" />
			</svg>
			<?php return
				ob_get_clean();
		case 'instagram':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 19.2 19.2">
				<path
					d="M13.498 6.651a1.656 1.656 0 0 0-.95-.949 2.766 2.766 0 0 0-.928-.172c-.527-.024-.685-.03-2.02-.03s-1.493.006-2.02.03a2.766 2.766 0 0 0-.929.172 1.656 1.656 0 0 0-.949.95 2.766 2.766 0 0 0-.172.928c-.024.527-.03.685-.03 2.02s.006 1.493.03 2.02a2.766 2.766 0 0 0 .172.929 1.656 1.656 0 0 0 .95.949 2.766 2.766 0 0 0 .928.172c.527.024.685.03 2.02.03s1.493-.006 2.02-.03a2.766 2.766 0 0 0 .929-.172 1.656 1.656 0 0 0 .949-.95 2.766 2.766 0 0 0 .172-.928c.024-.527.03-.685.03-2.02s-.006-1.493-.03-2.02a2.766 2.766 0 0 0-.172-.929zM9.6 12.168A2.568 2.568 0 1 1 12.168 9.6 2.568 2.568 0 0 1 9.6 12.168zm2.669-4.637a.6.6 0 1 1 .6-.6.6.6 0 0 1-.6.6z">
				</path>
				<circle cx="9.6" cy="9.6" r="1.667"></circle>
				<path
					d="M9.6 0a9.6 9.6 0 1 0 9.6 9.6A9.6 9.6 0 0 0 9.6 0zm4.97 11.662a3.67 3.67 0 0 1-.233 1.213 2.556 2.556 0 0 1-1.462 1.462 3.67 3.67 0 0 1-1.213.233c-.534.024-.704.03-2.062.03s-1.528-.006-2.062-.03a3.67 3.67 0 0 1-1.213-.233 2.556 2.556 0 0 1-1.462-1.462 3.67 3.67 0 0 1-.233-1.213c-.024-.534-.03-.704-.03-2.062s.006-1.528.03-2.062a3.67 3.67 0 0 1 .233-1.213 2.556 2.556 0 0 1 1.462-1.462 3.67 3.67 0 0 1 1.213-.233c.534-.024.704-.03 2.062-.03s1.528.006 2.062.03a3.67 3.67 0 0 1 1.213.233 2.556 2.556 0 0 1 1.462 1.462 3.67 3.67 0 0 1 .233 1.213c.024.534.03.704.03 2.062s-.006 1.528-.03 2.062z">
				</path>
			</svg>
			<?php return ob_get_clean();

		case 'youtube':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 32 32">
				<path d="M13.83 19.259L19.262 16l-5.432-3.259z"></path>
				<path
					d="M16 0C7.164 0 0 7.163 0 16s7.164 16 16 16 16-7.164 16-16S24.836 0 16 0zm8.688 16.701c0 1.5-.174 3-.174 3s-.17 1.278-.69 1.839c-.661.738-1.401.742-1.741.786-2.432.186-6.083.192-6.083.192s-4.518-.044-5.908-.186c-.387-.077-1.254-.055-1.916-.792-.521-.562-.69-1.839-.69-1.839s-.174-1.499-.174-3v-1.406c0-1.5.174-2.999.174-2.999s.17-1.278.69-1.841c.661-.739 1.401-.743 1.741-.785 2.431-.188 6.079-.188 6.079-.188h.008s3.648 0 6.079.188c.339.042 1.08.046 1.741.784.521.563.69 1.841.69 1.841s.174 1.5.174 3v1.406z">
				</path>
			</svg>
			<?php return ob_get_clean();

		case 'facebook':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 20 20">
				<path
					d="M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6S15.302.4 10 .4zm2.274 6.634h-1.443c-.171 0-.361.225-.361.524V8.6h1.805l-.273 1.486H10.47v4.461H8.767v-4.461H7.222V8.6h1.545v-.874c0-1.254.87-2.273 2.064-2.273h1.443v1.581z">
				</path>
			</svg>
			<?php return ob_get_clean();

		case 'behance':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 32 32" id="behance"><path d="M13.365 16.525h-3.15v3.15h3.15c.227 0 1.575-.016 1.575-1.575s-1.575-1.575-1.575-1.575zM14.091 13.622c0-1.281-.988-1.297-.988-1.297h-2.887v2.625h2.887s.988 0 .988-1.328zM21.24 14.95c-1.61 0-1.575 1.575-1.575 1.575h3.15s.034-1.575-1.575-1.575z"></path><path d="M16 0C7.163 0 0 7.164 0 16s7.163 16 16 16c8.836 0 16-7.164 16-16S24.837 0 16 0zm3.14 11.8h4.2v1.05h-4.2V11.8zm-2.362 6.3c0 3.241-2.887 3.15-2.887 3.15H8.115v-10.5l5.644.009c1.647 0 2.725.937 2.725 2.836 0 1.901-1.589 2.022-1.589 2.022 2.095.001 1.883 2.483 1.883 2.483zm4.462 1.575c1.575 0 1.575-1.575 1.575-1.575h2.1c0 3.15-3.675 3.15-3.675 3.15-4.2 0-3.937-3.937-3.937-3.937s-.007-3.937 3.937-3.937c3.675 0 3.675 3.15 3.675 4.2h-5.25c0 2.099 1.575 2.099 1.575 2.099z"></path></svg>
		<?php return ob_get_clean();

		case 'next-btn':
			ob_start(); ?>

			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C"/>
				<path d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z" stroke="#E3B24C"/>
				<path d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z" fill="#E3B24C"/>
			</svg>
		<?php return ob_get_clean();
		default:
			return;
	}
}