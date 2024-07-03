<?php 
    $url = '../../../data/tmp/myadmin/file/';
    include '../../../include/all_include.php';
    include '../../../include/function/session.php'; 
	?>
	<link rel="stylesheet" href="<?php echo $url;?>assets/styles/style.min.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/fonts/material-design/css/materialdesignicons.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/waves/waves.min.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/sweet-alert/sweetalert.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/chart/morris/morris.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="<?php echo $url;?>assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>
	<link rel="stylesheet" href="<?php echo $url;?>assets/styles/style.min.css">
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.php" class="logo"><i class="ico mdi mdi-cube-outline"></i><?php echo ucwords($siapa);?></a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="<?php echo ($avatar);?>" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="index.php">Halaman</a></h5>
			<h5 class="position"><?php tabelnomin();?></h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="<?php home();?>"><i class="fa fa-user"></i> Home</a></div>
					
					<div class="control-item"><a href="<?php logout();?>"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation Menu</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				
				
						
				
				
				 <!-- MENU -->
                <?php
$m = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
foreach($m as $i){if($i->t == 's' ){
?>
                <!-- SINGLE -->
              
				
				<li>
					<a class="waves-effect" href="<?php echo $i->l;?>"><i class="menu-icon mdi mdi-arrow-all"></i><span><?php echo $i->n;?></span></a>
				</li>
                <!-- /SINGLE -->
            <?php
}else if($i->t == 'm' ){ $idmenu = $i->id;
?>
                <!-- MULTI -->

                
					 
					 <li>
					<a class="waves-effect parent-item js__control" href="<?php echo $url;?>#"><i class="menu-icon mdi mdi-apps"></i><span><?php echo $i->n;?></span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
                            <?php
		$m1 = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
		foreach($m1 as $i1) {
		if($i1->s=="$idmenu" and $i1->t=="sm" ){
		?>
                        <li>
                            <a class="item" onclick="window.location = '<?php echo $i1->l;?>'">
                                <?php echo $i1->n;?></a>
                        </li>
                        <?php }} ?>
                    	</ul>
				</li>

            <!-- /MULTI -->
            <?php }} ?>
 <!-- /MENU -->
			</ul>
			
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Home</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		
		<a href="<?php logout();?>" class="ico-item pulse"><span class="ico-item mdi mdi-logout js__logout" ></span>Logout</a>
		
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				
				<div class="col-lg-12 col-md-12 col-xs-12">
				<div class="box-content card">
					<h4 class="box-title bg-warning"><i class="ico fa fa-table"></i>Management <?php tabelnomin();?></h4>
					
					<div class="card-content">
						
						<?php include 'halaman.php'; ?>
						
					</div>
					<!-- /.card-content -->
				</div>
				<!-- /.box-content -->
			</div>
				
				
			</div>
			<!-- /.col-xs-12 -->

		</div>
		<!-- /.row -->

			
		<footer class="footer">
			<ul class="list-inline">
				<?php echo $copyright; ?>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?php echo $url;?>assets/script/html5shiv.min.js"></script>
		<script src="<?php echo $url;?>assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo $url;?>assets/scripts/jquery.min.js"></script>
	<script src="<?php echo $url;?>assets/scripts/modernizr.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/nprogress/nprogress.js"></script>
	
	<script src="<?php echo $url;?>assets/plugin/waves/waves.min.js"></script>

	<!-- Morris Chart -->
	<script src="<?php echo $url;?>assets/plugin/chart/morris/morris.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/chart/morris/raphael-min.js"></script>
	<script src="<?php echo $url;?>assets/scripts/chart.morris.black.init.min.js"></script>

	<!-- Flot Chart -->
	<script src="<?php echo $url;?>assets/plugin/chart/plot/jquery.flot.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/chart/plot/jquery.flot.tooltip.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/chart/plot/jquery.flot.categories.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/chart/plot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo $url;?>assets/plugin/chart/plot/jquery.flot.stack.min.js"></script>
	<script src="<?php echo $url;?>assets/scripts/chart.flot.black.init.min.js"></script>

	<!-- Sparkline Chart -->
	<script src="<?php echo $url;?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?php echo $url;?>assets/scripts/chart.sparkline.init.min.js"></script>

	<!-- FullCalendar -->
	<script src="<?php echo $url;?>assets/plugin/moment/moment.js"></script>
	<script src="<?php echo $url;?>assets/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="<?php echo $url;?>assets/scripts/fullcalendar.init.js"></script>

	<script src="<?php echo $url;?>assets/scripts/main.min.js"></script>
</body>
</html>
