//  Big thanks to EBISUCOM (https://github.com/ebisucom/wordpress-note-lp) for the creative ideas

wp.domReady(() => {
	wp.blocks.registerBlockStyle('core/cover', {
		// cover block

		name: 'lpheight',
		label: 'arrange the height',
	});

	wp.blocks.registerBlockStyle('core/heading', {
		// heading block

		name: 'lpshadow',
		label: 'cast a shadow',
	});

	wp.blocks.registerBlockStyle('core/paragraph', {
		// paragraph block

		name: 'lpshadow',
		label: 'cast a shadow',
	});

	wp.blocks.registerBlockStyle('core/columns', {
		// column block

		name: 'lpconcepts',
		label: 'concept',
	});

	wp.blocks.registerBlockStyle('ugb/blog-posts', {
		// Posts block of Stackable

		name: 'lpposts',
		label: 'latest news',
	});

	wp.blocks.registerBlockStyle('core/media-text', {
		// media and text block

		name: 'lpmedia',
		label: 'arrange of height(column fill)',
	});

	wp.blocks.registerBlockStyle('core/media-text', {
		// media and text block: card type

		name: 'lpcard',
		label: 'card-shaped',
	});

	wp.blocks.registerBlockStyle('core/group', {
		// group

		name: 'lpgroup',
		label: 'side-by-side',
	});
});
