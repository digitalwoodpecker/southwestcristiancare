<?php
function hmt_enqueue_child_assets() {
	wp_enqueue_script( THEME_TEXTDOMAIN . '-main-child', THEME_CHILD_URL . assets_bundle_child( 'main.js' ), array('jquery'), false, true );
	wp_enqueue_style( THEME_TEXTDOMAIN . '-style-child', THEME_CHILD_URL . assets_bundle_child( 'main.css' ) );

	wp_enqueue_script(
		THEME_TEXTDOMAIN . '-webpack5-runtime-child',
		THEME_CHILD_URL . assets_bundle_child( 'runtime.js' ),
		array(),
		null,
		false
	);
}
add_action( 'enqueue_block_assets', 'hmt_enqueue_child_assets' );