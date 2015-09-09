<?php require_once('includes/head.php'); ?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
<script type="text/javascript" src="js/dashboard.js"></script><!-- Init plugins only for page -->
</head>

<body>
<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>
<?php require_once('includes/header.php') ?>
<div id="wrapper"> 
<!--Responsive navigation button-->
<div class="resBtn"> <a href="#"><span class="icon16 minia-icon-list-3"></span></a> </div>
<?php require_once('includes/sidebar.php'); ?>
<!--Body content-->
<div id="content" class="clearfix">
<div class="contentwrapper"><!--Content wrapper-->
<div class="heading">
<h3>Master Page</h3>
<ul class="breadcrumb">
  <li>You are here:</li>
  <li> <a href="#" class="tip" title="back to dashboard"> <span class="icon16 icomoon-icon-screen-2"></span> </a> <span class="divider"> <span class="icon16 icomoon-icon-arrow-right-2"></span> </span> </li>
  <li class="active">Master Page</li>
</ul>
</div>
<!-- End .heading--> 
<!--Content Goes Here-->



<!--Content End Here-->
</div>
<!-- End contentwrapper --> 
</div>
<!-- End #content --> 
</div>
<!-- End #wrapper -->
</body>
</html>