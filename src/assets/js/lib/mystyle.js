//  Big thanks to EBISUCOM (https://github.com/ebisucom/wordpress-note-lp) for the creative ideas

wp.domReady(() => {
	wp.blocks.registerBlockStyle('core/image', {
		name: 'my50vh',
		label: 'arrange the height',
		isDefault: true,
	});
});
