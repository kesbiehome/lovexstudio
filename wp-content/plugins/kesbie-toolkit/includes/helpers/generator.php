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

	if (isset($args['prevNextButton'])) :
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M40.5061 66.2054V6.25536L6.24987 36.2304L40.5061 66.2054ZM36.3874 70.9116L2.13737 40.9366C1.46606 40.35 0.928023 39.6265 0.559375 38.8148C0.190726 38.0031 0 37.1219 0 36.2304C0 35.3388 0.190726 34.4577 0.559375 33.6459C0.928023 32.8342 1.46606 32.1107 2.13737 31.5241L36.3874 1.54911C37.2911 0.757305 38.4039 0.242775 39.5925 0.067139C40.7811 -0.108497 41.9952 0.0622051 43.0893 0.558804C44.1834 1.0554 45.1112 1.85685 45.7615 2.86716C46.4118 3.87748 46.7572 5.05383 46.7561 6.25536V66.2054C46.7572 67.4069 46.4118 68.5832 45.7615 69.5936C45.1112 70.6039 44.1834 71.4053 43.0893 71.9019C41.9952 72.3985 40.7811 72.5692 39.5925 72.3936C38.4039 72.2179 37.2911 71.7034 36.3874 70.9116Z" fill="#D3FFEE" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.25 66.2147V6.26469L40.5063 36.2397L6.25 66.2147ZM10.3688 70.9209L44.6188 40.9459C45.2901 40.3593 45.8281 39.6358 46.1968 38.8241C46.5654 38.0124 46.7561 37.1312 46.7561 36.2397C46.7561 35.3482 46.5654 34.467 46.1968 33.6553C45.8281 32.8435 45.2901 32.1201 44.6188 31.5334L10.375 1.55844C6.31875 -1.97906 2.29816e-06 0.895942 2.29816e-06 6.26469V66.2147C-0.00102787 67.4162 0.344299 68.5926 0.994631 69.6029C1.64496 70.6132 2.57273 71.4146 3.66683 71.9113C4.76093 72.4079 5.97499 72.5786 7.16361 72.4029C8.35223 72.2273 9.46503 71.7128 10.3688 70.9209Z" fill="#D3FFEE" />
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

	if (isset($args['prevNextButton']) && isset($args['prevNextButtonOutSide']) && $args['prevNextButtonOutSide']) :
		ob_start(); ?>
		<div class="swiper-button-prev">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M40.5061 66.2054V6.25536L6.24987 36.2304L40.5061 66.2054ZM36.3874 70.9116L2.13737 40.9366C1.46606 40.35 0.928023 39.6265 0.559375 38.8148C0.190726 38.0031 0 37.1219 0 36.2304C0 35.3388 0.190726 34.4577 0.559375 33.6459C0.928023 32.8342 1.46606 32.1107 2.13737 31.5241L36.3874 1.54911C37.2911 0.757305 38.4039 0.242775 39.5925 0.067139C40.7811 -0.108497 41.9952 0.0622051 43.0893 0.558804C44.1834 1.0554 45.1112 1.85685 45.7615 2.86716C46.4118 3.87748 46.7572 5.05383 46.7561 6.25536V66.2054C46.7572 67.4069 46.4118 68.5832 45.7615 69.5936C45.1112 70.6039 44.1834 71.4053 43.0893 71.9019C41.9952 72.3985 40.7811 72.5692 39.5925 72.3936C38.4039 72.2179 37.2911 71.7034 36.3874 70.9116Z" fill="#D3FFEE" />
			</svg>
		</div>
		<div class="swiper-button-next">
			<svg width="47" height="73" viewBox="0 0 47 73" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.25 66.2147V6.26469L40.5063 36.2397L6.25 66.2147ZM10.3688 70.9209L44.6188 40.9459C45.2901 40.3593 45.8281 39.6358 46.1968 38.8241C46.5654 38.0124 46.7561 37.1312 46.7561 36.2397C46.7561 35.3482 46.5654 34.467 46.1968 33.6553C45.8281 32.8435 45.2901 32.1201 44.6188 31.5334L10.375 1.55844C6.31875 -1.97906 2.29816e-06 0.895942 2.29816e-06 6.26469V66.2147C-0.00102787 67.4162 0.344299 68.5926 0.994631 69.6029C1.64496 70.6132 2.57273 71.4146 3.66683 71.9113C4.76093 72.4079 5.97499 72.5786 7.16361 72.4029C8.35223 72.2273 9.46503 71.7128 10.3688 70.9209Z" fill="#D3FFEE" />
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
				'name' => $item['name'],
				'key' => $item['key'] ?? '',
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
	if (!empty($args['class'])) :
		$_class .= ' ' . esc_attr($args['class']);
	endif;

	$tab_data = kesbie_generate_tabs_data($items);

	$markup = sprintf('<div class="%s" data-aos="fade-up">', esc_attr($_class));

	$lazyload = $args['lazyload'] ?? true;

	/**
	 * Generate nav items
	 */
	ob_start();
	if (!empty($tab_data['nav_items'])) :
		echo '<ul class="kesbie-tabs__nav-items" data-aos="fade-up" aria-controls="js-tab-contents" role="tablist">';
		foreach ($tab_data['nav_items'] as $nav_item) :
			printf(
				'<li class="rel kesbie-tabs__nav-item" role="tab" aria-controls="%1$s" aria-selected="%2$s" data-key="%3$s">%4$s</li>',
				$nav_item['id'],
				var_export($nav_item['is_active'], true),
				$nav_item['key'],
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
	if (!empty($tab_data['content_items'])) :
		echo '<div class="kesbie-tabs__tab-contents js-tab-contents">';
		foreach ($tab_data['content_items'] as $index => $content_item) :
			$_item_class = 'kesbie-tabs__tab-content js-tab-content';

			if ($lazyload && $index > 0) :
				$_item_class .= ' is-not-loaded';
			endif;

			printf(
				'<div class="%s" id="%s" role="tabpanel" aria-expanded="%s">',
				$_item_class,
				$content_item['id'],
				var_export($content_item['is_active'], true)
			);

			if ($lazyload && $index > 0) :
				echo '<noscript>';
			endif;

			echo $content_item['content'];

			if ($lazyload && $index > 0) :
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
				<path d="M339.3 367.1c27.3-3.9 51.9-19.4 67.2-42.9L568.2 74.1c12.6-19.5 9.4-45.3-7.6-61.2S517.7-4.4 499.1 9.6L262.4 187.2c-24 18-38.2 46.1-38.4 76.1L339.3 367.1zm-19.6 25.4l-116-104.4C143.9 290.3 96 339.6 96 400c0 3.9 .2 7.8 .6 11.6C98.4 429.1 86.4 448 68.8 448H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H208c61.9 0 112-50.1 112-112c0-2.5-.1-5-.2-7.5z" />
			</svg>
		<?php return
				ob_get_clean();
		case 'instagram':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 19.2 19.2">
				<path d="M13.498 6.651a1.656 1.656 0 0 0-.95-.949 2.766 2.766 0 0 0-.928-.172c-.527-.024-.685-.03-2.02-.03s-1.493.006-2.02.03a2.766 2.766 0 0 0-.929.172 1.656 1.656 0 0 0-.949.95 2.766 2.766 0 0 0-.172.928c-.024.527-.03.685-.03 2.02s.006 1.493.03 2.02a2.766 2.766 0 0 0 .172.929 1.656 1.656 0 0 0 .95.949 2.766 2.766 0 0 0 .928.172c.527.024.685.03 2.02.03s1.493-.006 2.02-.03a2.766 2.766 0 0 0 .929-.172 1.656 1.656 0 0 0 .949-.95 2.766 2.766 0 0 0 .172-.928c.024-.527.03-.685.03-2.02s-.006-1.493-.03-2.02a2.766 2.766 0 0 0-.172-.929zM9.6 12.168A2.568 2.568 0 1 1 12.168 9.6 2.568 2.568 0 0 1 9.6 12.168zm2.669-4.637a.6.6 0 1 1 .6-.6.6.6 0 0 1-.6.6z">
				</path>
				<circle cx="9.6" cy="9.6" r="1.667"></circle>
				<path d="M9.6 0a9.6 9.6 0 1 0 9.6 9.6A9.6 9.6 0 0 0 9.6 0zm4.97 11.662a3.67 3.67 0 0 1-.233 1.213 2.556 2.556 0 0 1-1.462 1.462 3.67 3.67 0 0 1-1.213.233c-.534.024-.704.03-2.062.03s-1.528-.006-2.062-.03a3.67 3.67 0 0 1-1.213-.233 2.556 2.556 0 0 1-1.462-1.462 3.67 3.67 0 0 1-.233-1.213c-.024-.534-.03-.704-.03-2.062s.006-1.528.03-2.062a3.67 3.67 0 0 1 .233-1.213 2.556 2.556 0 0 1 1.462-1.462 3.67 3.67 0 0 1 1.213-.233c.534-.024.704-.03 2.062-.03s1.528.006 2.062.03a3.67 3.67 0 0 1 1.213.233 2.556 2.556 0 0 1 1.462 1.462 3.67 3.67 0 0 1 .233 1.213c.024.534.03.704.03 2.062s-.006 1.528-.03 2.062z">
				</path>
			</svg>
		<?php return ob_get_clean();

		case 'youtube':
			ob_start(); ?>
			<svg width="28" height="17" viewBox="0 0 28 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.0901 0H14.2459C15.6845 0.00453777 22.9737 0.0499157 24.9391 0.506718C25.5332 0.646131 26.0746 0.917874 26.5092 1.29479C26.9438 1.67171 27.2563 2.14059 27.4155 2.6546C27.5922 3.22938 27.7165 3.99021 27.8005 4.77525L27.818 4.93256L27.8565 5.32583L27.8705 5.48314C27.9843 6.86565 27.9983 8.16042 28 8.44328V8.55672C27.9983 8.85017 27.9825 10.2327 27.8565 11.6727L27.8425 11.8315L27.8267 11.9888C27.7392 12.854 27.6097 13.7131 27.4155 14.3454C27.2563 14.8594 26.9438 15.3283 26.5092 15.7052C26.0746 16.0821 25.5332 16.3539 24.9391 16.4933C22.9089 16.9652 15.1927 16.9985 14.1234 17H13.8749C13.3341 17 11.0974 16.9909 8.7523 16.9213L8.45478 16.9123L8.30252 16.9062L8.00325 16.8956L7.70398 16.885C5.76136 16.8109 3.91149 16.6914 3.05919 16.4918C2.46525 16.3525 1.92398 16.081 1.48943 15.7043C1.05488 15.3277 0.742262 14.8591 0.582787 14.3454C0.388524 13.7147 0.259016 12.854 0.171511 11.9888L0.15751 11.83L0.143509 11.6727C0.0566395 10.6477 0.00877735 9.62065 0 8.59302L0 8.40698C0.00350022 8.08177 0.0175011 6.95791 0.112007 5.71759L0.124258 5.56179L0.129508 5.48314L0.143509 5.32583L0.182011 4.93256L0.199512 4.77525C0.283518 3.99021 0.407775 3.22787 0.584537 2.6546C0.743745 2.14059 1.05625 1.67171 1.49081 1.29479C1.92538 0.917874 2.46679 0.646131 3.06094 0.506718C3.91324 0.310081 5.76311 0.189074 7.70573 0.113444L8.00325 0.102856L8.30427 0.0937808L8.45478 0.089243L8.75405 0.0786549C10.4196 0.0323749 12.0859 0.00665806 13.7524 0.00151266L14.0901 0ZM11.2007 4.85541V12.1431L18.4759 8.50076L11.2007 4.85541Z" fill="white" />
			</svg>


		<?php return ob_get_clean();

		case 'facebook':
			ob_start(); ?>
			<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 8.55206C18 3.82877 13.9708 0 9.00112 0C4.02925 0.00106237 0 3.82877 0 8.55312C0 12.8206 3.29134 16.3583 7.5928 17V11.0242H5.30934V8.55312H7.59505V6.66742C7.59505 4.52462 8.93926 3.34114 10.9944 3.34114C11.9798 3.34114 13.009 3.50794 13.009 3.50794V5.61142H11.874C10.757 5.61142 10.4083 6.27115 10.4083 6.94788V8.55206H12.9033L12.5051 11.0231H10.4072V16.9989C14.7087 16.3573 18 12.8196 18 8.55206Z" fill="white" />
			</svg>

		<?php return ob_get_clean();
		case 'tiktok':
			ob_start(); ?>
			<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.71429 0H12.1186C12.2934 0.759687 12.7743 1.71806 13.6182 2.669C14.4439 3.60081 15.5392 4.25 17 4.25V6.375C14.8714 6.375 13.2721 5.51012 12.1429 4.43169V11.6875C12.1429 12.7382 11.7868 13.7653 11.1196 14.639C10.4525 15.5126 9.50427 16.1935 8.39487 16.5956C7.28546 16.9977 6.0647 17.1029 4.88695 16.8979C3.70921 16.6929 2.62739 16.187 1.77828 15.444C0.929178 14.701 0.350931 13.7544 0.116664 12.7239C-0.117604 11.6934 0.00263063 10.6252 0.462163 9.65449C0.921695 8.68376 1.69988 7.85406 2.69833 7.27032C3.69677 6.68657 4.87062 6.375 6.07143 6.375V8.5C5.35094 8.5 4.64663 8.68694 4.04757 9.03719C3.4485 9.38744 2.98159 9.88526 2.70587 10.4677C2.43015 11.0501 2.35801 11.691 2.49857 12.3093C2.63913 12.9277 2.98608 13.4956 3.49554 13.9414C4.005 14.3872 4.6541 14.6908 5.36074 14.8138C6.06739 14.9367 6.79985 14.8736 7.46549 14.6324C8.13114 14.3911 8.70007 13.9826 9.10035 13.4584C9.50064 12.9342 9.71429 12.3179 9.71429 11.6875V0Z" fill="white" />
			</svg>

		<?php return ob_get_clean();
		case 'behance':
			ob_start(); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 32 32" id="behance">
				<path d="M13.365 16.525h-3.15v3.15h3.15c.227 0 1.575-.016 1.575-1.575s-1.575-1.575-1.575-1.575zM14.091 13.622c0-1.281-.988-1.297-.988-1.297h-2.887v2.625h2.887s.988 0 .988-1.328zM21.24 14.95c-1.61 0-1.575 1.575-1.575 1.575h3.15s.034-1.575-1.575-1.575z">
				</path>
				<path d="M16 0C7.163 0 0 7.164 0 16s7.163 16 16 16c8.836 0 16-7.164 16-16S24.837 0 16 0zm3.14 11.8h4.2v1.05h-4.2V11.8zm-2.362 6.3c0 3.241-2.887 3.15-2.887 3.15H8.115v-10.5l5.644.009c1.647 0 2.725.937 2.725 2.836 0 1.901-1.589 2.022-1.589 2.022 2.095.001 1.883 2.483 1.883 2.483zm4.462 1.575c1.575 0 1.575-1.575 1.575-1.575h2.1c0 3.15-3.675 3.15-3.675 3.15-4.2 0-3.937-3.937-3.937-3.937s-.007-3.937 3.937-3.937c3.675 0 3.675 3.15 3.675 4.2h-5.25c0 2.099 1.575 2.099 1.575 2.099z">
				</path>
			</svg>
		<?php return ob_get_clean();

		case 'next-btn':
			ob_start(); ?>

			<svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="42" cy="42" r="41.5" stroke="#E3B24C" />
				<path d="M58.5538 42.0915C58.8361 42.2907 58.8361 42.7093 58.5538 42.9085L41.0383 55.2684C40.7071 55.5021 40.25 55.2652 40.25 54.8599L40.25 30.1401C40.25 29.7348 40.7071 29.4979 41.0383 29.7316L58.5538 42.0915Z" stroke="#E3B24C" />
				<path d="M49.785 41.6732C50.3682 42.0701 50.3682 42.9299 49.785 43.3268L31.5626 55.7262C30.8987 56.1779 30 55.7024 30 54.8994L30 30.1006C30 29.2976 30.8987 28.8221 31.5626 29.2738L49.785 41.6732Z" fill="#E3B24C" />
			</svg>
<?php return ob_get_clean();
		default:
			return;
	}
}
