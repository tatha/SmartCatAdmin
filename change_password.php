<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
$instUser = new user;
//////////////////////////////////////////////////////////
if(isset($_REQUEST['key'])&&$_REQUEST['key']=='changePasswd') {
	$flag = $instUser->SavePassword($_REQUEST);
}
//////////////////////////////////////////////////////////
$arrProfile = $instUser->GetUserProfile($_SESSION[DB_PREFIX]['u_id']);
?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
<script type="text/javascript" src="js/change_password.js"></script><!-- Init plugins only for page -->
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
<h3>Change Password</h3>
<ul class="breadcrumb">
  <li>You are here:</li>
  <li> <a href="#" class="tip" title="back to dashboard"> <span class="icon16 icomoon-icon-screen-2"></span> </a> <span class="divider"> <span class="icon16 icomoon-icon-arrow-right-2"></span> </span> </li>
  <li class="active">Change Password</li>
</ul>
</div>
<!-- End .heading--> 
<!--Content Goes Here-->
<div class="row-fluid">
<?php
if(isset($flag)) {
	switch($flag) {
		case '0': {
			$msg = "Failed to change the password at this moment. Please try again.";
			break;
		}
		case '1': {
			$msg = "Your password has been changed successfully..";
			break;
		}
		case '2': {
			$msg = "Your old password didn't match. Please try again.";
			break;
		}
		case '3': {
			$msg = "Please provide new password as confirm password.";
			break;
		}
		default: {
			$msg = "Unexpected error occured. Please try again.";
		}
	}
?>
<div class="alert alert-<?=$flag==1?'success':'error'?>">
<?=$msg?>
</div>
<?php
}
?>
<form class="box" name="changePasswd" id="changePasswd" action="" method="post">
<input type="hidden" name="key" value="changePasswd">
<input type="hidden" name="u_id" value="<?=$arrProfile['u_id']?>">
<table class="table table-bordered left">
<thead>
  <tr>
    <th colspan="2">Basic Information</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td width="30%">Old Password</td>
    <td>
      <input type="password" name="oldPassword" id="oldPassword" value="">
    </td>
  </tr>
  <tr>
    <td>New Password</td>
    <td>
      <input type="password" name="newPassword" id="newPassword" value="">
    </td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td>
      <input type="password" name="newPassword2" id="newPassword2" value="">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <input type="button" class="btn btn-primary" name="saveBtn" id="saveBtn" value="Save">
    </td>
  </tr>
</tbody>
</table>
</form>
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