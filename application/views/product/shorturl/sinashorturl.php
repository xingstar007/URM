<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo SHORTURL_PAGETITLE ?></h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
 		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo PRODUCE_SHORTURL_SINA ?>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<?php 
					echo form_open('product/shorturl/getsinashorturl/');
				?>
					<div class="form-group">
					<?php
						$input_url = array(
							'name'	=>	'long_url',
							'class'	=>	'form-control',
						);
						echo form_input($input_url);
					?>
					</div>
					<div class="form-group">
					<?php
						$submit_button = array(
							'name'	=>	'create_sina',
							'class'	=>	'btn btn-default',
							'value'	=>	CREATE
						);
						echo form_submit($submit_button);
					?>
					</div>
					<?php
					if(isset($error_sina))
					{
						echo $error_sina;
					}else if(isset($short_url_sina))
					{
						$output_url = array(
							'name'	=>	'short_url_sina',
							'class'	=>	'form-control',
							'value'	=>	$short_url_sina
						);
						echo form_input($output_url);
					}		
				?>
				</div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->		
	</div><!-- /.col-lg-12 -->
</div>