<?php
require_once ('conf/define.php');
require_once ('helper/auto_include.php');
$user = new User();
$arr =$user->readDatabaseAll(null,null);
print_r($arr[3]);