<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
// ==============define constants ======================================
DEFINE('DS',DIRECTORY_SEPARATOR);
DEFINE('BASE_URL','http://localhost/PHPoop/final/catalogRyt/');
DEFINE('DEFAULT_CONTROLLER','Main');
DEFINE('DEFAULT_METHOD','index');
DEFINE('BASE_PATH',__DIR__);
DEFINE('CONTROLLER_PATH',BASE_PATH.DS.'src'.DS.'Controllers'.DS);
//=========================================================================
require_once 'vendor/autoload.php';
require_once 'src/Helpers/functions.php';
// ================ get url ===============================
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace(BASE_URL,'',$url);
$urlParts = array_filter(explode('/',$url));
// get controller from url =========================
$controller = $urlParts[0] ?? DEFAULT_CONTROLLER;
$controller = ucFirst(strtolower($controller));
$controllerFile = $controller.'.php';
// ==== get method from url ==================================
$method = $urlParts[1] ?? DEFAULT_METHOD;
unset($urlParts[0],$urlParts[1]);
// ========= ste method to default if there is no method
if(!file_exists(CONTROLLER_PATH.$controllerFile))
{
  $controller = DEFAULT_CONTROLLER;
}
// ======= initiate new object in controller ==============
$initController = "Tod\\Controllers\\".$controller;
$app = new $initController();

// ======= call method from the object with params ==============
$con = Tod\Helpers\Database::getConnection();
call_user_func_array(array($app, $method), $urlParts);
