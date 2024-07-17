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
		'title' => esc_html__( 'Código extra', 'ligaDebate' ),
		'post_types' => array( 'latamleague', 'spanishleague', 'university', 'course'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'date_publication',
				'type' => 'text',
				'name' => esc_html__( 'Fecha de la liga', 'ligaDebate' ),
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
		'name'              => _x( 'latamleagues', 'SpanishLeagues' ),
		'singular_name'     => _x( 'latamleague', 'SpanishLeague' ),
		'search_items'      => __( 'Search SpanishLeague' ),
		'all_items'         => __( 'All latam leagues' ),
		'parent_item'       => __( 'Parent latam league' ),
		'parent_item_colon' => __( 'Parent latam league:' ),
		'edit_item'         => __( 'Edit latam league' ),
		'update_item'       => __( 'Update latam league' ),
		'add_new_item'      => __( 'Add New latam league' ),
		'new_item_name'     => __( 'New SpanishLeague latam league' ),
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
				'name'          	=> __('SpanishLeagues', 'ligaDebate'),
				'singular_name' 	=> __('SpanishLeague', 'ligaDebate'),
				'menu_name'     	=> __( 'Liga pre-universitaria de España', 'ligaDebate' ),
				'add_new'       	=> __( 'Add SpanishLeague', 'ligaDebate' ),
				'add_new_item'      => __( 'Add new SpanishLeague', 'ligaDebate' ),
				'new_item'          => __( 'New SpanishLeague', 'ligaDebate' ),
				'edit_item'         => __( 'Edit SpanishLeague', 'ligaDebate' ),
				'view_item'         => __( 'View SpanishLeague', 'ligaDebate' ),
				'update_item'       => __( 'View SpanishLeague', 'ligaDebate' ),
				'all_items'         => __( 'All SpanishLeagues', 'ligaDebate' ),
				'search_items'      => __( 'Search SpanishLeagues', 'ligaDebate' ),
				'parent_item_colon' => __( 'Parent SpanishLeague', 'ligaDebate' ),
				'not_found'         => __( 'No SpanishLeagues found', 'ligaDebate' ),
				'not_found_in_trash'=> __( 'No SpanishLeagues found in Trash', 'ligaDebate' )
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
		'name'              => _x( 'SpanishLeagues', 'SpanishLeagues' ),
		'singular_name'     => _x( 'SpanishLeague', 'SpanishLeague' ),
		'search_items'      => __( 'Search SpanishLeague' ),
		'all_items'         => __( 'All SpanishLeagues' ),
		'parent_item'       => __( 'Parent SpanishLeague' ),
		'parent_item_colon' => __( 'Parent SpanishLeague:' ),
		'edit_item'         => __( 'Edit SpanishLeague' ),
		'update_item'       => __( 'Update SpanishLeague' ),
		'add_new_item'      => __( 'Add New SpanishLeague' ),
		'new_item_name'     => __( 'New SpanishLeague Name' ),
		'menu_name'         => __( 'SpanishLeague' ),
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

// Custom Post Cursos

function course_custom_post_types() {
	register_post_type('course',
		array(
			'labels'      => array(
				'name'          	=> __('Courses', 'ligaDebate'),
				'singular_name' 	=> __('Course', 'ligaDebate'),
				'menu_name'     	=> __( 'Cursos', 'ligaDebate' ),
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
				'menu_icon'   	=> 'dashicons-awards',
				'menu_position' => 11,
				'query_var'     => true,
		 		'rewrite'       => [ 'slug' => 'courses' ],
				'supports' 		=> ['title', 'editor', 'thumbnail', 'excerpt'],
				'show_in_menu'  => true,
				'show_ui'       => true,
				'show_in_rest'  => true,
		)
	);
}
add_action('init', 'course_custom_post_types');


// Taxonomy Cursos

function course_taxonomy() {
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
		'rewrite'           => [ 'slug' => 'course' ],
	);
	register_taxonomy( 'course', [ 'courses' ], $args );
}
add_action( 'init', 'course_taxonomy' );
