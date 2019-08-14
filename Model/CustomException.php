<?php

namespace Model;

use \Exception;
use Model\Session;

class CustomException extends \Exception
{
    public function __construct($message, $code)
    {

        parent::__construct($message, $code);

        $session = new Session();
        $session->addSession('errorMessage', $this->getMessage());        
        $session->addSession('errorCode', $code);
        
        //Appelle l'affichage
        header('Location: error-page');
    }
}