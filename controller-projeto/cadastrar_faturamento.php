<?php

require_once 'global.php';

$projeto = $_POST['projeto'];

$limpar = Projeto::limpar_faturamento($projeto);

for ($i=1; $i < 13; $i++) {
  if($_POST['qnt'.$i]>0){
    $cadastrar = Projeto::cadastrar_faturamento($projeto,$i,$_POST['valor'.$i],$_POST['qnt'.$i]);
  }
}

header('Location:../projeto_existente.php?id='.$projeto);

?>
