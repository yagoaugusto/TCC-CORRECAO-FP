<?php require_once 'global.php'; ?>
<!DOCTYPE html>
<html lang="pt">

<?php require_once '_head.php'; ?>

<body>
  <section id="container">

    <?php require_once '_nav_superior.php'; ?>

    <?php require_once '_nav_lateral.php'; ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-bolt"></i> SUPER FP - SISTEMA EM NUVEM PARA CORREÇÃO DE FATOR DE POTÊNCIA</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-6 mb">
                <div class="content-panel pn">
                  <div id="profile-01" style="background: url(img/motores.jpg) no-repeat center;">
                    <h3 style="text-shadow: #000 1px 1px 5px;">O PROBLEMA JÁ EXISTE!</h3>
                    <h6 style="text-shadow: #000 1px 1px 5px;">E eu quero resolver</h6>
                  </div>
                  <div class="profile-01 centered">
                    <p data-toggle="modal" data-target="#projeto_existente">CADASTRAR PROJETO EXISTENTE</p>
                  </div>
                  <div class="centered">
                    <h6><i class="fa fa-info-circle"></i><br/>Utilize esta opção para dimensionar a correção de um problema que já existe.</h6>
                  </div>
                </div>
                <!-- /content-panel -->
              </div>

              <div class="modal fade" id="projeto_existente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form class="form-horizontal style-form" action="controller-projeto/existente_projeto.php" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">CONTINUAR COM PROJETO EXISTENTE</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Título do projeto</label>
                          <div class="col-sm-10">
                            <input type="text" name="titulo" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Nível de Tensão</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="tensao">
                              <option value="220">220</option>
                              <option value="380">380</option>
                              <option value="440">440</option>
                              <option value="660">660</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">FP Desejado</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="fp">
                              <option value="0.92">0.92</option>
                              <option value="0.93">0.93</option>
                              <option value="0.94">0.94</option>
                              <option value="0.95">0.95</option>
                              <option value="0.96">0.96</option>
                              <option value="0.97">0.97</option>
                              <option value="0.98">0.98</option>
                              <option value="0.99">0.99</option>
                              <option value="1.0">1.0</option>
                            </select>
                          </div>
                        </div>

                        <input type="hidden" name="tipo" value="existente">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>



              <div class="col-lg-6 col-md-6 col-sm-6 mb">
                <div class="content-panel pn">
                  <div id="profile-01" style="background: url(img/projeto.jpg) no-repeat center;">
                    <h3 style="text-shadow: #000 1px 1px 5px;">O PROJETO É NOVO!</h3>
                    <h6 style="text-shadow: #000 1px 1px 5px;">E quero dimensionar a correção de FP</h6>
                  </div>
                  <div class="profile-01 centered">
                    <p data-toggle="modal" data-target="#novo_projeto">INICIAR NOVO PROJETO</p>
                  </div>
                  <div class="centered">
                    <h6><i class="fa fa-info-circle"></i><br/>Utilize esta opção para dimensionar a correção de uma indústria que ainda está no papel.</h6>
                  </div>
                </div>
                <!-- /content-panel -->
              </div>

              <div class="modal fade" id="novo_projeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form class="form-horizontal style-form" action="controller-projeto/novo_projeto.php" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">CRIAR NOVO PROJETO</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Título do projeto</label>
                          <div class="col-sm-10">
                            <input type="text" name="titulo" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Quant CCM</label>
                          <div class="col-sm-10">
                            <input type="text" name="ccm" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Nível de Tensão</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="tensao">
                              <option value="220">220</option>
                              <option value="380">380</option>
                              <option value="440">440</option>
                              <option value="660">660</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">FP Desejado</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="fp">
                              <option value="0.92">0.92</option>
                              <option value="0.93">0.93</option>
                              <option value="0.94">0.94</option>
                              <option value="0.95">0.95</option>
                              <option value="0.96">0.96</option>
                              <option value="0.97">0.97</option>
                              <option value="0.98">0.98</option>
                              <option value="0.99">0.99</option>
                              <option value="1.0">1.0</option>
                            </select>
                          </div>
                        </div>

                        <input type="hidden" name="tipo" value="novo">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

            </div>



            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="custom-box">
                  <div class="servicetitle">
                    <h4>ALUNO DESENVOLVEDOR</h4>
                    <hr>
                  </div>
                  <!-- <div class="icn-main-container">
                  <span class="icn-container">$25</span>
                </div> -->
                <p><b>YAGO AUGUSTO COSTA PEREIRA</b></p>
                <ul class="pricing">
                  <li>yagoacp@gmail.com</li>
                  <li>(98)991668283</li>
                </ul>
              </div>
              <!-- end custombox -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="custom-box">
                <div class="servicetitle">
                  <h4>PROFESSOR ORIENTADOR</h4>
                  <hr>
                </div>
                <!-- <div class="icn-main-container">
                <span class="icn-container">$25</span>
              </div> -->
              <p><b>FELIPE BORGES</b></p>
              <ul class="pricing">
                <li>felipe.borges.28@gmail.com</li>
                <li>(98)981926006</li>
              </ul>
            </div>
            <!-- end custombox -->
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

</body>

</html>
