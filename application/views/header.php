<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RMC - Userman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RMC User Manager Application">
    <meta name="author" content="Andrew Niemantsverdriet">

    <!-- Le styles -->
    <link href="<?=base_url('static/css/bootstrap.css')?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="<?=base_url('/static/css/bootstrap-responsive.css')?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons
    <link rel="shortcut icon" href="/static/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/static/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/static/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/static/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/static/ico/apple-touch-icon-57-precomposed.png">
    -->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand">Userman</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php if($this->session->userdata('key') != -1) : ?>
                <a href="<?=site_url('/welcome/logout')?>">Log Out</a>
              <?php else : ?>
                Not Logged In
              <?php endif; ?>
            </p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
