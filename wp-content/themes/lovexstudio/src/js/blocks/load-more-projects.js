import { select, getData, on, appendHtml, createNodes } from 'lib/dom'
import { addQueryVar, map } from 'lib/utils'
import { selectAll } from '../lib/dom'

export default el => {
	const loadMoreButton = select('.js-button', el)
	let dataSet = JSON.parse(getData('set', loadMoreButton))

	const projectGridEl = select('.project-grid', el)
	const projectColumnEls = selectAll('.project-column', projectGridEl)

	console.log(projectColumnEls)

	const loadMore = () => {
		let restUrl = `${lovexstudioConfig.restUrl}${lovexstudioConfig.loadMoreProjectsApi}`
		restUrl = addQueryVar('termID', dataSet.termID, restUrl)
		restUrl = addQueryVar('postsPerPage', dataSet.postsPerPage, restUrl)
		restUrl = addQueryVar('paged', parseInt(dataSet.paged) + 1, restUrl)

		fetch(restUrl)
			.then(res => res.json())
			.then(res => {
				const columnContent = res.html

				map((column, index) => {
					const columnNode = createNodes(columnContent[index])
					const cardEls = selectAll('.project-card', columnNode)
					console.log(cardEls)
				}, projectColumnEls)
			})
	}

	on(
		'click',
		() => {
			loadMore()
		},
		loadMoreButton
	)
}
