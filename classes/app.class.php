<?php
/*
************************************************
** Page Name     : app.class.php
** Page Author   : Tathagata Basu
** Created On    : 21/11/2017
************************************************
*/
require_once('db.class.php');
class app extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}

	# Lets write some codes... 
	
}
?>