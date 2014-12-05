<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header"><?php echo $pagetitle ?></h1>
    </div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class = "panel-body">
				<?php 
				echo validation_errors();
				if($edit_type=="add")
				{
					echo form_open_multipart('product/release/create_version_submit/'.$project_id,array('id' => 'version_form'));
				}else if($edit_type=="edit"){
					echo form_open_multipart('product/release/create_version_submit/'.$project_id,array('id' => 'version_form'));
				}
				?>
				<div class="row">
					<label>选择版本类型</label>
					<select name="version_type" class="form-control" >
						<option value ="1" <?php if($versiontype = "1"){ ?> selected = "selected"  <?php } ?> >android</option>
						<option value ="2" <?php if($versiontype = "2"){ ?> selected = "selected"  <?php } ?> >IOS</option>
					</select>
				</div>
				<div class="row">
					<label>版本号</label>
					<input name="version_name" class="form-control"  <?php if( !is_null($version_name)){ ?> value = "<?php $version_name ?>" <?php } ?> >
				</div>
				<div class="row">
					<label>版本上传</label>
 					<input type="file" name="product" >
				</div>
				<div class="row">					
 					<input name="publish-flag" type="checkbox" value="1"  <?php if( $is_publish == 1){ ?> checked <?php } ?> />
 					<label>是否发布</label>
				</div>
				<div class="row">
					<button type="submit" name="project_id" value="<?php  echo $project_id; ?>" class="btn btn-outline btn-default ">提交</button>
				</div>
				</form>
			</div>
		</div>
		<!-- /.panel -->
	</div>
</div>
<!-- /.row --> 
