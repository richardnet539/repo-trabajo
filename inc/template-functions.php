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




// Custom Post Liga Pre-Universitaria en LATAM

function latam_league_custom_post_types() {
	register_post_type('latamleague',
		array(
			'labels'      => array(
				'name'          	=> __('Latamleagues', 'ligaDebate'),
				'singular_name' 	=> __('Latamleague', 'ligaDebate'),
				'menu_name'     	=> __( 'Liga pre-universitaria de LATAM', 'ligaDebate' ),
				'add_new'       	=> __( 'Add latam league', 'ligaDebate' ),
				'add_new_item'      => __( 'Add new latam league', 'ligaDebate' ),
				'new_item'          => __( 'New latam league', 'ligaDebate' ),
				'edit_item'         => __( 'Edit latam league', 'ligaDebate' ),
				'view_item'         => __( 'View latam league', 'ligaDebate' ),
				'update_item'       => __( 'View latam league', 'ligaDebate' ),
				'all_items'         => __( 'All latam league', 'ligaDebate' ),
				'search_items'      => __( 'Search latam league', 'ligaDebate' ),
				'parent_item_colon' => __( 'Parent latam league', 'ligaDebate' ),
				'not_found'         => __( 'No latam league found', 'ligaDebate' ),
				'not_found_in_trash'=> __( 'No latam league found in Trash', 'ligaDebate' )
			),
				'public'      	=> true,
				'has_archive' 	=> true,
				'capability_type' => 'post',
				'menu_icon'   	=> 'dashicons-welcome-learn-more',
				'menu_position' => 11,
				'query_var'     => true,
		 		'rewrite'       => [ 'slug' => 'latamleague' ],
				'supports' 		=> ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_menu'  => true,
				'show_ui'       => true,
				'show_in_rest'  => true,
		)
	);
}
add_action('init', 'latam_league_custom_post_types');


// Taxonomy Liga Pre-Universitaria en LATAM

function latam_league_taxonomy() {
	$labels = array(
		'name'              => _x( 'latamleagues', 'Albums' ),
		'singular_name'     => _x( 'latamleague', 'Album' ),
		'search_items'      => __( 'Search Album' ),
		'all_items'         => __( 'All latam leagues' ),
		'parent_item'       => __( 'Parent latam league' ),
		'parent_item_colon' => __( 'Parent latam league:' ),
		'edit_item'         => __( 'Edit latam league' ),
		'update_item'       => __( 'Update latam league' ),
		'add_new_item'      => __( 'Add New latam league' ),
		'new_item_name'     => __( 'New Album latam league' ),
		'menu_name'         => __( 'latam league' ),
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'latamleague' ],
	);
	register_taxonomy( 'latamleagues', [ 'latamleague' ], $args );
}
add_action( 'init', 'latam_league_taxonomy' );





// Custom Post Liga Pre-Universitaria en España

function spanish_league_custom_post_types() {
	register_post_type('spanishleague',
		array(
			'labels'      => array(
				'name'          	=> __('Albums', 'ligaDebate'),
				'singular_name' 	=> __('Album', 'ligaDebate'),
				'menu_name'     	=> __( 'Liga pre-universitaria de España', 'ligaDebate' ),
				'add_new'       	=> __( 'Add Album', 'ligaDebate' ),
				'add_new_item'      => __( 'Add new Album', 'ligaDebate' ),
				'new_item'          => __( 'New Album', 'ligaDebate' ),
				'edit_item'         => __( 'Edit Album', 'ligaDebate' ),
				'view_item'         => __( 'View Album', 'ligaDebate' ),
				'update_item'       => __( 'View Album', 'ligaDebate' ),
				'all_items'         => __( 'All Albums', 'ligaDebate' ),
				'search_items'      => __( 'Search Albums', 'ligaDebate' ),
				'parent_item_colon' => __( 'Parent Album', 'ligaDebate' ),
				'not_found'         => __( 'No Albums found', 'ligaDebate' ),
				'not_found_in_trash'=> __( 'No Albums found in Trash', 'ligaDebate' )
			),
				'public'      	=> true,
				'has_archive' 	=> true,
				'capability_type' => 'post',
				'menu_icon'   	=> 'dashicons-welcome-learn-more',
				'menu_position' => 11,
				'query_var'     => true,
		 		'rewrite'       => [ 'slug' => 'spanishleagues' ],
				'supports' 		=> ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_menu'  => true,
				'show_ui'       => true,
				'show_in_rest'  => true,
		)
	);
}
add_action('init', 'spanish_league_custom_post_types');


// Taxonomy Liga Pre-Universitaria en España

function spanish_league_taxonomy() {
	$labels = array(
		'name'              => _x( 'Albums', 'Albums' ),
		'singular_name'     => _x( 'Album', 'Album' ),
		'search_items'      => __( 'Search Album' ),
		'all_items'         => __( 'All Albums' ),
		'parent_item'       => __( 'Parent Album' ),
		'parent_item_colon' => __( 'Parent Album:' ),
		'edit_item'         => __( 'Edit Album' ),
		'update_item'       => __( 'Update Album' ),
		'add_new_item'      => __( 'Add New Album' ),
		'new_item_name'     => __( 'New Album Name' ),
		'menu_name'         => __( 'Album' ),
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => [ 'slug' => 'spanishleague' ],
	);
	register_taxonomy( 'spanishleagues', [ 'spanishleague' ], $args );
}
add_action( 'init', 'spanish_league_taxonomy' );
