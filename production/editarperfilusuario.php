<?php
  /*Se incluyen los ficheros necesarios y se incia sesión*/ /*Done*/
  include_once('funciones.php');
  /*Iniciamos la sesión*/
  session_start();
  
    /*Controlamos que exista una sesión de usuario*/
    if (!isset($_SESSION['registrado'])) {
    
          echo "<script> window.location.href='login.php?salir=true'</script>";

    }

    /*Controlamos que el usuario tenga los permisos correspondientes, 
     en caso de que fuese otro usuario el que intenta acceder a la página lo enviamos al login dónde se le cerrará la sesión.*/
    if ($_SESSION['registrado']->getPermiso() != 3){

       echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

    }

    /*Si hemos recargado la página pasándo por url una variable user*/
     if (isset($_GET['user'])){

            /*Abrimos una conexión hacia la base de datos*/
            $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
            $mysqli->set_charset("utf8");

            /*Obtenemos los valores pasados por url*/
            $id = $_GET['user'];

            /*Seleccionamos todos los datos del usuario*/
            $query = $mysqli->query("SELECT * FROM `usuario` WHERE `email`= '$id'");

                    /*Variables para almacenar los datos que están en la base de datos*/
                    $emailOriginal;
                    $contrasenyaOriginal;
                    $permisoOriginal;
                    $iconoOriginal;
                    $departamentoOriginal;
                    $telefonoOriginal;
                                 
                    /*Almacenamos los datos del usuario*/
                    while($fila = $query->fetch_array(MYSQLI_NUM)){

                      $emailOriginal = $fila[0];
                      $contrasenyaOriginal = $fila[1];
                      $permisoOriginal = $fila[2];
                      $iconoOriginal = $fila[3];
                      $departamentoOriginal = $fila[4];
                      $telefonoOriginal = $fila[5];

                    }

        }else{

          /*Si no se ha recibido una variable por url, re-dirigimos hacia la página original*/
          echo "<script language='javascript'> window.location.href='modificarusuarios.php';</script>";
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

    <title>Portal de administrador </title>

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

      /*Esta función será necesaria para validar el campo de la contraseña*/
      function funcionesRegistro(){

          var password = document.getElementById("password");
          var password2 = document.getElementById("password2");
          var error = document.getElementById("error");
      }

      /*Esta es la función que valida las contraseñas*/
      function validar(){

        /*Obtenemos los valores actualizados mediante la función anterior*/
        funcionesRegistro();

          if (password.value != password2.value){
            /*Se le inserta un texto*/
            error.innerHTML = "Las contraseñas no coinciden, introduzca la misma contraseña y haga clic fuera del formulario para poder guardar los cambios.";
            /*Deshabilitamos el botón del formulario*/
            botonS.disabled = true;
            
          }else{
            error.innerHTML = " ";
            botonS.disabled = false;

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
                  <li><a href="datosusuarios.php"><i class="fa fa-edit"></i> Re-asignar incidencias</span></a>
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
                              <div class="clearfix"></div>
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div class="x_panel">
                                    <div class="x_title">
                                      <h2>Perfil de administrador</h2>
                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <!-- Creamos formulariotipo multipart/form-data -->
                                      <form enctype="multipart/form-data" action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del perfil</span>

                                        <!-- Email del usuario pasado por url -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Usuario <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $emailOriginal ?>'' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Departamento del usuario pasado por url -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="departamento" name="departamento" class="form-control col-md-7 col-xs-12" value='<?php echo $departamentoOriginal ?>'></input>
                                          </div>
                                        </div>

                                        <!-- Teléfono del usuario pasado por url -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono" >Teléfono <span class="required">(+34) *</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="telefono" name="telefono"  maxlength="9" class="form-control col-md-7 col-xs-12" pattern="^[0-9]{9}" title="El teléfono debe contener 9 carácteres numéricos, si desconoce el teléfono del usuario puede utilizar el valor 000000000" value='<?php echo $telefonoOriginal ?>'></input>
                                          </div>
                                        </div>

                                        <!-- Input para cargar nuevo icono -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icono">Icono <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type='file' size="512000" id="icono" name="icono" class="form-control col-md-7 col-xs-12"></input>
                                          </div>
                                        </div>

                                        <!-- Permiso del usuario pasado por url -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permiso">Permiso <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type='text' id="permiso" name="permiso" class="form-control col-md-7 col-xs-12" pattern="^[1-3]{1}" title="Introduzca valor correcto: 1-Usuario, 2-técnico, 3-Administrador" value='<?php echo $permisoOriginal ?>'></input>
                                          </div>
                                        </div>

                                        <!-- Input con validación de email "@"" "carácteres despues del punt final", ... 
                                        al sacar el foco valida si es igual qu eel siguiente input y si no lo es muestra un mensaje de error y desactiva el botón,-->
                                        <br>
                                        <p>Si no quiere modificar la contraseña, repita la su contraseña actual en el siguiente campo</p>
                                        <br>
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="password" name="password" class="form-control col-md-7 col-xs-12" pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,20}$" title="Debería tener 8 caracteres alfanuméricos incluyendo mayúsculas y minúsculas" onblur="validar()"></input>
                                            <p id="error" style="color:red"></p>
                                          </div>
                                        </div>
                                        
                                        <!-- Segundo input tipo contraseña del usuario -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password2">Repita contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="password2" name="password2" class="form-control col-md-7 col-xs-12" onblur="validar()"></input>
                                          </div>
                                        </div>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!-- Botón para guardar cambios-->
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
         
                    <!-- Fin del formulario -->

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

      /*Declaramos las variables que nos interesan*/
      $semaforoError = 0;
      $icono = $iconoOriginal;

      /*Abrimos conexión a la base de datos*/
      $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
      $mysqli->set_charset("utf8");

      /*Si se ha subido una image*/
			if($_FILES['icono']['name'] != ""){

				/*Verificamos que no sea más grande de 500KB*/
				if ($_FILES['icono']['size'] > 512000) {

					/*Si es más grande se lo indicamos al usuario y aumentamos la variable semáforo*/
					$semaforoError++;
					echo '<script language="javascript">alert("La imagen solo puede tener 500 KB de peso");</script>';
					
				}else{

					/*Si la imágen cumple con el tamaño, le indicamos la ruta de destino*/
					$destino = "images/";
					/*Creamos un identificador único*/
					$id = time();
					/*Le cambiamos el nombre a la imágen añadiéndole el id único*/
					$_FILES['icono']['name'] = $id.$_FILES['icono']['name'];
					/*Concatenamos el nombre de la imágen a la ruta*/
					$destino = $destino.$_FILES['icono']['name'];

						/*Utilizamos esta función dentro del if para que si es true siga trabajando*/
						if(move_uploaded_file($_FILES['icono']['tmp_name'], $destino)){ 

							/*De esta manera evitamos eliminar el icono por defecto de la carpeta del servidor para los usuarios recién registrados,
							donde icono.png será el nombre de la imágen por defecto*/
							if ($icono != 'images/icono.png'){

				                /*Borramos la imágen que tenía antes el usuario en la carpeta del servidor*/
				                unlink("/home/u752761204/public_html/production/".$iconoOriginal);
											
							}

							/*Almacenamos la url de la nueva imágen*/
				            $icono = $destino;
							
							}else{

							$semaforoError++;
							/*En caso de que la imágen no se haya podido guardar se le indica al usuario*/
							echo '<script language="javascript">alert("Se ha producido un error al guardar la imagen!");</script>';

							}

						}
								
					}



				/*Si el semáforo esta a 0 quiere decir que no se ha producido ningún error */
				if($semaforoError == 0){

				  /*Actualizamos los campos que nos interesan actualizar*/

          $email = $_GET['user'];
          $permiso = $_POST['permiso'];
          $departamento = $_POST['departamento'];
          $telefono = $_POST['telefono'];

          /*Si se ha cambiado la contraseña, la codificamos*/
          if (isset($_POST['password'])){

            $contrasenya = md5($_POST['password']);

          }else{

            $contrasenya = $contrasenyaOriginal;
          }

          /*Si el departamento se dejase en blanco, cambiamos al valor por defecto*/
          if ($departamento == ""){

              $departamento == "Desconocido";
          }

					/*Mediante las variables declaradas al principio y en las líneas anteriores, actualizamos los datos del usuario en la base de datos*/
					if($query = $mysqli->query("UPDATE `usuario` SET `contrasenya`='$contrasenya',`permiso`=$permiso,`icono`='$icono',`departamento`='$departamento',`telefono`='$telefono' WHERE `email` = '$email' ")){
						/*Cerramos la conexión con la base de datos*/
						$mysqli->close();

						/*Le indicamos al usuario que los datos han sido actualizados y lo mandamos a la página de inicio*/
						echo '<script language="javascript">alert("Cambios realizados correctamente");</script>';
						echo "<script> window.location.href='modificarusuarios.php'</script>";
					}else{
            
						echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
						echo "<script> window.location.href='modificarusuarios.php'</script>";
					}
				
				}else{


					/*En caso de que la variable semáforo sema mayor a 0, quiere decir que se ha producido algún error. */
         		    echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos inicio");</script>';
					echo "<script> window.location.href='modificarusuarios.php'</script>";
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
    <!--Scripts personalizados -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
