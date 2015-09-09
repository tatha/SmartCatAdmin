<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
$instUser = new user;
//////////////////////////////////////////////////////////
if(isset($_REQUEST['key'])&&$_REQUEST['key']=='editProfile') {
	$flag = $instUser->SaveProfile($_REQUEST);
}
//////////////////////////////////////////////////////////
$arrProfile = $instUser->GetUserProfile($_SESSION[DB_PREFIX]['u_id']);
?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
<script type="text/javascript" src="js/profile.js"></script><!-- Init plugins only for page -->
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
<h3>Profile</h3>
<ul class="breadcrumb">
  <li>You are here:</li>
  <li> <a href="#" class="tip" title="back to dashboard"> <span class="icon16 icomoon-icon-screen-2"></span> </a> <span class="divider"> <span class="icon16 icomoon-icon-arrow-right-2"></span> </span> </li>
  <li class="active">Profile</li>
</ul>
</div>
<!-- End .heading--> 
<!--Content Goes Here-->

<div class="row-fluid">
<div class="box">
  <div class="title">
    <h4 class="clearfix"> <span class="left">Edit Profile</span></h4>
    <a href="#" class="minimize" style="display: none;">Minimize</a> </div>
  <div class="content">
    <form class="box" name="editProfile" id="editProfile" action="" method="post">
    <input type="hidden" name="key" value="editProfile">
    <input type="hidden" name="u_id" value="<?=$arrProfile['u_id']?>">
	<table class="table table-bordered left">
    <thead>
      <tr>
      	<th colspan="2">Basic Information</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Username</td>
        <td>
          <input type="text" name="u_username" id="u_username" value="<?=$arrProfile['u_username']?>" readonly>
        </td>
      </tr>
      <tr>
        <td>First Name</td>
        <td>
          <input type="text" name="u_fname" id="u_fname" value="<?=$arrProfile['u_fname']?>">
        </td>
      </tr>
      <tr>
        <td>Last Name</td>
        <td>
          <input type="text" name="u_lname" id="u_lname" value="<?=$arrProfile['u_lname']?>">
        </td>
      </tr>
      <tr>
        <td>Email ID</td>
        <td>
          <input type="text" name="u_email" id="u_email" value="<?=$arrProfile['u_email']?>">
        </td>
      </tr>
      <tr>
        <td>Contact Number</td>
        <td>
          <input type="text" name="u_contact" id="u_contact" value="<?=$arrProfile['u_contact']?>">
        </td>
      </tr>
      <tr>
        <td>Role</td>
        <td>
          <input type="hidden" name="u_role" id="u_role" value="<?=$arrProfile['u_role']?>">
          <input type="text" name="r_name" id="r_name" value="<?=$arrProfile['r_name']?>" readonly>
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
    <div class="clearfix"></div>
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