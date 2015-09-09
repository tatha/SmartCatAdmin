<?php
$curPage = substr(trim(basename($_SERVER['PHP_SELF'])),0,-4);
/*if($curPage<>'login') {
	//all page except login
	if(!isset($_SESSION[DB_PREFIX]['u_id'])) {
		//if session is not saved
		header("Location:login.html");
	}
} else {
	//signin page
	if(isset($_SESSION[DB_PREFIX]['u_id'])) {
		//if session is set
		header("Location:dashboard.html");
	}
}*/
switch($curPage) {
	case 'login':
	case 'register':
	case 'confirm':
	case 'check-username': {
		//signin page
		if(isset($_SESSION[DB_PREFIX]['u_id'])) {
			//if session is set
			header("Location:dashboard.html");
		}
		break;
	}
	default: {
		//all page except public pages
		if(!isset($_SESSION[DB_PREFIX]['u_id'])) {
			//if session is not saved
			header("Location:login.html");
		} else {
			/*if($_SESSION[DB_PREFIX]['r_id']=='3'||$_SESSION[DB_PREFIX]['r_id']=='4') {
				if(!$instSys->CheckProfileCreation()) {
					if($curPage<>'profile') {
						header("Location:profile.html");
					}
				}
			}*/
		}
	}
}
?>