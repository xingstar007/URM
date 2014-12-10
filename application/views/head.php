<!DOCTYPE html>
<html lang="zh-cn">
    <head>           <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="">
    	
    	 <!-- Bootstrap Core CSS -->
    	<link href="<?php echo base_url()?>resource/css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
    	<link href="<?php echo base_url()?>resource/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    	<!-- DataTables CSS -->
    	<link href="<?php echo base_url()?>resource/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    	<!-- Custom CSS -->
    	<link href="<?php echo base_url()?>resource/css/sb-admin-2.css" rel="stylesheet">
    	<!-- Custom Fonts -->
    	<link href="<?php echo base_url()?>resource/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    	<!-- Custom CSS -->
    	<link href="<?php echo base_url()?>resource/css/my.css" rel="stylesheet">

		<!-- jQuery -->
		<script src="<?php echo base_url()?>resource/js/jquery.js"></script>
		<script src="<?php echo base_url()?>resource/js/jquery.form.js"></script>
    	<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo base_url()?>resource/js/bootstrap.min.js"></script>
    	<!-- Metis Menu Plugin JavaScript -->
    	<script src="<?php echo base_url()?>resource/js/plugins/metisMenu/metisMenu.min.js"></script>
    	<!-- DataTables JavaScript -->
    	<script src="<?php echo base_url()?>resource/js/plugins/dataTables/jquery.dataTables.js"></script>
    	<script src="<?php echo base_url()?>resource/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    	<!-- Custom Theme JavaScript -->
    	<script src="<?php echo base_url()?>resource/js/sb-admin-2.js"></script>
    	
    	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
        	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    	
        <title><?php echo isset($header_title)?$header_title:isset($this->get_menu['list'][$this->uuri])?$this->get_menu['list'][$this->uuri]:""; ?></title>

    </head>
    <body>
		<div class="wrapper">
 		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="#"><?php echo isset($header_title)?$header_title:isset($this->get_menu['list'][$this->uuri])?$this->get_menu['list'][$this->uuri]:""; ?></a>
        	</div>
        	<ul class="nav navbar-top-links navbar-right">
				<li id="fat-menu" class="dropdown">
					<a href="#" id="user_action" role="button" class="dropdown-toggle" data-toggle="dropdown">欢迎您:<?php echo rbac_conf(array('INFO','nickname'));?><b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="user_action">
						<li> <?php echo anchor("Index/logout","<span class='glyphicon glyphicon-log-out'></span> 退出"); ?></li>
					</ul>
				</li>
			</ul>



