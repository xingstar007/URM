<?php

if( !function_exists("default_table_style")){
	function default_table_style(){
		$table_style = array (
		
				'table_open'          => '<table class="table table-striped table-bordered table-hover">',
		
				'heading_row_start'   => '<tr>',
				'heading_row_end'     => '</tr>',
				'heading_cell_start'  => '<th>',
				'heading_cell_end'    => '</th>',
		
				'row_start'           => '<tr class="odd gradeX">',
				'row_end'             => '</tr>',
				'cell_start'          => '<td>',
				'cell_end'            => '</td>',
		
				'row_alt_start'       => '<tr class="even gradeC">',
				'row_alt_end'         => '</tr>',
				'cell_alt_start'      => '<td>',
				'cell_alt_end'        => '</td>',
		
				'table_close'         => '</table>'
		);
		return	$table_style;		
	}
}

if( !function_exists("project_table_heading")){
	function project_table_heading(){
		$heading = array ('项目ID', '项目名称', '项目下载页面地址','Android发布版本','IOS发布版本','操作');
		return	$heading;
	}
}

if( !function_exists("version_table_heading")){
	function version_table_heading(){
		$heading = array ('版本号', '上传时间', '文件地址','是否发布','操作');
		return	$heading;
	}
}

define("PROJECT_PAGETITLE","产品发布管理");
define("PROJECT_TABLETITLE","项目列表");
define("VERSION_ANDROIDTITLE","安卓版本列表");
define("VERSION_IOSTITLE","苹果版本列表");
define("DELETE","删除");
define("EDIT","编辑");
define("ENTER","进入");
define("CREATE_VERSION_ERROR1","资料填写不完整");
define("CHOOSE_VERSION_TYPE","选择版本类型");
define("VERSION_NAME","版本号");
define("UPDATE_PROJECT","上传文件");
define("IS_PUBLISH","是否发布");
define("ADD_VERSION","新增版本");
define("UPDATE_VERSION","修改版本信息");
define("SHORTURL_PAGETITLE","短链接管理");
define("PRODUCE_SHORTURL_SINA","生成新浪短链接");
define("CREATE","生成");