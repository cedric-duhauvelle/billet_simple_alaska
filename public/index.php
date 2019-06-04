<?php
require '../controller/class/Router.php';
$url = '';
if(isset($_GET['url'])) {
    $url = $_GET['url'];
}
$router = new Router();
$router->road(htmlspecialchars($url));
