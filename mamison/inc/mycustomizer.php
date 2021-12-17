<?
add_action('customize_register', function($customizer) {
	$customizer->add_section(
		'section_one', array(
			'title' => 'Настройки сайта',
			'description' => 'При добавлении нескольких значений в поле, пишите через запяту пример (+79288008080,+79299009090)',
			'priority' => 11,
		)
	);
  // телефон 1
	$customizer->add_setting('phones', 
		array('default' => '+79304804444')
	);
	$customizer->add_control('phones', array(
    'label' => 'Телефон(ы)',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // Е-почта флексопечать
  $customizer->add_setting('email', 
    array('default' => 'mamison@mail.ru')
  );
  $customizer->add_control('email', array(
    'label' => 'Е-почта',
    'section' => 'section_one',
    'type' => 'text',
  ));
  
  // адрес
  $customizer->add_setting('address', 
		array('default' => 'г. Владикавказ, ул. Димитрова, 31')
	);
	$customizer->add_control('address', array(
    'label' => 'Адрес',
    'section' => 'section_one',
    'type' => 'text',
	));
  // копирайт сайта
  $customizer->add_setting('copyright', 
    array('default' => '© 2021, Мамисон. Все права защищены.')
  );
  $customizer->add_control('copyright', array(
    'label' => 'Копирайт сайта (copyright ©)',
    'section' => 'section_one',
    'type' => 'text',
  ));
  //================================================================

  $customizer->add_section(
		'section_two', array(
    'title' => 'Муниципальный приют в цифрах',
    'description' => '',
    'priority' => 11,
	));
  // Заголовок секции (Муниципальный приют в цифрах)
  $customizer->add_setting('section_counted', 
		array('default' => 'Муниципальный приют в цифрах')
	);
	$customizer->add_control('section_counted', array(
    'label' => 'Заголовок секции (Муниципальный приют в цифрах)',
    'section' => 'section_two',
    'type' => 'text',
	));


  // блок один 
  $customizer->add_setting('section_counted_item_1_title', 
		array('default' => 'Питомцев было вылечено')
	);
	$customizer->add_control('section_counted_item_1_title', array(
    'label' => 'Заголовок блока 1',
    'section' => 'section_two',
    'type' => 'text',
	));

  $customizer->add_setting('section_counted_item_1_value', 
		array('default' => '153')
	);
	$customizer->add_control('section_counted_item_1_value', array(
    'label' => 'Значение блока 1',
    'section' => 'section_two',
    'type' => 'text',
	));
  // блок второй
  $customizer->add_setting('section_counted_item_2_title', 
		array('default' => 'Волонтеров оказывают помощь')
	);
	$customizer->add_control('section_counted_item_2_title', array(
    'label' => 'Заголовок блока 2',
    'section' => 'section_two',
    'type' => 'text',
	));

  $customizer->add_setting('section_counted_item_2_value', 
		array('default' => '201')
	);
	$customizer->add_control('section_counted_item_2_value', array(
    'label' => 'Значение блока 2',
    'section' => 'section_two',
    'type' => 'text',
	));

  // блок третий
  $customizer->add_setting('section_counted_item_3_title', 
		array('default' => 'Питомцев обрели новый дом и семью')
	);
	$customizer->add_control('section_counted_item_3_title', array(
    'label' => 'Заголовок блока 3',
    'section' => 'section_two',
    'type' => 'text',
	));

  $customizer->add_setting('section_counted_item_3_value', 
		array('default' => '473')
	);
	$customizer->add_control('section_counted_item_3_value', array(
    'label' => 'Значение блока 3',
    'section' => 'section_two',
    'type' => 'text',
	));

  // блок четвертый
  $customizer->add_setting('section_counted_item_4_title', 
		array('default' => 'Столько питомцев ждут своих хозяев')
	);
	$customizer->add_control('section_counted_item_4_title', array(
    'label' => 'Заголовок блока 4',
    'section' => 'section_two',
    'type' => 'text',
	));

  $customizer->add_setting('section_counted_item_4_value', 
		array('default' => '567')
	);
	$customizer->add_control('section_counted_item_4_value', array(
    'label' => 'Значение блока 4',
    'section' => 'section_two',
    'type' => 'text',
	));
  
});