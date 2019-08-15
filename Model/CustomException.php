<?php

namespace Model;

use \Exception;
use Model\Session;

class CustomException extends \Exception
{
	public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
     
        $session = new Session();
        $session->addSession('errorMessage', $message);        
        $session->addSession('errorCode', $code);
        
        //Appelle l'affichage
        header('Location: error-page');
    }
}