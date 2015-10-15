<?php
require_once('classes/user.class.php');
$instUser = new user;
///////////////////////////////////////////////////
$data = $instUser->RealEscape($_REQUEST);
///////////////////////////////////////////////////
switch($data['action']) {
	case 'openModal':{
		$arrUser = $instUser->GetUserDetail($data['u_id']);
		$resRole = $instUser->FetchRole('A');
?>
<div>
<style>
#messageBox li {
	margin:0;
}
#messageBox li label.error {
	margin:0;
}
.alert {
	padding:0px;
	border:none;
}
</style>
<div class="alert alert-error" id="messageBox"></div>
<form name="userForm" id="userForm" action="" method="post">
<input type="hidden" name="action" id="action" value="saveUser">
<input type="hidden" name="u_id" id="u_id" value="<?=$arrUser['u_id']?>">
<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top;"><strong>Username</strong><span class="required">*</span></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_username" id="u_username" value="<?=$arrUser['u_username']?>" placeholder="Username" <?php if($arrUser['u_id']<>'') { ?>readonly<?php } ?>>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Name</strong><span class="required">*</span></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_fname" id="u_fname" value="<?=$arrUser['u_fname']?>" placeholder="First Name">
    <input type="text" name="u_lname" id="u_lname" value="<?=$arrUser['u_lname']?>" placeholder="Last Name">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Email ID</strong><span class="required">*</span></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_email" id="u_email" value="<?=$arrUser['u_email']?>" placeholder="E-mail">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Password</strong><?php if($arrUser['u_id']=='') { ?><span class="required">*</span><?php } ?></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="password" name="u_password" id="u_password" value="" placeholder="New Password">
    <input type="password" name="u_password_2" id="u_password_2" value="" placeholder="Confirm New Password">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong></strong></td>
    <td style="vertical-align:top;"><strong></strong></td>
    <td colspan="4">
    <input type="button" class="btn btn-small" name="genRandBtn" id="genRandBtn" value="Generate Random Password">
    <span id="randString"></span>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Role</strong><span class="required">*</span></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <select name="u_role" id="u_role">
    	<option value="">Select Role</option>
        <?php
		while($arrRole = $resRole->fetch_assoc()) {
			if($arrRole['r_id']=='1') { continue; }
		?>
    	<option value="<?=$arrRole['r_id']?>" <?=$arrUser['u_role']==$arrRole['r_id']?'selected':''?>><?=$arrRole['r_name']?></option>
        <?php
		}
		?>
    </select>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Status</strong><span class="required">*</span></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="radio" name="u_status" id="u_status" value="A" <?php if($arrUser['u_status']=='A'||$arrUser['u_status']=='') { ?>checked<?php } ?>> Active
    <input type="radio" name="u_status" id="u_status" value="D" <?php if($arrUser['u_status']=='D') { ?>checked<?php } ?>> Inactive
    </td>
  </tr>
  <tr>
    <td colspan="7" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center">
    <input type="button" class="btn btn-primary" name="saveBtn" id="saveBtn" value="Save">
    <input type="button" class="btn" name="cancelBtn" id="cancelBtn" value="Cancel">
    </td>
  </tr>
</table>
</form>
</div>
<?php	
		break;
	}
	case 'saveUser': {
		echo $instUser->SaveUser($data);
		break;
	}
	case 'deleteUser': {
		echo $instUser->DeleteUser($data['u_id']);
		break;
	}
	case 'resetUserPassword': {
		echo $instUser->ResetUserPassword($data['u_id']);
		break;
	}
	case 'unlockUser': {
		echo $instUser->UnlockUser($data['u_id']);
		break;
	}
	default: {
		
	}
}
?>