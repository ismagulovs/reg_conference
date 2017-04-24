<div class="login-panel panel panel-default" style="background-color: #E8F5F7;">
        <div class="panel-heading text-center" style="background-color: #127989;"><h2 style="color: #e8f5f7;"><?php echo $ar_lang[$lang]['title']; ?></h2></div>
        <div class="panel-body" >
            <form>
                    <div class="form-group" >
						 <div id="dfam" class="form-group panel panel-default">
						   <div class="panel-heading"><label for="fam" style="margin-bottom: 1px">
							<?php echo $ar_lang[$lang]['fam_user'];?></label>
						   <input type="text" id="fam" class="form-control" placeholder="<?php echo $ar_lang[$lang]['fam_user'];?>"></div>
						 </div>
						 <div id="dname" class="form-group panel panel-default">
						    <div class="panel-heading"><label for="name" style="margin-bottom: 1px">
								<?php echo $ar_lang[$lang]['name_user'];?></label>
						   <input type="text" id="name" class="form-control" placeholder="<?php echo $ar_lang[$lang]['name_user'];?>" onkeyup="key('text', this.id)" ><div id="tname"></div></div>
						 </div>
						 
						 <div id="dfath" class="form-group panel panel-default">
						   <div class="panel-heading"><label for="fath"  style="margin-bottom: 1px">
							<?php echo $ar_lang[$lang]['fat_user'];?></label>
						   <input type="text" id="fath" class="form-control" placeholder="<?php echo $ar_lang[$lang]['fat_user'];?>"></div>
						 </div>
						 
						 <div id="djob" class="form-group panel panel-default">
						   <div class="panel-heading"><label for="job"  style="margin-bottom: 1px">
						   <?php echo $ar_lang[$lang]['job_user'];?></label>
						   <input type="text" id="job" class="form-control" placeholder="<?php echo $ar_lang[$lang]['job_user'];?>" onkeyup="key('text', this.id)" ><div id="tjob"></div></div>
						 </div>
						<div id="demail" class="form-group panel panel-default">
							<div class="panel-heading"><label for="email">
							<?php echo $ar_lang[$lang]['email'];?></label>
							<input type="email" class="form-control" id="email" placeholder="email" onkeyup="key('text', this.id)"><div id="temail"></div></div>
						</div>						 
						<div id="dsection" class="form-group panel panel-default">
							<div class="panel-heading" ><label for="section">
							<?php echo $ar_lang[$lang]['sect'];?></label><br/>
							</div> 		
							<div class="panel-body">							
							<?php  
								$result = get_section();
								foreach($result as $item):
									 echo '<div class="radio"><label>
											  <input type="radio" name="section" onclick="key(\'radio\', \'section\')" id="'.$item['id'].'" value="'.$item['id'].'">
											  '.$item[$ar_lang[$lang]['name']].'
											</label></div>';
								endforeach;
								//$sql = pg_query("SELECT * FROM tbl_section");
								//while($item = pg_fetch_array($sql)){
								//	echo '<option>'.$item['name'].'</option>';
								//} 
							?>
							</div>
								<div class="panel-footer">
								<div class="row">
								  <div class="col-xs-9"><label class="control-label" style="color: #127989;"><?php echo $ar_lang[$lang]['m1'];?></label></div>
								  <div class="col-xs-3">
										<input name="radio" type='hidden' id="sect" value="нет"/>
										   <div class="btn-group" data-toggle="buttons">
											  <button type="button" class="btn btn-default active"  data-radio-name="radio" onclick="closebox('dtheme')"><?php echo $ar_lang[$lang]['no'];?></button>
											  <button type="button" class="btn btn-default" data-radio-name="radio" onclick="openbox('dtheme')"><?php echo $ar_lang[$lang]['yes'];?></button>
										  </div> 
								</div>		 
								</div>
								 <div id="dtheme" class="form-group panel panel-default" style="margin-top: 10px; display: none;">
								   <div class="panel-heading"><label for="theme"  style="margin-bottom: 1px">
									<?php echo $ar_lang[$lang]['theme'];?>
								   <input type="text" id="theme" class="form-control" placeholder="<?php echo $ar_lang[$lang]['theme'];?>" onkeyup="key('text', this.id)" >
								  <?php echo $ar_lang[$lang]['th1'];?></label>
								   <div id="ttheme"></div></div>
								 </div>
								</div><div id="tsection"></div>
						</div>
						
				<div class="checkbox panel panel-default">
					<div class="panel-heading text-center">
						<h4><?php echo $ar_lang[$lang]['m2'];?></h4>
					</div>
					<div class="panel-body">
						<div id="dmclass1" class="checkbox panel panel-default">
						    <div class="panel-heading">
							<div class="row">
							  <div class="col-xs-9"><strong><?php echo $ar_lang[$lang]['m2-1'];?></strong> </div>
							  <div class="col-xs-3">
									 <input name="cm1" type='hidden' id="cm1" >
									   <div class="btn-group" data-toggle="buttons">
										  <button type="button" class="btn btn-default active" data-radio-name="cm1"  onclick="closebox('m1')"><?php echo $ar_lang[$lang]['no'];?></button>
										  <button type="button" class="btn btn-default" data-radio-name="cm1" onclick="openbox('m1')"><?php echo $ar_lang[$lang]['yes'];?></button>
									  </div> 
							    </div>		 
							</div>	
							</div>
							<div id="m1" class="panel-body" style="display: none;">
								<?php echo $ar_lang[$lang]['m3-2'];?></label>
							</div>
						</div>
						
						<div id="dmclass2" class="checkbox panel panel-default">
						    <div class="panel-heading">
								<div class="row">
								  <div class="col-xs-9"><strong><?php echo $ar_lang[$lang]['m3-1'];?></strong> </div>
								  <div class="col-xs-3">
										 <input name="cm2" type='hidden' id="cm2" >
										   <div class="btn-group" data-toggle="buttons">
											  <button type="button" class="btn btn-default active" data-radio-name="cm2"  onclick="closebox('m2')"><?php echo $ar_lang[$lang]['no'];?></button>
											  <button type="button" class="btn btn-default" data-radio-name="cm2" onclick="openbox('m2')"><?php echo $ar_lang[$lang]['yes'];?></button>
										  </div> 
								    </div>		 
								</div>	
							</div>
							<div id="m2" class="panel-body" style="display: none;">
								<?php echo $ar_lang[$lang]['m3-2'];?></label>
							</div>
						</div>
					</div>
					</div>
				</div>
												
                        <div id="dbtn">
							<input type="button" id="btn" style="background-color: #127989;" class="form-control btn-primary" value="<?php echo $ar_lang[$lang]['butn']; ?>"/>
						</div>
                    </div>
			</form>
		</div>
	</div>