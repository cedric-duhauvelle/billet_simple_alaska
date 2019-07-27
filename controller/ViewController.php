<?php
$getClean = $router->cleanArray($_GET);
$postClean = $router->cleanArray($_POST);

require_once '../View/Template/header.php';

if(is_array($getClean) && array_key_exists('url', $getClean)) {
    $router->setUrl($getClean['url']);      
} else {
    header('Location: accueil');
}

require_once '../View/Template/footer.php';

