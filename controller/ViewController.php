<?php

$getClean = $router->cleanArray($_GET);
$postClean = $router->cleanArray($_POST);
if (isset($_GET)) {
	require_once '../View/Template/header.php';

	if(is_array($getClean) && array_key_exists('url', $getClean)) {
	    $url = $getClean['url'];   
	} else {
		$url = 'accueil';
	}
	$router->setUrl($url);
	require_once '../View/Template/footer.php';
} 




