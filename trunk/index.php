<!DOCTYPE html>
<html lang="en">
<?php
require_once ('conf/define.php');
require_once ('helper/auto_include.php');

$site = new Site();
if(!$site->isSetSession()) {
	$site->setlanguage("en");
	$site->setSession();
} else {
	$site = $site->getSession();
}
// check language to show
SessionHandlers::checkSession ();
$_SESSION ["locale"] = $site->getlanguage();
if ($_SESSION ["locale"] == "kh") {
	echo "<style> * { font-family: 'Khmer OS System','Khmer OS','Khmer OS Muol','Khmer OS Battambang'; !important }</style>";
} 
$user1 = new User();
if ($user1->isLogin ()) {
	$log_user = Tool::getLoginUser();
	if (!$site->isExist($log_user)) {
		$site->setrefUser($log_user->getId());
		$site->insertDatabase($log_user);
	} else {
		$site->setrefUser($log_user->getId());
		$site->setSessionByUser();
	}
	// HTML HEAD
	require_once 'public/masterPages/head.php';
	// BODY
	echo '<body class="tooltips">';
	// ===================
	// MAIN
	// ===================
	require_once '/public/masterPages/main.php';
	if (isset ( $_GET ["menu"] )) {
		switch ($_GET ["menu"]) {
			case PAGE_USER_REGISTER :
				require_once ('public/register.php');
				break;
			case PAGE_FOOD :
				require_once 'public/pages/uploadPanel.php';
				break;
			case PAGE_MANAGE_USER :
				Tool::isLoginUserTypeAdmin($log_user);
				require_once 'public/User/pageManageUser.php';
				break;
			case PAGE_SITE_CONFIGURE :
				Tool::isLoginUserTypeAdmin($log_user);
				require_once 'public/site/configureSite.php';
				break;
			default :
				require_once ('public/masterPages/dashboard.php');
		}
	} else {
		require_once ('public/masterPages/dashboard.php');
	}
	
	require_once 'public/masterPages/footer.php';
	// SCRIPT
	require_once '/public/masterPages/script.php';
	// END BODY
	echo '</body>';
} else {
	require_once ('public/login.php');
}
exit ();
?>
</html>