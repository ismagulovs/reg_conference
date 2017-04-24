<?php
session_start();
if(isset($_POST['login'])){
	if($_POST['login'] == 'admin' and $_POST['pass'] == 'nctadmin'){
		$_SESSION['admin'] = 'admin';
	}
}
//$_SESSION['admin'] = ' noadmin';
echo $_SESSION['admin'];
if($_SESSION['admin'] == 'admin'){
?>
<div class="col-lg-12 filterable">
<form role="form">
	<table>
		<tbody>
			<tr>
				  <th> </th>
				  <th></th>
				  <th><input type="text" class="form-control" id="inname" placeholder="Имя"></th>
				  <th><input type="text" class="form-control" id="infam" placeholder="Фамилия"></th>
				  <th><input type="text" class="form-control" id="infath" placeholder="Отчество"></th>
				  <th><input type="text" class="form-control" id="injob" placeholder="Организация"></th>
				  <th><input type="text" class="form-control" id="intheme" placeholder="Тема доклада"></th>
				  <th><input type="text" class="form-control" id="invist" placeholder="Высту. на конференции"></th>
				  <th><input type="text" class="form-control" id="insection" placeholder="Секция"></th>
				  <th><input type="text" class="form-control" id="inmclass1" placeholder="Мастер класс 1"></th>
				  <th><input type="text" class="form-control" id="inmclass2" placeholder="Мастер класс 2"></th>
				  <th><input type="text" class="form-control" id="instatus" placeholder="Статус"></th>
				  <th><input type="text" class="form-control" id="indate" placeholder="Дата"></th>
			</tr>
		</tbody>
	</table>
	<div id="text"><?php echo $_SESSION['sql'];?></div>
	<button type="button" id="db_qwerty" class="btn btn-primary" />запрос</button>
	<table class="table" id="table" data-toggle="table"  data-show-columns="true" data-search="true"  data-sort-order="desc">
	    <thead>
	    <tr>
	        <th><input type="checkbox" onclick="allcheck();" id="allcb" name="allcb"/></th>
	        <th>ID</th>
	        <th>Имя</th>
	        <th>Фамилия</th>
	        <th>Отчество</th>
	        <th >Организация</th>
	        <th>Тема доклада</th>
	        <th >EMAIL</th>
	        <th >Высту. на конференции</th>
	        <th >Секция</th>
	        <th>Мастер класс 1</th>
	        <th>Мастер класс 2</th>
	        <th>Статус</th>
	        <th>Дата регистрации</th>
	    </tr>
	    </thead>
		<tbody id="body-table">
		<?php
		$param = 'where';
		if($_POST['inname']){
			$param .= ' LOWER(name) like\'%'.$_POST['inname'].'%\' and';
		}
		if($_POST['infam']){
			$param .= ' LOWER(fam) like \'%'.$_POST['infam'].'%\' and';
		}
		if($_POST['infath']){
			$param .= ' LOWER(fath) like \'%'.$_POST['infath'].'%\' and';
		}
		if($_POST['injob']){
			$param .= ' LOWER(job) like \'%'.$_POST['injob'].'%\' and';
		}
		if($_POST['intheme']){
			$param .= ' LOWER(theme) like \'%'.$_POST['intheme'].'%\' and';
		}
		if($_POST['invist']){
			$param .= ' vist = '.$_POST['invist'].' and';
		}
		if($_POST['insection']){
			$param .= ' section = '.$_POST['insection'].' and';
		}
		if($_POST['inmclass1']){
			$param .= ' mclass1 = '.$_POST['inmclass1'].' and';
		}
		if($_POST['inmclass2']){
			$param .= ' mclass2 = '.$_POST['inmclass2'].' and';
		}
		if($_POST['instatus']){
			$param .= ' status='.$_POST['instatus'].' and';
		}
		if($_POST['indate']){
			$param .= ' LOWER(date) like \'%'.$_POST['indate'].'%\' and';
		}
		if(isset($_POST['sql'])){
			if(strlen($param)==5){
				$_SESSION['sql'] =  'select * from reg_user;';
			}else{
				$where = substr($param, 0, -3);
				$where = mb_strtolower($where, 'UTF-8');
				$_SESSION['sql'] = 'select * from reg_user '.$where;
			}
		}
		$array = get_user_adminka($_SESSION['sql']);
		foreach($array as $item):
		 echo '<tr>
			<td><input type="checkbox" name="SelectItem" value="'.$item['id'].'"/></td>				
			<td>'.$item['id'].'</td>              
			<td>'.$item['name'].'</td>            
			<td>'.$item['fam'].'</td>             
			<td>'.$item['fath'].'</td>            
			<td>'.$item['job_name'].'</td>        
			<td>'.$item['theme'].'</td>           
			<td>'.$item['email'].'</td>           
			<td>'.$item['vistup'].'</td>          
			<td>'.$item['section'].'</td>         
			<td>'.$item['mclass1'].'</td>         
			<td>'.$item['mclass2'].'</td>         
			<td>'.$item['status'].'</td>          
			<td>'.$item['date'].'</td>                         
		</tr>';                                     
		endforeach;
		?>
		</tbody>
	</table>

	
	<div class="form-group">
		<label>Текст сообщения</label>
		<textarea class="form-control" id="text_email" ></textarea>
		<button type="button" id="sel_mail" class="btn btn-primary">отправить</button>
	</div>
</form>
</div>
<?php 
}else{
	?>
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Login" id="login" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" id="password" type="password" value="">
							</div>
							<a href="#" class="btn btn-primary" onclick="adminLogin();">Login</a>
						</fieldset>
					</form>
				</div>
			</div>
	</div>
	<?php
}
?>
<script type="text/javascript">
function adminLogin(){
	var login = $('#login').val();
	var pass = $('#password').val();
	$.post("admin.php", 
		{
			login: login,
			pass: pass,
		},function(data){
			location.reload();
		});
}
</script>