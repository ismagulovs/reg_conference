<?php
$email = 'sultan_1993@list.ru';

$fam = 'qwe';
$name = 'qwe';
$pass = 'qwe12';

include('SendMailSmtpClass.php');
	
                                     
 $mailSMTP = new SendMailSmtpClass('ncgsot2016@yandex.ru', 'ncgsot195375', 'ssl://smtp.yandex.ru', 'НЦТ',465 ); // создаем экземпляр класса
                                      
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
	$headers .= "From: <ncgsot2016@yandex.ru>\r\n"; // от кого письмо !!! тут e-mail, через который происходит авторизация
	$result =  $mailSMTP->send($email, 'Пароль для Заявки УМП', $fam.' '.$name.'<br/>Вы зарегистрировались на сервисе http://prob.ncgsot.kz/ump/ . <br/> Пароль для доступа - '.$pass, $headers); // отправляем письмо
		
	if ($result === true){                        
		$_SESSION["msg"] = '<div id="regis" style="display: block;"><div class="alert alert-error">
						<p>Вы успешно зарегистрировались. На указаную почту отправлен пароль <a href="./auth">Авторизации</a> </p>            
						</div></div>';             
	}else{
		$_SESSION["msg"] = '<div id="regis" style="display: block;"><div class="alert alert-error">
						<p>Вы успешно зарегистрировались. Ну были проблемы при отправке на почту, просим позвонить по телефону 8 7172 69-50-62 </p>            
						</div></div>';
	}
	echo  $result;
?>