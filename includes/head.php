<?php
session_start();
require_once('classes/config.php.inc');
require_once('classes/system.class.php');
$instSys = new system;
require_once('classes/auth.class.php');
$instAuth = new auth;
require_once('includes/page_security.php');
?>