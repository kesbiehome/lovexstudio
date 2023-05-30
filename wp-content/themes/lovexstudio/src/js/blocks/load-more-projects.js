import {
	select,
	getData,
	on,
	appendHtml,
	createNodes,
	getChildren,
	append,
	trigger,
	remove,
} from 'lib/dom';
import { addQueryVar, map } from 'lib/utils';
import { selectAll } from '../lib/dom';

export default (el) => {
	const loadMoreButton = select('.js-button', el);
	let settings = getData('set', loadMoreButton)
		? JSON.parse(getData('set', loadMoreButton))
		: {};

	const projectTabs = select('[data-child-block="project-tabs"]');

	const projectGridEl = select('.project-grid', el)
	const projectColumnEls = selectAll('.project-column', projectGridEl)

	const loadMore = () => {
		let restUrl = `${lovexstudioConfig.restUrl}${lovexstudioConfig.loadMoreProjectsApi}`;
		restUrl = addQueryVar('termID', settings.termID, restUrl);
		restUrl = addQueryVar('postsPerPage', settings.postsPerPage, restUrl);
		restUrl = addQueryVar('paged', parseInt(settings.paged) + 1, restUrl);

		fetch(restUrl)
			.then((res) => res.json())
			.then((res) => {
				const columnContent = res.html;
				const args = res.args;

				map((column, index) => {
					const columnNode = createNodes(columnContent[index]);
					const cardEls = selectAll('.project-card', columnNode[0]);

					append(column, cardEls);
				}, projectColumnEls);

				if (!args['nextPage']) {
					remove(loadMoreButton);
					loadMoreButton;
				} else {
					settings.paged++;
				}
			})
			.then(() => {
				trigger(
					{
						event: 'update',
						data: {
							currentIndex: 0,
						},
					},
					projectTabs
				);
			});
	};

	on(
		'click',
		() => {
			loadMore()
		},
		loadMoreButton
	)
}
