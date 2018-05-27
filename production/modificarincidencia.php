 <?php
/*Se incluyen los ficheros necesarios*/
include_once('funciones.php');
session_start();


     if (!isset($_SESSION['registrado'])){

        echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

     }

     if ($_SESSION['registrado']->getPermiso() != 2){

       echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

     }

     if (!isset($_GET['ticket'])){

      echo '<script language="javascript">alert("No puede modifar un ticket sin seleccionarlo, le redirigimos a la página de gestión");</script>';
      echo "<script language='javascript'> window.location.href='incidenciasasignadas.php';</script>";
      
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

    <title>Portal resolución tickets</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

      <script>

      /*Esta es la función que valida las contraseñas*/
      function validar(){


      var estado = document.getElementById("estado");
      var boton = document.getElementById("botonS");
      var error = document.getElementById("error");
      var error2 = document.getElementById("error2");
      var resolucion = document.getElementById("resolucion");



          if (estado.value == "Cerrada" && resolucion.value == ""){
            /*Se le inserta un texto*/
            error2.innerHTML = "Cambie el estado a abieta o introduzca resolucion y haga clic fuera del formulario para poder guardar los cambios";
            boton.disabled = true;
            
          }else if (resolucion.value != "" && estado.value == "Abierta"){

            /*Se le inserta un texto*/
            error.innerHTML = "Cambie el estado a cerrado y haga clic fuera del formulario para poder cerrar el ticket";
            boton.disabled = true;

          }else if(estado.value == "Abierta" && resolucion.value == ""){

            error2.innerHTML = " ";
            boton.disabled = false;


          }else{

            error2.innerHTML = " ";
            error.innerHTML = " ";
            boton.disabled = false;

          }
         
      }

    </script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-cogs"></i> <span>Bienvenido!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_pic">
                <img src='<?php echo $_SESSION["registrado"]->getIcono()?>' alt="..." class="img-circle profile_img">
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
                  <li><a href="incidenciassinasignar.php"><i class="fa fa-home"></i> Tickets sin asignar</span></a>
                  </li>
                  <li><a href="incidenciasasignadas.php"><i class="fa fa-edit"></i> Ver tickets pendientes</span></a>
                  </li>
                  <li><a href="verusuariosregistrados.php"><i class="fa fa-edit"></i> Datos de usuarios</span></a>
                  </li>
                  <li><a href="verimpresoras.php"><i class="fa fa-edit"></i> Inventario Impresoras</span></a>
                  </li>
                  <li><a href="verequipos.php"><i class="fa fa-edit"></i> Inventario Equipos</span></a>
                  </li>
                  <li><a href="verservidores.php"><i class="fa fa-edit"></i> Inventario Servidores</span></a>
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
                    <img src='<?php echo $_SESSION["registrado"]->getIcono()?>' alt=""><?php echo cortarNombre($_SESSION['registrado']->getEmail())?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="editarperfiltecnico.php">
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
            <div class="page-title">
              <div class="title_left">
                <h3>Portal técnico <small>Gestión de tickets</small></h3>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Gestión de ticket</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                          <div class="right_col" role="main">
                            <div class="">
                              <div class="clearfix"></div>

                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div class="x_panel">
                                    <div class="x_title">
                                      <h2>Perfil técnico</h2>
                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <form enctype="multipart/form-data" action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del ticket</span>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['ticket']?>' disabled></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solicitante">Usuario solicitante <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="solicitante" name="solicitante" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['solicitante']?>' disabled></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Título <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="titulo" name="titulo" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['titulo']?>' disabled></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="estado" name="estado" onblur="validar()">
                                                
                                                <option>Abierta</option>
                                                <option>Cerrada</option>

                                              </select>

                                          </div>
                                          
                                        </div>

                                        <center><p id="error" style="color:red"></p></center>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipo">Equipo <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="equipo" name="equipo">
                                                
                                                <?php 

                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");



                                                    $equipo = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `equipo` WHERE `usuarioAsignado` = '$_GET[solicitante]'");


                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `equipo` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);
                                                                      


                                                                      if ($testDatos[0] != ""){

                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $equipo->fetch_array(MYSQLI_NUM)){

                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";

                                                                           
                                                                          }



                                                                      }else{


                                                                        echo "<option>"."No corresponde"."</option>";
                                                                        

                                                                      }
                                                    
                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli->close();

                                                ?>

                                              </select>

                                          </div>
                                        </div>



                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="impresora">Impresora <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="impresora" name="impresora">
                                                
                                                <?php 

                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");


                                                    $impresora = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `impresora` WHERE `usuarioAsignado` = '$_GET[solicitante]'");
                                          
                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `impresora` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);
                                                                      


                                                                      if ($testDatos[0] != ""){

                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $impresora->fetch_array(MYSQLI_NUM)){

                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";

                                                                           
                                                                          }


                                                                      }else{


                                                                        echo "<option>"."No corresponde"."</option>";
                                                                        

                                                                      }

                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli->close();

                                                ?>

                                              </select>

                                          </div>
                                        </div>
                    

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servidor">Servidor <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="servidor" name="servidor">
                                                
                                                <?php 

                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");


                                                    $servidor = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `servidor` WHERE `usuarioAsignado` = '$_GET[solicitante]'");
                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `servidor` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);


                                                                      if ($testDatos[0] != ""){

                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $servidor->fetch_array(MYSQLI_NUM)){

                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";

                                                                           
                                                                          }


                                                                      }else{


                                                                        echo "<option>"."No corresponde"."</option>";
                                                                        

                                                                      }


                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli->close();

                                                ?>

                                              </select>

                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resolucion">Resolucion <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="resolucion" name="resolucion" class="form-control col-md-7 col-xs-12" maxlength="250" onblur="validar()"></textarea>
                                          </div>
                                        </div>
                                        <center><p id="error2" style="color:red"></p></center>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!--<button class="btn btn-primary">Cancelar</button>-->
                                            <button type="submit" id="botonS" type="submit" name="botonS" class="btn btn-danger">Guardar cambios</button>
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
  
      /*Si se ha pulsado el botón de registro*/
      if (isset($_POST['botonS'])){



            /*Se almacenan las variables que necesitaremos guardar luego en la base de datos*/
            $id = $_GET['ticket'];
            $estado = $_POST['estado'];
            $resolucion = $_POST['resolucion'];
            $fechaCierre = "0000-00-00 00:00:00";

            if($_POST['equipo']!= "No corresponde"){

            $equipo = obtenerNumeroSerie($_POST['equipo']);

            }else{

              $equipo = 'NULL';

            }

            if($_POST['impresora']!= "No corresponde"){

            $impresora = obtenerNumeroSerie($_POST['impresora']);

            }else{

              $impresora = 'NULL';
              
            }
            
            if($_POST['servidor']!= "No corresponde"){

            $servidor = obtenerNumeroSerie($_POST['servidor']);

            }else{

              $servidor = 'NULL';
              
            }

            if ($estado == "Cerrada"){
              
              $fechaCierre = new DateTime();
              $fechaCierre = $fechaCierre->format('Y-m-d H:i:s');
            }

            $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
            $mysqli->set_charset("utf8");


            /*Mediante las variables declaradas al principio y en las líneas anteriores, actualizamos los datos del usuario en la base de datos*/
            if($query = $mysqli->query("UPDATE `ticket` SET `equipo_numeroDeSerie`=$equipo,`impresora_numeroDeSerie`=$impresora,`servidor_numeroDeSerie`= $servidor, `estado`='$estado', `resolucion`='$resolucion',`fecha_cierre`='$fechaCierre' WHERE `id` = '$id'")){


            /*Cerramos la conexión con la base de datos*/
            $mysqli->close();

            /*Le indicamos al usuario que los datos han sido actualizados y lo mandamos a la página de inicio*/
            echo '<script language="javascript">alert("Cambios realizados correctamente");</script>';
            echo "<script> window.location.href='incidenciasasignadas.php'</script>";
          }else{
            
            echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
            echo "<script> window.location.href='incidenciasasignadas.php'</script>";
          }
                
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
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
