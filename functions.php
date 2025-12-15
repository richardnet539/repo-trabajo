<?php
/**
 * liga-de-debate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package liga-de-debate
 */

if (!function_exists('ligaDebate_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ligaDebate_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on liga-de-debate, use a find and replace
         * to change 'ligaDebate' to the name of your theme in all the template files.
         */
        load_theme_textdomain('ligaDebate', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('page-thumbnail', 1110, 275, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'ligaDebate'),
            'menu-2' => esc_html__('Footer', 'ligaDebate'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('ligaDebate_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        // Font Sizes
        add_theme_support('editor-font-sizes', array(
            array(
                'name' => __('Small', 'ligaDebate'),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => __('Normal', 'ligaDebate'),
                'size' => 16,
                'slug' => 'normal'
            ),
            array(
                'name' => __('Large', 'ligaDebate'),
                'size' => 36,
                'slug' => 'large'
            ),
            array(
                'name' => __('Huge', 'ligaDebate'),
                'size' => 50,
                'slug' => 'huge'
            )
        ));

        // Responsive Embeds
        add_theme_support('responsive-embeds');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Backend visual editor
        add_theme_support('editor-styles');
    }
endif;
add_action('after_setup_theme', 'ligaDebate_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ligaDebate_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('ligaDebate_content_width', 640);
}

add_action('after_setup_theme', 'ligaDebate_content_width', 0);


/**
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if (!function_exists('ligaDebate_main_content_bootstrap_classes')) :
    function ligaDebate_main_content_bootstrap_classes()
    {
        if (is_page_template('page-fullwidth.php')) {
            return 'col-md-12';
        }
        return 'col-md-9';
    }
endif;


if (!function_exists('ligaDebate_container_content_classes')) :
    function ligaDebate_container_content_classes()
    {
        if ((is_front_page())) {
            return 'home-content';
        }
        return 'container';
    }
endif;

if (!function_exists('ligaDebate_row_content_classes')) :
    function ligaDebate_row_content_classes()
    {
        if ((is_front_page())) {
            return 'home-row';
        }
        return 'row';
    }
endif;


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ligaDebate_widgets_init()
{

    register_sidebar(array(
        'id' => 'top-content',
        'name' => esc_html__('Top Content', 'ligaDebate'),
        'description' => esc_html__('Displays top content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-top-content %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'top-content-1',
        'name' => esc_html__('Top Content 1', 'ligaDebate'),
        'description' => esc_html__('Add widgets here.', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-top-content-1 d-inline-block %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Menu Header', 'ligaDebate'),
        'id' => 'menu-header',
        'description' => esc_html__('menu header widget area', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-top %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Slider Home', 'ligaDebate'),
        'id' => 'slider-home',
        'description' => esc_html__('Displays home slider.', 'ligaDebate'),
        'before_widget' => '<section id="%1$s" class="widget widget-slider-home %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title heading-style-3">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'ligaDebate'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'ligaDebate'),
        'before_widget' => '<section id="%1$s" class="widget widget-sidebar-1 %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'id' => 'home-pre-content',
        'name' => esc_html__('Home Pre-Content', 'ligaDebate'),
        'description' => esc_html__('Displays home pre content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-home-pre-content %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'home-banner',
        'name' => esc_html__('Home Banner', 'ligaDebate'),
        'description' => esc_html__('Displays home banner', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-home-banner %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'home-content',
        'name' => esc_html__('Home Content', 'ligaDebate'),
        'description' => esc_html__('Displays home content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget widget-home-content %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'footer-menu',
        'name' => esc_html__('Footer Menu', 'ligaDebate'),
        'description' => esc_html__('Displays footer menu', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'id' => 'top-menu-language',
        'name' => esc_html__('Top Menu Language', 'ligaDebate'),
        'description' => esc_html__('Displays top content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'normativa-curso',
        'name' => esc_html__('Normativas', 'ligaDebate'),
        'description' => esc_html__('Displays top content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'formulario-contacto-curso',
        'name' => esc_html__('Formulario de contacto', 'ligaDebate'),
        'description' => esc_html__('Displays top content', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title heading-style-3 text-uppercase">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'id' => 'webforms-course',
        'name' => esc_html__('Webforms', 'ligaDebate'),
        'description' => esc_html__('Displays Webforms', 'ligaDebate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="pt-3 entry-title subtitle-style heading-home--center color-dimgray">',
        'after_title' => '</h3>',
    ));

}

add_action('widgets_init', 'ligaDebate_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function ligaDebate_scripts()
{

    // Font Awesome 5
    wp_enqueue_style('ligaDebate-fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');

    // Bootstrap 4 default CSS
    wp_enqueue_style('ligaDebate-bootstrapcss', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css');

    // Theme Styles
    wp_enqueue_style('ligaDebate-style', get_template_directory_uri() . '/style.css');

    // Bootstrap default JS
    wp_enqueue_script('ligaDebate-bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js', array('jquery'), '1', true);

    wp_enqueue_script('ligaDebate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    // Main theme js
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'ligaDebate_scripts');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Navigation Walker.
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if (!function_exists('of_get_option')) :
    function of_get_option($name, $default = false)
    {
        $options = get_option('ligaDebate');

        // Return specific option
        if (isset($options[$name])) {
            return $options[$name];
        }

        return $default;
    }
endif;


/* Globals variables */
global $site_layout;
$site_layout = array(
    'right-sidebar' => esc_html__('Right Sidebar', 'ligaDebate'),
    'left-sidebar' => esc_html__('Left Sidebar', 'ligaDebate'),
    'no-sidebar' => esc_html__('No Sidebar', 'ligaDebate')
);


/**
 * Custom Functions
 */

// Let svg as image
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');


/**
 * get_layout_class - Returns class name for layout
 */
if (!function_exists('get_layout_class')) :
    function get_layout_class()
    {
        global $post;
        if (is_singular() && get_post_meta($post->ID, 'site_layout', true)) {
            $layout_class = get_post_meta($post->ID, 'site_layout', true);
        } else {
            $layout_class = of_get_option('site_layout', 'sidebar-right');
        }
        return $layout_class;
    }
endif;

/**
 * Add class to excerpt
 */
function add_class_to_excerpt($excerpt)
{
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}

add_filter("the_excerpt", "add_class_to_excerpt");


/* Configuración máxima de archivo */
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

//Strings Polylang

/*GDPR*/
add_action('gdpr_custom_button_styles','gdpr_custom_button_styles',10,1);
function gdpr_custom_button_styles( $css ) {
    $css = 'border-radius: 5px;';
    return $css;
}

add_filter('redirect_canonical', function($redirect_url) {
    if (isset($_GET['_gl'])) {
        return false; // Disable redirection for URLs with _gl parameter
    }
    return $redirect_url;
});
