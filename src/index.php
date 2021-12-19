<?php

if (basename(dirname(dirname(__FILE__))) != 'src') {
  // do not show warnings or errors in production mode
  ini_set('display_errors', false);
}else{
  // show everything in development mode
  ini_set('display_errors', true);
  error_reporting(E_ALL);
}

session_start();
// ini_set('display_errors', true);
// error_reporting(E_ALL);

// parsing the .env file if available
// convert content to key / value pairs
if (file_exists("../.env")) {
  $variables = parse_ini_file("../.env", true);
  foreach ($variables as $key => $value) {
    putenv("$key=$value");
  }
}

require_once getenv('PHP_AUTOLOAD_PATH') ?: "../../../vendor/autoload.php";
require_once "./bootstrap/database.php";

require_once "./bootstrap/router.php";

$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
