<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
        ?>

    </head>
    <body>
        <div class="container">
            <header class="blog-header">
                <?php $this->load->view("widget/navigationWidget"); ?>
            </header>
            <?php echo @$afterHeader; ?>
            <main role="main" id="body">
                <div class="row">
                    <aside id="navbarNavDropdown" class="col-md-4 col-lg-3 blog-sidebar collapse d-md-block d-lg-block">
                        <?php $this->load->view("widget/categoryWidget"); ?>
                        <?php $this->load->view("widget/archiveWidget"); ?>
                    </aside><!-- /.blog-sidebar -->
                    <div class="col-md-8 col-lg-9 blog-main">
                        <?php echo $output; ?>
                    </div><!-- /.blog-main -->

                </div><!-- /.row -->

            </main>
        </div>

        <footer class="blog-footer bg-dark">
            <div class="footer-nav row mx-auto">
                <div class="col-sm-4">
                    <?php /*$this->load->view("widget/addressWidget"); */?>
                    <div class="widget">
                        <h4 class="widget-title">Important Links</h4>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php $this->load->view("widget/addressWidget"); ?>
                </div>
                <div class="col-sm-4">
                    <?php $this->load->view("widget/aboutWidget"); ?>
                </div>
            </div>
            <div class="footer-note">
                <span>&copy; 2017-<?php echo date("Y"); ?> <a href="https://shahinkhaled.000webhostapp.com" target="_blank">SHAHIN KHALED</a>. All rights reserved</span>
                <span id="top-link" class="link float-md-right text-primary fas fa-arrow-up" title="Back to Top">Top</span>
            </div>
        </footer>
    </body>
</html>
