<?php
///test file next time I will move it to controls to do it
    /*require_once('../helper/session/session_handler.php');
    Session_Handler::destroyAllSession();
    header("Location:".dirname(__FILE__));*/
    unset($_COOKIE['user']);
    setcookie('user',  null, -1, '/');
    header("Location:../index.php");
    exit();
?>