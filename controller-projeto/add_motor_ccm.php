<?php

require_once 'global.php';

$quantidade = $_POST['quantidade'];
$motor =  $_POST['motor'];
$ccm = $_POST['ccm'];
$projeto = $_POST['projeto'];

$info_motor = Motores::resgatar_motor_id($motor);
$fp = $info_motor[0]['fp'];
$cv = $info_motor[0]['cv'];

$info_projeto = Projeto::resgatar_projeto_id($projeto);
$tensao = $info_projeto[0]['tensao'];

$conv=0.735499;

$ativa = $cv*$conv;
$aparente = $ativa/$fp;
$q = $aparente*$aparente-$ativa*$ativa;
$reativa = sqrt($q);

for ($i=1; $i <= $quantidade ; $i++) {

  $cadatrar = Projeto::adicionar_motor_ccm($motor,$ccm,$cv,$fp,$ativa,$aparente,$reativa);

}

header ('Location:../projeto_novo.php?id='.$projeto);
?>
