<?php require_once 'global.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '_head.php'; ?>

<body>
  <section id="container">

    <?php require_once '_nav_superior.php'; ?>

    <?php require_once '_nav_lateral.php'; ?>

    <?php
    $id  =  $_GET['id'];
    $projeto = Projeto::resgatar_projeto_id($id);

    $fps = Projeto::hist_dados_importado($id);

    $faturamento_ener_reat = Projeto::hist_faturamento_er($id);

    $fat_med=0;
    $fat_total=0;
    $fat_registros=0;
    foreach($faturamento_ener_reat as $x):
      $fat_total=$fat_total+$x['valor'];
      $fat_registros=$fat_registros+1;
    endforeach;
    $fat_med=$fat_total/$fat_registros;

    $dados = Projeto::info_projeto_importado($id);
    $config = Sistema::preco_investimento(0);

    ?>

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-bolt"></i> <?= $projeto[0]['titulo'] ?> // FP Desejado: <?= $projeto[0]['fp_desejado'] ?></h3>
        <div class="row mt">

          <div class="col-lg-12">

            <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="content-panel pn">
                <div id="profile-01" style="background: url(img/analisadorenergia.jpg) no-repeat center;">
                  <h3 style="text-shadow: #000 1px 1px 5px;">CARREGAR DADOS DE ENERGIA</h3>
                  <h6 style="text-shadow: #000 1px 1px 5px;"></h6>
                </div>
                <div class="profile-01 centered">
                  <p data-toggle="modal" data-target="#">IMPORTAR</p>
                </div>
                <div class="centered">
                  <h6><i class="fa fa-info-circle"></i><br/>Utilize esta opção para carregar dados do analizador de eneria!</h6>
                </div>
              </div>
              <!-- /content-panel -->
            </div>


            <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="content-panel pn">
                <div id="profile-01" style="background: url(img/contaenergia.jpg) no-repeat center;">
                  <h3 style="text-shadow: #000 1px 1px 5px;">INFORMAR DADOS TARIFAÇÃO</h3>
                  <h6 style="text-shadow: #000 1px 1px 5px;">Tenha em mão as últimas faturas da concessionária</h6>
                </div>
                <div class="profile-01 centered">
                  <p data-toggle="modal" data-target="#conta_energia">CADASTRAR</p>
                </div>
                <div class="centered">
                  <h6><i class="fa fa-info-circle"></i><br/>Utilize esta opção para informar os excedentes reativos dos últimos faturamentos de energia.</h6>
                </div>
              </div>
              <!-- /content-panel -->
            </div>

            <div class="modal fade" id="conta_energia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form class="style-form" action="controller-projeto/cadastrar_faturamento.php" method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">INFORMAR FATURAS DE ENERGIA</h4>
                    </div>
                    <div class="modal-body">
                      <?php for ($i=1; $i < 13; $i++) { ?>
                      <div class="row">
                      <div class="form-group">
                        <label class="col-md-1 control-label">MÊS <?= $i ?></label>

                        <label class="col-md-1 control-label">ERE KHW</label>
                        <div class="col-sm-4">
                          <input type="text" name="qnt<?= $i ?>" value="0" class="form-control">
                        </div>

                        <label class="col-md-1 control-label">ERE R$</label>
                        <div class="col-sm-5">
                          <input type="text" name="valor<?= $i ?>" value="0" class="form-control">
                        </div>
                      </div>
                      </div>
                      <?php } ?>


                      <input type="hidden" name="projeto" value="<?= $id ?>">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>


            <?php foreach($dados as $x):

              $q = $x['aparente']*$x['aparente']-$x['ativo']*$x['ativo'];
              $reativa = sqrt($q);

              ?>

              <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="weather-2 pn">
                  <div class="weather-2-header" style="background-color:#101D42;">
                    <div class="row">
                      <div class="col-sm-12 col-xs-12">
                        <p><b>RESUMO <?= $projeto[0]['titulo'] ?></b></p>
                      </div>
                      <div class="col-sm-6 col-xs-6 goright">

                      </div>
                    </div>
                  </div>
                  <!-- /weather-2 header -->
                  <div class="row centered">
                    <img src="img/industria.jpg" class="img-circle" width="120"></img>
                  </div>
                  <div class="row data">
                    <div class="col-sm-6 col-xs-6 goleft">
                      <h4><b><?= $x['aparente'] ?>KVA</b></h4>
                      <h5><i class="fa fa-smile-o" style="color:green;"></i><?= $x['ativo'] ?>  KW</h5>
                      <h5><i class="fa fa-frown-o" style="color:red;"></i> <?= round($reativa,2) ?> KVAR</h5>
                    </div>
                    <?php
                      //coalesce(round(sum(potati)*(fp_desejado-(sum(potati)/sum(potapa))),2),0) as correcao,
                      $correcao = $x['ativo']*($projeto[0]['fp_desejado']-($x['ativo']/$x['aparente']));
                      $investimento = round($correcao*$config[0]['preco_kvar'],2);

                    ?>
                    <div class="col-sm-6 col-xs-6 goright">
                      <br>
                      <h5><b><i class="fa fa-tachometer"></i> FP: <?= $x['fp'] ?></b></h5>
                      <h5 style="color:green;"><b><i class="fa fa-refresh"></i> <?= round($correcao,2) ?>  KVAR</b></h5>
                      <h5 style="color:#A78F25;"><b><i class="fa fa-money"></i><?= $investimento ?> R$ </b></h5>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>




            <!-- GRÁFICO DO FATOR DE POTENCIA -->
            <div class="col-md-12">
              <div class="weather-2 pn" style="height:auto;">
                <div class="weather-2-header">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p>HISTÓRICO DE FATOR DE POTÊNCIA IMPORTADO</p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small">DMHm = Dia Mês Hora Minuto</p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <div id="historicofp" style="width:95%; align:center;"></div>
                </div>
              </div>
            </div>

            <!-- GRÁFICO DAS TENSOES -->
            <div class="col-md-12">
              <div class="weather-2 pn" style="height:auto;">
                <div class="weather-2-header">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p>HISTÓRICO DE NÍVEIS DE TENSÃO</p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small">DMHm = Dia Mês Hora Minuto</p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <div id="historicotensao" style="width:95%; align:center;"></div>
                </div>
              </div>
            </div>


            <!-- GRÁFICO FATURAMENTO REATIVO -->
            <div class="col-md-12">
              <div class="weather-2 pn" style="height:auto;">
                <div class="weather-2-header">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p>HISTÓRICO DE FATURAMENTO DE EXCEDENTE REATIVO</p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small"></p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <div id="faturamento" style="width:95%; align:center;"></div>
                </div>
              </div>
            </div>

            <!-- GRÁFICO PAYBACK -->
            <div class="col-md-12">
              <div class="weather-2 pn" style="height:auto;">
                <div class="weather-2-header">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p>TEMPO EM MESES PARA RETORNO DO INVESTIMENTO ( PAYBACK )</p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small"></p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <div id="payback" style="width:95%; align:center;"></div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->


    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <?php require_once '_footer.php'; ?>

  </section>

  <?php require_once '_js.php'; ?>

  <!-- GRÁFICO DO FATURAMENTO -->
  <script type="text/javascript">
    var options = {
      series: [{
      name: 'VALOR PAGO EM MULTA R$',
      type: 'line',
      data: [<?php foreach($faturamento_ener_reat as $x): echo $x['valor'].','; endforeach; ?>]
    }, {
      name: 'ENERGIA REATIVA EXCEDENTE CONSUMIDA KWH',
      type: 'line',
      data: [<?php foreach($faturamento_ener_reat as $x): echo $x['quantidade'].','; endforeach; ?>]
    }],
      chart: {
      height: 350,
      type: 'line',
    },
    stroke: {
      curve: 'smooth'
    },
    fill: {
      type:'solid',
      opacity: [0.35, 1],
    },
    labels: [<?php foreach($faturamento_ener_reat as $x): echo $x['mes'].','; endforeach; ?>],
    markers: {
      size: 0
    },
    yaxis: [
      {
        title: {
          text: 'VALOR FATURADO R$',
        },
      },
      {
        opposite: true,
        title: {
          text: 'ENERGIA REATIVA EXCEDENTE KHW',
        },
      },
    ],
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: function (y) {
          if(typeof y !== "undefined") {
            return  y.toFixed(2);
          }
          return y;
        }
      }
    }
    };

    var chart = new ApexCharts(document.querySelector("#faturamento"), options);
    chart.render();
  </script>

  <!-- GRAFICO DAS TENSOES -->
  <script type="text/javascript">
    var options = {
    series: [
      {
        name: 'V12',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V12'].','; endforeach; ?>]
      },
      {
        name: 'V23',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V23'].','; endforeach; ?>]
      },
      {
        name: 'V31',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V31'].','; endforeach; ?>]
      },
      {
        name: 'V1',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V1'].','; endforeach; ?>]
      },
      {
        name: 'V2',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V2'].','; endforeach; ?>]
      },
      {
        name: 'V3',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['V3'].','; endforeach; ?>]
      }],
      chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        curve: 'smooth'
      },
      labels: [<?php foreach($fps as $x): echo '"'.$x['legenda'].'"'.','; endforeach; ?>],
      markers: {
        size: 0
      },
      yaxis: [
        {
          title: {
            text: 'NÍVEL DE TENSÃO',
          },
        },
      ],
      tooltip: {
        shared: true,
        intersect: false,
        y: {
          formatter: function (y) {
            if(typeof y !== "undefined") {
              return  y.toFixed(2);
            }
            return y;
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#historicotensao"), options);
    chart.render();
  </script>

  <!-- GRÁFICO DOS FATORES DE POTENCIA -->
  <script type="text/javascript">
  var options = {
    series: [
      {
        name: 'SISTEMA',
        type: 'area',
        data: [<?php foreach($fps as $x): echo $x['PF_SYS'].','; endforeach; ?>]
      },
      {
        name: 'FP MIN',
        type: 'line',
        data: [<?php foreach($fps as $x): echo 0.92.','; endforeach; ?>]
      },
      {
        name: 'FASE A',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['PF1'].','; endforeach; ?>]
      },
      {
        name: 'FASE B',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['PF2'].','; endforeach; ?>]
      },
      {
        name: 'FASE C',
        type: 'line',
        data: [<?php foreach($fps as $x): echo $x['PF3'].','; endforeach; ?>]
      }],
      chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        type:'solid',
        opacity: [0.15, 1],
      },
      labels: [<?php foreach($fps as $x): echo '"'.$x['legenda'].'"'.','; endforeach; ?>],
      markers: {
        size: 0
      },
      yaxis: [
        {
          title: {
            text: 'FATOR DE POTÊNCIA',
          },
        },
      ],
      tooltip: {
        shared: true,
        intersect: false,
        y: {
          formatter: function (y) {
            if(typeof y !== "undefined") {
              return  y.toFixed(2);
            }
            return y;
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#historicofp"), options);
    chart.render();
  </script>


  <script type="text/javascript">

  var options = {
    chart: {
      height: 280,
      type: 'bar',
      stacked: true,
      toolbar: {
        show: true
      },
      zoom: {
        enabled: true
      }
    },
    responsive: [{
      breakpoint: 480,
      options: {
        legend: {
          position: 'bottom',
          offsetX: -10,
          offsetY: 0
        }
      }
    }],
    plotOptions: {
      bar: {
        horizontal: false,
      },
    },
    series: [{
      name: 'ATIVA',
      data: [10],

    },{
      name: 'REATIVA',
      data: [20],
    }],
    xaxis: {
      categories: ['POT'],
    },
    legend: {
      position: 'right',
      offsetY: 40
    },
    fill: {
      opacity: 1
    },
  }

  var chart = new ApexCharts(
    document.querySelector("#chart"),
    options
  );

  chart.render();

</script>

<script type="text/javascript">

      var options = {
      series: [{
      name: 'Investimento',
      data: [<?php
      $retorno_investimento = $investimento;
      while ($retorno_investimento >0) {
        echo round($retorno_investimento,2).',';
        $retorno_investimento=$retorno_investimento-$fat_med;
      }
      ?>0]
      }],
      chart: {
      type: 'bar',
      height: 350
      },
      plotOptions: {
      bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded'
      },
      },
      dataLabels: {
      enabled: false
      },
      stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
      },
      xaxis: {
      categories: [<?php
      $mes_investimento=$investimento;
      $i = 1;
      while ($mes_investimento>0) {
        echo '"MÊS '.$i.'",';
        $i=$i+1;
        $mes_investimento=$mes_investimento-$fat_med;
      }
      echo '"MÊS '.$i.'"'; ?>],
      },
      yaxis: {
      title: {
      text: 'R$'
      }
      },
      fill: {
      opacity: 1
      },
      tooltip: {
      y: {
      formatter: function (val) {
        return "R$ " + val + " "
      }
      }
      }
      };

      var chart = new ApexCharts(document.querySelector("#payback"), options);
      chart.render();


</script>


</body>

</html>
