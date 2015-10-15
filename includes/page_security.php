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
	case 'logout':
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
			$pagePerm = $instAuth->CheckPagePerm($curPage.'.html');
			if($pagePerm['mp_view']=='1') {
				// View Access Granted
			} else {
				if($curPage=='profile' || $curPage=='change_password') {
					//By Pass
				} else {
					header('HTTP/1.0 403 Forbidden');
					header('Location:403.php');
					echo "Access Denied"; exit;
				}
			}
		}
	}
}
?>