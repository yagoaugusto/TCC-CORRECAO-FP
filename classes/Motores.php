<?php

class Motores{

  public static function listar_motores()
  {
    $query = "SELECT * from motor order by cv";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public static function resgatar_motor_id($motor)
  {
    $query = "SELECT * from motor where id='{$motor}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public function cadastrar_motor($descricao,$tensao,$polos,$cv,$n,$fp)
  {
    $query = "INSERT INTO motor (descricao,tensao,polos,cv,n,fp)
    VALUES ('{$descricao}','{$tensao}','{$polos}','{$cv}','{$n}','{$fp}')";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }

  public static function ultimo_motor_gerado()
  {
    $query = "SELECT * from motor order by id desc limit 1";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }


}
