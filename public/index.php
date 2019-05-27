<?php
/*var_dump($_SERVER);
echo "<br/>";
var_dump($_GET);*/
require '../controller/class/Router.php';
$url = '';

$router = new Router($_SERVER['PHP_SELF']);

$router->road($_GET['url']);
