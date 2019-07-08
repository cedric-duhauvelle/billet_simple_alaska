<?php

class CustomException extends \Exception
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
        
        //Appelle l'affichage
        header('Location: error-page');
    }
}