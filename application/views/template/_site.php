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
                baseUrl: '<?php echo base_url() ?>',
				maxResult: 10,
            };
        </script>
        
        <link rel="icon" href="<?php echo base_url(); ?>asset/image/sys/favicon.png">
        <script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>asset/vendor/jquery.form.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>asset/vendor/angular-1.7.2.min.js"></script> -->
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
        <header class="banner d-print-none">
            <div id="global-info"></div>
        </header>
        <section id="body" class="container-fluid">
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
								<?php foreach ($categories as $category) {?>
									<li class="nav-item clearfix">
										<a class="" href="<?php echo base_url("category/".$category['id'])?>"><?php echo($category['name']);?></a>
										<a class="skui-accordion-label badge badge-light float-right" href="#"><i class="fas fa-arrow-circle-down"></i></a>
										<ul class="skui-accordion-item">
											<?php foreach ($category["child"] as $cat) {?>
												<li class="nav-item"><a href="<?php echo base_url("category/".$cat['id'])?>" class="skui-accordion-label"><?php echo($cat['name']);?></a></li>
											<?php }?>
										</ul>
									</li>
								<?php }?>
							</ul>
						</div>
                    </nav>
                </div>
                <article class="sidebar col-md-9 col-lg-10">
                    <?php echo $output; ?>
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
        </footer>
    </body>
</html>
