
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $page_title?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $project_table_title ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php echo $project_table; ?>                               
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<script type="text/javascript">

           
function enter_version(id)
{		
	$.ajax({
		type:"POST",
		url: "http://127.0.0.1/URM/index.php/product/release/version/",
		dataType:"html",
		data:{"project_id":id},
		success:function(data){
			$("#page-wrapper").html(data);
			return false;
		},
		error:function(XMLHttpRequest){
			alert('error');
			alert(XMLHttpRequest.readyState);
			alert(XMLHttpRequest.status);
			return false;
		}
	});	
}
</script> 