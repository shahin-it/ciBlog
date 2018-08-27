<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="resource-type" content="document"/>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow"/>

		<title><?php echo $title; ?></title>

        <script type="text/javascript">
            var app = {
                baseUrl: '<?php echo base_url() ?>',
				maxResult: 10,
            };
        </script>
        
        <link rel="icon" href="<?php echo base_url(); ?>asset/image/sys/favicon.png">
        <script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>asset/vendor/jquery.form.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/vendor/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/vendor/jquery.twbsPagination.min.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/skui.js"></script>
        <script src="<?php echo base_url(); ?>asset/js/site.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-reboot.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/site.css"/>

        <?php
        /** -- Copy from here -- */
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";

        if (!empty($canonical)) {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical ?>" /><?php
        }
        echo "\n\t";

        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";

        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";

        /** -- to here -- */


		$categories = $this->blogCategory->getCategoryTree(["parent"=>null]);
        ?>

    </head>
    <body>
	<div class="container">
		<header class="blog-header">
			<nav class="navbar navbar-expand-md navbar-dark bg-secondary">
				<a class="navbar-brand" href="<?php echo base_url()?>"><i class="fas fa-book pr-1"></i> Batayon</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav-bar" aria-controls="main-nav-bar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="main-nav-bar">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="<?php echo base_url()?>">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Disabled</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
					</ul>
					<form class="form-inline my-2 my-md-0">
						<input class="form-control" type="text" placeholder="Search">
					</form>
				</div>
			</nav>
		</header>
		<?php echo isset($featured) ? $featured : ""; ?>
		<main role="main" id="body">
			<div class="row">
				<aside class="col-md-4 col-lg-3 blog-sidebar">
					<div class="p-3 mb-3 bg-light rounded">
						<h4 class="font-italic">About</h4>
						<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
					</div>

					<div class="p-3">
						<h4 class="font-italic">Categories</h4>
						<ol class="side-bar-nav list-unstyled mb-0 skui-accordion-panel">
							<?php foreach ($categories as $category) {?>
							<li class="nav-item clearfix">
								<a href="<?php echo base_url("category/".$category['id'])?>"><?php echo($category['name']);?></a>
								<?php if($category["child"]) { ?>
									<span class="skui-accordion-label float-right btn btn-link"><h6 class="fas fa-arrow-circle-down"></h6></span>
									<ul class="skui-accordion-item">
										<?php foreach ($category["child"] as $cat) {?>
											<li class="nav-item"><a href="<?php echo base_url("category/".$cat['id'])?>" class="skui-accordion-label"><?php echo($cat['name']);?></a></li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
							<?php } ?>
						</ol>
					</div>

					<div class="p-3">
						<h4 class="font-italic">Archives</h4>
						<ol class="list-unstyled mb-0">
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">March 2014</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">February 2014</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">January 2014</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">December 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">November 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">October 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">September 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">August 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">July 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">June 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">May 2013</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">April 2013</a></li>
						</ol>
					</div>

					<div class="p-3">
						<h4 class="font-italic">Elsewhere</h4>
						<ol class="list-unstyled">
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">GitHub</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">Twitter</a></li>
							<li><a href="https://getbootstrap.com/docs/4.1/examples/blog/#">Facebook</a></li>
						</ol>
					</div>
				</aside><!-- /.blog-sidebar -->
				<div class="col-md-8 col-lg-9 blog-main">
					<?php echo $output; ?>
				</div><!-- /.blog-main -->

			</div><!-- /.row -->

		</main>
	</div>

	<footer class="blog-footer">
		<p>Blog template built by <a href="https://twitter.com/shahin_it" target="_blank">@shahin_it</a>.</p>
		<p>© 2018 SHAHIN KHALED. All rights reserved</p>
		<p><a href="#">Back to top</a></p>
	</footer>

	<!--<section id="body" class="container-fluid">
		<div class="row">
			<div class="sidebar col-md-3 col-lg-2 d-print-none">
				<form class="bd-search d-flex align-items-center">
					<div class="input-group">
						<input name="searchText" type="text" class="form-control input-search" placeholder="Search....">
						<div class="input-group-append">
							<span class="btn input-group-text"><i class="fa fa-search"></i></span>
						</div>
					</div>
					<button class="btn btn-link d-md-none p-0 ml-3" onclick="$('.navigation').slideToggle()" type="button">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
						<title>Menu</title>
						<path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
						</svg>
					</button>
				</form>
				<nav class="navigation">
					<div class="navigation-item">
						<ul class="side-bar-nav skui-accordion-panel">
							<li><h6>Categories</h6></li>
							<?php /*foreach ($categories as $category) {*/?>
								<li class="nav-item clearfix">
									<a class="" href="<?php /*echo base_url("category/".$category['id'])*/?>"><?php /*echo($category['name']);*/?></a>
									<a class="skui-accordion-label badge badge-light float-right" href="#"><i class="fas fa-arrow-circle-down"></i></a>
									<ul class="skui-accordion-item">
										<?php /*foreach ($category["child"] as $cat) {*/?>
											<li class="nav-item"><a href="<?php /*echo base_url("category/".$cat['id'])*/?>" class="skui-accordion-label"><?php /*echo($cat['name']);*/?></a></li>
										<?php /*}*/?>
									</ul>
								</li>
							<?php /*}*/?>
						</ul>
					</div>
				</nav>
			</div>
			<article class="sidebar col-md-9 col-lg-10">
				<?php /*echo $output; */?>
			</article>
		</div>
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
	</footer>-->
    </body>
</html>
