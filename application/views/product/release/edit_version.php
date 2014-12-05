<?php 
if($edit_type=="add")
{
	$pagetitle = ADD_VERSION;
	$submit_url = form_open_multipart('product/release/create_version_submit/'.$project_id,array('id' => 'version_form'));
}else if($edit_type=="edit"){
	$pagetitle = UPDATE_VERSION;
	$submit_url = form_open_multipart('product/release/create_version_submit/'.$project_id,array('id' => 'version_form'));
}
?>

<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header"><?php echo $pagetitle ?></h1>
    </div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class = "panel-body">
				<div class="col-lg-12">
				<?php 
				echo validation_errors();
				echo $submit_url;
				?>
				<div class="row">
				<?php
					echo form_label(CHOOSE_VERSION_TYPE,"version_type");
					$type = array (
						'1'	=>	'ANDROID',
						'2'	=>	'IOS'
					);
					echo form_dropdown("version_type",$type,"","class = 'form-control version_dropdown'");	
				?>
				</div>
				<div class="row">
				<?php 
					echo form_label(VERSION_NAME,"version_name");
					$v_name = array(
						'name'	=>	'version_name',
						'maxlength'	=>	'100',
						'size'	=>	'50',
						'class'	=>	'form-control version_input',
					);
					if(isset($version_name)){
						$v_name['value'] = $version_name;
					}
					echo form_input($v_name);	
				?>
				</div>
				<div class="row">
				<?php 
					echo form_label(UPDATE_PROJECT,"product");
					$v_file = array(
							'name'	=>	'product',
							'value'	=>	'test',
							'maxlength'	=>	'100',
							'size'	=>	'50',
							'class'	=>	'form-control',
					);
					echo form_upload('product')
				?>
				</div>
				<div class="row">
				<?php
					echo form_label(IS_PUBLISH,"publish-flag");
					$v_p = array(
							'name'	=>	'publish-flag',
							'value'	=>	'1',
							'class'	=>	'form-control version_checkbox',
					);
					if(isset($is_publish)){
						if($is_publish==1)
						{
							$v_p['checked'] = 'checked';
						}
					}else {
						$v_p['checked'] = 'checked';
					}
					echo form_checkbox($v_p);
				?>
				</div>
				<?php
					$v_submit = array(
						'name'	=>	'project_id',
						'value'	=>	'1',
						'maxlength'	=>	'100',
						'size'	=>	'50',
						'class'	=>	'btn btn-outline btn-default',
					);
					echo form_submit($v_submit)
				
				?>
				</form>
			</div>
			</div>
		</div><!-- /.panel -->
	</div>
</div><!-- /.row --> 
				
				
