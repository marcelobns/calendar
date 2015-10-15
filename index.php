<?php
//root folders
$res = "public";
$src = "source";
$vendor = "vendor";
$modules = "modules";

//global constants
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
define('DIR', dirname(__DIR__));
define('ROOT', __DIR__);
define('SRC', ROOT . DS . $src . DS);
define('VENDOR', ROOT . DS . $vendor . DS);
define('RES', ROOT . DS . $res . DS);
if (!defined('HREF')) {
	define('HREF', str_replace("index.php", "", $_SERVER['PHP_SELF']));
}
define('WEBROOT', HREF . $res . DS);
define('MODULES', "\\$src\\$modules\\");

//Autoloader
require_once VENDOR."autoload.php";
//Routes
new Anotherwise\Bonus\Router();
