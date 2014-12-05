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
				<div class="table-responsive">
					<?php 
					$this->load->library('table');
					$this->table->set_template(default_table_style());
					$this->table->set_heading(project_table_heading());					
					$p_data = array();
					if(0<count($project_list)){
						for($i = 0; $i < count($project_list); $i++){
							$p_data[$i][0] = $project_list[$i]['project_id'];
							$p_data[$i][1] = $project_list[$i]['project_name'];
							$p_data[$i][2] = $project_list[$i]['page_url'];
							$p_data[$i][3] = $project_list[$i]['android_version'];
							$p_data[$i][4] = $project_list[$i]['ios_version'];
							$p_data[$i][5] = anchor('product/release/version/'.$project_list[$i]['project_id'],ENTER,array('class'=>'btn btn-outline btn-default btn-xs'));
						}
					}
					echo  $this->table->generate($p_data);
					?>                               
                </div><!-- /.table-responsive -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div>