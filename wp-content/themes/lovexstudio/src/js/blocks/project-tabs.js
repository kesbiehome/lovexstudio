import {
	select,
	selectAll,
	on,
	getChildren,
	getHeight,
	setAttribute
} from 'lib/dom'
import Tabs from 'lib/tabs'

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
}