<?php
require '../controller/class/Router.php';
$url = '';
if(array_key_exists('url', $_GET)) {
    $url = $_GET['url'];
}
$router = new Router();
$router->recoveredUrl(htmlspecialchars($url));
$router->checkUrl($url);
