<?php


require_once 'global.php';

$usuario=0;
$preco = $_POST['preco'];
$atualizar = Sistema::atualizar_investimento($preco,$usuario);

header('Location:../configuracao.php');



 ?>
