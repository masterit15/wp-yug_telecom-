<?
add_action('customize_register', function ($customizer) {
  $customizer->add_section(
    'section_one',
    array(
      'title' => 'Настройки сайта',
      'description' => 'При добавлении нескольких значений в поле, пишите через запяту пример (+79288008080,+79299009090)',
      'priority' => 11,
    )
  );
  // Оффер заголовок
  $customizer->add_setting(
    'offer_title',
    array('default' => 'Не отказывай себе в качестве!')
  );
  $customizer->add_control('offer_title', array(
    'label' => 'Заголовок офера',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // Оффер текс
  $customizer->add_setting(
    'offer_text',
    array('default' => 'Наша компания предоставляет стабильное и качественное интернет подключение посредством оптоволоконных технологий. Каждый может подобрать подходящий ему безлимитный тарифный план.')
  );
  $customizer->add_control('offer_text', array(
    'label' => 'Текст офера',
    'section' => 'section_one',
    'type' => 'textarea',
  ));
  // Карта охвата
  $customizer->add_setting(
    'maps',
    array('default' => '[[42.26441895501271,43.95980061613289],[42.264801473985436,43.96100224577157],[42.24567266141469,43.96546544157233],[42.24554511638548,43.97301854215828],[42.24006043439986,43.974735155927796],[42.22921720812044,43.980399981367256],[42.22347591680182,43.98022831999031],[42.210332759163315,43.98383320890632],[42.20497262244333,43.981601611005935],[42.204462109336916,43.97765339933601],[42.206121261738744,43.967868700849685],[42.205610757982505,43.955680743086],[42.20650413682876,43.952247515546944],[42.21186414264507,43.95156087003913],[42.21837210518087,43.95756901823248],[42.22398627510682,43.95499409757819],[42.22641042030191,43.95413579069343],[42.23393743139353,43.954650774824295],[42.23355472383475,43.96065892301765],[42.23903997545909,43.96134556852546],[42.23942264951002,43.958255663740296],[42.24401455577387,43.95447911344735],[42.249881501653995,43.957054034101645],[42.25064671494193,43.96237553678719]]')
  );
  // Оффер заголовок
  $customizer->add_setting(
    'terminals',
    array('default' => 'ОФИС Юг-Телеком,ПАТРИОТ маг. ул Сталина,ОФИС МегаФон ул.Героев,"ВЯБЛОЧКО"маг.,"888"маг. п-т.А.Джиоева,"ЛЁВЧИК"маг. ул. Октябрьская,"555"маг. ул.ГАФЕЗА,АМ "Быт.химия" маг.,ул Защит.Отечество мик-н. Московский,БАМ "ДУШМАН"маг.,"БАРС"маг.,"Альбион" прод.маг. ул Осетинская,Лесокомбинат прод.маг. ул.Осетинская,"АЛАНИЯ" маг. ул.Армянская,	ул.Бр.Губаевых прод.маг.,	ул.8го-Июня прод.маг ?32,	"МИРАЖ"маг ул.В.Хубулова,"БИБЛИОТЕКА" пр-т.А.Джиоева,"БТКА" ул.И.Харебова,"АЛАН"гост. ул.Героев,1.,"БОГИРИ"р-н. ул.Московского,с.Знауыр Нар,п.Дзау внут,п.Дзау нар,с.Знауыр внут,АП пр-т.А.Джиоева,г.КВАИСА нар 2,п.Ленингор внут,п.Ленингор нар,ШАНХАЙ р-н.,ЖИЛМАССИВ р-н. пр-т. А.Джиоева,	ЧКАЛОВА улиц. АПТЕКА,ЭВРОСЕТЬ ул.И.Харебова,СОЛНЕЧНЫЙ м-р. прод.магазин,c.Цъунар нар.,г.Кваиса нар 1,ул.И.Харебова нар,ОФИС Юг-Телеком НАР,
    ')
  );
  $customizer->add_control('terminals', array(
    'label' => 'Терминалы для оплаты',
    'section' => 'section_one',
    'type' => 'textarea',
  ));
  $customizer->add_control('maps', array(
    'label' => 'Карта охвата (масив координат)',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // телефон 1
  $customizer->add_setting(
    'phones',
    array('default' => '88004444245')
  );
  $customizer->add_control('phones', array(
    'label' => 'Телефон(ы)',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // Е-почта флексопечать
  $customizer->add_setting(
    'email',
    array('default' => 'office@юг-телеком.com')
  );
  $customizer->add_control('email', array(
    'label' => 'Е-почта',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // Режим работы 
  $customizer->add_setting(
    'operating_mode',
    array('default' => 'с пн по пт с 9:00 до 18:00 (с 13:00 до 14:00 перерыв)')
  );
  $customizer->add_control('operating_mode', array(
    'label' => 'Режим работы',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // адрес
  $customizer->add_setting(
    'address',
    array('default' => 'г. Цхинвал, ул 8-го июня, дом 86')
  );
  $customizer->add_control('address', array(
    'label' => 'Адрес',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // копирайт сайта
  $customizer->add_setting(
    'copyright',
    array('default' => '© 2021 «ЮГ-Телеком» Все права защищены.')
  );
  $customizer->add_control('copyright', array(
    'label' => 'Копирайт сайта (copyright ©)',
    'section' => 'section_one',
    'type' => 'text',
  ));
  // Настройки соцсетей ==========================================================
  $customizer->add_section(
    'section_soc',
    array(
      'title' => 'Ссылки на соцсети',
      'description' => 'Указываем ссылку в поле',
      'priority' => 10,
    )
  );
  // Ссылки на соцсети
  $customizer->add_setting(
    'soc_fac',
    array('default' => 'https://www.facebook.com/')
  );
  $customizer->add_control('soc_fac', array(
    'label' => 'Ссылка на фейсбук',
    'section' => 'section_soc',
    'type' => 'text',
  ));
  $customizer->add_setting(
    'soc_vk',
    array('default' => 'https://www.vk.com/')
  );
  $customizer->add_control('soc_vk', array(
    'label' => 'Ссылка на вконтакте',
    'section' => 'section_soc',
    'type' => 'text',
  ));
  $customizer->add_setting(
    'soc_inst',
    array('default' => 'https://www.instagram.com/')
  );
  $customizer->add_control('soc_inst', array(
    'label' => 'Ссылка на инстаграм',
    'section' => 'section_soc',
    'type' => 'text',
  ));


// Уведомления ==========================================================
$customizer->add_section(
  'section_notification',
  array(
    'title' => 'Уведомления',
    'description' => 'Указываем текст уведомления',
    'priority' => 10,
  )
);
$customizer->add_setting(
  'notification',
  array(
    'default' => '',
    'transport' => 'postMessage'
    )
);
$customizer->add_control('notification', array(
  'label' => 'Уведомление',
  'section' => 'section_notification',
  'type' => 'textarea',
));

});

