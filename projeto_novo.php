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
    $motores = Motores::listar_motores();
    $ccm = Projeto::listar_ccm_projeto($id);
    $resumo_ccm = Projeto::resumo_ccm_projeto($id);
    $resumo_sistema = Projeto::resumo_sistema_projeto($id);
    $motores_sistema = Projeto::motores_sistema($id);
    ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-bolt"></i> <?= $projeto[0]['titulo'] ?> // FP Desejado: <?= $projeto[0]['fp_desejado'] ?> // Tensão: <?= $projeto[0]['tensao'] ?>V</h3>
        <div class="row">
          <div class="col-md-12">
            <p class="btn btn-primary" data-toggle="modal" data-target="#add_motor"> <i class="fa fa-folder-open-o"></i> ADICIONAR MOTOR</p>
            <p class="btn btn-primary" data-toggle="modal" data-target="#criar_motor"><i class="fa fa-plus-circle"></i> CRIAR E ADICIONAR NOVO MOTOR</p>
          </div>
        </div>

        <!-- ADICIONAR MOTOR -->
        <div class="modal fade" id="add_motor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form class="form-horizontal style-form" action="controller-projeto/add_motor_ccm.php" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">ADICIONAR MOTORES DO BANCO AO CCM</h4>
                </div>
                <div class="modal-body">

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">CCM</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="ccm" required>
                        <option value=""></option>
                        <?php foreach($ccm as $x): ?>
                          <option value="<?= $x['id'] ?>"><?= $x['ccm'] ?></option>
                        <?php endforeach;  ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Motor</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="motor" required>
                        <option value=""></option>
                        <?php foreach($motores as  $x): ?>
                          <option value="<?= $x['id'] ?>"><?= $x['descricao'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Quantidade</label>
                    <div class="col-sm-10">
                      <input type="text" name="quantidade" value="1" required class="form-control">
                    </div>
                  </div>


                  <input type="hidden" name="projeto" value="<?= $id ?>">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- CADASTRAR NOVO MOTOR NO BANCO E DEPOIS ADICIONAR -->
        <div class="modal fade" id="criar_motor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form class="form-horizontal style-form" action="controller-projeto/criar_add_motor_ccm.php" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">CRIAR UM NOVO MOTOR E ADICIONA-LO AO PROJETO</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                    <div class="col-sm-10">
                      <input type="text" name="descricao" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tensão</label>
                    <div class="col-sm-10">
                      <input type="text" name="tensao" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Polos</label>
                    <div class="col-sm-10">
                      <input type="text" name="polos" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">POT em CV</label>
                    <div class="col-sm-10">
                      <input type="text" name="cv" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Rendimento (n)</label>
                    <div class="col-sm-10">
                      <input type="text" name="n" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">FP</label>
                    <div class="col-sm-10">
                      <input type="text" name="fp" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">CCM</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="ccm" required>
                        <option value=""></option>
                        <?php foreach($ccm as $x): ?>
                          <option value="<?= $x['id'] ?>"><?= $x['ccm'] ?></option>
                        <?php endforeach;  ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Quantidade</label>
                    <div class="col-sm-10">
                      <input type="text" name="quantidade" class="form-control">
                    </div>
                  </div>



                  <input type="hidden" name="projeto" value="<?= $x['projeto'] ?>">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
              </div>
            </form>
          </div>
        </div>


        <br>

        <div class="row">
          <?php foreach($resumo_ccm as $x): ?>
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="weather-2 pn">
                <div class="weather-2-header" style="background-color:#232ED1;">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p><b>CCM: <?= $x['ccm'] ?></b></p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small">Comandando <?= $x['quant_motores'] ?> motores</p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <img src="img/ccm.jpg" class="img-circle" width="120"></img>
                </div>
                <div class="row data">
                  <div class="col-sm-6 col-xs-6 goleft">
                    <h4><b><?= $x['potapa'] ?> KVA</b></h4>
                    <h5><i class="fa fa-smile-o" style="color:green;"></i> <?= $x['potati'] ?> KW</h5>
                    <h5><i class="fa fa-frown-o" style="color:red;"></i> <?= $x['potrea'] ?> KVAR</h5>
                  </div>
                  <div class="col-sm-6 col-xs-6 goright">
                    <br>
                    <h5><b><i class="fa fa-tachometer"></i> FP: <?= $x['fp'] ?></b></h5>
                    <h5 style="color:green;"><b><i class="fa fa-refresh"></i> <?= $x['correcao'] ?> KVAR</b></h5>
                    <h5 style="color:#A78F25;"><b><i class="fa fa-money"></i> R$ <?= $x['investimento'] ?></b></h5>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <?php foreach($resumo_sistema as $x): ?>
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="weather-2 pn">
                <div class="weather-2-header" style="background-color:#101D42;">
                  <div class="row">
                    <div class="col-sm-6 col-xs-6">
                      <p><b><?= $projeto[0]['titulo'] ?></b></p>
                    </div>
                    <div class="col-sm-6 col-xs-6 goright">
                      <p class="small">Comandando <?= $x['quant_motores'] ?> motores</p>
                    </div>
                  </div>
                </div>
                <!-- /weather-2 header -->
                <div class="row centered">
                  <img src="img/industria.jpg" class="img-circle" width="120"></img>
                </div>
                <div class="row data">
                  <div class="col-sm-6 col-xs-6 goleft">
                    <h4><b><?= $x['potapa'] ?> KVA</b></h4>
                    <h5><i class="fa fa-smile-o" style="color:green;"></i> <?= $x['potati'] ?> KW</h5>
                    <h5><i class="fa fa-frown-o" style="color:red;"></i> <?= $x['potrea'] ?> KVAR</h5>
                  </div>
                  <div class="col-sm-6 col-xs-6 goright">
                    <br>
                    <h5><b><i class="fa fa-tachometer"></i> FP: <?= $x['fp'] ?></b></h5>
                    <h5 style="color:green;"><b><i class="fa fa-refresh"></i> <?= $x['correcao'] ?> KVAR</b></h5>
                    <h5 style="color:#A78F25;"><b><i class="fa fa-money"></i> R$ <?= $x['investimento'] ?></b></h5>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>


        </div>


        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> DETALHAMENTO DE MOTORES DO SISTEMA</h4>
                <hr>
                <thead>
                  <tr>
                    <th>CCM</th>
                    <th>MOTOR</th>
                    <th>CV</th>
                    <th>FP</th>
                    <th>POT ATIVA</th>
                    <th>POT APARENTE</th>
                    <th>POT REATIVA</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($motores_sistema as $x): ?>
                    <tr>
                      <td><?= $x['ccm'] ?></td>
                      <td><?= $x['motor'] ?></td>
                      <td><?= $x['cv'] ?></td>
                      <td><?= $x['fp'] ?></td>
                      <td><?= $x['potati'] ?></td>
                      <td><?= $x['potapa'] ?></td>
                      <td><?= $x['potrea'] ?></td>
                      <td><a href="controller-projeto/remover_motor.php?id=<?= $x['id'].'&projeto='.$id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                  <?php endforeach ?>
                </table>
              </div>
              <!-- /content-panel -->
            </div>
            <!-- /col-md-12 -->
          </div>

        </section>


      </section>
      <!-- /wrapper -->


    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <?php require_once '_footer.php'; ?>

  </section>

  <?php require_once '_js.php'; ?>

</body>

</html>
