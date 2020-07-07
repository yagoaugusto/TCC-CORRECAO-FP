<?php require_once 'global.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '_head.php'; ?>

<body>
  <section id="container">

    <?php require_once '_nav_superior.php'; ?>

    <?php require_once '_nav_lateral.php'; ?>

    <?php $motores = Motores::listar_motores(); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-cogs"></i> PAINEL DE MOTORES</h3>

        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> BANCO DE MOTORES DISPONÍVEIS</h4>
                <hr>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>DESCRIÇÃO</th>
                    <th>TENSÃO</th>
                    <th>POLOS</th>
                    <th>CV</th>
                    <th>CONJUGADO PART</th>
                    <th>CONJUGADO MÁX</th>
                    <th>ROTAÇÃO</th>
                    <th>N</th>
                    <th>FP</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($motores as $x): ?>
                    <tr>
                      <td><?= $x['id'] ?></td>
                      <td><?= $x['descricao'] ?></td>
                      <td><?= $x['tensao'] ?></td>
                      <td><?= $x['polos'] ?></td>
                      <td><?= $x['cv'] ?></td>
                      <td><?= $x['conjugado_partida']*100 ?>%</td>
                      <td><?= $x['conjugado_maximo']*100 ?>%</td>
                      <td><?= $x['rotacao'] ?></td>
                      <td><?= $x['n'] ?></td>
                      <td><?= $x['fp'] ?></td>
                    </tr>
                  <?php endforeach ?>
                </table>
              </div>
              <!-- /content-panel -->
            </div>
            <!-- /col-md-12 -->
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
