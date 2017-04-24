<?php
include(__DIR__ .'/../connect.php');
include('SendMailSmtpClass.php');
//echo '12313';
$id = $_POST['id'];
$text = $_POST['text'];

for($i = 0; $i < count($id); $i++){
	$item = get_id_to_email($id[$i]);
	$email[] = $item[0]['email'];
}

$mailSMTP = new SendMailSmtpClass('ncgsot2016@yandex.ru', 'ncgsot195375', 'ssl://smtp.yandex.ru', 'НЦТ',465 ); // создаем экземпляр класса
$headers  = "MIME-Version: 1.0\r\n  
			Content-type: text/html; charset=utf-8\r\n
			From: <ncgsot2016@yandex.ru>\r\n"; 
for($i = 0; $i < count($email); $i++){
	// от кого письмо !!! тут e-mail, через который происходит авторизация
	$result = $mailSMTP->send($email[$i], 'TEST', ' <br/>'.$text.' ', $headers); // отправляем письмо

	if ($result === true){                        
		$res = 'true';            
	}else{
		$res = 'false';
	}
	echo $res.$email[$i].$text.'<br>';
}
 
?>