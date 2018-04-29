<?php
  /*Incluimos el fichero de las funciones*/
  include_once('funciones.php');
  /*Iniciamos la sesión*/
  session_start();
  
?>

<?php

    if (!isset($_SESSION['registrado'])) {
    
          echo "<script> window.location.href='login.php'</script>";

    }

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal del usuario </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Bienvenido!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_pic">
                <img src="images/icono.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo cortarNombre($_SESSION['registrado']->getEmail())?></h2>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php?salir=true">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
            <br />

             <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Abrir ticket <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="abririncidencia.php">Incidencia</a></li>
                      <li><a href="#">Servicio</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Ver incidencias <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="incidenciaabierta.php">Abiertas</a></li>
                      <li><a href="incidenciacerrada.php">Cerradas</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Ver servicios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="servicioabierto.php">Abierta</a></li>
                      <li><a href="serviciocerrado.php">Cerrada</a></li>

                    </ul>
                  </li>

                </ul>
              </div>
              
            </div>
         
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/icono.png" alt=""><?php echo cortarNombre($_SESSION['registrado']->getEmail())?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="javascript:;">
                        <span>Editar perfil</span>
                      </a>
                    </li>
                    <li><a href="login.php?salir=true"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
     

                 <!-- Add context -->
                          <div class="right_col" role="main">
                            <div class="">
                              <div class="clearfix"></div>

                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div class="x_panel">
                                    <div class="x_title">
                                      <h2>Formulario de ticket</h2>
                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <form action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Solicitud de servicio</span>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">Tipo <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="tipo" name="tipo" class="form-control col-md-7 col-xs-12" value="Servicio" required="required" disabled></input>
                                          </div>
                                        </div>
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solicitante">Solicitante <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="solicitante" name="solicitante" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_SESSION["registrado"]->getEmail()?>' disabled></input>
                                          </div>
                                        </div>
                                        <div>
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">Descripción <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="descripcion" required="required" name="descripcion" class="form-control col-md-7 col-xs-12" maxlength="100"></textarea>
                                          </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!--<button class="btn btn-primary">Cancelar</button>-->
                                            <button type="submit" id="submit" type="submit" name="enviar" class="btn btn-success">Abrir solicitud</button>
                                          </div>
                                          </center>
                                        </div>
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
         
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
        
        <!-- /page content -->

      </div>
    </div>

    <?php
    /*Si se ha pulsado el botón de login*/
    if (isset($_POST['enviar'])){

         $tipo = "solicitud";
         $email = $_SESSION['registrado'] -> getEmail();
         $titulo = $_POST['descripcion'];

         $fecha = new DateTime();
         $fecha = $fecha->format('Y-m-d H:i:s');
         
            $mysqli = new mysqli("localhost","root","1neesf_","bbddhelpdesk");
            $mysqli->set_charset("utf8");

            $mysqli->query("INSERT INTO `ticket`(`tipo`, `titulo`, `fecha_apertura`, `usuario_email_solicitante` ) VALUES ('".$tipo."','".$titulo."','".$fecha."','".$email."')");

            /*Cerramos la conexión con el servidor*/
            $mysqli->close();

            echo '<script language="javascript">alert("Solicitud creada correctamente");</script>';
      }
    ?>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    
    <!--Scripts personalizados -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>



           