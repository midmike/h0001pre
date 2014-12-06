<?php
/*
 * Author midmike
 */
	require_once '../../models/User.php';
	require_once '../../helper/Tools/Tool.php';
	require_once '../../helper/i18n/i18n.php';
	require_once '../../helper/session/SessionHandlers.php';
	require_once '../../conf/define.php';
	$log_user = new User();
	$log_user = Tool::getLoginUserTypeAdmin();
	$cache = $_GET['cache'];
	$log_user->dataTable($cache);
?>