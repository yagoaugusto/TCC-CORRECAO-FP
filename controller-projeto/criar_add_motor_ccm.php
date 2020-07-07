<?php
require_once 'global.php';

$descricao = $_POST['descricao'];
$tensao= $_POST['tensao'];
$polos= $_POST['polos'];
$cv = $_POST['cv'];
$n= $_POST['n'];
$fp= $_POST['fp'];

$ccm= $_POST['ccm'];
$quantidade= $_POST['quantidade'];
$projeto = $_POST['projeto'];

$cadastrar_motor = Motores::cadastrar_motor($descricao,$tensao,$polos,$cv,$n,$fp);
$info_motor = Motores::ultimo_motor_gerado();

$fp = $info_motor[0]['fp'];
$cv = $info_motor[0]['cv'];
$motor = $info_motor[0]['id'];

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
