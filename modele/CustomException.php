<?php

class CustomException extends \Exception
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
        
        //Appelle l'affichage
        require_once('../Template/error-page.php');
        header('Location: error-page');
    }
}