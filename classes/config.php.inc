<?php
/*
************************************************
** Page Name     : config.php.inc
** Page Author   : Tathagata Basu
** Created On    : 10/01/2013
** Modified By   : 
** Modified On   : 
************************************************
** This is a configuration page of SmartCat
************************************************
*/

//DB Credencials

define('HOSTNAME','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DBNAME','supr_admin');

//max number of failed password in loging
define('MAX_FAILED_PASSWD','5');

//session time out in sec
define('MAX_INACTIVE_TIME','36000');
define('MAX_INACTIVE_TIME_SU','36000');

//Data directory Root
define('APP_ROOT', 'http://'.$_SERVER['SERVER_NAME'].'/supr_admin_mods/');
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'].'/supr_admin_mods/');

//PREFIX
define('DB_PREFIX', 'sa');

//Date Variable
define('NULL_DATE', '0000-00-00 00:00:00');

?>