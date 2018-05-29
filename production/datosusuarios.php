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
     if ($_SESSION['registrado']->getPermiso() != 3){

       echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

     }

     /*Si hemos recargado la página pasándo por url una variable ticket*/
     if (isset($_GET['ticket'])){

     		/*Abrimos una conexión hacia la base de datos*/
        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

            /*Obtenemos los valores pasados por url*/
            $id = $_GET['ticket'];
            $tecnico = $_GET['tecnico'];

            /*Utilizamos esta comprobación para no cambiar el valor Sin Asignar en la base de datos*/
            if ($tecnico == "Usuario actual = Sin Asignar"){

              $tecnico = "Sin Asignar";
            }

            /*Si la actualización de datos funciona correctamente*/
            if($query = $mysqli->query("UPDATE `ticket` SET `tecnico`='$tecnico' WHERE `id` = '$id' ")){

              /*Cerramos la conexión con la base de datos*/
              $mysqli->close();

              /*Vaciamos las variables GET*/
              unset($_GET['ticket']);
              unset($_GET['tecnico']);

              /*Le indicamos al usuario que los datos han sido actualizados y lo mandamos a la página de nuevo*/
              echo '<script language="javascript">alert("Ticket re-asignado correctamente");</script>';
              echo "<script> window.location.href='datosusuarios.php'</script>";
            }else{

              /*En caso de que falle la actualización de datos, se lo indicamos y volvemos a la página*/
              echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
              echo "<script> window.location.href='datosusuarios.php'</script>";
            }

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

    <title>Portal distribución de trabajo</title>

    <!-- Estilos de la plantilla descargada -->
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script>

      /*Al cargar la página se crea un evento onClic en todos los botones, el cual recargará la página enviando los datos
      del ticket sobre el cual se ha clicado, para re-asignarlo*/
      $(document).ready(function(){
        $("button").click(function(){
          id = $(this).parents("tr").find("td").eq(1).html();
          tecnico = $(this).parents("tr").find("select").val();
          url = "datosusuarios.php?ticket="+id+"&tecnico="+tecnico;
          location.href=url;
        });
      });

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
              <div class="profile_pic">
              	<!-- Obtenemos el icono del usuario registrado -->
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
                  <li><a href="#"><i class="fa fa-home"></i> Re-asignar incidencias</span></a>
                  </li>
                  <li><a href="modificarusuarios.php"><i class="fa fa-edit"></i> Modificar usuarios</span></a>
                  </li>
                  <li><a href="crearusuarios.php"><i class="fa fa-edit"></i> Crear usuarios</span></a>
                  </li>
                  <li><a href="eliminarusuarios.php"><i class="fa fa-edit"></i> Eliminar usuarios</span></a>
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
		                      <a href="editarperfiladministrador.php">
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
                <h3>Portal de administrador <small>Gestión de usuarios</small></h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Distribución de trabajo</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- Inicio de tabla -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">ID ticket</th>
                          <th>Tipo</th>
                          <th>Título</th>
                          <th>Técnico</th>
                          <th>Estado</th>
                          <th>Fecha apertura</th>
                          <th>Solicitante</th>
                          <th>Impresora asociada</th>
                          <th>Equipo asociado</th>
                          <th>Servidor asociado</th>
                          <th>Re-asignar Ticket</th>
 
                        </tr>
                      </thead>

                      <?php 
                      			  /*Abrimos conexión con la base de datos*/
                              $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                              $mysqli->set_charset("utf8");
                                  
                                  /*Seleccionamos todos los tickets que estén Abiertos*/
                                  $query = $mysqli->query("SELECT * FROM `ticket` WHERE `estado`= 'Abierta' ORDER BY `tipo` = 'solicitud'");

                                  /*Incializamos el cuepo de la tabla*/
                                  echo "<body>";
                                  /*Mientras existan datos a recorrer en la búsqueda*/
                                  while($fila = $query->fetch_array(MYSQLI_NUM)){

                                  	   /*Vamos generando filas en la tabla con los datos que nos interesan.*/
                                       echo "<tr>";
                                          echo "<td> # </td>";
                                          echo "<td>".$fila[0]."</td>";
                                          echo "<td>".$fila[1]."</td>";
                                          echo "<td>".$fila[2]."</td>";
                                          echo "<td><select>";

                                          		 /*Creamos una segunda conexión a la base de datos*/
                                              $mysqli2 = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                              $mysqli2->set_charset("utf8");


                                                    /*Hacemos 2 consultas igual para utilizarlas luego*/
                                                    $usuarios = $mysqli2->query("SELECT `email` FROM `usuario` WHERE `permiso` = 2");
                                                    $test2 = $mysqli2->query("SELECT `email` FROM `usuario` WHERE `permiso` = 2");

                                                    				  /*Guardamos los datos de una consulta*/
                                                                      $testDatos = $test2->fetch_array(MYSQLI_NUM);

                                                                      /*Si la consulta ha devuelto algún valor*/
                                                                      if ($testDatos[0] != ""){

                                                                          /*Primero mostramos el usuario el cual actualmente tiene asignado el ticket y luego mostramos una
                                                                          segunda opción para dejarlo sin Asignar, finalmente mostramos todos los usuarios tipo técnico en el select*/
                                                                          echo "<option>"."Usuario actual = ".$fila[3]."</option>";
                                                                          echo "<option>"."Sin Asignar"."</option>";

                                                                          while($fila2 = $usuarios->fetch_array(MYSQLI_NUM)){

                                                                            echo "<option>".$fila2[0]."</option>";

                                                                          }

                                                                      }else{

                                                                      	/*En caso de que no haya usuarios técnicos no podremos asigar el ticket*/
                                                                        echo "<option>"."Sin Asignar"."</option>";
                                                                        
                                                                      }
                                                    
                                                                          /*Cerramos la conexión con la base de datos*/
                                                                          $mysqli2->close();


                                          echo "</select></td>";
                                          /*Vamos generando filas en la tabla con los datos que nos interesan.*/
                                          echo "<td>".$fila[4]."</td>";
                                          echo "<td>".$fila[6]."</td>";
                                          echo "<td>".$fila[7]."</td>";
                                          echo "<td>".$fila[8]."</td>";
                                          echo "<td>".$fila[9]."</td>";
                                          echo "<td>".$fila[10]."</td>";
                                          echo '<td><button>Re-asignar ticket</button></td>';
                                        echo "</tr>";

                                  }

                                  /*Cerrramos la tabla*/
                                  echo "</body>";
                                  echo "</table>";
                                  /*Cerramos la conexión con la base de datos*/
                                  $mysqli->close();
                              ?>


                    <!-- Fin de la Tabla -->

                  </div>
                </div>
              </div>
            </div>
        
        <!-- /Fin del contenido -->


      </div>
    </div>

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
