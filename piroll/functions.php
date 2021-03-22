<?php

/**
 * piroll functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package piroll
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('piroll_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function piroll_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on piroll, use a find and replace
		 * to change 'piroll' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('piroll', get_template_directory() . '/languages');

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
				'header' => esc_html__('Header', 'piroll'),
				'footer' => esc_html__('Footer', 'piroll'),
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
				'piroll_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'piroll_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function piroll_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('piroll_content_width', 640);
}
add_action('after_setup_theme', 'piroll_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function piroll_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'piroll'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'piroll'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'piroll_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function piroll_scripts()
{
	wp_enqueue_style('piroll-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('piroll-style', 'rtl', 'replace');

	wp_enqueue_style('all.min', get_template_directory_uri() . '/layouts/all.min.css');
	wp_enqueue_style('slick', get_template_directory_uri() . '/layouts/slick.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/layouts/magnific-popup.css');
	wp_enqueue_style('piroll-main', get_template_directory_uri() . '/layouts/main.css');

	//wp_enqueue_script( 'piroll-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), '', false);
	wp_enqueue_script('magnific-popup.min', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '', false);

	wp_enqueue_script('piroll-scripts', get_template_directory_uri() . '/js/script.js', array(), '', true);


	wp_enqueue_script('piroll-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'piroll_scripts');

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
 * Redux Options Panel.
 */
require get_template_directory() . '/inc/sample-config.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

function index($meta_boxes)
{
	$prefix = 'piroll-';

	$meta_boxes[] = array(
		'id' => 'index',
		'title' => esc_html__('Home Page', 'metabox-online-generator'),
		'post_types' => array('page'),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'home_title',
				'type' => 'text',
				'name' => esc_html__('Home Title', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'home_desc',
				'type' => 'textarea',
				'name' => esc_html__('Home Description', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'home_bttn',
				'type' => 'text',
				'name' => esc_html__('Home Button', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'about_title',
				'type' => 'text',
				'name' => esc_html__('About Title', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'about_desc',
				'type' => 'textarea',
				'name' => esc_html__('About Description', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'about_img',
				'type' => 'image_advanced',
				'name' => esc_html__('Signature image', 'metabox-online-generator'),
				'force_delete' => 'false',
				'max_file_uploads' => '1',
			),
			array(
				'id' => $prefix . 'skills_title',
				'type' => 'text',
				'name' => esc_html__('Skills Title', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'skills_name',
				'type' => 'text',
				'name' => esc_html__('Skills Name', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'skills_fill',
				'type' => 'number',
				'name' => esc_html__('Skill Level', 'metabox-online-generator'),
				'min' => '1',
				'max' => '100',
				'clone' => 'true',
				'step' => 'any',
			),
			array(
				'id' => $prefix . 'skills_img',
				'type' => 'image_advanced',
				'name' => esc_html__('Professional Skills Right Img', 'metabox-online-generator'),
				'force_delete' => 'false',
				'max_file_uploads' => '1',
			),
			array(
				'id' => $prefix . 'stat_icon',
				'type' => 'text',
				'name' => esc_html__('Statictic Icon', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'stat_value',
				'type' => 'number',
				'name' => esc_html__('Statictic Value', 'metabox-online-generator'),
				'clone' => 'true',
				'step' => 'any',
			),
			array(
				'id' => $prefix . 'stat_title',
				'type' => 'text',
				'name' => esc_html__('Statictic Title', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'gallery_load_more',
				'type' => 'text',
				'name' => esc_html__('Load More Bttn Text', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'process_title',
				'type' => 'text',
				'name' => esc_html__('Process title', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'process_desc',
				'type' => 'textarea',
				'name' => esc_html__('Process Description', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'process_video_img',
				'type' => 'image_advanced',
				'name' => esc_html__('Video image', 'metabox-online-generator'),
				'force_delete' => 'false',
				'max_file_uploads' => '1',
			),
			array(
				'id' => $prefix . 'process_video_link',
				'type' => 'text',
				'name' => esc_html__('Video Link', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'service_icon',
				'type' => 'text',
				'name' => esc_html__('Service Icon', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'service_title',
				'type' => 'text',
				'name' => esc_html__('Service Title', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'service_desc',
				'type' => 'textarea',
				'name' => esc_html__('Service Description', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'testimonials_name',
				'type' => 'text',
				'name' => esc_html__('Testimonial Name', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'testimonials_desc',
				'type' => 'textarea',
				'name' => esc_html__('Testimonial Description', 'metabox-online-generator'),
				'clone' => 'true',
			),
			array(
				'id' => $prefix . 'clients_img',
				'type' => 'image_advanced',
				'name' => esc_html__('Clients image', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'contact_title',
				'type' => 'text',
				'name' => esc_html__('Contact Title', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'contact_desc',
				'type' => 'textarea',
				'name' => esc_html__('Contact Description', 'metabox-online-generator'),
			),
			array(
				'id' => $prefix . 'contact_shortcode',
				'type' => 'text',
				'name' => esc_html__('Contact Form Shortcode', 'metabox-online-generator'),
			),
		),
	);

	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'index');

add_image_size('post_front', 340, 300, true);

add_filter('wpcf7_form_elements', function ($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

	return $content;
});


function blog_scripts()
{
	// Register the script
	wp_register_script('custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);

	// Localize the script with new data
	$script_data_array = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'security' => wp_create_nonce('load_more_posts'),
	);
	wp_localize_script('custom-script', 'blog', $script_data_array);

	// Enqueued script with localized data.
	wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts', 'blog_scripts');

function load_posts_by_ajax_callback()
{
	check_ajax_referer('load_more_posts', 'security');
	$paged = $_POST['page'];
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => '8',
		'paged' => $paged,
	);
	$blog_posts = new WP_Query($args);

	if ($blog_posts->have_posts()) :
		$i = 1;
		$value = 0;
		$color = "#dddddd";

		while ($blog_posts->have_posts()) : $blog_posts->the_post();
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($blog_posts->ID), 'full');

			$color = "#dddddd";

			if ($value == 0 or $value % 2 == 0) {
				if ($i != 1 and ($i % 4 == 0)) {
					$value++;
				}

				if ($i % 2 == 0) {
					$color = "#838383";
				}
			} else {
				if ($i % 8 == 0) {
					$value++;
				}

				if ($i % 2 == 1) {
					$color = "#838383";
				}
			}

			$i++;
?>
			<li class="gallery_item" style="background: <?php echo $color; ?> ">
				<a class="link" id="link_id" href="<?php echo $image[0]; ?>">
					<?php echo get_the_post_thumbnail($blog_posts->ID, 'post_front'); ?>
					<span class="eye_icon"><i class="far fa-eye"></i></span>
				</a>
			</li>
<?php endwhile;
	//wp_enqueue_script('magnific-popup.min', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '', false);

	//wp_enqueue_script('piroll-scripts', get_template_directory_uri() . '/js/script.js', array(), '', true);

	endif;
	wp_die();
}


add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
