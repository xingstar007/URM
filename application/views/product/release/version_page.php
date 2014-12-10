<div class="row">
	<div class="col-lg-8">
    	<h1 class="page-header"><?php echo $page_title?></h1>
    </div>
	<div class="col-lg-4">
		<?php echo anchor('product/release/add_version/'.$project_id,'新增版本',array('class'=>'btn btn-outline btn-default btn-lg btn-right-header create-version'));?>
	</div>
</div><!-- /.row -->                   
<div id="version_table">
<?php
$this->load->library('table');
if(isset($version_type)){
for ($i =0 ; $i < count($version_type);$i++)
{
?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
  				<div class="panel-heading">
   					<?php 
   					if($version_type[$i] == 1)
   					{
   						echo VERSION_ANDROIDTITLE;
   					}else if($version_type[$i] == 2)
   					{
   						echo VERSION_IOSTITLE;
   					}
   					?>
				</div><!-- /.panel-heading -->
 				<div class="panel-body">
					<div class="table-responsive">
						<?php
						$this->table->set_template(default_table_style());
						$this->table->set_heading(version_table_heading());
					
						$v_data = array();
						if(0<count($version_list[$i])){
							for($r = 0; $r < count($version_list[$i]); $r++)
							{
								$v_id = $version_list[$i][$r]['version_id'];
								$v_data[$r][0] = $version_list[$i][$r]['version_name'];
								$v_data[$r][1] = $version_list[$i][$r]['version_date'];
								$v_data[$r][2] = $version_list[$i][$r]['file_url'];
								if($version_list[$i][$r]['is_publish'])
								{
									$v_data[$r][3] = '<input class="publish-flag" name="'.$version_type[$i].'" type="radio" value='.$v_id.' checked/>';
								}else {
									$v_data[$r][3] = '<input class="publish-flag" name="'.$version_type[$i].'" type="radio" value='.$v_id.'/>';
								}
								$v_del = anchor('product/release/version_delete/'.$v_id,DELETE,array('class'=>'btn btn-outline btn-default btn-xs'));
								//$v_edit = anchor('product/release/version_updata/'.$v_id,'编辑',array('class'=>'btn btn-outline btn-default btn-xs'));
								$v_data[$r][4] = $v_del;
							}
						}
						echo $this->table->generate($v_data);
						?>
					</div><!-- /.table-responsive -->
				</div><!-- /.panel-body -->
			</div><!-- /.panel -->
		</div>
	</div><!-- /.row -->
<?php }} ?>
</div>
<script type="text/javascript">
						
$(".publish-flag").change(function() {
	var $this = $(this)		
	$.ajax({
			type:"POST",
			url: "http://127.0.0.1/URM/index.php/product/release/version_publish/",
			dataType:"json",
			data:{"version_id":$(this).val()},
			success:function(data){
				if(data>0){
					alert('success');
				}
				return false;
			},
			error:function(XMLHttpRequest){
				alert('error');
				alert(XMLHttpRequest.readyState);
				alert(XMLHttpRequest.status);
				return false;
			}
	});
});	
</script>
