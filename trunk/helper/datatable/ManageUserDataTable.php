<?php
	require_once '../../models/User.php';
	require_once '../../helper/Tools/Tool.php';
	require_once '../../conf/define.php';
	$log_user = Tool::getLoginUserTypeAdmin();
	$log_user->dataTable();
?>