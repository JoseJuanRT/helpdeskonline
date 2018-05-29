 <?php
/*Se incluyen los ficheros necesarios y se incia sesión*/ /*Done*/
include_once('funciones.php');
session_start();

     /*Controlamos que exista una sesión de usuario*/
     if (!isset($_SESSION['registrado'])){

        echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

     }
     /*Controlamos que el usuario tenga los permisos correspondientes, 
     en caso de que fuese otro usuario el que intenta acceder a la página lo enviamos al login dónde se le cerrará la sesión.*/
     if ($_SESSION['registrado']->getPermiso() != 2){

       echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

     }

     /*Si hemos recargado la página sin pasar por url una variable ticket*/
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

    <!-- Estilos de la plantilla descargada -->
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

      /*Obtenemos los valores actuales*/
      var estado = document.getElementById("estado");
      var boton = document.getElementById("botonS");
      var error = document.getElementById("error");
      var error2 = document.getElementById("error2");
      var resolucion = document.getElementById("resolucion");


          /*Obligamos a rellenar la resolución cuando un ticket se cierra*/
          if (estado.value == "Cerrada" && resolucion.value == ""){
  
            error2.innerHTML = "Cambie el estado a abieta o introduzca resolucion y haga clic fuera del formulario para poder guardar los cambios";
            boton.disabled = true;
          
          /*Obligamos a cerrar un ticket si se rellena la resolución*/
          }else if (resolucion.value != "" && estado.value == "Abierta"){

            error.innerHTML = "Cambie el estado a cerrado y haga clic fuera del formulario para poder cerrar el ticket";
            boton.disabled = true;

          /*Si esta abierta sin resolución, limpiamos errores*/
          }else if(estado.value == "Abierta" && resolucion.value == ""){

            error2.innerHTML = " ";
            boton.disabled = false;

          }else{

            /*Limpiamos posibles errores anteriores y activamos el botón*/
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

            <!-- Saludo al usuario -->
            <div class="profile clearfix">
              <!-- Obtenemos el icono del usuario registrado -->
              <div class="profile_pic">
                <img src='<?php echo $_SESSION["registrado"]->getIcono()?>' alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <!-- Separamos el nombre del usuario del dominio de correo para mosrar sólo el nombre -->
                <h2><?php echo cortarNombre($_SESSION['registrado']->getEmail())?></h2>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php?salir=true">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /Saludo al usuario -->
            <br />

            <!-- Menu botonoes izquierdo -->
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
                  <li><a href="crearequipos.php"><i class="fa fa-edit"></i> Alta de equipos</span></a>
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

        <!-- Barra superior -->
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

        <!-- /Barra superior -->

        <!-- Contenido de la página -->
     
          <!-- Añadir contenido -->

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Portal de técnico <small>Gestión de tickets</small></h3>
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

                                      <!-- Creamos formulariotipo multipart/form-data -->
                                      <form enctype="multipart/form-data" action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del ticket</span>

                                        <!-- ID del ticket actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['ticket']?>' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Email del ticket actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solicitante">Usuario solicitante <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="solicitante" name="solicitante" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['solicitante']?>' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Titulo del ticket actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Título <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="titulo" name="titulo" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['titulo']?>' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Estado del ticket actual -->
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

                                        <!-- Párrafo de error1 -->
                                        <center><p id="error" style="color:red"></p></center>

                                        <!-- Select del Equipo del ticket actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="equipo">Equipo <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="equipo" name="equipo">
                                                
                                                <?php 

                                                    /*Abrimos conexión a la base de datos*/
                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");

                                                    /*Hacemos 2 consultas igual para utilizarlas luego*/
                                                    $equipo = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `equipo` WHERE `usuarioAsignado` = '$_GET[solicitante]'");
                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `equipo` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      /*Guardamos los datos de una consulta*/
                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);

                                                                      /*Si la consulta ha devuelto algún valor*/
                                                                      if ($testDatos[0] != ""){

                                                                          /*Motramos primero la opción de no corresponde*/
                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $equipo->fetch_array(MYSQLI_NUM)){

                                                                            /*Luego siempre que exista algun item asociado al usuario, 
                                                                            procedemos a mostrarlo como disponible para asociar al caso.*/
                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";
                                                                           
                                                                          }

                                                                      }else{

                                                                        /*En el caso de que no tenga ningún item asociado solo mostramos la opción de no corresponde*/
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

                                                 /*Abrimos conexión a la base de datos*/
                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");

                                                    /*Hacemos 2 consultas igual para utilizarlas luego*/
                                                    $impresora = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `impresora` WHERE `usuarioAsignado` = '$_GET[solicitante]'");
                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `impresora` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      /*Guardamos los datos de una consulta*/
                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);
                                                                      
                                                                      /*Si la consulta ha devuelto algún valor*/
                                                                      if ($testDatos[0] != ""){

                                                                          /*Motramos primero la opción de no corresponde*/
                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $impresora->fetch_array(MYSQLI_NUM)){

                                                                            /*Luego siempre que exista algun item asociado al usuario, 
                                                                            procedemos a mostrarlo como disponible para asociar al caso.*/
                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";
                                                                           
                                                                          }

                                                                      }else{

                                                                        /*En el caso de que no tenga ningún item asociado solo mostramos la opción de no corresponde*/
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

                                                    /*Creamos una segunda conexión a la base de datos*/
                                                    $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                    $mysqli->set_charset("utf8");

                                                    /*Hacemos 2 consultas igual para utilizarlas luego*/
                                                    $servidor = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `servidor` WHERE `usuarioAsignado` = '$_GET[solicitante]'");
                                                    $test = $mysqli->query("SELECT `nombre`,`modelo`,`numeroDeSerie` FROM `servidor` WHERE `usuarioAsignado` = '$_GET[solicitante]'");

                                                                      /*Guardamos los datos de una consulta*/
                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);

                                                                      /*Si la consulta ha devuelto algún valor*/
                                                                      if ($testDatos[0] != ""){

                                                                          /*Motramos primero la opción de no corresponde*/
                                                                          echo "<option>"."No corresponde"."</option>";
                                                                          while($fila = $servidor->fetch_array(MYSQLI_NUM)){

                                                                            /*Luego siempre que exista algun item asociado al usuario, 
                                                                            procedemos a mostrarlo como disponible para asociar al caso.*/
                                                                            echo "<option>".$fila[0].",".$fila[1].",".$fila[2]."</option>";
                                                                           
                                                                          }

                                                                      }else{

                                                                        /*En el caso de que no tenga ningún item asociado solo mostramos la opción de no corresponde*/
                                                                        echo "<option>"."No corresponde"."</option>";
                                                                        
                                                                      }

                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli->close();

                                                ?>

                                              </select>

                                          </div>
                                        </div>

                                        <!-- Creamos un text area para introducir la resolución-->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resolucion">Resolucion <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="resolucion" name="resolucion" class="form-control col-md-7 col-xs-12" maxlength="250" onblur="validar()"></textarea>
                                          </div>
                                        </div>
                                        <!--Párrafo de error 2-->
                                        <center><p id="error2" style="color:red"></p></center>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!--Botón para guardar cambios-->
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


                    <!-- Fin de la Tabla -->

                  </div>
                </div>
              </div>
            </div>
        
        <!-- /Fin del contenido -->


      </div>
    </div>

    <?php
  
      /*Si se ha pulsado el botón*/
      if (isset($_POST['botonS'])){

            /*Se almacenan las variables que necesitaremos guardar luego en la base de datos*/
            $id = $_GET['ticket'];
            $estado = $_POST['estado'];
            $resolucion = $_POST['resolucion'];
            $fechaCierre = "0000-00-00 00:00:00";

            /*Si se ha seleccionado un item asociado al usuario*/
            if($_POST['equipo']!= "No corresponde"){

            /*Obtenemos el número de serie del Item*/
            $equipo = obtenerNumeroSerie($_POST['equipo']);

            }else{

              /*En caso contrario se establece a NULL*/
              $equipo = 'NULL';

            }

            /*Si se ha seleccionado un item asociado al usuario*/
            if($_POST['impresora']!= "No corresponde"){

            /*Obtenemos el número de serie del Item*/
            $impresora = obtenerNumeroSerie($_POST['impresora']);

            }else{

              /*En caso contrario se establece a NULL*/
              $impresora = 'NULL';
              
            }
            
            /*Si se ha seleccionado un item asociado al usuario*/
            if($_POST['servidor']!= "No corresponde"){

            /*Obtenemos el número de serie del Item*/
            $servidor = obtenerNumeroSerie($_POST['servidor']);

            }else{

              /*En caso contrario se establece a NULL*/
              $servidor = 'NULL';
              
            }

            /*Si el estado del ticket es Cerrada*/
            if ($estado == "Cerrada"){
            	
              /*Ejecutamos un valor de fecha*/
            	$fechaCierre = new DateTime();
         			$fechaCierre = $fechaCierre->format('Y-m-d H:i:s');
            }

            /*Creamos una segunda conexión a la base de datos*/
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

    <!-- JavaScript de la plantilla descargada -->
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
