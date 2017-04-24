<?php
session_start();
include(__DIR__ .'/../connect.php');
include(__DIR__ .'/../lang.php');
$replace = array( 
'\'' => '\\\'', 
'"' => '\"' , 
'\\' => '' 
); 

if(!$_POST['fam']) $fam = ' '; else $fam = $_POST['fam'];

if(!$_POST['name'] or $_POST['name'] == ''){
	echo json_encode(array("status"=>"error","id"=>"name","text"=>$ar_lang[$_SESSION['lang']]['no_name']));
	exit();
}else{
	$name = $_POST['name'];
}

if(!$_POST['fath'] or $_POST['fath'] == '') $fath = ' '; else $fath = $_POST['fath'];

if(!$_POST['vistup'] or $_POST['vistup'] == '') $vistup = ' '; else $vistup = $_POST['vistup'];

if(!$_POST['job'] or $_POST['job'] == ''){
	echo json_encode(array("status"=>"error","id"=>"job","text"=>$ar_lang[$_SESSION['lang']]['no_job']));
	exit();
}else{ $job = $_POST['job']; }

if($_POST['vistup'] == 1){
	if(!$_POST['theme'] or $_POST['theme'] == ''){
		echo json_encode(array("status"=>"error","id"=>"theme","text" =>$ar_lang[$_SESSION['lang']]['no_theme']));
		exit();
	}else{ $theme = $_POST['theme'];}
}else{
	$theme = ' ';
}


if(!$_POST['email'] or $_POST['email'] == '' ){
	echo json_encode(array("status"=>"error","id"=>"email","text" => $ar_lang[$_SESSION['lang']]['no_email']));
	exit();
}elseif(get_test_email($_POST['email']) > 0){
	echo json_encode(array("status"=>"error","id"=>"email","text" => $ar_lang[$_SESSION['lang']]['no_email2']));
	exit();
}else{
	if(email_format($_POST['email'] ) == true){
		$email = strtolower($_POST['email']);
	}else{
		echo json_encode(array("status"=>"error","id"=>"email","text" => $ar_lang[$_SESSION['lang']]['no_email']));
		exit();
	}
}


if(!$_POST['section']) $section = ' '; else $section = $_POST['section'];
if($_POST['section'] == ''){
	echo json_encode(array("status"=>"error","id"=>"section", "text" => $ar_lang[$_SESSION['lang']]['no_sec']));
	exit();
}

if(!$_POST['mclass1']) $mclass1 = ' '; else $mclass1 = $_POST['mclass1'];
if($_POST['mclass1'] == ''){
	echo json_encode(array("status"=>"error","id"=>"mclass1", "text" => "укажите Мастер-класс не указана"));
	exit();
}

if(!$_POST['mclass2']) $mclass2 = ' '; else $mclass2 = $_POST['mclass2'];
if($_POST['mclass2'] == ''){
	echo json_encode(array("status"=>"error","id"=>"mclass2", "text" => "укажите Мастер-класс не указана"));
	exit();
}

//echo json_encode(array("status"=>"ok","id"=> $mclass2.
//'1 '.$mclass1.'2  '.$section.'3  //
//'.$email.'4 '.$theme.'5 '.$job.'6 '.$fath.'7 '.$name.'8 '.$fam));
$fam 	 = str_replace(array_keys($replace), array_values($replace), $fam );
$name	 = str_replace(array_keys($replace), array_values($replace), $name);
$fath	 = str_replace(array_keys($replace), array_values($replace), $fath);
$job	 = str_replace(array_keys($replace), array_values($replace), $job); 
$theme	 = str_replace(array_keys($replace), array_values($replace), $theme);

$rand = generation();

$res = set_reg_user($fam, $name, $fath, $job , $theme, $section, $mclass1, $mclass2, $email, $rand, $vistup);  //запись в базу

if($res != 'false' and $res != 'zhopa'){
	$res_email = send_email($email, $rand, $res, $ar_lang[$_SESSION['lang']]['mail_text']);
	if($res_email == 'true'){
		echo json_encode(array("status"=>"ok","id"=> $ar_lang[$_SESSION['lang']]['text_reg']));
		exit();
	}else{
		echo json_encode(array("status"=>"error_service","id"=>"email"));
		exit();
	}
}else{
	echo json_encode(array("status"=>"error_service","id"=>"database"));
	exit();
}


//echo json_encode(array("status"=>"ok","id"=>$res));



function generation(){
    $characters = '0123456789zxcvbnmasdfghjklqwertyuiop';
    $randstring = '';

	for($i = 0; $i < 25; $i++){
      $randstring = $randstring.$characters[rand(0, strlen($characters))];
    }
	
    return $randstring;  
}

function send_email($email, $rand, $id, $text){ //отправка почты 
	// текст сообщения 
	//$message = "первая строка\nвторая строка\nтретья строка"; 
	// При помощи функции wordwrap() расставляем
	// переносы так, чтобы строки были не длиннее 70 символов 
	//$message = wordwrap($message, 70); 
	// отправляем сообщение 
	//	mail('sultan_1993@list.ru', 'Тема', $message);
		
		include('SendMailSmtpClass.php');
		$mailSMTP = new SendMailSmtpClass('ncgsot2016@yandex.ru', 'ncgsot195375', 'ssl://smtp.yandex.ru', 'НЦТ',465 ); // создаем экземпляр класса
											  
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
		$headers .= "From: <ncgsot2016@yandex.ru>\r\n"; // от кого письмо !!! тут e-mail, через который происходит авторизация
		$result =  $mailSMTP->send($email, 'NCT', $text.'/res?rdn='.$rand.'&id='.$id.'"/>http://conference.testcenter.kz/kz/res?rdn='.$rand.'&id='.$id.'</a>', $headers); // отправляем письмо
        
		if ($result === true){                        
			$res = 'true';            
		}else{
			$res = 'false';
		}
		return $res;
}

function email_format($email) { //проверка email
	if(preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $email) !== 0) {
	if(strlen($email) < 6) return FALSE; else return TRUE;
	} else { return FALSE; }
}

?>
