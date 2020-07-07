<?php
require_once 'global.php';

$usuario = 0;
$titulo = $_POST['titulo'];
$tensao = $_POST['tensao'];
$fp = $_POST['fp'];
$tipo = $_POST['tipo'];
$ccm =  $_POST['ccm'];

$cadastrar = Projeto::cadastrar_projeto($usuario,$titulo,$tensao,$fp,$tipo);

$resgatar = Projeto::resgatar_projeto_cadastrado($usuario,$tipo);

$id = $resgatar[0]['id'];

for ($i=1; $i <= $ccm; $i++) {
  $cad_ccm = Projeto::cadastrar_ccm($id,$i);
}

header('Location:../projeto_novo.php?id='.$id);

?>
