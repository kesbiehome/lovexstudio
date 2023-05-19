const blocks = document.querySelectorAll('[data-child-block]');
import './postcss/frontend.css';

const initChildBlocks = () => {
	if (blocks) {
		blocks.forEach((block) => {
			const blockName = block.getAttribute('data-child-block');
			if (!blockName) {
				return;
			}

			require(`./js/blocks/${blockName}.js`).default(block);
		});
	}
};

document.addEventListener('DOMContentLoaded', initChildBlocks);
