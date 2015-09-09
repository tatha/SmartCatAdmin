<?php
/*
************************************************
** Page Name     : db.class.php
** Page Author   : Tathagata Basu
** Created On    : 11/11/2014
************************************************
** This page contain class to connect database
************************************************
*/

/*
	MySQLi Database class
*/
require_once('config.php.inc');
class db {
	
	var $conn;
	
	function __construct() {
		session_start();
	}
	
	function con_db() {
		$this->conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		if($this->conn->connect_errno) {
			echo "Database Connectivity Error : ".str_replace(DB_USER, '********', $this->conn->connect_error);
			exit();
		} else {
			return $this->conn;
		}
	}
	
	function RealEscape($data) {
		if(is_array($data)) {
			foreach($data as $key=>$val)
			{
				if(is_array($data[$key])) {
					$data[$key] = $this->RealEscape($data[$key]);
				} else {
					$data[$key] = $this->conn->real_escape_string(trim($val));
				}
			}
		} else {
			$data = $this->conn->real_escape_string(trim($data));
		}
		return $data;
	}
	
}
?>