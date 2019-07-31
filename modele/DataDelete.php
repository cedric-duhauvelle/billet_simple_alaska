<?php

require_once 'Data.php';

class DataDelete extends Data
{
	public function chapter($id)
	{
		$req = $this->_db->prepare('DELETE FROM chapters WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
	}

	public function report($id)
	{
		$req = $this->_db->prepare('DELETE FROM reporting WHERE id_comment=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
	}

	public function comment($id)
	{
		$req = $this->_db->prepare('DELETE FROM comments WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
	}
}