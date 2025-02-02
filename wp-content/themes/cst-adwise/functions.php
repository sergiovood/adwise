<?php
/**
 * CustomThemeAdwise functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CustomThemeAdwise
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());

// Dodanie strony opcji motywu
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Ustawienia Motywu',
        'menu_title' => 'Ustawienia Motywu',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ));
}

// Dodaj tę funkcję do functions.php
function register_acf_blocks() {
    register_block_type(THEME_PATH . '/inc/blocks/hero-section');
	register_block_type(THEME_PATH . '/inc/blocks/values-section');
	register_block_type(THEME_PATH . '/inc/blocks/heading-block');
}
add_action('init', 'register_acf_blocks');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cst_adwise_setup() {
	// Wsparcie dla bloków Gutenberga
	add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
	
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CustomThemeAdwise, use a find and replace
		* to change 'cst-adwise' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cst-adwise', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cst-adwise' ),
			'footer-menu' => esc_html__('Footer Menu', 'cst-adwise'),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cst_adwise_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'cst_adwise_setup' );

// Rejestracja kategorii bloków
function cst_adwise_block_categories($categories) {
    return array_merge(
        array(
            array(
                'slug'  => 'cst-adwise-blocks',
                'title' => __('Adwise Blocks', 'cst-adwise'),
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'cst_adwise_block_categories', 10, 1);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cst_adwise_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cst_adwise_content_width', 640 );
}
add_action( 'after_setup_theme', 'cst_adwise_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cst_adwise_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cst-adwise' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cst-adwise' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cst_adwise_widgets_init' );

/**
 * Customowe style i skrypty.
 */
function cst_adwise_scripts() {
    $theme_version = defined('_S_VERSION') ? _S_VERSION : '1.0.0';

    // Lista stylów do załadowania
    $styles = array(
        'cst-adwise-style' => get_stylesheet_uri(),
        'cst-adwise-fonts' => THEME_URL . '/assets/css/fonts.css',
		'cst-adwise-custom' => THEME_URL . '/assets/css/custom.css',
        'cst-adwise-hero'  => THEME_URL . '/assets/css/blocks/hero-section.css',
		'cst-adwise-values' => THEME_URL . '/assets/css/blocks/values-section.css',
		'cst-adwise-heading' => THEME_URL . '/assets/css/blocks/heading-block.css',
    );

    // Dodawanie stylów w pętli
    foreach ($styles as $handle => $src) {
        wp_enqueue_style($handle, $src, array(), $theme_version);
    }

    // Dodanie obsługi RTL, jeśli strona używa języka RTL
    if (is_rtl()) {
        wp_style_add_data('cst-adwise-style', 'rtl', 'replace');
    }

    // Skrypty
    wp_enqueue_script('cst-adwise-navigation', THEME_URL . '/js/navigation.js', array(), $theme_version, true);

    // Obsługa wątkowanych komentarzy
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cst_adwise_scripts');

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_template_directory() . '/inc/jetpack.php';
}

// Formatowanie linku w bloku hero-section
function cst_adwise_format_link($link) {
    // Jeśli link jest pusty, zwróć #
    if (empty($link)) {
        return '#';
    }
    
    // Jeśli link już zawiera http lub https, zwróć go bez zmian
    if (strpos($link, 'http') === 0) {
        return $link;
    }
    
    // Jeśli link zaczyna się od # lub /, zwróć go bez zmian
    if (strpos($link, '#') === 0 || strpos($link, '/') === 0) {
        return $link;
    }
    
    // W przeciwnym razie dodaj / na początku
    return '/' . $link;
}