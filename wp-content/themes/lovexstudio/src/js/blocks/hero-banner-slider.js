import {
	select,
	selectAll,
	hasClass,
	addClass,
	loadNoscriptContent,
	on
} from 'lib/dom'
import Swiper from 'swiper/bundle'

const BREAKPOINT = 781

export default el => {
	const initApp = () => {
		const sliderEl = select('.js-hero-slider', el)
		let slider = null
		let slideEls = null
		if (sliderEl) {
			slider = new Swiper(sliderEl, {
				slidesPerView: 1,
				autoplay: {
					delay: 5000
				},
				navigation: {
					nextEl: select('.swiper-button-next', sliderEl),
					prevEl: select('.swiper-button-prev', sliderEl)
				}
			})

			const windowWidth =
				window.innerWidth ||
				document.documentElement.clientWidth ||
				document.body.clientWidth

			/**
			 * Remove lazyload on next and prev active image when slider loaded
			 */

			slideEls = selectAll('.swiper-slide', el)

			if (windowWidth > BREAKPOINT) {
				slideEls.map(slideEl => {
					if (
						hasClass('swiper-slide-prev', slideEl) ||
						hasClass('swiper-slide-next', slideEl)
					) {
						loadNoscriptContent(slideEl)
					}
				})
			}

			slider.on('activeIndexChange', () => {
				if (windowWidth > BREAKPOINT) {
					slideEls.map(slideEl => {
						if (hasClass('is-not-loaded', slideEl)) {
							loadNoscriptContent(slideEl)
						}
					})
				}
			})
		}
	}

	on('load', initApp, window)
}
