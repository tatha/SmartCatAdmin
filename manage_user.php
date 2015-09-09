<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
$instUser = new user;
$resUser = $instUser->FetchUser('%');
?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
<script type="text/javascript" src="js/manage_user.js"></script><!-- Init plugins only for page -->
</head>

<body>
<!--loading animation -->
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
<h3>User Management</h3>
<ul class="breadcrumb">
  <li>You are here:</li>
  <li> <a href="#" class="tip" title="back to dashboard"> <span class="icon16 icomoon-icon-screen-2"></span> </a> <span class="divider"> <span class="icon16 icomoon-icon-arrow-right-2"></span> </span> </li>
  <li class="active">User Management</li>
</ul>
</div>
<!-- End .heading--> 
<!--Content Goes Here-->

<div class="row-fluid">
<div class="box">
  <div class="title">
    <h4 class="clearfix"> <span class="left">User List</span>
    <div class="rightBox">
      <input type="button" class="btn btn-primary btn-mini" id="addBtn" value="Add New">
    </div>
    </h4>
    <a href="#" class="minimize" style="display: none;">Minimize</a> </div>
  <div class="content noPad">
    <table class="table table-bordered responsive" id="userList">
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$i=1;
	while($arrUser = $resUser->fetch_assoc()) {
		if($arrUser['u_role']<>1) {
	?>
      <tr>
        <td><?=$i++?></td>
        <td><?=$arrUser['u_username']?></td>
        <td><?=$arrUser['u_fname'].' '.$arrUser['u_lname']?></td>
        <td><?=$arrUser['u_email']?></td>
        <td><?=$arrUser['u_contact']?></td>
        <td><?=$arrUser['r_name']?></td>
        <td>
        <span class="label label-<?=$arrUser['u_status']=='A'?'success':'important'?>">
        <?=$arrUser['u_status']=='A'?'Active':'Inactive'?>
        </span>
        </td>
        <td>
        <div class="controls center">
        <a href="javascript:void(0)" class="tip actnLink" id="edit_<?=$arrUser['u_id']?>" oldtitle="Settings task" title="" data-hasqtip="true">
        	<span class="icon12 icomoon-icon-pencil"></span>
        </a>
        <a href="javascript:void(0)" class="tip actnLink" id="passwd_<?=$arrUser['u_id']?>" oldtitle="PasswdRst task" title="" data-hasqtip="true">
        	<span class="icon12 icomoon-icon-switch"></span>
        </a>
        </div>
        </td>
      </tr>
	<?php
    	}
	}
	?>
    </tbody>
    </table>
  </div>
</div>
</div>

<!--Content End Here-->
</div>
<!-- End contentwrapper --> 
</div>
<!-- End #content --> 
</div>
<!-- End #wrapper -->
</body>
</html>