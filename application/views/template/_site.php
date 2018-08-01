<!doctype html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8"/>
  <meta name="resource-type" content="document"/>
  <meta name="robots" content="all, index, follow"/>
  <meta name="googlebot" content="all, index, follow"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="<?php echo base_url(); ?>asset/vendor/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/vendor/angular-1.7.2.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/vendor/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/js/app.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/bootstrap-reboot.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/vendor/font-awesome.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css"/>

  <?php
  /** -- Copy from here -- */
  if(!empty($meta))
    foreach($meta as $name=>$content) {
      echo "\n\t\t";
      ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
    }
    echo "\n";

    if(!empty($canonical))
    {
      echo "\n\t\t";
      ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

    }
    echo "\n\t";

    foreach($css as $file) {
      echo "\n\t\t";
      ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";

    foreach($js as $file) {
      echo "\n\t\t";
      ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";

    /** -- to here -- */
    ?>

  </head>
  <body>
    <div class="container">
      <header class="container banner">
        <div id="global-info"></div>
      </header>
      <section id="body" class="row">
        <div class="sidebar col-md-3">
          <form class="bd-search d-flex align-items-center">
            <div class="input-group">
              <input name="searchText" type="text" class="form-control input-search" placeholder="Search....">
              <div class="input-group-append">
                <span class="btn input-group-text"><i class="fa fa-search"></i></span>
              </div>
            </div>
            <button class="btn btn-link d-md-none p-0 ml-3" onclick="$('.navigation').toggle()" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
                <title>Menu</title>
                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
              </svg>
            </button>
          </form>
          <nav class="navigation">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">America</a>
              <a href="#" class="list-group-item list-group-item-action">England</a>
              <a href="#" class="list-group-item list-group-item-action">Bangladesh</a>
              <a href="#" class="list-group-item list-group-item-action">Australia</a>
              <a href="#" class="list-group-item list-group-item-action disabled">Rusia</a>
            </div>
          </nav>
        </div>
        <article class="col-md-9 sidebar">
          <?php echo $output;?>
        </article>
      </section>
      <footer class="container">
        <div class="row">
          <div class="col-sm-8">
            <a href="#!">Terms of Service</a> | <a href="#!">Privacy</a>    
          </div>
          <div class="col-sm-4">
            <p>© 2013 Company Name. All rights reserved</p>
          </div>
        </div>
      </footer>
    </div>
  </body>
  </html>