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

	if (isset($args['prevNextButton'])):
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M40.5061 66.2054V6.25536L6.24987 36.2304L40.5061 66.2054ZM36.3874 70.9116L2.13737 40.9366C1.46606 40.35 0.928023 39.6265 0.559375 38.8148C0.190726 38.0031 0 37.1219 0 36.2304C0 35.3388 0.190726 34.4577 0.559375 33.6459C0.928023 32.8342 1.46606 32.1107 2.13737 31.5241L36.3874 1.54911C37.2911 0.757305 38.4039 0.242775 39.5925 0.067139C40.7811 -0.108497 41.9952 0.0622051 43.0893 0.558804C44.1834 1.0554 45.1112 1.85685 45.7615 2.86716C46.4118 3.87748 46.7572 5.05383 46.7561 6.25536V66.2054C46.7572 67.4069 46.4118 68.5832 45.7615 69.5936C45.1112 70.6039 44.1834 71.4053 43.0893 71.9019C41.9952 72.3985 40.7811 72.5692 39.5925 72.3936C38.4039 72.2179 37.2911 71.7034 36.3874 70.9116Z"
					fill="#D3FFEE" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M6.25 66.2147V6.26469L40.5063 36.2397L6.25 66.2147ZM10.3688 70.9209L44.6188 40.9459C45.2901 40.3593 45.8281 39.6358 46.1968 38.8241C46.5654 38.0124 46.7561 37.1312 46.7561 36.2397C46.7561 35.3482 46.5654 34.467 46.1968 33.6553C45.8281 32.8435 45.2901 32.1201 44.6188 31.5334L10.375 1.55844C6.31875 -1.97906 2.29816e-06 0.895942 2.29816e-06 6.26469V66.2147C-0.00102787 67.4162 0.344299 68.5926 0.994631 69.6029C1.64496 70.6132 2.57273 71.4146 3.66683 71.9113C4.76093 72.4079 5.97499 72.5786 7.16361 72.4029C8.35223 72.2273 9.46503 71.7128 10.3688 70.9209Z"
					fill="#D3FFEE" />
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

	if (isset($args['prevNextButton']) && isset($args['prevNextButtonOutSide']) && $args['prevNextButtonOutSide']):
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M40.5061 66.2054V6.25536L6.24987 36.2304L40.5061 66.2054ZM36.3874 70.9116L2.13737 40.9366C1.46606 40.35 0.928023 39.6265 0.559375 38.8148C0.190726 38.0031 0 37.1219 0 36.2304C0 35.3388 0.190726 34.4577 0.559375 33.6459C0.928023 32.8342 1.46606 32.1107 2.13737 31.5241L36.3874 1.54911C37.2911 0.757305 38.4039 0.242775 39.5925 0.067139C40.7811 -0.108497 41.9952 0.0622051 43.0893 0.558804C44.1834 1.0554 45.1112 1.85685 45.7615 2.86716C46.4118 3.87748 46.7572 5.05383 46.7561 6.25536V66.2054C46.7572 67.4069 46.4118 68.5832 45.7615 69.5936C45.1112 70.6039 44.1834 71.4053 43.0893 71.9019C41.9952 72.3985 40.7811 72.5692 39.5925 72.3936C38.4039 72.2179 37.2911 71.7034 36.3874 70.9116Z"
					fill="#D3FFEE" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M6.25 66.2147V6.26469L40.5063 36.2397L6.25 66.2147ZM10.3688 70.9209L44.6188 40.9459C45.2901 40.3593 45.8281 39.6358 46.1968 38.8241C46.5654 38.0124 46.7561 37.1312 46.7561 36.2397C46.7561 35.3482 46.5654 34.467 46.1968 33.6553C45.8281 32.8435 45.2901 32.1201 44.6188 31.5334L10.375 1.55844C6.31875 -1.97906 2.29816e-06 0.895942 2.29816e-06 6.26469V66.2147C-0.00102787 67.4162 0.344299 68.5926 0.994631 69.6029C1.64496 70.6132 2.57273 71.4146 3.66683 71.9113C4.76093 72.4079 5.97499 72.5786 7.16361 72.4029C8.35223 72.2273 9.46503 71.7128 10.3688 70.9209Z"
					fill="#D3FFEE" />
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

	$markup = sprintf('<div class="%s" data-aos="fade-up">', esc_attr($_class));

	$lazyload = $args['lazyload'] ?? true;

	/**
	 * Generate nav items
	 */
	ob_start();
	if (!empty($tab_data['nav_items'])):
		echo '<ul class="kesbie-tabs__nav-items" data-aos="fade-up" aria-controls="js-tab-contents" role="tablist">';
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
			<svg width="52" height="31" viewBox="0 0 52 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M26.1674 0H26.4567C29.1283 0.00827476 42.6654 0.0910228 46.3154 0.924015C47.4188 1.17824 48.4243 1.67377 49.2313 2.36109C50.0384 3.0484 50.6188 3.90343 50.9144 4.84073C51.2427 5.88887 51.4735 7.27627 51.6295 8.7078L51.662 8.99466L51.7335 9.71181L51.7595 9.99867C51.9707 12.5197 51.9967 14.8808 52 15.3966V15.6034C51.9967 16.1385 51.9675 18.6596 51.7335 21.2854L51.7075 21.5751L51.6782 21.8619C51.5157 23.4396 51.2752 25.0063 50.9144 26.1593C50.6188 27.0966 50.0384 27.9516 49.2313 28.6389C48.4243 29.3262 47.4188 29.8218 46.3154 30.076C42.5452 30.9366 28.215 30.9972 26.2291 31H25.7676C24.7633 31 20.6095 30.9834 16.2543 30.8566L15.7017 30.84L15.419 30.829L14.8632 30.8097L14.3074 30.7904C10.6997 30.6552 7.2642 30.4373 5.68135 30.0732C4.57832 29.8192 3.57311 29.3241 2.76609 28.6373C1.95907 27.9505 1.37849 27.0961 1.08232 26.1593C0.721545 25.0091 0.48103 23.4396 0.31852 21.8619L0.292518 21.5723L0.266517 21.2854C0.105188 19.4165 0.0163008 17.5435 0 15.6696L0 15.3304C0.00650041 14.7373 0.032502 12.688 0.208013 10.4262L0.230764 10.1421L0.240515 9.99867L0.266517 9.71181L0.338021 8.99466L0.370523 8.7078C0.526533 7.27627 0.757297 5.88611 1.08557 4.84073C1.38124 3.90343 1.9616 3.0484 2.76865 2.36109C3.57571 1.67377 4.58118 1.17824 5.68461 0.924015C7.26745 0.565442 10.7029 0.344781 14.3106 0.206869L14.8632 0.187561L15.4222 0.171012L15.7017 0.162737L16.2575 0.14343C19.3508 0.0590366 22.4453 0.0121412 25.5401 0.00275838L26.1674 0ZM20.8013 8.85399V22.1433L34.3124 15.5014L20.8013 8.85399Z"
					fill="white" />
			</svg>

			<?php return ob_get_clean();

		case 'facebook':
			ob_start(); ?>
			<svg width="37" height="31" viewBox="0 0 37 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M37 15.5949C37 6.98188 28.7177 0 18.5023 0C8.28234 0.00193726 0 6.98188 0 15.5969C0 23.3788 6.76553 29.8299 15.6074 31V20.1029H10.9136V15.5969H15.612V12.1582C15.612 8.25078 18.3751 6.09268 22.5995 6.09268C24.625 6.09268 26.7407 6.39683 26.7407 6.39683V10.2326H24.4077C22.1117 10.2326 21.3949 11.4356 21.3949 12.6697V15.5949H26.5234L25.7048 20.101H21.3926V30.9981C30.2345 29.828 37 23.3769 37 15.5949Z"
					fill="white" />
			</svg>
			<?php return ob_get_clean();
		case 'tiktok':
			ob_start(); ?>
			<svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M18.2857 0H22.8114C23.1406 1.34062 24.0457 3.03187 25.6343 4.71C27.1886 6.35437 29.2503 7.5 32 7.5V11.25C27.9931 11.25 24.9829 9.72375 22.8571 7.82062V20.625C22.8571 22.4792 22.1869 24.2918 20.9311 25.8335C19.6753 27.3752 17.8904 28.5768 15.8021 29.2864C13.7138 29.9959 11.4159 30.1816 9.19897 29.8199C6.98205 29.4581 4.94567 28.5652 3.34736 27.2541C1.74904 25.943 0.660576 24.2725 0.219602 22.454C-0.221372 20.6354 0.00495177 18.7504 0.869953 17.0373C1.73495 15.3243 3.19978 13.8601 5.0792 12.83C6.95862 11.7998 9.16822 11.25 11.4286 11.25V15C10.0724 15 8.7466 15.3299 7.61895 15.948C6.4913 16.5661 5.6124 17.4446 5.0934 18.4724C4.5744 19.5002 4.43861 20.6312 4.70319 21.7224C4.96777 22.8135 5.62085 23.8158 6.57984 24.6025C7.53883 25.3891 8.76066 25.9249 10.0908 26.1419C11.421 26.359 12.7997 26.2476 14.0527 25.8218C15.3057 25.3961 16.3766 24.6751 17.1301 23.7501C17.8836 22.8251 18.2857 21.7375 18.2857 20.625V0Z"
					fill="white" />
			</svg>
			<?php return ob_get_clean();
		case 'behance':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 32 32" id="behance">
				<path
					d="M13.365 16.525h-3.15v3.15h3.15c.227 0 1.575-.016 1.575-1.575s-1.575-1.575-1.575-1.575zM14.091 13.622c0-1.281-.988-1.297-.988-1.297h-2.887v2.625h2.887s.988 0 .988-1.328zM21.24 14.95c-1.61 0-1.575 1.575-1.575 1.575h3.15s.034-1.575-1.575-1.575z">
				</path>
				<path
					d="M16 0C7.163 0 0 7.164 0 16s7.163 16 16 16c8.836 0 16-7.164 16-16S24.837 0 16 0zm3.14 11.8h4.2v1.05h-4.2V11.8zm-2.362 6.3c0 3.241-2.887 3.15-2.887 3.15H8.115v-10.5l5.644.009c1.647 0 2.725.937 2.725 2.836 0 1.901-1.589 2.022-1.589 2.022 2.095.001 1.883 2.483 1.883 2.483zm4.462 1.575c1.575 0 1.575-1.575 1.575-1.575h2.1c0 3.15-3.675 3.15-3.675 3.15-4.2 0-3.937-3.937-3.937-3.937s-.007-3.937 3.937-3.937c3.675 0 3.675 3.15 3.675 4.2h-5.25c0 2.099 1.575 2.099 1.575 2.099z">
				</path>
			</svg>
			<?php return ob_get_clean();

		case 'next-btn':
			ob_start(); ?>

			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path
					d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z"
					stroke="#E3B24C" />
				<path
					d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z"
					fill="#E3B24C" />
			</svg>
			<?php return ob_get_clean();
		default:
			return;
	}
}
