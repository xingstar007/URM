<?php $this->load->view("head");?>

		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<?php $this->load->view("menu",array("menu"=>$this->get_menu));?>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
        <!-- /.navbar-static-side -->
	</nav>
	<div id="page-wrapper">
		<?php echo $this->output->get_output();?>
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
</body>
<?php $this->load->view("foot");?>