import {
	on,
	selectAll,
	setAttribute,
	trigger,
	addClass,
	removeClass
} from 'lib/dom'

export default (el, customOptions = {}) => {
	const defaultOptions = {
		tabNavSelector: '[role="tab"]',
		tabPanelSelector: '[role="tabpanel"]',
		activeNavClass: 'is-active',
		activePanelClass: 'is-active',
		lazyload: true,
		index: 0,
		lazyloadCallback: function () {}
	}

	const options = { ...defaultOptions, ...customOptions }
	const navItems = selectAll(options.tabNavSelector, el)
	const panels = selectAll(options.tabPanelSelector, el)

	on(
		'update',
		e => {
			for (let index = 0; index < navItems.length; index++) {
				if (index === e.detail.currentIndex) {
					setAttribute('aria-selected', 'true', navItems[index])
					addClass(options.activeNavClass, navItems[index])

					setAttribute('aria-expanded', 'true', panels[index])
					addClass(options.activePanelClass, panels[index])

					if (options.lazyload) {
						checkTabPanelLoad(panels[index])

						if (typeof options.lazyloadCallback === 'function') {
							options.lazyloadCallback(navItems[index], panels[index])
						}
					}
				} else {
					setAttribute('aria-selected', 'false', navItems[index])
					removeClass(options.activeNavClass, navItems[index])

					setAttribute('aria-expanded', 'false', panels[index])
					removeClass(options.activePanelClass, panels[index])
				}
			}
		},
		el
	)

	const checkTabPanelLoad = tabPanel => {
		const contextEls = tabPanel.getElementsByTagName('noscript')

		if (!contextEls || !contextEls.length) {
			return false
		}

		const content = contextEls[0].textContent || contextEls[0].innerHTML

		tabPanel.innerHTML = content
	}

	const getParentElByTagName = (tag, el) => {
		let newEl = el.parentElement

		if (newEl.tagName.toLowerCase() === tag) {
			return newEl
		}

		return getParentElByTagName(tag, newEl)
	}

	on(
		'click',
		e => {
			let navItem = e.target

			if (navItem.tagName.toLowerCase() != 'li') {
				navItem = getParentElByTagName('li', e.target)
			}

			trigger(
				{
					event: 'update',
					data: {
						currentIndex: navItems.indexOf(navItem)
					}
				},
				el
			)
		},
		navItems
	)

	trigger(
		{
			event: 'update',
			data: {
				currentIndex: options.index
			}
		},
		el
	)
}
