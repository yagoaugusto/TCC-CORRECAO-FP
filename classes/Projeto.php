<?php

class Projeto{

  public function cadastrar_projeto($usuario,$titulo,$tensao,$fp,$tipo)
  {
    $query = "INSERT INTO projeto (usuario,titulo,tipo,tensao,fp_desejado)
    VALUES ('{$usuario}','{$titulo}','{$tipo}','{$tensao}','{$fp}')";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }

  public function cadastrar_ccm($projeto,$ccm)
  {
    $query = "INSERT INTO ccm (projeto,ccm)
    VALUES ('{$projeto}','{$ccm}')";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }

  public function limpar_faturamento($projeto)
  {
    $query = "DELETE from faturamento where projeto='{$projeto}'";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }

  public function cadastrar_faturamento($projeto,$mes,$valor,$quantidade)
  {
    $query = "INSERT INTO faturamento (projeto,mes,valor,quantidade)
    VALUES ('{$projeto}','{$mes}','{$valor}','{$quantidade}')";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }

  public static function resgatar_projeto_cadastrado($usuario,$tipo)
  {
    $query = "SELECT * from projeto where tipo='{$tipo}' and usuario='{$usuario}' order by id desc";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public static function resgatar_projeto_id($id)
  {
    $query = "SELECT * from projeto where id='{$id}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public static function hist_dados_importado($id)
  {
    $query = "SELECT ID,concat('D',day(DATE),'M',month(DATE),'H',hour(TIME),'m',minute(TIME)) as legenda,PF1,PF2,PF3,V12,V23,V31,V1,V2,V3,
    DATE,TIME,PF_SYS from importar_dados_projeto where projeto='{$id}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public static function hist_faturamento_er($id)
  {
    $query = "SELECT * from faturamento where projeto='{$id}' order by mes asc";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }



  public static function listar_projeto_usuario($usuario)
  {
    $query = "SELECT * from projeto where usuario = '{$usuario}' order by id desc";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public static function listar_ccm_projeto($id)
  {
    $query = "SELECT * from ccm where projeto='{$id}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

  public function adicionar_motor_ccm($motor,$ccm,$cv,$fp,$ativa,$aparente,$reativa)
  {
    $query = "INSERT INTO motor_ccm (motor,ccm,cv,fp,potati,potapa,potrea)
    VALUES ('{$motor}','{$ccm}','{$cv}','{$fp}','{$ativa}','{$aparente}','{$reativa}')";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }


  public static function resumo_ccm_projeto($projeto)
  {
    $query = "SELECT
      ccm.id as ccm_id, ccm.ccm as ccm,projeto.tensao,projeto.fp_desejado,count(motor_ccm.id) as quant_motores,
      coalesce(round(sum(potati)*(fp_desejado-(sum(potati)/sum(potapa))),2),0) as correcao,
      coalesce(round(sum(potati)*(fp_desejado-(sum(potati)/sum(potapa))),2)*(select preco_kvar from configuracao where usuario=0 limit 1),0) as investimento,
      coalesce(sum(potati),0) as potati,
      coalesce(sum(potapa),0) as potapa,
      coalesce(sum(potrea),0) as potrea,
      coalesce(round((sum(potati)/sum(potapa)),2),0) as fp
        from ccm
      left join motor_ccm on ccm.id=motor_ccm.ccm
      join projeto on projeto.id=ccm.projeto

      where projeto.id='{$projeto}'
      group by ccm.id";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }


  public static function resumo_sistema_projeto($projeto)
  {
    $query = "SELECT
      ccm.id as ccm_id, ccm.ccm as ccm,projeto.tensao,projeto.fp_desejado,count(motor_ccm.id) as quant_motores,
      coalesce(round(sum(potati)*(fp_desejado-(sum(potati)/sum(potapa))),2),0) as correcao,
      coalesce(round(sum(potati)*(fp_desejado-(sum(potati)/sum(potapa))),2)*(select preco_kvar from configuracao where usuario=0 limit 1),0) as investimento,
      coalesce(sum(potati),0) as potati,
      coalesce(sum(potapa),0) as potapa,
      coalesce(sum(potrea),0) as potrea,
      coalesce(round((sum(potati)/sum(potapa)),2),0) as fp
        from ccm
      left join motor_ccm on ccm.id=motor_ccm.ccm
      join projeto on projeto.id=ccm.projeto

      where projeto.id='{$projeto}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }


  public static function motores_sistema($projeto)
  {
    $query = "SELECT
      motor_ccm.id as id,
      ccm.ccm as ccm,motor.descricao as motor,
      motor.cv,motor.fp,potati,potrea,potapa

      from motor_ccm

      join ccm on motor_ccm.ccm=ccm.id
      join projeto on ccm.projeto=projeto.id
      join motor on motor_ccm.motor=motor.id

      where  projeto.id='{$projeto}'
      order by ccm.ccm,motor.cv";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }


  public function remover_motor_ccm($id)
  {
    $query = "DELETE from motor_ccm where id='{$id}'";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->execute();
  }



  public static function info_projeto_importado($projeto)
  {
    $query = "SELECT * FROM v_importacao where projeto='{$projeto}'";
    $conexao = Conexao::pegarConexao();
    $resultado = $conexao->query($query);
    $lista = $resultado->fetchAll();
    return $lista;
  }

}
