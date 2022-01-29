<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
DEFINE('DS',DIRECTORY_SEPARATOR);
DEFINE('BASE_URL','http://localhost/PHPoop/final/catalogRyt/');
DEFINE('DEFAULT_CONTROLLER','Main');
DEFINE('DEFAULT_METHOD','index');
DEFINE('BASE_PATH',__DIR__);
DEFINE('CONTROLLER_PATH',BASE_PATH.DS.'src'.DS.'Controllers'.DS);
require_once 'vendor/autoload.php';
require_once 'src/Helpers/functions.php';

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace(BASE_URL,'',$url);
$urlParts = array_filter(explode('/',$url));
$controller = $urlParts[0] ?? DEFAULT_CONTROLLER;
$controller = ucFirst(strtolower($controller));
$controllerFile = $controller.'.php';
// echo '<pre>'; print_r($controller);  die;
$method = $urlParts[1] ?? DEFAULT_METHOD;
unset($urlParts[0],$urlParts[1]);
if(!file_exists(CONTROLLER_PATH.$controllerFile))
{
  $controller = DEFAULT_CONTROLLER;
}
$initController = "Tod\\Controllers\\".$controller;
$app = new $initController();

echo go('login', 'index');
//call method from the object with params
$con = Tod\Helpers\Database::getConnection();
call_user_func_array(array($app, $method), $urlParts);
//include 'header.php';

// $sql = "SELECT * FROM `users`";
// $query = $con->prepare($sql);
// $query->execute();
// $users = $query->fetchAll();
// echo '<pre>'; print_r($users);



?>
