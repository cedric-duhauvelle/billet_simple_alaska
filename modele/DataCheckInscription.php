<?php

require_once 'Data.php';

class DataCheckInscription extends Data {

	protected $_db;

	public function __construct($db) {
		return $this->_db = $db;
	}

	public function test() {
		echo $this->_db;
	}
}