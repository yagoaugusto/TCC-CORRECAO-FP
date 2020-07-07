<?php

class Sistema{

  public function atualizar_investimento($preco,$usuario)
  {
    $query = "UPDATE configuracao set preco_kvar='{$preco}' where usuario='{$usuario}'";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }


  public static function preco_investimento($usuario)
  {
    $query = "SELECT preco_kvar from configuracao where usuario='$usuario' limit 1";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }




}
