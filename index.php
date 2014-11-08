<!DOCTYPE html>
<html lang="en">
<?php
require_once ('conf/define.php');
require_once ('helper/auto_include.php');

// check language to show
SessionHandlers::checkSession ();
if (empty ( $_SESSION ["locale"] )) {
	$_SESSION ["locale"] = "en";
}
if (! empty ( $_GET ["lang"] )) {
	$_SESSION ["locale"] = $_GET ["lang"];
}
$session = $_SESSION ["locale"];
if ($session == "kh") {
	echo "<style> * { font-family: 'Khmer OS System','Khmer OS','Khmer OS Muol','Khmer OS Battambang'; !important }</style>";
}

$user = new User ();
if ($user->isLogin ()) {
	require_once ('models/site.php');
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
			case USER_REGISTER :
				require_once ('public/register.php');break;
			case FOOD :
				require_once 'public/pages/uploadPanel.php';break;
			case MANAGE_USER :
				require_once 'public/User/pageManageUser.php';break;
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