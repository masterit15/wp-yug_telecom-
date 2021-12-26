<?

add_action('init', 'application');
function application() {
	register_post_type('application', array(
		'labels' => array(
			'name' => 'Заявки',
			'singular_name' => 'Заявка',
			'add_new' => 'Добавить заявку',
			'add_new_item' => 'Добавить новоую заявку',
			'edit_item' => 'Редактировать заявку',
			'new_item' => 'Новый питомец',
			'view_item' => 'Посмотреть заявку',
			'search_items' => 'Найти заявку',
			'not_found' => 'Заявок не найдено',
			'not_found_in_trash' => 'В корзине заявок не найдено',
			'parent_item_colon' => '',
			'menu_name' => 'Заявки',
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'rewrite' => array('slug' => 'application', 'with_front' => true),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title'),
		'show_in_rest' => true,
		'rest_base' => 'application',
	));
}

//Дополнительные поля 
add_action("admin_init", "application_field_init");
add_action('save_post', 'save_application_field');
function application_field_init() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		add_meta_box("application_field", "Данные о клиенте", "application_field", 'application', "normal", "low");
	}
}
// Функция сохранения полей продукта "Цена" и "Тираж"
function save_application_field() {
	global $post;
	if ($post) {
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {return $post->ID;}
		update_post_meta($post->ID, "application_name", $_POST["name"]);
		update_post_meta($post->ID, "application_phone", $_POST["phone"]);
		update_post_meta($post->ID, "application_address", $_POST["address"]);
		update_post_meta($post->ID, "application_rates", $_POST["rates"]);
	}
}
// Регистрируем колонку 'ID' и 'Миниатюра'. Обязательно.
add_filter( 'manage_application_posts_columns', function ( $columns ) {
	$my_columns = [
		'name' => 'Имя клиента',
		'phone'=> 'Телефон клиента',
		'address'=> 'Адрес клиента',
	];

	return array_slice( $columns, 0, 1 ) + $columns + $my_columns ;
} );
// Выводим контент для каждой из зарегистрированных нами колонок. Обязательно.
add_action( 'manage_application_posts_custom_column', function ( $column_name ) {
	global $post;
	$custom = get_post_custom($post->ID);
	if ( $column_name === 'name' ) {
		echo $custom['application_name'][0];
	}
	if ( $column_name === 'phone' ) {
		echo $custom['application_phone'][0];
	}
	if ( $column_name === 'address' ) {
		echo $custom['application_address'][0];
	}

} );

add_action( 'admin_menu', function() {
	global $menu;
	$posts = get_posts('post_type=application&suppress_filters=0&posts_per_page=-1&post_status=unread');
	$count = count($posts); 
	$menu[27][0] = $count > 0 ? 'Заявок <span class="awaiting-mod">' . $count. '</span>' : 'Заявки';
});

//Дополнительные поля продукта html
function application_field() {
	global $post;
	$custom = get_post_custom($post->ID);
	?>
	<div class="application">
		<div class="application_fields">
			<div class="group">
				<label>ФИО (название организации) клиента:</label>
					<?if ($custom['application_name']) {?>
						<input class="application_fields_name" name="name" type="text" value="<?=$custom['application_name'][0]?>">
					<?} else {?>
						<input class="application_fields_name" name="name" type="text">
					<?}?>
			</div>
			<div class="group">
				<label>Телефон клиента:</label>
					<?if ($custom['application_phone']) {?>
						<input class="application_fields_phone" name="phone" type="text" value="<?=$custom['application_phone'][0]?>">
					<?} else {?>
						<input class="application_fields_phone" name="phone" type="text">
					<?}?>
			</div>
			<div class="group">
				<label>Адрес клиента:</label>
					<?if ($custom['application_address']) {?>
						<input class="application_fields_address" name="address" type="text" value="<?=$custom['application_address'][0]?>">
					<?} else {?>
						<input class="application_fields_address" name="address" type="text">
					<?}?>
			</div>
			
			<div class="group">
				<label>Популярный тариф?:</label>
				<?if ($custom['application_rates']) {
					?>
					<select name="rates">
						<?
						$reviews = new WP_Query(
						array(
						'post_type' => 'rates',
						'post_status' => 'publish',
						'posts_per_page' => 5,
						'orderby'          => 'date',
						'order'            => 'ASC',
						'page'=> 1
						));
						
						if ($reviews->have_posts()) {
							while ($reviews->have_posts()) {$reviews->the_post();
								$rates_custom = get_post_custom($post->ID);
						?>
						<option value="<?the_ID()?>" <?if($custom['application_rates'][0] == $post->ID){?> selected<?}?>><?the_title()?>, Скорость: <?=$rates_custom['rates_speed'][0]?> Мбит/сек</option>
						<?}}?>
					</select>
				<?} else {?>
					<select name="rates">
						<option value="#" selected>Тарифы</option>
						<?
						$reviews = new WP_Query(
						array(
						'post_type' => 'rates',
						'post_status' => 'publish',
						'posts_per_page' => 5,
						'orderby'          => 'date',
						'order'            => 'ASC',
						'page'=> 1
						));
						
						if ($reviews->have_posts()) {
							while ($reviews->have_posts()) {$reviews->the_post();
							$custom = get_post_custom($reviews->ID);
						?>
						<option value="<?the_ID()?>"><?the_title()?>, Скорость: <?=$custom['rates_speed'][0]?> Мбит/сек</option>
						<?}}?>
					</select>
				<?}?>
			</div>

		</div>
	</div>
<?
}
function true_status_unread(){
	register_post_status( 'unread', array(
		'label'                     => 'Не прочитанные',
		'label_count'               => _n_noop( 'Не прочитанные <span class="count">(%s)</span>', 'Не прочитанные <span class="count">(%s)</span>' ),
		'public'                    => true,
		'show_in_admin_status_list' => true // если установить этот параметр равным false, то следующий параметр можно удалить
	) );
}
add_action( 'init', 'true_status_unread' );

add_action('admin_footer-edit.php','true_status_unread_select');
function true_status_unread_select() {
	echo "<script>
	jQuery(document).ready( function($) {
		$( 'select[name=\"_status\"]' ).append( '<option value=\"unread\">Не прочитано</option>' );
	});
	</script>";
}

function true_status_unread_display( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'unread' ){ // проверка, что мы не находимся на странице всех постов данного статуса
		if($post->post_status == 'unread'){ // если статус поста - Архив
			return array('Не прочитанные');
		}
	}
	return $statuses;
}
 
add_filter( 'display_post_states', 'true_status_unread_display' );


function true_status_isread(){
	register_post_status( 'isread', array(
		'label'                     => 'Прочитанные',
		'label_count'               => _n_noop( 'Прочитанные <span class="count">(%s)</span>', 'Прочитанные <span class="count">(%s)</span>' ),
		'public'                    => true,
		'show_in_admin_status_list' => true // если установить этот параметр равным false, то следующий параметр можно удалить
	) );
}
add_action( 'init', 'true_status_isread' );


function true_status_isread_select() {
	echo "<script>
	jQuery(document).ready( function($) {
		$( 'select[name=\"_status\"]' ).append( '<option value=\"isread\">Прочитано</option>' );
	});
	</script>";
}
add_action('admin_footer-edit.php','true_status_isread_select');

function true_status_isread_display( $statuses ) {
	global $post;
	if( get_query_var( 'post_status' ) != 'isread' ){ // проверка, что мы не находимся на странице всех постов данного статуса
		if($post->post_status == 'isread'){ // если статус поста - Архив
			return array('Прочитанные');
		}
	}
	return $statuses;
}
 
add_filter( 'display_post_states', 'true_status_isread_display' );

if(isset($_GET['post']) && $_GET['action'] == 'edit' && get_post_type($_GET['post']) == 'application' && get_post_status($_GET['post']) == 'unread'){
	wp_update_post(array(
		'ID'    =>  $_GET['post'],
		'post_status'   =>  'isread'
		));
}
