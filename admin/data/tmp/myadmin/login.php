<?php
$default_url = '../data/tmp/tmp 44';
$tema = 'myadmin/';
$url = $default_url . '/' . $tema;
?>
<?php include '../include/function/login.php'; ?>

<link rel="stylesheet" href="<?php echo $url; ?>assets/styles/style.min.css">
<link rel="stylesheet" href="<?php echo $url; ?>assets/plugin/waves/waves.min.css">
</head>

<body>

	<div id="single-wrapper">
		<form action='' method='POST' class="frm-single">
			<div class="inside">
				<div class="title"><strong>Form </strong>Admin</div>
				<!-- /.title -->
				<div class="frm-title"><?php echo $judul; ?></div>
				<!-- /.frm-title -->

				<form action='' method='POST' class="form-inline" role="form">
					<div class="form-group col-md-12 col-sm-12 col-xs-12">
						<div class="text-left">
							<br>
							<label for="signupInputEmail" class="text-muted">Username</label>
							<input class="form-control" name="username" type="text" placeholder="Username">
						</div>
						<div class="text-left">
							<label for="signupInputPassword" class="text-muted">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="pull-left pad-btm">

						</div> <br>
						<button type="submit" type='submit' name="login" class="btn btn-block btn-primary">
							LOGIN
						</button>

						<a href="../../" class="btn btn-block btn-warning">CANCEL</a>
					</div>
				</form>


				<!-- /.row -->

				<div class="frm-footer"><?php echo $copyright; ?></div>
				<!-- /.footer -->
			</div>
		</form>
	</div>
	<script src="<?php echo $url; ?>assets/scripts/jquery.min.js"></script>
	<script src="<?php echo $url; ?>assets/scripts/modernizr.min.js"></script>
	<script src="<?php echo $url; ?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?php echo $url; ?>assets/plugin/waves/waves.min.js"></script>
	<script src="<?php echo $url; ?>assets/scripts/main.min.js"></script>
</body>

</html>
