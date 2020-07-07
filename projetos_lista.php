<?php require_once 'global.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '_head.php'; ?>

<body>
  <section id="container">

    <?php require_once '_nav_superior.php'; ?>

    <?php require_once '_nav_lateral.php'; ?>

    <?php $projetos = Projeto::listar_projeto_usuario(0); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-archive"></i> PAINEL DE PROJETOS</h3>

        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> PROJETOS CADASTRADOS</h4>
                <hr>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>TÍTULO</th>
                    <th>TENSÃO</th>
                    <th>TIPO</th>
                    <th>FP DESEJADO </th>
                    <th>OPÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($projetos as $x): ?>
                    <tr>
                      <td><?= $x['id'] ?></td>
                      <td><?= $x['titulo'] ?></td>
                      <td><?= $x['tensao'] ?></td>

                      <?php if($x['tipo']==='existente'){ ?>
                        <td><span class="label label-primary" style="font-size:9pt;"> <i class="fa fa-file-text-o"> </i> EXISTENTE</span></td>
                      <?php }else{ ?>
                        <td><span class="label label-success" style="font-size:9pt;"> <i class="fa fa-file-o"></i> NOVO</span></td>
                      <?php } ?>
                      <td><?= $x['fp_desejado'] ?></td>

                      <?php if($x['tipo']==='existente'){ ?>
                        <td>
                          <a href="projeto_existente.php?id=<?= $x['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a>
                        </td>
                      <?php }else{ ?>
                        <td>
                          <a href="projeto_novo.php?id=<?= $x['id'] ?>" class="btn btn-success btn-xs"><i class="fa fa-folder-open"></i></a>
                        </td>
                      <?php } ?>
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
