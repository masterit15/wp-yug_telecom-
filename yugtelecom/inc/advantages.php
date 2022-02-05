<?

add_action('init', 'advantages');
function advantages() {
	register_post_type('advantages', array(
		'labels' => array(
			'name' => 'Преимущества',
			'singular_name' => 'Преимущество',
			'add_new' => 'Добавить преимущество',
			'add_new_item' => 'Добавить новоую преимущество',
			'edit_item' => 'Редактировать преимущество',
			'new_item' => 'Новое преимущество',
			'view_item' => 'Посмотреть преимущество',
			'search_items' => 'Найти преимущество',
			'not_found' => 'Преимуществ не найдено',
			'not_found_in_trash' => 'В корзине преимуществ не найдено',
			'parent_item_colon' => '',
			'menu_name' => 'Наши преимущества',
		),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'rewrite' => array('slug' => 'advantages', 'with_front' => true),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail'),
		'show_in_rest' => true,
		'rest_base' => 'advantages',
	));
}


