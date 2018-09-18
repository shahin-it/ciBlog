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
        
        <link rel="icon" type="image/x-icon" href="<?php echo base_url("asset/image/default/favicon.png");?>">
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


		$categories = $this->blogCategory->getCategoryTree();
		$postByMonth = $this->blogPost->getPostByMonth();
        ?>

    </head>
    <body>
	<div class="container">
		<header class="blog-header">
			<nav class="navbar navbar-expand-md navbar-light bg-light skui-hover-menu">
				<a class="navbar-brand" href="<?php echo base_url()?>"><img class="logo" height="28" width="28" src="<?php echo base_url("asset/image/default/logo.png")?>"/> Batayon</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item <?php echo @$home?>">
							<a class="nav-link" href="<?php echo base_url()?>">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item <?php echo @$featured?>">
							<a class="nav-link" href="<?php echo base_url("category/featured")?>">Featured</a>
						</li>
						<li class="nav-item <?php echo @$latest?>">
							<a class="nav-link" href="<?php echo base_url("category/latest")?>">Latest</a>
						</li>
						<li class="nav-item <?php echo @$popular?>">
							<a class="nav-link" href="<?php echo base_url("category/popular")?>">Most Popular</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="https://bootstrapthemes.co" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Others
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li>
									<a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Submenu action</a></li>
										<li><a class="dropdown-item" href="#">Another submenu action</a></li>
										<li><a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Subsubmenu action aa</a></li>
												<li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
											</ul>
										</li>
										<li><a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Subsubmenu action bb</a></li>
												<li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a class="dropdown-item dropdown-toggle" href="#">Submenu 2</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Submenu action 2</a></li>
										<li><a class="dropdown-item" href="#">Another submenu action 2</a></li>
										<li>
											<a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Subsubmenu action 1 3</a></li>
												<li><a class="dropdown-item" href="#">Another subsubmenu action 2 3</a></li>
											</ul>
										</li>
										<li>
											<a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu 3</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Subsubmenu action 3 </a></li>
												<li><a class="dropdown-item" href="#">Another subsubmenu action 3</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<?php echo @$afterHeader; ?>
		<main role="main" id="body">
			<div class="row">
				<aside class="col-md-4 col-lg-3 blog-sidebar">
					<div class="p-3 mb-3 bg-light rounded">
						<h4 class="font-italic">About</h4>
						<p class="mb-0">
							It's a web space for sharing knowledge about different Web technology e.g. Java, Groovy, Grails,
							Spring Boot, JavaScript, Jquery, Web Development, SQL etc and Interesting android hacks.
						</p>
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
							<?php foreach ($postByMonth as $dateTime) {?>
							<li><a href="<?php echo base_url("archive/".$dateTime["year"]."/".$dateTime["month"])?>"><?php echo (date("F",
											strtotime($dateTime["year"]."-".$dateTime["month"]))." ".$dateTime["year"]." [".$dateTime["count"]."]")?></a></li>
							<?php }?>
						</ol>
					</div>

					<div class="p-3">
						<h4 class="font-italic">Contact</h4>
						<ol class="list-unstyled">
							<li><a href="https://github.com/shahin-it" target="_blank">GitHub</a></li>
							<li><a href="https://twitter.com/shahin_it" target="_blank">Twitter</a></li>
							<li><a href="https://facebook.com/shahin31" target="_blank">Facebook</a></li>
							<li><a href="tel: +8801722567008">+8801722567008</a></li>
							<li><a href="mailto: mbstu.shahin@live.com">mbstu.shahin@live.com</a></li>
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
		<p>&copy; 2017-<?php echo date("Y"); ?> <a href="https://twitter.com/shahin_it" target="_blank">SHAHIN KHALED</a>. All rights reserved</p>
		<p><span class="link text-primary" id="back-to-top">Back to top</span></p>
	</footer>
    </body>
</html>
