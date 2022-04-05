<?php
/**
 * digiq-starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package digiq-starter
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (! function_exists('digiq_starter_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function digiq_starter_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on digiq-starter, use a find and replace
         * to change 'digiq-starter' to the name of your theme in all the template files.
         */
        load_theme_textdomain('digiq-starter', get_template_directory() . '/languages');

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

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'digiq-starter'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'digiq_starter_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function digiq_starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('digiq_starter_content_width', 640);
}
add_action('after_setup_theme', 'digiq_starter_content_width', 0);

/**
 * Enqueue styles.
 */
function digiq_starter_styles()
{
    $version = wp_get_theme()->get( 'Version' );

    // Custom Stylesheets
    wp_enqueue_style('digiq-starter-style', get_stylesheet_uri(), array(), $version, true);
}
add_action('wp_enqueue_scripts', 'digiq_starter_styles');

/**
 * Enqueue scripts.
 */
function digiq_starter_scripts()
{
    // GSAP for building high-performance animations 
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js', array(), '3.7.1', true );
    wp_enqueue_script( 'scroll-trigger-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js', array('gsap-js'), '3.7.1', true );
    wp_enqueue_script( 'scroll-to-plugin-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollToPlugin.min.js', array('gsap-js'), '3.7.1', true );

    // Custom Javascript
    wp_enqueue_script('digiq-starter-navigation', get_template_directory_uri() . '/public/js/navigation.min.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'digiq_starter_scripts');

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
