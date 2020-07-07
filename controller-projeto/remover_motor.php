<?php
require_once 'global.php';

$id = $_GET['id'];
$projeto = $_GET['projeto'];

$remover = Projeto::remover_motor_ccm($id);

header('Location:../projeto_novo.php?id='.$projeto);
?>
