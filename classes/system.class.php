<?php
/*
************************************************
** Page Name     : system.class.php
** Page Author   : Tathagata Basu
** Created On    : 12/11/2014
************************************************
*/
require_once('db.class.php');
class system extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	function FetchMenu($parentMenuId) {
		return $this->db->query("SELECT m.m_id, m.m_name, m.m_url, m.m_icon, m.m_parent_id, m.m_position, m.m_submenu, m.m_status, m.m_display FROM ".DB_PREFIX."_menu AS m WHERE m.m_parent_id = ".$parentMenuId." ORDER BY m.m_position ASC");
	}
	function GetCurrMenu($m_url) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_menu WHERE m_url = '".$m_url."'")->fetch_assoc();
	}
	function SaveMenuPermByRole($r_id, $view) {
		$r_id = $this->RealEscape($r_id);
		$view = $this->RealEscape($view);
		$resMenu = $this->db->query("SELECT * FROM ".DB_PREFIX."_menu");
		while($arrMenu = $resMenu->fetch_assoc()) {
			$resPerm = $this->db->query("SELECT * FROM ".DB_PREFIX."_menu_perm WHERE mp_roleid = '".$r_id."' AND mp_menuid = '".$arrMenu['m_id']."'");
			if($view[$arrMenu['m_id']]==1) { $v = 1; } else { $v = 0; }
			if($resPerm->num_rows == 0) {
				//Insert
				$this->db->query("INSERT INTO ".DB_PREFIX."_menu_perm(mp_roleid, mp_menuid, mp_view, mp_update_by, mp_update_on, mp_update_from) VALUES('".$r_id."', '".$arrMenu['m_id']."', '".$v."', '".$_SESSION[DB_PREFIX]['u_id']."', '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."')");
			} else {
				//Update
				$this->db->query("UPDATE ".DB_PREFIX."_menu_perm SET mp_view = '".$v."', mp_update_by = '".$_SESSION[DB_PREFIX]['u_id']."', mp_update_on = '".date('Y-m-d H:i:s')."', mp_update_from = '".$_SERVER['REMOTE_ADDR']."' WHERE mp_roleid = '".$r_id."' AND mp_menuid = '".$arrMenu['m_id']."'");
			}
		}
	}
	function FetchMenuByRole($r_id, $parentMenuId = '%') {
		return $this->db->query("SELECT m.m_id, m.m_name, m.m_url, m.m_icon, m.m_parent_id, m.m_position, m.m_submenu, m.m_status, m.m_display, mp.mp_view FROM ".DB_PREFIX."_menu AS m LEFT JOIN ".DB_PREFIX."_menu_perm AS mp ON m.m_id = mp.mp_menuid WHERE mp.mp_roleid = ".$r_id." AND m.m_parent_id LIKE '".$parentMenuId."' ORDER BY m.m_position ASC");
	}
	function GetMenuPerm($r_id) {
		$resPerm = $this->FetchMenuByRole($r_id);
		$arrMP = array();
		while($arrPerm = $resPerm->fetch_assoc()) {
			$arrMP[$arrPerm['m_id']] = $arrPerm['mp_view'];
		}
		return $arrMP;
	}
	function CheckProfileCreation() {
		if($this->db->query("SELECT up_id FROM ".DB_PREFIX."_user_profile WHERE up_u_id = '".$_SESSION[DB_PREFIX]['u_id']."'")->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	/****************************************** Supporting Function ******************************************/
	/*
		Beautify Date display
	*/
	function BeautifyDateDisplay($date) {
		if($date <> NULL_DATE && $date <> '') {
			$dateStr = date('jS F Y', strtotime($date));
		} else {
			$dateStr = "";
		}
		return $dateStr;
	}
	function BeautifyDateDisplaySmall($date) {
		if($date <> NULL_DATE && $date <> '') {
			$dateStr = date('jS M Y', strtotime($date));
		} else {
			$dateStr = "";
		}
		return $dateStr;
	}
	function BeautifyDateDisplaySmallAll($date) {
		if($date <> NULL_DATE && $date <> '') {
			$dateStr = date('jS M\'y', strtotime($date));
		} else {
			$dateStr = "";
		}
		return $dateStr;
	}
	function BeautifyDateDisplayFull($date) {
		if($date <> NULL_DATE && $date <> '') {
			$dateStr = date('jS F,Y h:i A', strtotime($date));
		} else {
			$dateStr = "";
		}
		return $dateStr;
	}
	/**
	Convert dd/mm/yyyy to yyyy-mm-dd
	*/
	function ConvertDateToMySQLFormat($date) {
		$dateSplit = explode('/', $date);
		$date = $dateSplit[2].'-'.$dateSplit[1].'-'.$dateSplit[0];
		return $date;
	}
	function BeautifyAmount($price) {
		if($price==''||$price=='0') { return $price; }
		$a = explode('.', (string)$price);
		$a[1] = str_pad($a[1],2,'0',STR_PAD_RIGHT);
		return $a[0].'.'.$a[1];
	}
	function BeautifyNegetiveAmount($price) {
		$price = $this->BeautifyAmount($price);
		return str_replace('-','- ',$price);
	}
	/*
		Function to generate rad string
	*/
	function GenRand($strsize) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str = '';
		for( $j = 0; $j < $strsize; $j++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}
	/*
		Function to encrypt string
	*/
	function MyEncrypt($str) {
		$enc = '';
		for($i=0;$i<strlen($str);$i++) {
			$enc .= dechex(ord($str[$i])+19);
		}
		return $enc;
	}
	/*
		Function to decrypt string
	*/
	function MyDecrypt($str) {
		$dec = '';
		for($i=0;$i<strlen($str)-1;$i=$i+2) {
			$dec .= chr(hexdec($str[$i].$str[$i+1])-19);
		}
		return $dec;
	}
	/*
		Function simmiler to json encode
	*/
	function myjson_encode($a) {
		$str = '';
		$str .= '{';
		foreach($a as $key=>$val)
		{
		$str .= '"'.$key.'"'.':'.'"'.$val.'",';
		}
		$str = substr($str, 0, -1);
		$str .= '}';
		return $str;
	}
	/*
		Function similer to json decode
	*/
	function myjson_decode($str) {
		$b = array();
		$c = array();
		$str = substr($str, 1, -1);
		$c = split(',',$str);
		foreach($c as $key=>$val) {
		$d = array();
		$d = split(':',$val);
		$a[substr($d[0], 1, -1)] = substr($d[1], 1, -1);
		}
		return $a;
	}
	/*
		Function simmiler to json encode version 2
	*/
	function is_assoc($var) {
	   if(count(array_diff_key($var,array_keys($var)))) {
		 return false;
	   } else {
		 return true;
	   }
	}
	function str_encode($arr) {
		if($this->is_assoc($arr)) {
			$str = '';
			$str .= '[';
			foreach($arr as $val) {
				if(is_array($val)) {
					$str .= $this->str_encode($val).',';
				} else {
					$str .= '"'.$val.'",';
				}
			}
			if(substr($str, -1)<>'[') { $str = substr($str, 0, -1); }
			$str .= ']';
		} else {
			$str = '';
			$str .= '{';
			foreach($arr as $key=>$val) {
				if(is_array($val)) {
					$str .= '"'.$key.'"'.':'.$this->str_encode($val).',';
				} else {
					$str .= '"'.$key.'"'.':'.'"'.$val.'",';
				}
			}
			if(substr($str, -1)<>'{') { $str = substr($str, 0, -1); }
			$str .= '}';
			}
		return $str;
	}
	/**
	 * A temporary method of generating GUIDs of the correct format for DB.
	 * @return String contianing a GUID in the format: aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee
	 *
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
	 * All Rights Reserved.
	 * Contributor(s): ______________________________________..
	 */
	function create_guid()
	{
		$microTime = microtime();
		list($a_dec, $a_sec) = explode(" ", $microTime);
		$dec_hex = dechex($a_dec* 1000000);
		$sec_hex = dechex($a_sec);
		$this->ensure_length($dec_hex, 5);
		$this->ensure_length($sec_hex, 6);
		$guid = "";
		$guid .= $dec_hex;
		$guid .= $this->create_guid_section(3);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $sec_hex;
		$guid .= $this->create_guid_section(6);
		return $guid;
	}
	function create_guid_section($characters)
	{
		$return = "";
		for($i=0; $i<$characters; $i++)
		{
			$return .= dechex(mt_rand(0,15));
		}
		return $return;
	}
	function ensure_length(&$string, $length)
	{
		$strlen = strlen($string);
		if($strlen < $length)
		{
			$string = str_pad($string,$length,"0");
		}
		else if($strlen > $length)
		{
			$string = substr($string, 0, $length);
		}
	}
	function microtime_diff($a, $b) {
		list($a_dec, $a_sec) = explode(" ", $a);
		list($b_dec, $b_sec) = explode(" ", $b);
		return $b_sec - $a_sec + $b_dec - $a_dec;
	}
	/**
	 * End of block
	 * A temporary method of generating GUIDs of the correct format for DB.
	 * @return String contianing a GUID in the format: aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee
	 *
	 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
	 * All Rights Reserved.
	 * Contributor(s): ______________________________________..
	 */
}
?>