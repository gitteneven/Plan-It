<?php
// set routes
$routes = array(
  'home' => array(
    'controller' => 'Pages',
    'action' => 'index'
  ),


  'overview' => array(
    'controller' => 'Pages',
    'action' => 'overview'
  ),

     'search' => array(
    'controller' => 'Pages',
    'action' => 'search'
  )
);

if(empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
