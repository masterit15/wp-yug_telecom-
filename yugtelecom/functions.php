<?php
/**
 * yugtelecom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yugtelecom
 */
// функция отладки
function PR($var, $all = false, $die = false) {
	$bt = debug_backtrace();
	$bt = $bt[0];
	$dRoot = $_SERVER["DOCUMENT_ROOT"];
	$dRoot = str_replace("/", "\\", $dRoot);
	$bt["file"] = str_replace($dRoot, "", $bt["file"]);
	$dRoot = str_replace("\\", "/", $dRoot);
	$bt["file"] = str_replace($dRoot, "", $bt["file"]);
	?>
		<div style='position: relative;font-size:9pt; color:#000; background:#fff; border:1px dashed #000;z-index: 999'>
		<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
		<pre style='padding:10px;'><?print_r($var)?></pre>
		</div>
		<?
	if ($die) {
		die;
	}
}
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'yugtelecom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yugtelecom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on yugtelecom, use a find and replace
		 * to change 'yugtelecom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'yugtelecom', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'yugtelecom' ),
			)
		);
		register_nav_menus(
			array(
				'menu-footer' => esc_html__( 'Footer', 'yugtelecom' ),
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
				'yugtelecom_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'yugtelecom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yugtelecom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yugtelecom_content_width', 640 );
}
add_action( 'after_setup_theme', 'yugtelecom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yugtelecom_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'yugtelecom' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'yugtelecom' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'yugtelecom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function yugtelecom_scripts() {
	wp_enqueue_style( 'yugtelecom-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'yugtelecom-main', get_template_directory_uri() . '/css/main.min.css');
	wp_style_add_data( 'yugtelecom-style', 'rtl', 'replace' );

	wp_enqueue_script( 'yugtelecom-recaptcha', 'https://www.google.com/recaptcha/api.js?render=6LcK86odAAAAAMBrh7sttKbex2LwIL1OWJn3qo3c', array(), _S_VERSION, true );
	wp_enqueue_script( 'yugtelecom-app', get_template_directory_uri() . '/js/index.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'yugtelecom_scripts' );

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
 * mycustomizer additions.
 */
require get_template_directory() . '/inc/mycustomizer.php';
/**
 * Тарифы
 */
require get_template_directory() . '/inc/rates.php';
/**
 * dublicate Post
 */
require get_template_directory() . '/inc/dublicatePost.php';
/**
 * form
 */
require get_template_directory() . '/inc/form.php';
/**
 * handler
 */
require get_template_directory() . '/inc/handler.php';
/**
 * application
 */
require get_template_directory() . '/inc/application.php';
/**
 * supports
 */
require get_template_directory() . '/inc/supports.php';
/**
 * advantages
 */
require get_template_directory() . '/inc/advantages.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//Удаляем определённые карты сайта из индекса
add_filter( 'wp_sitemaps_add_provider', 'truemisha_remove_user_sitemap', 25, 2 );

function truemisha_remove_user_sitemap( $provider, $name ) {
	// PR($name);
	$links = ['users', 'user-agreement', 'taxonomies'];
		if (in_array($name, $links)) { // если архивы пользователей, то отключаем
			return false;
		}
	return $provider;
 
}
//Убираем определённые типы постов из карты
add_filter( 'wp_sitemaps_post_types', 'truemisha_remove_pages', 25 );
 
function truemisha_remove_pages( $post_types ) {
	unset( $post_types['advantages'] );
	unset( $post_types['supports'] );
	unset( $post_types['rates'] );
	return $post_types;
 
}

function dateModify($date){
	$_monthsList = array(
		"-01-" => "Январь",
		"-02-" => "Февраль",
		"-03-" => "Март",
		"-04-" => "Апрель",
		"-05-" => "Май",
		"-06-" => "Июня",
		"-07-" => "Июля",
		"-08-" => "Августа",
		"-09-" => "Сентября",
		"-10-" => "Октября",
		"-11-" => "Ноября",
		"-12-" => "Декабря"
	);
	$date = explode(' ', $date)[0];
	$_mD = date("-m-", strtotime($date));
	$currentDate = explode('-', str_replace($_mD, "-".$_monthsList[$_mD]."-", $date));
	echo $currentDate[1].' '.$currentDate[2].' '.$currentDate[0];
}

function wpschool_page_navi() {
	global $wp_query;
	$pages = '';
	$maxpages = $wp_query->max_num_pages;
	if ( !$currentpage = get_query_var( 'paged' ) ) {
			$currentpage = 1;
	}
	$link['base'] = str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) );
	$link['totalpages'] = $maxpages;
	$link['currentpage'] = $currentpage;
	$totalpages = 0; //1 - вывести "Страница N из N", 0 - не выводить
	$link['mid_size'] = 3; //к-во ссылок показывать слева и справа от текущей
	$link['end_size'] = 1; //к-во ссылок показывать в начале и в конце
	$link['prev_text'] = 'Пред.';
	$link['next_text'] = 'След.';
	if ( $maxpages > 1 ) {
			echo '<div class="pagination">';
	}
	if ( $totalpages == 1 && $maxpages > 1 ) {
			$pages = '<span class="pages">Страница ' . $currentpage . ' из ' . $maxpages . '</span>'."\r\n";
	}
	echo $pages . paginate_links($link);
	if ( $maxpages > 1 ) {
			 echo '</div>';
	}
}