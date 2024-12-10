<?php

add_action( 'init', 'hmt_register_post_types' );
function hmt_register_post_types() {

	$enabled_services = get_field('global_enable_services', 'option');
	$enabled_projects = get_field('global_enable_projects', 'option');
	$enabled_testimonials = get_field('global_enable_testimonials', 'option');
	$enabled_equipment = get_field('global_enable_equipment', 'option');
	$enabled_industries = get_field('global_enable_industries', 'option');
	$enabled_service_areas = get_field('global_enable_service_areas', 'option');
	$enabled_vacancies = get_field('global_enable_vacancies', 'option');

	if( $enabled_services && $enabled_services == 'enabled' && !post_type_exists('program')):
		register_taxonomy(
			'location',
			['program', 'page'],
			[
				'labels' => array(
					'name' => _x( 'Locations', 'taxonomy general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Location', 'taxonomy singular name', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Locations', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Locations', THEME_TEXTDOMAIN ),
					'parent_item' => __( 'Parent Location', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Location:', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Location', THEME_TEXTDOMAIN ),
					'update_item' => __( 'Update Location', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Location', THEME_TEXTDOMAIN ),
					'new_item_name' => __( 'New Location', THEME_TEXTDOMAIN ),
					'menu_name' => __( 'Locations', THEME_TEXTDOMAIN )
				),
				'public' => true,
				'publicly_queryable' => true,
				'query_var' => true,
				'show_in_nav_menus' => true,
				'show_in_rest' => true,
				'show_ui' => true,
				'show_tagcloud' => false,
				'hierarchical' => true,
				'show_admin_column' => true,
				'supports' => array('title', 'editor', 'thumbnail'),
				'rewrite' => [
					'slug' => 'location',
				]
			]
		);

		register_post_type(
			'program',
			array(
				'labels' => array(
					'name' => _x( 'programs', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'program', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'programs', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'program', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'program', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New program', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New program', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit program', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View program', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All programs', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search programs', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent programs:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No programs found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No programs found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'program'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'menu_position' => null,
				'menu_icon' => 'dashicons-admin-tools',
				'supports' => array('title', 'editor', 'page-attributes'),
			)
		);
	endif;

	if( $enabled_projects && $enabled_projects == 'enabled' && !post_type_exists('project')):
		register_taxonomy(
			'project_category',
			'project',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( 'Project Categories', 'taxonomy general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Project Category', 'taxonomy singular name', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Project Categories', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Project Categories', THEME_TEXTDOMAIN ),
					'parent_item' => __( 'Parent Project Category', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Project Category:', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Project Category', THEME_TEXTDOMAIN ),
					'update_item' => __( 'Update Project Category', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Project Category', THEME_TEXTDOMAIN ),
					'new_item_name' => __( 'New Project Category', THEME_TEXTDOMAIN ),
					'menu_name' => __( 'Project Categories', THEME_TEXTDOMAIN )
				),
				'public' => false,
				'publicly_queryable' => false,
				'show_in_nav_menus' => true,
				'show_in_rest' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'project-category'
				)
			)
		);

		register_post_type(
			'project',
			array(
				'labels' => array(
					'name' => _x( 'Projects', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Project', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Projects', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Project', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'service', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Project', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Project', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Project', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Project', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Projects', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Projects', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Projects:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No projects found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No projects found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'project'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'supports' => array('title', ['my_feature', ['field' => 'value']]),
				'menu_position' => null,
				'menu_icon' => 'dashicons-screenoptions',
			)
		);
	endif;

	if( $enabled_testimonials && $enabled_testimonials == 'enabled' && !post_type_exists('testimonial')):
		register_taxonomy(
			'testimonial_type',
			['testimonial'],
			[
				'labels' => array(
					'name' => _x( 'Testimonial Type', 'taxonomy general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Testimonial Type', 'taxonomy singular name', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Testimonial Types', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Testimonial Types', THEME_TEXTDOMAIN ),
					'parent_item' => __( 'Parent Testimonial Type', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Testimonial Type:', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Testimonial Type', THEME_TEXTDOMAIN ),
					'update_item' => __( 'Update Testimonial Type', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Testimonial Type', THEME_TEXTDOMAIN ),
					'new_item_name' => __( 'New Testimonial Type', THEME_TEXTDOMAIN ),
					'menu_name' => __( 'Testimonial Types', THEME_TEXTDOMAIN )
				),
				'public' => false,
				'publicly_queryable' => false,
				'query_var' => true,
				'show_in_nav_menus' => true,
				'show_in_rest' => true,
				'show_ui' => true,
				'show_tagcloud' => false,
				'hierarchical' => true,
				'show_admin_column' => true,
				'supports' => array('title'),
				'rewrite' => [
					'slug' => 'testimonial-type',
				]
			]
		);

		register_post_type(
			'testimonial',
			array(
				'labels' => array(
					'name' => _x( 'Testimonials', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Testimonial', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Testimonials', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Testimonial', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'testimonial', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Testimonial', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Testimonial', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Testimonial', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Testimonial', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Testimonials', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Testimonials', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Testimonial:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No projects found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No projects found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'testimonial'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'supports' => array('title'),
				'menu_position' => null,
				'menu_icon' => 'dashicons-testimonial',
			)
		);
	endif;

	if( $enabled_equipment && $enabled_equipment == 'enabled' && !post_type_exists('equipment_item')):
		register_post_type(
			'equipment_item',
			array(
				'labels' => array(
					'name' => _x( 'Equipment', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Equipment', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Equipment', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Equipment', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New Equipment Item', 'service', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Equipment Item', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Equipment Item', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Equipment Item', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Equipment Item', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Equipment Items', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Equipment Item', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Equipment Item:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No Equipment Items found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No Equipment Items found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'equipment'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'supports' => array('title'),
				'menu_position' => null,
				'menu_icon' => 'dashicons-cart',
			)
		);
	endif;

	if( $enabled_industries && $enabled_industries == 'enabled' && !post_type_exists('industry')):
		register_post_type(
			'industry',
			array(
				'labels' => array(
					'name' => _x( 'Industries', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Industry', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Industries', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Industries', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'Industry', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Industry', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Industry', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Industry', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Industry', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Industries', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Industries', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Industries:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No Industries found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No Industries found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'industry'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'menu_position' => null,
				'menu_icon' => 'dashicons-admin-tools',
				'supports' => ['title',  'editor'],
			)
		);
	endif;

	if( $enabled_service_areas && $enabled_service_areas == 'enabled' && !post_type_exists('service_area')):
		register_taxonomy(
			'service_area_category',
			'service_area',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( 'Service Areas Categories', 'taxonomy general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Service Area Category', 'taxonomy singular name', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Service Area Categories', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Service Areas Categories', THEME_TEXTDOMAIN ),
					'parent_item' => __( 'Parent Service Areas Category', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Service Areas Category:', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Service Areas Category', THEME_TEXTDOMAIN ),
					'update_item' => __( 'Update Service Areas Category', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Service Areas Category', THEME_TEXTDOMAIN ),
					'new_item_name' => __( 'New Service Areas Category', THEME_TEXTDOMAIN ),
					'menu_name' => __( 'Service Area Categories', THEME_TEXTDOMAIN )
				),
				'public' => false,
				'publicly_queryable' => false,
				'show_in_nav_menus' => true,
				'show_in_rest' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'service-area-category'
				)
			)
		);

		register_post_type(
			'service_area',
			array(
				'labels' => array(
					'name' => _x( 'Service Areas', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Service Areas', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Service Areas', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Service Areas', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'service', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Service Areas', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Service Areas', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Service Areas', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Service Areas', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Service Areas', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Service Areas', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Service Areas:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No projects found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No projects found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'service-area'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'supports' => array('title', 'editor'),
				'menu_position' => null,
				'menu_icon' => 'dashicons-screenoptions',
			)
		);
	endif;

	if( $enabled_vacancies && $enabled_vacancies == 'enabled' && !post_type_exists('vacancy')):
		register_post_type(
			'vacancy',
			array(
				'labels' => array(
					'name' => _x( 'Vacancies', 'post type general name', THEME_TEXTDOMAIN ),
					'singular_name' => _x( 'Vacancy', 'post type singular name', THEME_TEXTDOMAIN ),
					'menu_name' => _x( 'Vacancies', 'admin menu', THEME_TEXTDOMAIN ),
					'name_admin_bar' => _x( 'Vacancy', 'add new on admin bar', THEME_TEXTDOMAIN ),
					'add_new' => _x( 'Add New', 'vacancy', THEME_TEXTDOMAIN ),
					'add_new_item' => __( 'Add New Vacancy', THEME_TEXTDOMAIN ),
					'new_item' => __( 'New Vacancy', THEME_TEXTDOMAIN ),
					'edit_item' => __( 'Edit Vacancy', THEME_TEXTDOMAIN ),
					'view_item' => __( 'View Vacancy', THEME_TEXTDOMAIN ),
					'all_items' => __( 'All Vacancies', THEME_TEXTDOMAIN ),
					'search_items' => __( 'Search Vacancies', THEME_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent Vacancies:', THEME_TEXTDOMAIN ),
					'not_found' => __( 'No vacancies found.', THEME_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'No vacancies found in Trash.', THEME_TEXTDOMAIN )
				),
				'description' => __( 'Description.', THEME_TEXTDOMAIN ),
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'vacancy'),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => true,
				'supports' => array('title'),
				'menu_position' => null,
				'menu_icon' => 'dashicons-businessman',
			)
		);
	endif;

	//flush_rewrite_rules();
}