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

    <script>

      /*Esta función será necesaria para validar el campo de la contraseña*/
      function funcionesRegistro(){

          var password = document.getElementById("password");
          var password2 = document.getElementById("password2");
          var error = document.getElementById("error");
      }

      /*Esta es la función que valida las contraseñas*/
      function validar(){

        funcionesRegistro();

          if (password.value != password2.value){
            /*Se le inserta un texto*/
            error.innerHTML = "Las contraseñas no coinciden, introduzca la misma contraseña y haga clic fuera del formulario para poder guardar los cambios.";
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
                  <li><a><i class="fa fa-home"></i> Abrir ticket <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="abririncidencia.php">Incidencia</a></li>
                      <li><a href="abrirservicio.php">Servicio</a></li>
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
                    <img src='<?php echo $_SESSION["registrado"]->getIcono()?>' alt=""><?php echo cortarNombre($_SESSION['registrado']->getEmail())?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="editarperfilregistrado.php">
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
                                      <h2>Perfil de usuario registrado</h2>
                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <form enctype="multipart/form-data" action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del perfil</span>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solicitante">Usuario <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="solicitante" name="solicitante" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_SESSION["registrado"]->getEmail()?>' disabled></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="departamento" name="departamento" class="form-control col-md-7 col-xs-12" value='<?php echo $_SESSION["registrado"]->getDepartamento()?>' required="required" disabled></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono" >Teléfono <span class="required">(+34) *</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="telefono" name="telefono"  maxlength="9" class="form-control col-md-7 col-xs-12" pattern="^[0-9]{9}" title="El teléfono debe contener 9 carácteres numéricos"></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icono">Icono <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type='file' size="512000" id="icono" name="icono" class="form-control col-md-7 col-xs-12"></input>
                                          </div>
                                        </div>

                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="password" name="password" class="form-control col-md-7 col-xs-12" required pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,20}$" title="Debería tener 8 caracteres alfanuméricos incluyendo mayúsculas y minúsculas" value='<?php echo $_SESSION['contrasenyaSinCifrar']?>' onblur="validar()" required="required"></input>
                                            <p id="error" style="color:red"></p>
                                          </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password2">Repita contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="password2" name="password2" class="form-control col-md-7 col-xs-12" onblur="validar()" required="required"></input>
                                          </div>
                                        </div>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!--<button class="btn btn-primary">Cancelar</button>-->
                                            <button type="submit" id="botonS" type="submit" name="botonS" class="btn btn-danger" disabled="true">Guardar cambios</button>
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
    if (isset($_POST['botonS'])){

    	$semaforoError = 0;
    	$telefono = $_SESSION['registrado'] -> getTelefono();
    	$icono = "images/icono.png";


            $mysqli = new mysqli("localhost","root","1neesf_","bbddhelpdesk");
            $mysqli->set_charset("utf8");

            if (isset($_POST['telefono'])){
            	
            	$telefono = $_POST['telefono'];

            }

			if($_FILES['icono']['name'] != ""){

				/*Verificamos que no sea más grande de 500KB*/
				if ($_FILES['icono']['size'] > 512000) {
					/*Si es más grande se lo indicamos al usuario y aumentamos la variable semáforo*/
					$semaforoError++;
					$telefono = $_SESSION['registrado'] -> getTelefono();
					echo '<script language="javascript">alert("La imagen solo puede tener 500 KB de peso");</script>';
					
				}else{

					/*Si la imágen cumple con el tamaño, le indicamos la ruta de destino*/
					$destino = "/home/u752761204/public_html/production/images/";
					/*Creamos un identificador único*/
					$id = time();
					/*Le cambiamos el nombre a la imágen añadiéndole el id único*/
					$_FILES['icono']['name'] = $id.$_FILES['icono']['name'];
					/*Concatenamos el nombre de la imágen a la ruta*/
					$destino = $destino.$_FILES['icono']['name'];

						/*Utilizamos esta función dentro del if para que si es true siga trabajando*/
						if(move_uploaded_file($_FILES['icono']['tmp_name'], $destino)){ 

							/*De esta manera evitamos eliminar el icono por defecto de la carpeta del servidor para los usuarios recién registrados,
							donde ico.jpg será el nombre de la imágen por defecto*/
							if ($_SESSION['registrado']->getIcono() != 'images/icono.png'){
											
							/*Borramos la imágen que tenía antes el usuario en la carpeta del servidor*/
							unlink("/home/u752761204/public_html/production/".$_SESSION['registrado'] -> getIcono());
							}
										
							/*Cambiamos la imágen en la sesión del usuario*/
							$_SESSION['registrado'] -> setIcono("images/".$_FILES['icono']['name']);
							/*Modificamos la variable creada anteriormente*/
							$icono = $_SESSION['registrado'] -> getIcono();

							}else{

							$semaforoError++;
							$telefono = $_SESSION['registrado'] -> getTelefono();
							/*En caso de que la imágen no se haya podido guardar se le indica al usuario*/
							echo '<script language="javascript">alert("Se ha producido un error al guardar la imagen!");</script>';
							echo '<script language="javascript">alert("$icono");</script>';
							echo '<script language="javascript">alert("$destino");</script>';

							}

						}
								
					}



				/*Si el semáforo esta a 0 quiere decir que no se ha producido ningún error */
				if($semaforoError == 0){

				/*Actualizamos los campos nombre, email y firma en la sesión y también en las variables declaradas al principio*/
				$usuario = $_SESSION['registrado'] -> getEmail();
				$_SESSION['registrado'] -> setTelefono($telefono);
				$_SESSION['registrado'] -> setIcono($icono);
				$_SESSION['contrasenyaSinCifrar'] = $_POST['password'];
				$contrasenya = md5($_POST['password']);

					/*Mediante las variables declaradas al principio y en las líneas anteriores, actualizamos los datos del usuario en la base de datos*/
					if($query = $mysqli->query("UPDATE `usuario` SET `contrasenya`='$contrasenya',`icono`='$icono',`telefono`='$telefono' WHERE `email` = '$usuario' ")){
						/*Cerramos la conexión con la base de datos*/
						$mysqli->close();

						/*Le indicamos al usuario que los datos han sido actualizados y lo mandamos a la página de inicio*/
						echo '<script language="javascript">alert("Cambios realizados correctamente");</script>';
						echo "<script> window.location.href='abririncidencia.php'</script>";
					}else{
						echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
						echo "<script> window.location.href='editarperfilregistrado.php'</script>";
					}
				
				}else{
					/*En caso de que la variable semáforo sema mayor a 0, quiere decir que se ha producido algún error. Por lo que mantenemos al usuario en la misma página*/
					echo "<script> window.location.href='editarperfilregistrado.php'</script>";
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
    
    <!--Scripts personalizados -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
