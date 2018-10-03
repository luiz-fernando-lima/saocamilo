<?php

class Conexao extends PDO {
	private $connection;

	public function __construct() {
		$this -> connection = new PDO("mysql:host=localhost;dbname=saocamilo", "root", "root");
	}

	private function setParams($statement, $parameters = array()) {
		foreach ($parameters as $key => $value) {
			$this -> setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value) {
		$statement -> bindParam($key, $value);
	}


	public function query($query, $parameters = array()) {
		$statement = $this -> connection -> prepare($query);
		$this -> setParams($statement, $parameters);
		$statement -> execute();
		return $statement;
	}

	public function select($query, $parameters = array()): array {
		$statement = $this -> query($query, $parameters);
		return $statement -> fetchAll(PDO::FETCH_ASSOC);
	}
}

?>