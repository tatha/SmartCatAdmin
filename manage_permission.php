<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
$instUser = new user;
$resRole = $instUser->FetchRole('A');
if(isset($_REQUEST['r_id'])&&$_REQUEST['r_id']<>'') {
	$flag = $instSys->SaveMenuPermByRole($_REQUEST['r_id'], $_REQUEST['view']);
}
?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
<script type="text/javascript" src="js/manage_permission.js"></script><!-- Init plugins only for page -->
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
<h3>Permission Management</h3>
<ul class="breadcrumb">
  <li>You are here:</li>
  <li> <a href="#" class="tip" title="back to dashboard"> <span class="icon16 icomoon-icon-screen-2"></span> </a> <span class="divider"> <span class="icon16 icomoon-icon-arrow-right-2"></span> </span> </li>
  <li class="active">Permission Management</li>
</ul>
</div>
<!-- End .heading--> 
<!--Content Goes Here-->

<div class="row-fluid">
<div class="box">
  <div class="title">
    <h4 class="clearfix"> <span class="left">Board List</span></h4>
    <a href="#" class="minimize" style="display: none;">Minimize</a> 
  </div>
  <div class="content noPad">
    <div style="padding:20px 0px 0px 20px;">
    <span>Select Role : </span>
      <select name="role" id="role">
      	<option value="">Select</option>
      	<?php
		while($arrRole = $resRole->fetch_assoc()) {
		?>
      	<option value="<?=$arrRole['r_id']?>" <?php if($_REQUEST['role']==$arrRole['r_id']) { ?>selected<?php } ?>><?=$arrRole['r_name']?></option>
        <?php
		}
		?>
      </select>
    </div>
    <?php
	if(isset($_REQUEST['role'])&&$_REQUEST['role']<>'') {
		$arrMenuPerm = $instSys->GetMenuPerm($_REQUEST['role']);
	?>
    <form name="permForm" id="permForm" action="" method="post">
    <input type="hidden" name="r_id" id="r_id" value="<?=$_REQUEST['role']?>">
    <table class="table table-bordered responsive" id="boardList">
    <thead>
      <tr>
        <th>Menu Name</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$resMainMenu = $instSys->FetchMenu(0);
	while($arrMainMenu = $resMainMenu->fetch_assoc()) {
	?>
      <tr>
        <td><strong><?=$arrMainMenu['m_name']?></strong></td>
        <td>
		<input type="checkbox" name="view[<?=$arrMainMenu['m_id']?>]" id="view_<?=$arrMainMenu['m_id']?>" value="1" <?php if($arrMenuPerm[$arrMainMenu['m_id']]==1) { ?>checked<?php } ?>>
        </td>
      </tr>
    <?php
		if($arrMainMenu['m_submenu']==1) {
			$resSubMenu = $instSys->FetchMenu($arrMainMenu['m_id']);
			while($arrSubMenu = $resSubMenu->fetch_assoc()) {
	?>
      <tr>
        <td><?=$arrSubMenu['m_name']?></td>
        <td>
		<input type="checkbox" name="view[<?=$arrSubMenu['m_id']?>]" id="view_<?=$arrSubMenu['m_id']?>" value="1" <?php if($arrMenuPerm[$arrSubMenu['m_id']]==1) { ?>checked<?php } ?>>
        </td>
      </tr>
    <?php
			}
		}
	}
	?>
    </tbody>
    </table>
    <div style="padding:10px;">
    <input type="button" class="btn btn-primary" name="saveBtn" id="saveBtn" value="Save">
    </div>
    </form>
    <?php
	}
	?>
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