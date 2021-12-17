<?
/**
 * mamison Theme Customizer
 *
 * @package mamison
 */
// Добавляем кастомный тип записи Галерея
add_action('init', 'my_custom_participant');
function my_custom_participant() {
	register_post_type('participant', array(
		'labels' => array(
			'name' => 'Участники',
			'singular_name' => 'Участник',
			'add_new' => 'Добавить участника',
			'add_new_item' => 'Добавить новоого участника',
			'edit_item' => 'Редактировать м',
			'new_item' => 'Новаый участник',
			'view_item' => 'Посмотреть участника',
			'search_items' => 'Найти м',
			'not_found' => 'Участник не найдено',
			'not_found_in_trash' => 'В корзине участников не найдено',
			'parent_item_colon' => '',
			'menu_name' => 'Участники',

		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'rewrite' => array('slug' => 'participant', 'with_front' => true),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title',  'thumbnail'),
		'show_in_rest' => true,
		'rest_base' => 'participant',
	));

	// Добавляем для кастомных типов записей Категории
	register_taxonomy(
		"participant-cat",
		array("participant"),
		array(
			"hierarchical" => true,
			"label" => "Долности",
      'labels'                => [
        'name'              => 'Долности',
        'singular_name'     => 'Долность',
        'search_items'      => 'Найти долность',
        'all_items'         => 'Все долности',
        'view_item '        => 'Смотреть долность',
        'parent_item'       => 'Вышестоящая долность',
        'parent_item_colon' => 'Вышестоящая долность:',
        'edit_item'         => 'Редактировать долность',
        'update_item'       => 'Обновить долность',
        'add_new_item'      => 'Добавить новую долность',
        'new_item_name'     => 'Название новой долности',
        'menu_name'         => 'Долность',
      ],
			"singular_label" => "Долность",
			"rewrite" => array('slug' => 'participant', 'with_front' => false),
		)
	);
}
?>