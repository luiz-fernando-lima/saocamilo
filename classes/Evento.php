<?php

require_once("Conexao.php");

class Evento {

	private $id;
	private $evento;
	private $dataevento;

	public function getId() {
		return $this -> id;
	}

	public function setId($id) {
		$this -> id = $id;
	}


	public function getEvento() {
		return $this -> evento;
	}

	public function setEvento($evento) {
		$this -> evento = $evento;
	}

	public function getDataevento() {
		return $this -> dataevento;	
	}

	public function setDataevento($dataevento) {
		$this -> dataevento = $dataevento;
	}

	public function inserir() {
		$conexao = new Conexao();
		$conexao -> query("INSERT INTO EVENTOS(EVENTO, DATAEVENTO) 
								  VALUES(:EVENTO, :DATAEVENTO)", 
								  array(':EVENTO' => $this -> getEvento(),
								        ':DATAEVENTO' => $this -> getDataevento()));

		echo "Evento inserido com sucesso";
	}

	public function alterar() {
		$conexao = new Conexao();
		$conexao -> query("UPDATE EVENTOS SET EVENTO = :EVENTO, DATAEVENTO = :DATAEVENTO WHERE ID = :ID", 
								  array(':EVENTO' => $this -> getEvento(),
								        ':DATAEVENTO' => $this -> getDataevento(),
								        ':ID' => $this -> getId()));

		
		echo "Evento alterado com sucesso";								        	
	}

	public function excluir() {
		$conexao = new Conexao();
		$conexao -> query("DELETE FROM EVENTOS WHERE ID = :ID", array(':ID' => $this -> getId()));

		echo "Evento excluido com sucesso";
	}

	public static function lista() {
		$conexao = new Conexao();
		return $conexao -> select("SELECT * FROM EVENTOS ORDER BY ID");
	}

	public function pesquisarId($id) {
		$conexao = new Conexao();
		$resultado = $conexao -> select("SELECT * FROM EVENTOS WHERE ID = :ID", array(':ID' => $id));

		if(count($resultado) > 0) {

			$linha = $resultado[0];

			$this -> setId($linha["ID"]);
			$this -> setEvento($linha["EVENTO"]);
			$this -> setDataevento(new DateTime($linha["DATAEVENTO"]));
		}
	}

	public function __toString() {
		return json_encode(array(
		"ID" => $this -> getId(),
		"EVENTO" => $this -> getEvento(),
		"DATAEVENTO" => $this -> getDataevento() -> format("d/m/Y H:i:s")));
	}
}

?>