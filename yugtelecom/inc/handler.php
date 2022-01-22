<?php
add_action('wp_ajax_handler', 'applicationAdd'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_handler', 'applicationAdd');
header('Access-Control-Allow-Origin: *');
function applicationAdd(){
  $res = array('success' => false);
  // Проверка, что есть POST запрос
  if ($_POST) {
    $is_valid = returnReCaptcha($_POST['token']);
    $the_post = get_post($_POST['rates']);
    $custom = get_post_custom($_POST['rates']);
    $title = $the_post->post_title;
    
    if($is_valid['success']){
      $feed = array(
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'rates' => $_POST['rates'],
        'rate' => $_POST['rate'],
      );
      $postContent =  '<strong>ФИО (Название):</strong> '. $feed['name'] .'<br>'.
                      '<strong>Телефон:</strong> ' . $feed['phone'] . '<br>' .
                      '<strong>Адрес:</strong> ' . $feed['address'] . '<br>' .
                      '<strong>Выбранный тариф:</strong> ' . $title . ' Скорость: ' . $custom['rates_speed'][0] .' Мбит/сек<br>';

      if($feed['name'] and $feed['phone']) {
        $new_post = array(
        'ID'             => "", // Вы обновляете существующий пост?
        'menu_order'     => "", // Если запись "постоянная страница", установите её порядок в меню.
        'comment_status' => 'closed' | 'open', // 'closed' означает, что комментарии закрыты.
        'ping_status'    => 'closed' | 'open', // 'closed' означает, что пинги и уведомления выключены.
        'pinged'         => "",  //?
        'post_author'    => 1, // ID автора записи
        'post_content'   => $postContent, // Полный текст записи.
        'post_date'      => date('Y-m-d H:i:s'), // Время, когда запись была создана.
        'post_date_gmt'  => date('Y-m-d H:i:s'), // Время, когда запись была создана в GMT.
        'post_excerpt'   => "", // Цитата (пояснительный текст) записи.
        'post_name'      => "", // Альтернативное название записи (slug) будет использовано в УРЛе.
        'post_parent'    => "", // ID родительской записи, если нужно.
        'post_password'  => "", // Пароль для просмотра записи.
        'post_status'    => 'unread', // Статус создаваемой записи. 'draft' | 'publish' | 'pending'| 'future' | 'private'
        'post_title'     => 'Заявка на подключение от: ' . $feed['name'], // Заголовок (название) записи.
        'post_type'      => 'application',// Тип записи.
        'post_category'  => array(), // Категория к которой относится пост (указываем ярлыки, имена или ID).
        'tags_input'     => array(), // Метки поста (указываем ярлыки, имена или ID).
        // 'tax_input'      => array( 'taxonomy_name' => array() ), // К каким таксам прикрепить запись (указываем ярлыки, имена или ID).
        'to_ping'        => "", //?
        // 'meta_input'     => [ 'meta_key'=>'meta_value' ], // добавит указанные мета поля. По умолчанию: ''. с версии 4.4.
        );
        $post_id = wp_insert_post($new_post);
        $post = get_post($post_id);
        update_post_meta($post_id, "application_name", $feed['name']);
        update_post_meta($post_id, "application_phone", $feed['phone']);
        update_post_meta($post_id, "application_address", $feed['address']);
        update_post_meta($post_id, "application_rates", $feed['rate']);
        // if ( $_FILES ) { 
        //   $files = $_FILES["more_photos"];  
        //       foreach ($files['name'] as $key => $value) {            
        //           if ($files['name'][$key]) { 
        //               $file = array( 
        //                   'name' => $files['name'][$key],
        //                   'type' => $files['type'][$key], 
        //                   'tmp_name' => $files['tmp_name'][$key], 
        //                   'error' => $files['error'][$key],
        //                   'size' => $files['size'][$key]
        //               ); 
        //               $_FILES = array ("my_file_upload" => $file); 
        //               foreach ($_FILES as $file => $array) {              
        //                   $newupload = my_handle_attachment($file,$post->ID); 
        //               }
        //           } 
        //       } 
        //   }

          if($post->ID){
            $res['success'] = true;
            $res['message'] = '<div class="message success">
                                  <i class="far fa-user-check"></i>
                                  <h3 class="label">Ваша заявка принята. Мы свяжемся с Вами в ближайшее время</h3>
                                  <a href="#" class="close">Закрыть</a>
                              </div>';
            $res['rechaptcha'] = $is_valid;
            $res['sendEmail'] = sendEmail($feed, $post->ID);
            
          }else{
            $res['message'] = '<div class="message success">
                                  <i class="far fa-exclamation-triangle"></i>
                                  <h3 class="label">Возникла ошибка, сообщение не доставлено! Попробуйте отправить еще раз.</h3>
                                  <a href="#" class="close">Закрыть</a>
                              </div>';
            $res['rechaptcha'] = $is_valid;
          }
      }
    }else{
      $res['message'] = '<div class="message success">
                            <i class="fas fa-robot"></i>
                            <h3 class="label">Извините, но Вы не прошли каптчу.</h3>
                            <a href="#" class="close">Закрыть</a>
                        </div>';
      $res['rechaptcha'] = $is_valid;
    }
  }

  echo json_encode($res);
  die();
}
// Функция для получения данных reCaptcha
function returnReCaptcha($token) {
  // URL куда отправлять токин и секретный ключ
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  
  // Параметры отправленных данных
  $params = [
      'secret' => '6LcK86odAAAAAPYKnbposT7cm5mZZmhHvkir4lYu', // Секретный ключ
      'response' => $token, // Токин
      'remoteip' => $_SERVER['REMOTE_ADDR'], // IP-адрес пользователя
  ];
  
  // Делаем запрос
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // Отправляем запрос 
  $response = curl_exec($ch);
  
  // Возвращаем массив полученных данных
  return json_decode($response, true);
}

// функция отправки оповещения на Е-почту
function sendEmail($feed, $post_id){
	global $phpmailer;
		if ( !is_object( $phpmailer ) || !is_a( $phpmailer, 'PHPMailer' ) ) { // проверяем, существует ли объект $phpmailer и принадлежит ли он классу PHPMailer
			// если нет, то подключаем необходимые файлы с классами и создаём новый объект
			require_once ABSPATH . WPINC . '/class-phpmailer.php';
			require_once ABSPATH . WPINC . '/class-smtp.php';
			$phpmailer = new PHPMailer( true );
		}
    $postContent =  '<strong>ФИО (Название):</strong> '. $feed['name'] .'<br>'.
                    '<strong>Телефон:</strong> ' . $feed['phone'] . '<br>' .
                    '<strong>Адрес:</strong> ' . $feed['address'] . '<br>' .
                    '<strong>Выбранный тариф:</strong> ' . $feed['rates'].'<br>';
		$attachments = get_attached_media( '', $post_id); // получаем прикрепленные файлы по ИД сообщения
		$phpmailer->ClearAttachments(); // если в объекте уже содержатся вложения, очищаем их
		$phpmailer->ClearCustomHeaders(); // то же самое касается заголовков письма
		$phpmailer->ClearReplyTos(); 
		$phpmailer->From = 'jubo89@gmail.com'; // от кого, Email
		$phpmailer->FromName = $feed['name']; // от кого, Имя
		$phpmailer->Subject = 'Заявка на подключение от: '.$feed['name']; // тема
		$phpmailer->SingleTo = true; // это означает, что если получателей несколько, то отображаться будет всё равно только один (если непонятно, спросите, я вам подробно объясню в комментариях)
		$phpmailer->ContentType = 'text/html'; // тип содержимого письма
		$phpmailer->IsHTML( true );
		$phpmailer->CharSet = 'utf-8'; // кодировка письма
		$phpmailer->ClearAllRecipients(); // очищаем всех получателей
		$phpmailer->AddAddress('masterit15@yandex.ru'); // добавляем новый адрес получателя
		$phpmailer->Body = 	$postContent;
		// foreach ($attachments as $k => $file) { // перебираем массив файлов
		// 	$attachment_url = get_attached_file($file->ID); // получаем полный путь к файлу
		// 	$phpmailer->AddAttachment($attachment_url); // добавляем вложение
		// }
		return $phpmailer->Send(); // отправка письма
}
add_action('wp_ajax_handler_map', 'savePoligonCoords'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_handler_map', 'savePoligonCoords');
function savePoligonCoords(){
  set_theme_mod( 'maps', $_POST['poligons']);
  $res['message'] = 'координаты успешно сохранены';
  $res['coords'] = $_POST['poligons'];
  $res['success'] = true;
  echo json_encode($res);
  die();
}
?>