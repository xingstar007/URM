<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo PROJECT_PAGETITLE ?></h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
 		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo PROJECT_TABLETITLE ?>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<?php 
					echo form_open('product/shorturl/get/');
					$long_url = array(
							'name'	=>	'long_url',
							'class'	=>	'form-control version_input',
					);
					echo form_input($long_url);
					echo form_submit('mysubmit');
					if(isset($short_url))
					{
						echo $short_url;
					}		
				?>
				</div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div>