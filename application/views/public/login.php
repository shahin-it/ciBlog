<!doctype html>
<html lang="en">
<head>
	<title>Welcome to <?php echo "CiBlog"; ?> : Login</title>
	<meta charset="utf-8"/>
	<meta name="resource-type" content="document"/>
	<meta name="robots" content="all, index, follow"/>
	<meta name="googlebot" content="all, index, follow"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="text/javascript">
		var app = {
			baseUrl: '<?php echo base_url()?>',
		};
	</script>

	<link rel="icon" href="<?php echo base_url(); ?>asset/image/sys/favicon.ico" type="image/x-icon" sizes="16x16">
	<script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/jquery.form.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/skui.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/admin.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-reboot.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/admin.css"/>
</head>
<body>
<header class="banner d-print-none">
	<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="<?php echo site_url('admin') ?>"><i class="fas fa-book pr-1"></i>Batayon</a>
	</nav>
	<div id="global-info"></div>
</header>
<section id="body" class="container-fluid">
	<article>

	</article>
</section>
<footer class="d-print-none">
	<div class="row py-1 mx-0">
		<div class="col-sm-6">
			<a href="#!">Terms of Service</a> | <a href="#!">Privacy</a>
		</div>
		<div class="col-sm-6 text-sm-right">
			<span>© 2013 Company Name. All rights reserved</span>
		</div>
	</div>
</footer>
</body>
</html>
