<?php

/**
 * Theme cpt.
 */

/**
 * Add Custom Post Types.
 *
 */
function create_custom_testimonial_type() {
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
        ),
        'public' => true,
        'has_archive' => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
        'show_in_rest' => true, // This enables REST API support
    ));
}
add_action('init', 'create_custom_testimonial_type');
/**
 * Register Custom Post Type - Project.
 *
 */
function your_prefix_register_post_type() {
	$args = [
		'label'  => esc_html__( 'Projects', 'text-domain' ),
		'labels' => [
			'menu_name'          => esc_html__( 'Projects', 'your-textdomain' ),
			'name_admin_bar'     => esc_html__( 'Project', 'your-textdomain' ),
			'add_new'            => esc_html__( 'Add Project', 'your-textdomain' ),
			'add_new_item'       => esc_html__( 'Add new Project', 'your-textdomain' ),
			'new_item'           => esc_html__( 'New Project', 'your-textdomain' ),
			'edit_item'          => esc_html__( 'Edit Project', 'your-textdomain' ),
			'view_item'          => esc_html__( 'View Project', 'your-textdomain' ),
			'update_item'        => esc_html__( 'View Project', 'your-textdomain' ),
			'all_items'          => esc_html__( 'All Projects', 'your-textdomain' ),
			'search_items'       => esc_html__( 'Search Projects', 'your-textdomain' ),
			'parent_item_colon'  => esc_html__( 'Parent Project', 'your-textdomain' ),
			'not_found'          => esc_html__( 'No Projects found', 'your-textdomain' ),
			'not_found_in_trash' => esc_html__( 'No Projects found in Trash', 'your-textdomain' ),
			'name'               => esc_html__( 'Projects', 'your-textdomain' ),
			'singular_name'      => esc_html__( 'Project', 'your-textdomain' ),
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-admin-appearance',
		'supports' => [
			'title',
			'editor',
			'author',
			'thumbnail',
		],
		'taxonomies' => [
			'category',
			'post_tag',
		],
		'rewrite' => true
	];

	register_post_type( 'project', $args );
}
add_action( 'init', 'your_prefix_register_post_type', 99 );

