<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package liga-de-debate
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ligaDebate_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ligaDebate_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ligaDebate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ligaDebate_pingback_header' );


/**
 * Metabox Custom fields
 */
function metabox_fields( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'custom',
		'title' => esc_html__( 'Heading featured', 'ligaDebate' ),
		'post_types' => array( 'page' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'heading_featured',
				'type' => 'wysiwyg',
				'name' => esc_html__( 'Heading', 'ligaDebate' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'metabox_fields' );

// Custom Post Liga Universitaria

function university_custom_post_types() {
	register_post_type('university',
		array(
			'labels'      => array(
				'name'          	=> __('Universities', 'ligaDebate'),
				'singular_name' 	=> __('university', 'ligaDebate'),
				'menu_name'     	=> __( 'Liga Universitaria', 'ligaDebate' ),
				'add_new'       	=> __( 'Añadir liga universitaria', 'ligaDebate' ),
				'add_new_item'      => __( 'Añadir nueva liga universitaria', 'ligaDebate' ),
				'new_item'          => __( 'Nueva liga universitaria', 'ligaDebate' ),
				'edit_item'         => __( 'Editar liga universitaria', 'ligaDebate' ),
				'view_item'         => __( 'Ver liga universitaria', 'ligaDebate' ),
				'update_item'       => __( 'Ver liga universitaria', 'ligaDebate' ),
				'all_items'         => __( 'Todas las liga universitarias', 'ligaDebate' ),
				'search_items'      => __( 'Search liga universitaria', 'ligaDebate' ),
				'parent_item_colon' => __( 'Parent university', 'ligaDebate' ),
				'not_found'         => __( 'No universities found', 'ligaDebate' ),
				'not_found_in_trash'=> __( 'No universities found in Trash', 'ligaDebate' )
			),
				'public'      	=> true,
				'has_archive' 	=> true,
				'capability_type' => 'post',
				'menu_icon'   	=> 'dashicons-welcome-learn-more',
				'menu_position' => 11,
				'query_var'     => true,
		 		'rewrite'       => [ 'slug' => 'universities' ],
				'supports' 		=> ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_menu'  => true,
				'show_ui'       => true,
				'show_in_rest'  => true,
		)
	);
}
add_action('init', 'university_custom_post_types');


// Taxonomy Liga universitaria

function university_taxonomy() {
	$labels = array(
		'name'              => _x( 'Universities', 'universities' ),
		'singular_name'     => _x( 'University', 'university' ),
		'search_items'      => __( 'Search university' ),
		'all_items'         => __( 'All universities' ),
		'parent_item'       => __( 'Parent university' ),
		'parent_item_colon' => __( 'Parent university:' ),
		'edit_item'         => __( 'Edit university' ),
		'update_item'       => __( 'Update university' ),
		'add_new_item'      => __( 'Add New university' ),
		'new_item_name'     => __( 'New university Name' ),
		'menu_name'         => __( 'Liga universitaria' ),
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'university' ],
	);
	register_taxonomy( 'university', [ 'universities' ], $args );
}
add_action( 'init', 'university_taxonomy' );


// Custom Post Liga Pre-Universitaria LATAM

function latam_preuniversity_custom_post_types() {
	register_post_type('latam_preuniversity',
		array(
			'labels'      => array(
				'name'          	=> __('PreUniversity-LATAM', 'ligaDebate'),
				'singular_name' 	=> __('university', 'ligaDebate'),
				'menu_name'     	=> __( 'Liga Pre-Universitaria', 'ligaDebate' ),
				'add_new'       	=> __( 'Añadir liga universitaria', 'ligaDebate' ),
				'add_new_item'      => __( 'Añadir nueva liga universitaria', 'ligaDebate' ),
				'new_item'          => __( 'Nueva liga universitaria', 'ligaDebate' ),
				'edit_item'         => __( 'Editar liga universitaria', 'ligaDebate' ),
				'view_item'         => __( 'Ver liga universitaria', 'ligaDebate' ),
				'update_item'       => __( 'Ver liga universitaria', 'ligaDebate' ),
				'all_items'         => __( 'Todas las liga universitarias', 'ligaDebate' ),
				'search_items'      => __( 'Search liga universitaria', 'ligaDebate' ),
				'parent_item_colon' => __( 'Parent university', 'ligaDebate' ),
				'not_found'         => __( 'No universities found', 'ligaDebate' ),
				'not_found_in_trash'=> __( 'No universities found in Trash', 'ligaDebate' )
			),
				'public'      	=> true,
				'has_archive' 	=> true,
				'capability_type' => 'post',
				'menu_icon'   	=> 'dashicons-welcome-learn-more',
				'menu_position' => 11,
				'query_var'     => true,
		 		'rewrite'       => [ 'slug' => 'preuniversities-latam' ],
				'supports' 		=> ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_menu'  => true,
				'show_ui'       => true,
				'show_in_rest'  => true,
		)
	);
}
add_action('init', 'latam_preuniversity_custom_post_types');


// Taxonomy Liga universitaria LATAM

function latam_preuniversity_taxonomy() {
	$labels = array(
		'name'              => _x( 'Universities', 'universities' ),
		'singular_name'     => _x( 'University', 'university' ),
		'search_items'      => __( 'Search university' ),
		'all_items'         => __( 'All universities' ),
		'parent_item'       => __( 'Parent university' ),
		'parent_item_colon' => __( 'Parent university:' ),
		'edit_item'         => __( 'Edit university' ),
		'update_item'       => __( 'Update university' ),
		'add_new_item'      => __( 'Add New university' ),
		'new_item_name'     => __( 'New university Name' ),
		'menu_name'         => __( 'Liga LATAM' ),
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'latam' ],
	);
	register_taxonomy( 'latam', [ 'preuniversities-latam' ], $args );
}
add_action( 'init', 'latam_preuniversity_taxonomy' );

