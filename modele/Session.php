<?php

class Session
{
	//Cree une variable session 
    public function addSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }
}