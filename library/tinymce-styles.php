<?php
/**
 * Foundation Styles for TinyMCE
 */

 // Callback function to insert 'styleselect' into the $buttons array
 function my_mce_buttons_2( $buttons ) {
 	array_unshift( $buttons, 'styleselect' );
 	return $buttons;
 }
 // Register our callback to the appropriate filter
 add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );


 // Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Primary Button',
			'selector' => 'a',
			'classes' => 'large button',
		),
		array(
			'title' => 'Secondary Button',
			'selector' => 'a',
			'classes' => 'large secondary button',
		),
    array(
			'title' => 'Clear Button',
			'selector' => 'a',
			'classes' => 'large clear button',
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/*
 * Modify TinyMCE editor to remove H1.
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Address=address;Pre=pre';
	return $init;
}

add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
