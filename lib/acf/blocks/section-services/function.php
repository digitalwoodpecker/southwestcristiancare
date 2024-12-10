<?php

$style_handles = hmt_register_blocks_style( THEME_TEXTDOMAIN . '-section-services', 'section-services.css', [] );
$script_handles = hmt_register_blocks_script( THEME_TEXTDOMAIN . '-section-services', 'section-services.js', [THEME_TEXTDOMAIN . '-google-map'], false, true );

$config = [
	'style_handles' => $style_handles,
	'script_handles' => $script_handles,
	'example' => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'block_preview_images' => [
					get_theme_file_uri('/dist/admin/img/block-previews/block-preview-section-service-hero-v1.jpg'),
				]
			]
		]
	]
];
