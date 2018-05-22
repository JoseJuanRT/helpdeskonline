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

     if (isset($_GET['asignarTicket'])){

            $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
            $mysqli->set_charset("utf8");

            $email = $_SESSION['registrado']->getEmail();
            $id = $_GET['asignarTicket'];

            if($query = $mysqli->query("UPDATE `ticket` SET `tecnico`='$email' WHERE `id` = '$id' ")){

              /*Cerramos la conexión con la base de datos*/
              $mysqli->close();
              unset($_GET['asignarTicket']);

              /*Le indicamos al usuario que los datos han sido actualizados y lo mandamos a la página de inicio*/
              echo '<script language="javascript">alert("Ticket asignado correctamente");</script>';
              echo "<script> window.location.href='incidenciassinasignar.php'</script>";
            }else{
              echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
              echo "<script> window.location.href='incidenciassinasignar.php'</script>";
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

    <title>Portal resolución tickets</title>

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

      $(document).ready(function(){
        $("button").click(function(){
          id = $(this).parents("tr").find("td").eq(1).html();
          url = "incidenciassinasignar.php?asignarTicket="+id;
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
                  <li><a href="#"><i class="fa fa-home"></i> Tickets sin asignar</span></a>
                  </li>
                  <li><a href="incidenciasasignadas.php"><i class="fa fa-edit"></i> Ver tickets pendientes</span></a>
                  </li>
                  <li><a href="verusuariosregistrados.php"><i class="fa fa-edit"></i> Datos de usuarios</span></a>
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
                    <h2>Tickets sin asignar</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">ID ticket</th>
                          <th>Tipo</th>
                          <th>Título</th>
                          <th>Estado</th>
                          <th>Fecha apertura</th>
                          <th>Solicitante</th>
                          <th>Asigar Ticket</th>
                          
                          

                        </tr>
                      </thead>

                      <?php 

                                  $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
                                  $mysqli->set_charset("utf8");
                       
                                  $login = $_SESSION['registrado'] -> getEmail();

                                 
                                  $query = $mysqli->query("SELECT * FROM `ticket` WHERE `estado`= 'Abierta' AND `tecnico`= 'Sin asignar' ORDER BY `tipo` = 'solicitud'");

                                  echo "<body>";
                                  /*Mientras existan datos a recorrer en la búsqueda*/
                                  while($fila = $query->fetch_array(MYSQLI_NUM)){

                                       echo "<tr>";
                                          echo "<td> # </td>";
                                          echo "<td>".$fila[0]."</td>";
                                          echo "<td>".$fila[1]."</td>";
                                          echo "<td>".$fila[2]."</td>";
                                          echo "<td>".$fila[4]."</td>";
                                          echo "<td>".$fila[6]."</td>";
                                          echo "<td>".$fila[7]."</td>";
                                          echo '<td><button>Asignar ticket</button></td>';
                                        echo "</tr>";

                                  }

                                  echo "</body>";
                                  /*Cerrramos la tabla*/
                                  echo "</table>";
                                  /*Cerramos la conexión con la base de datos*/
                                  $mysqli->close();
                              ?>


                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
        
        <!-- /page content -->


      </div>
    </div>


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
