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

     /*Si no se ha inicializado la variable ticket por url devolvemos a la página original*/
     if (!isset($_GET['ticket'])){

     	echo '<script language="javascript">alert("No puede gestionar el inventario sin seleccionarlo, le redirigimos a la página de gestión");</script>';
     	echo "<script language='javascript'> window.location.href='verequipos.php';</script>";
     	
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
                    <h2>Gestión de inventario</h2>
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

                                      <!-- Creamos formulario -->
                                      <form method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del item</span>

                                        <!-- ID del item actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_GET['ticket']?>' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Marca item actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca">Marca <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="marca" name="marca" class="form-control col-md-7 col-xs-12" value='<?php echo obtenerMarcaEquipo($_GET['ticket'])?>'></input>
                                          </div>
                                        </div>

                                        <!-- SO item actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="so">Sistema Operativo <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="so" name="so" class="form-control col-md-7 col-xs-12" value='<?php echo obtenerSoEquipo($_GET['ticket'])?>'></input>
                                          </div>
                                        </div>

                                        <!-- Modelo item actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelo">Modelo <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="modelo" name="modelo" class="form-control col-md-7 col-xs-12" value='<?php echo obtenerModeloEquipo($_GET['ticket'])?>'></input>
                                          </div>
                                        </div>                                        

                                        <!-- Estado item actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="estado" name="estado">

                                                <?php 

                                                  /*De esta manera mostramos el estado correcto*/
                                                  if (obtenerEstadoEquipo($_GET['ticket']) == "En Stock") {
                                                   
                                                        echo "<option>En Stock</option>";
                                                        echo "<option>En Uso</option>";

                                                  }else{

                                                        echo "<option>En Uso</option>";
                                                        echo "<option>En Stock</option>";
                                                  }

                                                 

                                                 ?>

                                              </select>

                                          </div>
                                          
                                        </div>

                                        <center><p id="error" style="color:red"></p></center>

                                        <!-- Usuario asignado al item actual -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usuario">Usuario asignado <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                         
                                              <select id="usuario" name="usuario">
                                                
                                                <?php 

                                                 /*Abrimos conexión a la base de datos*/
                                                  $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                                  $mysqli->set_charset("utf8");


                                                    /*Hacemos 2 consultas igual para utilizarlas luego*/
                                                    $usuario = $mysqli->query("SELECT `email` FROM `usuario`");
                                                    $test = $mysqli->query("SELECT `email` FROM `usuario`");

                                                                      /*Guardamos los datos de una consulta*/
                                                                      $testDatos = $test->fetch_array(MYSQLI_NUM);

                                                                      /*Si la consulta ha devuelto algún valor*/
                                                                      if ($testDatos[0] != ""){

                                                                          /*Motramos primero el usuario que tiene el item asignado*/
                                                                          echo "<option>"."Usuario actual = ".$_GET['user']."</option>";
                                                                          /*Opción para dejar el item sin asignar*/
                                                                          echo "<option>"."Sin Asignar"."</option>";

                                                                          while($fila = $usuario->fetch_array(MYSQLI_NUM)){
                                                                            /*Luego siempre que exista algun usuario asociado al item, 
                                                                            procedemos a mostrarlo como disponible para asociar.*/
                                                                            echo "<option>".$fila[0]."</option>";

                                                                          }

                                                                      }else{

                                                                        /*Si ningún usuario tiene el item asignado se motrará*/
                                                                        echo "<option>"."Sin Asignar"."</option>";
                                                                        
                                                                      }
                                                    
                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli->close();

                                                ?>

                                              </select>

                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ip">IP <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="ip" name="ip" class="form-control col-md-7 col-xs-12" maxlength="16" value='<?php echo obtenerIpEquipo($_GET['ticket'])?>' onblur="validar()" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}.(?:\d|[12]\d|3[01])$" title="Debes introducir una IP válida xxx.xxx.xxx.xxx"></input>
                                          </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                            <!-- Botón para guardar cambios -->
                                          <div class="col-md-6 col-md-offset-3">
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
            $marca = $_POST['marca'];
            $so = $_POST['so'];
            $modelo = $_POST['modelo'];
            $estado = $_POST['estado'];
            $usuario = $_POST['usuario'];
            $usuarioOriginal = "Usuario actual = ".$_GET['user'];
            $ip = $_POST['ip'];

            /*Si lesta vacio rellenamos con valor por defecto*/
            if($marca == ""){

            $marca = "Sin marca";

            }

            /*Si lesta vacio rellenamos con valor por defecto*/
            if($so == ""){

            $so = "Sin sistema operativo";

            }

            /*Si lesta vacio rellenamos con valor por defecto*/
            if($modelo == ""){

            $modelo = "Sin modelo";

            }

            /*Si lesta vacio rellenamos con valor por defecto*/
            if($ip == ""){

            $ip = "255.255.255.255";

            }

            /*Si el usuario es el mismo lo dejamos como esta*/
            if ($usuario == $usuarioOriginal){
                  
              $usuario = $_GET['user'];

            }          

            /*Creamos una segunda conexión a la base de datos*/
             $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
             $mysqli->set_charset("utf8");


            /*Mediante las variables declaradas al principio y en las líneas anteriores, actualizamos los datos del item en la base de datos*/
            if($query = $mysqli->query("UPDATE `equipo` SET `nombre`='$marca', `so`='$so', `modelo`= '$modelo', `estado`='$estado', `usuarioAsignado`='$usuario', `ip`= '$ip' WHERE `numeroDeSerie` = '$id'")){

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
