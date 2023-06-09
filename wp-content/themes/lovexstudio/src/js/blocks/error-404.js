import {
	select,
	selectAll,
	addClass,
	hasClass,
	loadNoScriptContent,
	removeClass,
	setStyle
} from 'lib/dom'
import Plyr from 'plyr'

const LOADING_CLASS = 'is-loading'
const PLYR_STYLESHEET = 'https://cdn.plyr.io/3.6.4/plyr.css'

export default el => {
	const headerHeight = select('#masthead').offsetHeight
	const footerHeight = select('.site-footer').offsetHeight

	const contentHeight = `calc(100vh - (${headerHeight}px + ${footerHeight}px))`
	
	setStyle('height', contentHeight, el)
}
