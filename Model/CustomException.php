<?php

namespace Model;

use Exception;
use Model\Session;

class CustomException extends Exception
{
	public function __construct($message = null, $code = 5)
    {

        parent::__construct($message, $code);
        $session = new Session();
        var_dump($code);
        $session->addSession('errorMessage', $this->getMessage());        
        $session->addSession('errorCode', $this->getCode());       
        
        //Appelle l'affichage
        header('Location: error-page');
    }

    public function __toString()
	{
	    return $this->message;
	}
}
