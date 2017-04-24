<?php 
include(__DIR__ .'/../connect.php');
?>

<table class="table" id="table" data-toggle="table"  data-show-columns="true" data-search="true"  data-sort-order="desc">
	    <thead>
	    <tr>
	        <th data-field="state" data-id-field="id"  data-checkbox="true" >id</th>
	        <th data-field="id"   data-sortable="true">ID</th>
	        <th data-field="name"  data-sortable="true">Имя</th>
	        <th data-field="fam"  data-sortable="true">Фамилия</th>
	        <th data-field="fath"  data-sortable="true">Отчество</th>
	        <th data-field="job"  data-sortable="true" >Организация</th>
	        <th data-field="theme"  data-sortable="true">Тема доклада</th>
	        <th data-field="email"  data-sortable="true">EMAIL</th>
	        <th data-field="vist"  data-sortable="true">Высту. на конференции</th>
	        <th data-field="section" data-sortable="true">Секция</th>
	        <th data-field="mclass1"  data-sortable="true">Мастер класс 1</th>
	        <th data-field="mclass2"  data-sortable="true">Мастер класс 2</th>
	        <th data-field="status"  data-sortable="true">Статус</th>
	        <th data-field="date"  data-sortable="true">Дата регистрации</th>
	    </tr>
	    </thead>
		<tfoot>
            <tr class="filters">
                  <th> </th>
				  <th></th>
				  <th> <input type="text" class="form-control" placeholder="Имя"></th>
				  <th> <input type="text" class="form-control" placeholder="Фамилия"></th>
				  <th> <input type="text" class="form-control" placeholder="Отчество"></th>
				  <th> <input type="text" class="form-control" placeholder="Организация"></th>
				  <th> <input type="text" class="form-control" placeholder="Тема доклада"></th>
				  <th> <input type="text" class="form-control" placeholder="EMAIL"></th>
				  <th> <input type="text" class="form-control" placeholder="Высту. на конференции"></th>
				  <th> <input type="text" class="form-control" placeholder="Секция"></th>
				  <th> <input type="text" class="form-control" placeholder="Мастер класс 1"></th>
				  <th> <input type="text" class="form-control" placeholder="Мастер класс 2"></th>
				  <th> <input type="text" class="form-control" placeholder="Статус"></th>
				  <th> <input type="text" class="form-control" placeholder="Дата"></th>
            </tr>
        </tfoot>
		<tbody>
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
			$param .= ' mclass1 = '.$_POST['inmclass1'].'\' and';
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

		if(strlen($param)==5){

			$sql = 'select * from reg_user;';
		}else{
			$where = substr($param, 0, -3);
			$where = mb_strtolower($where, 'UTF-8');
			$sql = 'select * from reg_user '.$where;
		}
		$array = get_user_adminka($sql);
		foreach($array as $item):
		 echo '<tr>
			<td>'.$item['id'].'</td>				
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
