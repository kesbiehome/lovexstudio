import {
	select,
	selectAll,
	on,
	getChildren,
	getHeight,
	setAttribute
} from 'lib/dom'
import { map, throttle } from 'lib/utils'
import Tabs from 'lib/tabs'

const MAX_MOBILE_WIDTH = 768

export default el => {
	let tabInstance = Tabs(el, {
		lazyload: true
	})
	let maxHeight = 0

	const parentContentEl = select('.js-tab-contents', el)
	const tabContentEls = selectAll('[role="tabpanel"]', el)

	// const tabActive =
	const setParentHeight = height => {
		if (!parentContentEl) {
			return
		}

		setAttribute(`style`, `height: ${height}px`, parentContentEl)
	}

	const setTabActive = currentTabIndex => {
		const currentTabContentEl = tabContentEls[currentTabIndex]

		if (currentTabContentEl) {
			let childHeight = 16
			getChildren(currentTabContentEl).map(item => {
				childHeight += getHeight(item)
			})

			if (childHeight !== maxHeight) {
				maxHeight = childHeight
				setParentHeight(childHeight)
			}
		}
	}

	const handleData = el => {
		const cardHandled = []
		const cardRaw = []
		const columnEls = selectAll('.project-column', el)

		map(el => {
			const cardEls = selectAll('.project-card', el)
			cardRaw.push(cardEls)
		}, columnEls)

		map((el, index) => {}, cardRaw)
	}

	const setMobileLayout = () => {
		const windowWidth =
			window.innerWidth || document.documentElement.clientWidth

		if (windowWidth > MAX_MOBILE_WIDTH) {
			return
		}

		if (!tabContentEls) {
			return
		}

		map(el => {
			handleData(el)
		}, tabContentEls)
	}

	setTabActive(0)

	/**
	 * Update height based on current active tab
	 */
	on(
		'update',
		e => {
			const currentTabIndex = e.detail.currentIndex

			setTabActive(currentTabIndex)
		},
		el
	)

	on(
		'load',
		() => {
			setMobileLayout()
		},
		window
	)
}
