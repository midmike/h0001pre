<?php
    define('SITE_TITLE','ResManag Project');
    define('SITE_ROOT',dirname(dirname(__FILE__)));
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_PERSISTENCY','true');
    define('DB_DATABASE', 'resmanag');
    define('PDO_DSN', 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE.';charset=utf8');
?>