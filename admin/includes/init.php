<?php 
require_once("config.php"); 
require_once("db_object.php"); 
require_once("database.php"); 
require_once("functions.php"); 
require_once("user.php"); 
require_once("session.php"); 

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // '/' or '\' depending on system

define('SITE_ROOT', DS . 'Applications' . DS . 'MAMP' . DS . 'htdocs' . DS . 'PHP_OOP');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', __DIR__ . DS );

defined('IMAGES_PATH') ? null : define('IMAGES_PATH', INCLUDES_PATH . 'images');

?>
<!-- Applications/MAMP/htdocs/PHP_OOP -->