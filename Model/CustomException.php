<?php

namespace Model;

use \Exception;
use Model\Session;

class CustomException extends \Exception
{
    public function __construct($code)
    {

        parent::__construct($code);

        $session = new Session();
        $session->addSession('errorMessage', $this->getMessage());        
        $session->addSession('errorCode', $code);
        
        //Appelle l'affichage
        header('Location: error-page');
    }
}