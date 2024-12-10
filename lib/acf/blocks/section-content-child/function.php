<?php

$style_handles = hmt_register_blocks_style( THEME_TEXTDOMAIN . '-section-content-child', assets_bundle_child( 'section-content-child.css' ), [] );
$script_handles = hmt_register_blocks_script( THEME_TEXTDOMAIN . '-section-content-child', assets_bundle_child( 'section-content-child.js' ), [], false, true );

$config = [
	'style_handles' => $style_handles,
	'script_handles' => $script_handles,
	'icon' => hmt_get_svg_inline( get_theme_file_path('/dist/admin/img/icons/icon-header.svg') ),
	'example' => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'block_preview_images' => [
					get_theme_file_uri('/dist/admin/img/block-previews/block-preview-section-intro-v1.jpg'),
				]
			]
		]
	]
];