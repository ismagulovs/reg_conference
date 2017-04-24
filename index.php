<?php
	include('connect.php');
	include_once('lang.php');
	session_start();
?>
<html>
<head>
	<title>Регистрация</title>
	<meta charset="utf-8">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-table.css" rel="stylesheet">
</head>
<body>
<div class="col-sm-offset-1 col-md-10 col-md-offset-1">
    	<?php		
		$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$URL_Parts = explode('/', trim($URL_Path, ' /'));
		$lang = array_shift($URL_Parts);
		if(!$lang){
			header("Location: http://".$_SERVER['HTTP_HOST']."/kz");
		}elseif(($lang != 'kz') && ($lang != 'ru') && ($lang != 'en')){
			echo 'errer';
		}else{
			$_SESSION['lang'] = $lang;
			$view = array_shift($URL_Parts);
			if($_SERVER['REQUEST_URI'] === '/'.$lang){
				include('views/index.php');
			}else if( substr($_SERVER['REQUEST_URI'],0,7) == '/'.$lang.'/res'){
				include('views/res.php');
			}else if(substr($_SERVER['REQUEST_URI'],0,9) == '/'.$lang.'/admin'){
				include('views/admin.php');
			}else{
				header("Location: http://".$_SERVER['HTTP_HOST']."/".$lang);
			}
		}
		//if($_SERVER['REQUEST_URI'] === '/'){
		//	include('views/index.php');
		//}else if( $_SERVER['REQUEST_URI'] == '/res'){
		//	include('views/res.php');
		//}else if($_SERVER['REQUEST_URI'] == '/admin'){
		//	include('views/admin.php');
		//}else{
		//	header("Location: http://".$_SERVER['HTTP_HOST']."/");
		//}
	?>
</div>

<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-table.js"></script> 
<script src="../js/func.js"></script>
</body>
</html>