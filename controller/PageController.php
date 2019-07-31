<?php

require_once '../modele/Router.php';
require_once '../modele/CustomException.php';

$router = new Router($this->_db);
$getClean = $router->cleanArray($_GET);

require_once '../View/Template/header.php';

if ($page === 'chapitre' || $page === 'administrateur')
{
    if (array_key_exists('id', $getClean))
    {
        $chapter = new Chapters($this->_db);
        if ($chapter->checkId($getClean['id']))
        {
            require_once '../View/' . $page . '.php';
        }
        else
        {
            throw new CustomException("Chapitre introuvable", 404); 
        }
    }
    elseif ($page === 'administrateur')
    {
        require_once '../View/' . $page . '.php';
    }
}
else
{
    require_once '../View/' . $page . '.php';
}

require_once '../View/Template/footer.php';