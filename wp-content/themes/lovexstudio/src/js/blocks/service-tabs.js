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

			setTabActive(currentTabIndex)
		},
		el
	)
}
