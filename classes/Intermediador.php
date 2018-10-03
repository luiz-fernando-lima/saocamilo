<?php

require_once("Evento.php");

$evento = new Evento();

$idevento   = $_POST['idevento'];
$nomeevento = $_POST['nameevento'];
$dataevento = $_POST['namedata'];
$comando    = $_POST['operacao'];

$evento-> setId($idevento);
$evento-> setEvento($nomeevento);
$evento-> setDataevento($dataevento);


switch ($comando) {
	case 'Incluir':
		$evento -> inserir();
		break;
	
	case 'Alterar':
		$evento -> alterar();
		break;

	case 'Excluir':
		$evento -> excluir();
		break;

	case 'Consultar':
	 	var_dump($lista = Evento:: lista());
		break;
}

?>