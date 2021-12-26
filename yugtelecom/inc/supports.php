<?
/**
 * yugtelecom Theme Customizer
 *
 * @package yugtelecom
 */
add_action('init', 'supports');
function supports() {
	register_post_type('supports', array(
		'labels' => array(
			'name' => 'Вопросы',
			'singular_name' => 'Вопрос',
			'add_new' => 'Добавить вопрос',
			'add_new_item' => 'Добавить новоый вопрос',
			'edit_item' => 'Редактировать вопрос',
			'new_item' => 'Новый вопрос',
			'view_item' => 'Посмотреть вопрос',
			'search_items' => 'Найти вопрос',
			'not_found' => 'Вопросов не найдено',
			'not_found_in_trash' => 'В корзине вопросов не найдено',
			'parent_item_colon' => '',
			'menu_name' => 'Поддержка',
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'rewrite' => array('slug' => 'supports', 'with_front' => true),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor'),
		'show_in_rest' => true,
		'rest_base' => 'supports',
	));
}