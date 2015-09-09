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
<div style="width:700px">
<form name="userForm" id="userForm" action="" method="post">
<input type="hidden" name="action" id="action" value="saveUser">
<input type="hidden" name="u_id" id="u_id" value="<?=$arrUser['u_id']?>">
<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top;"><strong>Username</strong></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_username" id="u_username" value="<?=$arrUser['u_username']?>" <?php if($arrUser['u_id']<>'') { ?>readonly<?php } ?>>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Name</strong></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_fname" id="u_fname" value="<?=$arrUser['u_fname']?>">
    <input type="text" name="u_lname" id="u_lname" value="<?=$arrUser['u_lname']?>">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Email ID</strong></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_email" id="u_email" value="<?=$arrUser['u_email']?>">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Contact</strong></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="text" name="u_contact" id="u_contact" value="<?=$arrUser['u_contact']?>">
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><strong>Role</strong></td>
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
    <td style="vertical-align:top;"><strong>Status</strong></td>
    <td style="vertical-align:top;"><strong>:</strong></td>
    <td colspan="4">
    <input type="radio" name="u_status" id="u_status" value="A" <?php if($arrUser['u_status']=='A') { ?>checked<?php } ?>> Active
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
	case 'resetUserPassword': {
		echo $instUser->ResetUserPassword($data['u_id']);
		break;
	}
	default: {
		
	}
}
?>