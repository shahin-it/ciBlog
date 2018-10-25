<!doctype html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
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
        
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>asset/image/default/favicon.png">
	<script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/jquery.form.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/jquery.twbsPagination.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/vendor/tinymce/tinymce.min.js"></script>
<!--	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=wt3uzmqklhngrq7rtggyqdizn4k1cgkaod5o63m9q1jvjdsa"></script>-->
	<script src="<?php echo base_url(); ?>asset/js/skui.js"></script>
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
<body class="body">
<header class="banner d-print-none">
	<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="<?php echo site_url('admin') ?>"><img class="logo" height="32" width="32" src="<?php echo base_url("asset/image/default/logo.png")?>"/> Batayon</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php echo @$navigation?>"><a class="nav-link" href="<?php echo base_url('blogAdmin/navigation');?>">Navigation</a></li>
				<li class="nav-item <?php echo @$page?>"><a class="nav-link" href="<?php echo base_url('blogAdmin/page');?>">Page</a></li>
				<li class="nav-item <?php echo @$category?>"><a class="nav-link" href="<?php echo base_url('blogAdmin/category');?>">Category</a></li>
				<li class="nav-item <?php echo @$post?>"><a class="nav-link" href="<?php echo base_url('blogAdmin/post'); ?>">Post</a></li>
				<li class="nav-item <?php echo @$comment?>"><a class="nav-link" href="<?php echo base_url('blogAdmin/comment'); ?>">Comment</a></li>
				<li class="d-sm-none">
					<ul class="navbar-nav">
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>" target="_blank"> View Site</a></li>
						<li class="nav-item"><a class="nav-link" href="#"> Preferences</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url('user/logout');?>"> Log Out</a></li>
					</ul>
				</li>
			</ul>

			<ul class="navbar-nav flex-row d-none d-sm-block">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo base_url()?>" target="_blank">View Site</a>
						<a class="dropdown-item" href="#">Preferences</a>
						<a class="dropdown-item" href="<?php echo base_url('user/logout');?>">Log Out</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<div id="global-info"></div>
</header>
<section id="body" class="container-fluid">
	<article>
		<?php echo $output; ?>
	</article>
</section>
<footer class="d-print-none">
	<div class="row py-1 mx-0">
		<div class="col-sm-6">
			<a href="#!">Terms of Service</a> | <a href="#!">Privacy</a>
		</div>
		<div class="col-sm-6 text-sm-right">
			<span>© 2018 Shahin Khaled. All rights reserved</span>
		</div>
	</div>
</footer>
</body>
</html>
