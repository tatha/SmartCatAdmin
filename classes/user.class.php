<?php
/*
************************************************
** Page Name     : user.class.php
** Page Author   : Tathagata Basu
** Created On    : 12/11/2014
************************************************
*/
require_once('db.class.php');
class user extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	function FetchUser($status) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_fname, u.u_lname, u.u_email, u.u_contact, u.u_role, r.r_name, u.u_status, r.r_status FROM ".DB_PREFIX."_users AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id  WHERE u.u_status LIKE '".$status."' AND r.r_status LIKE '".$status."' ORDER BY u.u_role ASC");
	}
	function FetchUserByRole($r_id, $status) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_fname, u.u_lname, u.u_email, u.u_contact, u.u_role, r.r_name, u.u_status, r.r_status FROM ".DB_PREFIX."_users AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id  WHERE u.u_status LIKE '".$status."' AND r.r_status LIKE '".$status."' AND u.u_role LIKE '".$r_id."' ORDER BY u.u_role ASC");
	}
	function GetUserDetail($u_id) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE u_id = '".$u_id."'")->fetch_assoc();
	}
	function GetUserProfile($u_id) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_fname, u.u_lname, u.u_email, u.u_contact, u.u_role, r.r_name FROM ".DB_PREFIX."_users AS u LEFT JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id WHERE u.u_id = '".$u_id."'")->fetch_assoc();
	}
	function GetUserDisplayName($u_id) {
		$arrUSer = $this->GetUserDetail($u_id);
		return $arrUSer['u_fname'].' '.$arrUSer['u_lname'];
	}
	function FetchRole($status) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_role WHERE r_status LIKE '".$status."'");
	}
	function SaveUser($data) {
		if($data['u_id']=='') {
			if($this->db->query("INSERT INTO ".DB_PREFIX."_users(u_id, u_username, u_fname, u_lname, u_email, u_contact, u_password, u_role, u_secret, u_status, u_update_by, u_update_on, u_update_from) VALUES('', '".$data['u_username']."', '".$data['u_fname']."', '".$data['u_lname']."', '".$data['u_email']."', '".$data['u_contact']."', '".md5($data['u_username'])."', '".$data['u_role']."', '', '', '".$_SESSION[DB_PREFIX]['u_id']."', '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."')")) {
				return 1;
			} else {
				return 0;
			}
		} else {
			if($this->db->query("UPDATE ".DB_PREFIX."_users SET u_fname = '".$data['u_fname']."', u_lname = '".$data['u_lname']."', u_email = '".$data['u_email']."', u_contact = '".$data['u_contact']."', u_role = '".$data['u_role']."', u_status = '".$data['u_status']."', u_update_by = '".$_SESSION[DB_PREFIX]['u_id']."', u_update_on = '".date('Y-m-d H:i:s')."', u_update_from = '".$_SERVER['REMOTE_ADDR']."' WHERE u_id = '".$data['u_id']."'")) {
				return 1;
			} else {
				return 0;
			}
		}
	}
	function SaveProfile($data) {
		$data = $this->RealEscape($data);
		if($this->db->query("UPDATE ".DB_PREFIX."_users SET u_fname = '".$data['u_fname']."', u_lname = '".$data['u_lname']."', u_email = '".$data['u_email']."', u_contact = '".$data['u_contact']."', u_update_by = '".$_SESSION[DB_PREFIX]['u_id']."', u_update_on = '".date('Y-m-d H:i:s')."', u_update_from = '".$_SERVER['REMOTE_ADDR']."' WHERE u_id = '".$data['u_id']."'")) {
			return 1;
		} else {
			return 0;
		}
	}
	/*
	Change Password
	=============================
	Param : u_id, oldPassword, newPassword, newPassword2
	Return :
		0 =>	Failure
		1 =>	Success
		2 =>	Old Password Mismatch
		3 =>	Confirm Password Mismatch
	*/
	function SavePassword($data) {
		$data = $this->RealEscape($data);
		$arrUser = $this->GetUserDetail($data['u_id']);
		if(md5($data['oldPassword'])==$arrUser['u_password']) {
			if($data['newPassword']==$data['newPassword2']) {
				if($this->db->query("UPDATE ".DB_PREFIX."_users SET u_password = '".md5($data['newPassword'])."' WHERE u_id= '".$data['u_id']."'")) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 3;
			}
		} else {
			return 2;
		}
	}
	function ResetUserPassword($u_id) {
		$passwd = $this->GenRand(10);
		if($this->db->query("UPDATE ".DB_PREFIX."_users SET u_password = '".md5($passwd)."' WHERE u_id = '".$u_id."'")) {
			$arrMailTo = array();
			$resAdmin = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE u_role = '1'");
			while($arrAdmin = $resAdmin->fetch_assoc()) {
				array_push($arrMailTo, $arrAdmin['u_email']);
			}
			$userData = $this->GetUserDetail($u_id);
			array_push($arrMailTo, $userData['u_email']);
			$mailTo = implode(',',$arrMailTo);
			$mailFrom = 'The SmartCat <india.smartcat@gmail.com>';
			$name = $userData['u_fname'].' '.$userData['u_lname'];
			$username = $userData['u_username'];
			$password = $passwd;
			$html =
<<<EOD
Hello $name,
<br>
Your account password reset was complete. Your new login details as follows.<br>
<table border="0">
  <tr>
	<td>Username</td>
	<td>:</td>
	<td>$username</td>
  </tr>
  <tr>
	<td>Password</td>
	<td>:</td>
	<td>$password</td>
  </tr>
</table>
<br>
<br>
Admin
EOD;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			@mail($mailTo, $mailFrom, $html, $headers);
			return 1;
		} else {
			return 0;
		}
	}
	function GenRand($strsize) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str = '';
		for( $j = 0; $j < $strsize; $j++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
}
?>