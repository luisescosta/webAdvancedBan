<?php
require_once("DB.class.php");
abstract Class Crud extends DB {
	protected $table;

	// abstract function update($id);
	// abstract function insert();

	
	// BUSCAR POR NOME
	public function findName($nome){
		$sql	= "SELECT * FROM $this->table WHERE name LIKE :NOME";
		$stmt	= DB::prepare($sql);
		$stmt->bindValue(":NOME", "%".$nome."%");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	// BUSCA POR ID
	public function find($id){
		$sql 	= "SELECT * FROM $this->table WHERE id=:ID";
		$stmt 	= DB::prepare($sql);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();

		return $stmt->fetch();
	}

	// BUSCA TODOS DA TABELA
	public function findAll(){
		$sql	= "SELECT * FROM $this->table";
		$stmt	= DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function rowCount(){
		$sql	= "SELECT * FROM $this->table";
		$stmt	= DB::prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();
	}
	
	// DELETE
	public function delete($id){
		$sql 	= "DELETE FROM $this->table WHERE id=:ID";
		$stmt 	= DB::prepare($sql);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
	}
}