<?php

/**
 * Include Some Files
 */
// require_once('lib/actions-child.php'); - Add new file in progect
// ...


/**
 * Advanced Custom Fields theme support
 */
function hmt_acf_json_save( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'hmt_acf_json_save' );

function hmt_acf_json_load( $paths ) {
	unset( $paths[0] );

	$paths[] = get_template_directory() . '/acf-json';
	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'hmt_acf_json_load' );

/**
 * Theme Dependence
 */
function hmt_init_acf_child() {
	require_once('lib/acf/supported-blocks.php');
	require_once('lib/child-theme/assets.php');
}
add_action( 'after_setup_theme', 'hmt_init_acf_child' );

/**
 * Register new global modals.
 */
//function hmt_register_modals(): array {
//	return [
//		[
//			'global' => false,
//			'action_name' => 'new-popup',
//			'action_description' => __( 'New Popup', THEME_TEXTDOMAIN ),
//			'action_modal_renderer' => function () {
//				get_template_part( 'template-parts/popups/new-popup');
//			}
//		]
//	];
//}


/**
 * Register new admin pages.
 */
//function hmt_register_acf_child_settings() {
//	acf_add_options_sub_page( array(
//		'page_title' 	=> __( 'Test Settings', THEME_TEXTDOMAIN ),
//		'menu_title' 	=> __( 'Test', THEME_TEXTDOMAIN ),
//		'menu_slug' 	=> 'theme-test',
//		'parent_slug' 	=> 'theme-settings',
//	) );
//}