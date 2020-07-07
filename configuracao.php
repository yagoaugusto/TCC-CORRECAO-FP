<?php require_once 'global.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '_head.php'; ?>

<body>
  <section id="container">

    <?php require_once '_nav_superior.php'; ?>

    <?php require_once '_nav_lateral.php'; ?>

    <?php $preco = Sistema::preco_investimento(0); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-cogs"></i> Configurações do sistema</h3>
        <div class="row mt">

          <div class="col-lg-4 col-md-4 col-sm-4 mb" data-toggle="modal" data-target="#investimento">
            <div class="weather-3 pn centered">
              <i class="fa fa-money"></i>
              <h1> R$ <?= $preco[0]['preco_kvar'] ?></h1>
              <div class="info">
                <div class="row">
                  <h3 class="centered">INVESTIMENTO POR KVAR</h3>
                  <div class="col-sm-12 col-xs-12 pull-left">
                    <p class="gocenter"><i class="fa fa-refresh"></i> CLIQUE PARA ATUALIZAR</p>
                  </div>
                  <!-- <div class="col-sm-6 col-xs-6 pull-right">
                    <p class="goright"><i class="fa fa-flag"></i> 15 MPH</p>
                  </div> -->
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="investimento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form class="form-horizontal style-form" action="controller-sistema/investimento.php" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">ATUALIZAR PREÇO DE INVESTIMENTO POR KVR</h4>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Novo preço</label>
                      <div class="col-sm-10">
                        <input type="text" name="preco" class="form-control">
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                  </div>
                </div>
              </form>
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

</body>

</html>
