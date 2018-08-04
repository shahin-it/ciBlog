<!doctype html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8"/>
	<meta name="resource-type" content="document"/>
	<meta name="robots" content="all, index, follow"/>
	<meta name="googlebot" content="all, index, follow"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="<?php echo base_url(); ?>asset/image/sys/favicon.ico" type="image/x-icon" sizes="16x16">
	<script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/app.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/admin.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-reboot.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/admin.css"/>

	<?php
	/** -- Copy from here -- */
	if (!empty($meta))
		foreach ($meta as $name => $content) {
			echo "\n\t\t";
			?>
			<meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
		}
	echo "\n";

	if (!empty($canonical)) {
		echo "\n\t\t";
		?>
		<link rel="canonical" href="<?php echo $canonical ?>" /><?php

	}
	echo "\n\t";

	foreach ($css as $file) {
		echo "\n\t\t";
		?>
		<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	}
	echo "\n\t";

	foreach ($js as $file) {
		echo "\n\t\t";
		?>
		<script src="<?php echo $file; ?>"></script><?php
	}
	echo "\n\t";

	/** -- to here -- */
	?>

</head>
<body>
<header class="banner">
	<div id="global-info">Header</div>
</header>
<section id="body" class="container-fluid">
	<article>
		<?php echo $output; ?>
	</article>
</section>
<footer class="">
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
