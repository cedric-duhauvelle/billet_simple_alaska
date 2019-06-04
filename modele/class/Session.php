<?php
session_start();

class Session{

	public function addSession($name, $value) {
		$_SESSION[$name] = $value;
	}

}