<?php
/*
 * Author midmike
 */
    if (isset($_GET['lang'])) {
      //echo setlocale(LC_ALL,$_GET['lang']);
      setcookie('lang', setlocale(LC_ALL,$_GET['lang']), time() + (3600), "/");
    } else {
      //echo setlocale(LC_ALL,$_GET['lang']);
      //$_SESSION["locale"] = setlocale(LC_ALL,"en");
      setcookie('lang', setlocale(LC_ALL,"en"), time() + (3600), "/");
    }
    header("Location:../index.php?lang=kh");
    exit();

?>