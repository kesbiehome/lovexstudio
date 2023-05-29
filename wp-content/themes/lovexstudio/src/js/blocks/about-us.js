import {
	select,
	selectAll,
	addClass,
	hasClass,
	loadNoScriptContent,
	removeClass
} from 'lib/dom'
import Plyr from 'plyr'

const LOADING_CLASS = 'is-loading'
const PLYR_STYLESHEET = 'https://cdn.plyr.io/3.6.4/plyr.css'

export default el => {
	Fancybox.bind('[data-fancybox]', {
		// Your custom options
	})
}
