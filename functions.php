<?php
/**
 * PlaygroundTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PlaygroundTheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function playgroundtheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on PlaygroundTheme, use a find and replace
		* to change 'playgroundtheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'playgroundtheme', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'playgroundtheme' ),
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
			'playgroundtheme_custom_background_args',
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
add_action( 'after_setup_theme', 'playgroundtheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function playgroundtheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'playgroundtheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'playgroundtheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function playgroundtheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'playgroundtheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'playgroundtheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'playgroundtheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function playgroundtheme_scripts() {
	wp_enqueue_style( 'playgroundtheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'playgroundtheme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'playgroundtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'playgroundtheme_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enqueue Google Font: Figtree
 */
function playgroundtheme_google_fonts() {
	// We load 400 (Regular), 600 (SemiBold), 700 (Bold), and 900 (Black)
	wp_enqueue_style( 'figtree-font', 'https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700;900&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'playgroundtheme_google_fonts' );

// Enqueue Termekek scripts and styles
function enqueue_termekek_assets() {
    if (is_page_template('page-termekek.php')) {
        wp_enqueue_style('termekek-style', get_template_directory_uri() . '/css/termekek.css');
        wp_enqueue_script('termekek-script', get_template_directory_uri() . '/js/termekek.js', [], null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_termekek_assets');

// AJAX handler for products
function get_termekek_ajax() {
    $categories = isset($_POST['category']) ? (array) $_POST['category'] : ['all'];
    $categories = array_map('sanitize_text_field', $categories);
    $page       = intval($_POST['page'] ?? 1);
    $per_page   = 12;

    $args = [
        'post_type'      => 'termek',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'post_status'    => 'publish',
    ];

    // Filter out 'all' and only add tax_query if real categories exist
    $filtered = array_filter($categories, fn($c) => $c !== 'all');

    if (!empty($filtered)) {
        $args['tax_query'] = [[
            'taxonomy' => 'termek_kat',
            'field'    => 'slug',
            'terms'    => array_values($filtered), // ← array of slugs
            'operator' => 'IN', // ← match ANY of the selected categories
        ]];
    }

		/* database query */
    $query = new WP_Query($args);
    $total = $query->found_posts;
    $pages = ceil($total / $per_page);
    $products = [];

    while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_ID();
        $products[] = [
            'id'    => $id,
            'title' => get_the_title(),
            'url'   => get_permalink(),
            'image' => get_the_post_thumbnail_url($id, 'medium')
        ];
    }

    wp_reset_postdata();

    wp_send_json([
        'products' => $products,
        'total'    => $total,
        'pages'    => $pages,
    ]);
}
add_action('wp_ajax_get_termekek', 'get_termekek_ajax');
add_action('wp_ajax_nopriv_get_termekek', 'get_termekek_ajax');

// Register Termek Custom Post Type
function register_termek_post_type() {
    register_post_type('termek', [
        'labels' => [
            'name'          => 'Termékek',
            'singular_name' => 'Termék',
            'add_new'       => 'Új termék',
            'add_new_item'  => 'Új termék hozzáadása',
            'edit_item'     => 'Termék szerkesztése',
            'view_item'     => 'Termék megtekintése',
            'all_items'     => 'Összes termék',
        ],
        'public'        => true,
        'has_archive'   => false,
        'show_in_menu'  => true,
        'supports'      => ['title', 'thumbnail', 'excerpt'],
        'menu_icon'     => 'dashicons-cart',
        'rewrite'       => ['slug' => 'termek'],
    ]);
}
add_action('init', 'register_termek_post_type');

// Register Termek Category Taxonomy
function register_termek_taxonomy() {
    register_taxonomy('termek_kat', 'termek', [
        'labels' => [
            'name'          => 'Termék kategóriák',
            'singular_name' => 'Termék kategória',
            'add_new_item'  => 'Új kategória',
            'edit_item'     => 'Kategória szerkesztése',
            'all_items'     => 'Összes kategória',
        ],
        'hierarchical' => true,
        'show_ui'      => true,
        'rewrite'      => ['slug' => 'termek-kategoria'],
    ]);
}
add_action('init', 'register_termek_taxonomy');

function search_by_taxonomy($query) {
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        $search_term = $query->query_vars['s'];

        // Find matching taxonomy terms
        $terms = get_terms([
            'taxonomy'   => 'termek_kat',
            'name__like' => $search_term,
            'hide_empty' => false,
        ]);

        if (!empty($terms) && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');

            $tax_query = [
                [
                    'taxonomy' => 'termek_kat',
                    'field'    => 'term_id',
                    'terms'    => $term_ids,
                    'operator' => 'IN',
                ]
            ];

            $query->set('tax_query', $tax_query);
            $query->set('post_type', 'termek');

            // Clear the search string so WP doesn't filter by title too strictly
            $query->set('s', '');
        } else {
            // Normal search — still limit to termek post type
            $query->set('post_type', 'termek');
        }
    }

    return $query;
}
add_filter('pre_get_posts', 'search_by_taxonomy');

function search_suggestions_ajax() {
    $term = sanitize_text_field($_POST['term'] ?? '');
    if (empty($term)) wp_send_json([]);

    $suggestions = [];

    // Match product titles
    $posts = get_posts([
        'post_type'      => 'termek',
        'posts_per_page' => 5,
        's'              => $term,
        'post_status'    => 'publish',
    ]);
    foreach ($posts as $post) {
        $suggestions[] = [
            'label' => $post->post_title,
            'url'   => get_permalink($post->ID),
            'type'  => 'product',
        ];
    }

    // Match category names
    $terms = get_terms([
        'taxonomy'   => 'termek_kat',
        'name__like' => $term,
        'hide_empty' => false,
    ]);
    foreach ($terms as $t) {
        $suggestions[] = [
            'label' => $t->name,
            'url'   => home_url('/?s=' . urlencode($t->name)),
            'type'  => 'category',
        ];
    }

    wp_send_json($suggestions);
}
add_action('wp_ajax_search_suggestions', 'search_suggestions_ajax');
add_action('wp_ajax_nopriv_search_suggestions', 'search_suggestions_ajax');

function enqueue_search_assets() {
    wp_enqueue_script('search-script', get_template_directory_uri() . '/js/search.js', [], null, true);
    wp_localize_script('search-script', 'ajaxUrl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_search_assets');