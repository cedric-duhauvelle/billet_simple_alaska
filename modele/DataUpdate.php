<?php

namespace modele;

use modele\Data;

class DataUpdate extends Data
{
	public function __construct($db)
    {
        return $this->_db = $db;
    }
	public function name($id, $name)
	{
		$update = $this->_db->prepare('UPDATE users SET name=:name WHERE id=:id');
        $update->bindValue(':name', $name);
        $update->bindValue(':id', $id);
        $update->execute();
	}

	public function email($id, $email)
	{
		$update = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $update->bindValue(':email', $email);
        $update->bindValue(':id', $id);
        $update->execute();
	}

	public function password($id, $password)
	{
		$update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $password);
        $update->bindValue(':id', $id);
        $update->execute();
	}

	
}