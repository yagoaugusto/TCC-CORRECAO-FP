<?php
require_once 'global.php';

$usuario = 0;
$titulo = $_POST['titulo'];
$tensao = $_POST['tensao'];
$fp = $_POST['fp'];
$tipo = $_POST['tipo'];

$cadastrar = Projeto::cadastrar_projeto($usuario,$titulo,$tensao,$fp,$tipo);

$resgatar = Projeto::resgatar_projeto_cadastrado($usuario,$tipo);

$id = $resgatar[0]['id'];

header('Location:../projeto_existente.php?id='.$id);

?>
