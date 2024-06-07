import {
	select,
	selectAll,
	on,
	getChildren,
	getHeight,
	setAttribute,
	getParent
} from 'lib/dom'
import { map, throttle } from 'lib/utils'
import Tabs from 'lib/tabs'

export default el => {
	const url_string = window.location.href
	let url = new URL(url_string)
	let service = url.searchParams.get('service')
	let index = 0
	let activeLoop = true
	let nav = select('.kesbie-tabs__nav-items')

	if (service) {
		let elSearch = select('#service_' + service)
		let elChoice = getParent(elSearch)
		let navItems = selectAll('[role="tab"]', el)
		index = navItems.indexOf(elChoice) ?? 0
	}

	let maxHeight = 0

	let tabInstance = Tabs(el, {
		index: index
	})

	const parentContentEl = select('.js-tab-contents', el)
	const tabContentEls = selectAll('[role="tabpanel"]', el)

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

	setTabActive(index)

	/**
	 * Update height based on current active tab
	 */
	on(
		'update',
		e => {
			const currentTabIndex = e.detail.currentIndex
			index = currentTabIndex
			activeLoop = false
			setTabActive(currentTabIndex)
		},
		el
	)

	function loop () {
		if (activeLoop) {
			setTimeout(function () {
				if (index < tabContentEls.length - 1) {
					index = index + 1
					nav.scrollLeft += 120
				} else {
					index = 0
					nav.scrollLeft = 0
				}
				let tabInstance = Tabs(el, {
					index: index
				})

				// Again
				loop()

				// Every 5 sec
			}, 5000)
		}
	}

	// Begins
	loop()
}
