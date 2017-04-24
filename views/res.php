<div class="login-panel panel panel-default">
        <div class="panel-heading text-center"><h2 style="color: #007;"><?php echo $ar_lang[$lang]['title_reg']; ?></h2></div>
        <div class="panel-body" >
		<?php
			$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$rand = $_GET['rdn'];
			$id = $_GET['id'];
			//echo '$rand ='.$rand.'<br>$id ='.$id;
			$nid = get_test_res_email($id, $rand);
			if($nid > 0){
				$res = set_res_status_user($id);
				if($res == 'true'){
					echo '<div class="panel panel-primary text-center">
							<div class="panel-heading">
								'.$ar_lang[$lang]['reg_test_true1'].'
							</div>
							<div class="panel-body">
								<p>'.$ar_lang[$lang]['reg_test_true2'].'</p>
							</div>
						</div>';
				}else{
					echo '<div class="panel panel-danger text-center">
							<div class="panel-heading">
								error
							</div>
							<div class="panel-body">
								<p>error</p>
							</div>
						</div>';
				}
			}else{
				echo '<div class="panel panel-danger text-center">
							<div class="panel-heading">
								error
							</div>
							<div class="panel-body">
								<p>error</p>
							</div>
						</div>';
			}
		?>
		 <a class="btn btn-primary" href="http://testcenter.kz/">ok</a>
	</div>
</div>