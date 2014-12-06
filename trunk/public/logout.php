<?php
///test file next time I will move it to controls to do it
    require_once('../helper/session/SessionHandlers.php');
    require_once('../models/User.php');
    SessionHandlers::destroyAllSession();/*
    header("Location:".dirname(__FILE__));*/
    unset($_COOKIE[User::SESSION_USER]);
    setcookie(User::SESSION_USER,  null, -1, '/');
    header("Location:../");
    exit(); 
?>