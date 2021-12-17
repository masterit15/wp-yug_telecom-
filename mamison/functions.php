<?php
/**
 * mamison functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mamison
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
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
		<div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;z-index: 999'>
		<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
		<pre style='padding:10px;'><?print_r($var)?></pre>
		</div>
		<?
	if ($die) {
		die;
	}
}
if ( ! function_exists( 'mamison_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mamison_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mamison, use a find and replace
		 * to change 'mamison' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mamison', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'mamison' ),
			)
		);
		register_nav_menus(
			array(
				'menu-socicon' => esc_html__( 'Socicon', 'mamison' ),
			)
		);
		register_nav_menus(
			array(
				'menu-privacy-policy' => esc_html__( 'Privacy_Policy', 'mamison' ),
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
				'mamison_custom_background_args',
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
add_action( 'after_setup_theme', 'mamison_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mamison_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mamison_content_width', 640 );
}
add_action( 'after_setup_theme', 'mamison_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mamison_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mamison' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mamison' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mamison_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mamison_scripts() {
	wp_enqueue_style( 'mamison-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'mamison-main', get_template_directory_uri() . '/css/main.min.css');
	wp_style_add_data( 'mamison-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mamison-app', get_template_directory_uri() . '/js/app.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'mamison_scripts' );

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
 * custom posts application.
 */
require get_template_directory() . '/inc/mycustomizer.php';
/**
 * viewPostCounter.
 */
require get_template_directory() . '/inc/viewPostCounter.php';
/**
 * singleNewsHandler.
 */
require get_template_directory() . '/inc/singleNewsHandler.php';
/**
 * singleGalleryHandler
 */
require get_template_directory() . '/inc/singleGalleryHandler.php';
/**
 * filterPost.php.
 */
require get_template_directory() . '/inc/filterPost.php';
/**
 * filterGallery.php .
 */
require get_template_directory() . '/inc/filterGallery.php';
/**
 * filterGallery.php .
 */
require get_template_directory() . '/inc/nextGalleryAlbum.php';

/**
 * dublicate posts function.
 */
require get_template_directory() . '/inc/dublicatePost.php';

/**
 * participant.php
 */
require get_template_directory() . '/inc/participant.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
	
}


// Регистрируем колонку 'ID' и 'Миниатюра'. Обязательно.
add_filter( 'manage_post_posts_columns', function ( $columns ) {
	$my_columns = [
		'id'    => 'ID',
		'thumb' => 'Миниатюра',
	];

	return array_slice( $columns, 0, 1 ) + $my_columns + $columns;
} );
// Выводим контент для каждой из зарегистрированных нами колонок. Обязательно.
add_action( 'manage_post_posts_custom_column', function ( $column_name ) {
	if ( $column_name === 'id' ) {
		the_ID();
	}

	if ( $column_name === 'thumb' && has_post_thumbnail() ) {
		?>
		<a href="<?php echo get_edit_post_link(); ?>">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</a>
		<?php
	}
} );

// Добавляем стили для зарегистрированных колонок. Необязательно.
add_action( 'admin_print_footer_scripts-edit.php', function () {
	?>
	<style>
		.column-id {
			width: 50px;
		}

		.column-thumb img {
			max-width: 70px;
			height: auto;
		}
	</style>
	<?php
} );

// функция получения дня недели по дате

function getDayWeek($date){
	$days = [
			'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
			'Четверг', 'Пятница', 'Суббота'
	];
	echo $days[ date("w", strtotime($date) )];
}
function dateModify($date){
	$_monthsList = array(
		"-01-" => "Янв",
		"-02-" => "Фев",
		"-03-" => "Мар",
		"-04-" => "Апр",
		"-05-" => "Мая",
		"-06-" => "Июн",
		"-07-" => "Июл",
		"-08-" => "Авг",
		"-09-" => "Сен",
		"-10-" => "Окт",
		"-11-" => "Ноя",
		"-12-" => "Дек"
	);
	$date = explode(' ', $date)[0];
	$_mD = date("-m-", strtotime($date));
	$currentDate = explode('-', str_replace($_mD, "-".$_monthsList[$_mD]."-", $date));
	echo $currentDate[2].' '.$currentDate[1].', '.$currentDate[0];
}


// Добавляем кастомный тип записи Галерея
add_action('init', 'my_custom_gallery');
function my_custom_gallery() {
	register_post_type('gallery', array(
		'labels' => array(
			'name' => 'Галереи',
			'singular_name' => 'Галерея',
			'add_new' => 'Добавить галерею',
			'add_new_item' => 'Добавить новоую галерею',
			'edit_item' => 'Редактировать галерею',
			'new_item' => 'Новая галерея',
			'view_item' => 'Посмотреть галерею',
			'search_items' => 'Найти галерею',
			'not_found' => 'Галерей не найдено',
			'not_found_in_trash' => 'В корзине галерей не найдено',
			'parent_item_colon' => '',
			'menu_name' => 'Галереи',

		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'rewrite' => array('slug' => 'gallery', 'with_front' => true),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields'),
		'show_in_rest' => true,
		'rest_base' => 'gallery',
	));

	// Добавляем для кастомных типов записей Категории
	register_taxonomy(
		"gallery-cat",
		array("gallery"),
		array(
			"hierarchical" => true,
			"label" => "Категории",
			"singular_label" => "Категория",
			"rewrite" => array('slug' => 'gallery', 'with_front' => false),
		)
	);
}

add_action("admin_init", "gallery_field_init");
function gallery_field_init() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		add_meta_box("gallery_field", "Ссылки на видео", "gallery_field", 'gallery', "normal", "low");
	}
}

function gallery_field() {
	global $post;
	$custom = get_post_custom($post->ID);
	$video    = $custom["gallery"][0];
	if(get_post_type() == 'gallery'){
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
		wp_enqueue_script( 'jquery-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
		wp_enqueue_script( 'admin-script', get_template_directory_uri() . '/admin.js' );
	}
	?>
	<div class="field_wrap">
		<div class="one_colimn">
			<div class="fields">
					<div class="video_input">
						<input id="video-0" placeholder="Ссылка на видео" type="text" name="video"/>
          </div>
				<span class="add_video">Добавить</span>
			</div>
			<input type="hidden" name="videos" <?if($video != ''){?>value="<?=$video?>"<?}?>/>
		</div>
		<div class="two_colimn">
			<?
			$videoArr = explode(',', $video);
			if(count($videoArr) > 0){
				foreach($videoArr as $key=>$vd){
			?>
			<?if($video != ''){?>
			<div class="video" data-video-id="<?=$vd?>">
        <div class="video_input">
          <input type="text" value="<?=$vd?>" name="video-<?=$key?>"/>
        </div>
				<div class="video_frame">
          <img src="https://img.youtube.com/vi/<?=$vd?>/0.jpg"/>
        </div>
				<span class="delete" data-video-id="<?=$vd?>">Удалить</span>
			</div>
			<?}}}?>
		</div>
	</div>
	<?
}
add_action('save_post', 'save_gallery_field');
function save_gallery_field() {
	global $post;
	if ($post) {
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {return $post->ID;}
		update_post_meta($post->ID, "gallery", $_POST["videos"]);
	}
}

function nextAlbum($id){
	$prevId = '';
	$reviews = new WP_Query(
		array(
		'p'=> $id,
		'post_type' => 'gallery',
		'post_status' => 'publish',
		));
		if ($reviews->have_posts()) {
				while ($reviews->have_posts()) {
					$reviews->the_post();
					$prevId = get_previous_post();
				}
		}
	// wp_reset_postdata();
	return $prevId->ID;
	
}
