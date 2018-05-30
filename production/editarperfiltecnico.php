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
    if ($_SESSION['registrado']->getPermiso() != 2){

       echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";

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

    <title>Portal de técnico </title>

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

            <!-- menu profile quick info -->
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
                  <li><a href="incidenciassinasignar.php"><i class="fa fa-edit"></i> Tickets sin asignar</span></a>
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
                                      <h2>Perfil de técnico</h2>
                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <!-- Creamos formulariotipo multipart/form-data -->
                                      <form enctype="multipart/form-data" action='' method='POST' class="form-horizontal form-label-left">

                                        <span class="section">Datos del perfil</span>

                                        <!-- Email del usuario de la sesión actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="solicitante">Usuario <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="solicitante" name="solicitante" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $_SESSION["registrado"]->getEmail()?>' disabled></input>
                                          </div>
                                        </div>

                                        <!-- Departamento del usuario actual sin opción a cambio -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">Departamento <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="departamento" name="departamento" class="form-control col-md-7 col-xs-12" value='<?php echo $_SESSION["registrado"]->getDepartamento()?>' required="required" disabled></input>
                                          </div>
                                        </div>

                                        <!-- Input con un pattern el cual sólo permite 9 números (Teléfono) -->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono" >Teléfono <span class="required">(+34) *</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="telefono" name="telefono"  maxlength="9" class="form-control col-md-7 col-xs-12" pattern="^[0-9]{9}" value='<?php echo $_SESSION["registrado"]->getTelefono()?>' title="El teléfono debe contener 9 carácteres numéricos, si desconoce el teléfono del usuario puede utilizar el valor 000000000"></input>
                                          </div>
                                        </div>

                                        <!-- Input tipo file para subir imagen de icono, máximo 500KB-->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icono">Icono <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type='file' size="512000" id="icono" name="icono" class="form-control col-md-7 col-xs-12"></input>
                                          </div>
                                        </div>

                                        <!-- Input con validación de email "@"" "carácteres despues del punt final", ... 
                                        al sacar el foco valida si es igual qu eel siguiente input y si no lo es muestra un mensaje de error y desactiva el botón.-->
                                        <br>
                                        <p>Si no quiere modificar la contraseña, repita la su contraseña actual en el siguiente campo</p>
                                        <br>
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" required pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,20}$" title="Debería tener 8 caracteres alfanuméricos incluyendo mayúsculas y minúsculas" value='<?php echo $_SESSION['contrasenyaSinCifrar']?>' onblur="validar()" required="required"></input>
                                            <p id="error" style="color:red"></p>
                                          </div>
                                        </div>
                                        
                                        <!-- Input al sacar el foco valida si es igual que el input anterior y si no lo es muestra un mensaje de error y desactiva el botón.-->
                                        <div class="item form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password2">Repita contraseña <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" id="password2" name="password2" class="form-control col-md-7 col-xs-12" onblur="validar()" required="required"></input>
                                          </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                        <br></br>
                                          <center>
                                          <div class="col-md-6 col-md-offset-3">
                                            <!--Botón para guardar cambios-->
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

      /*Obtenemos los valores del formulario que nos interesan*/
    	$semaforoError = 0;
    	$telefono = $_POST['telefono'];
    	/*Es muy importante mantener esta configuración de icono puesto que nos guarda el valor del último icono
       y en caso de no subir imagen volveremos a grabar este valor en la base de datos*/
      $icono = $_SESSION['registrado']->getIcono();

            /*Abrimos conexión a la base de datos*/
            $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
            $mysqli->set_charset("utf8");

            /*Si se ha indicado un teléfono diferente lo almacenamos*/
            if (isset($_POST['telefono'])){
            	
            	$telefono = $_POST['telefono'];

            }

            /*Si teléfono tuviese un valor en blanco se cambia a "Desconocido"*/
            if ($telefono == ""){
            	
            	echo '<script language="javascript">alert("Variable teléfono en blanco codificamos valor a Desconocido");</script>';
            	$telefono = "Desconocido";
            }

      /*Si el nombre de la imagen es diferente a vacío procedemos a guardar la imagen*/
			if($_FILES['icono']['name'] != ""){

				/*Verificamos que no sea más grande de 500KB*/
				if ($_FILES['icono']['size'] > 512000) {
					/*Si es más grande se lo indicamos al usuario y aumentamos la variable semáforo*/
					$semaforoError++;
					$telefono = $_SESSION['registrado'] -> getTelefono();
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
							donde ico.jpg será el nombre de la imágen por defecto*/
							if ($_SESSION['registrado']->getIcono() != 'images/icono.png'){
											
							/*Borramos la imágen que tenía antes el usuario en la carpeta del servidor*/
							unlink("/home/u752761204/public_html/production/".$_SESSION['registrado'] -> getIcono());

							}
										
							/*Cambiamos la imágen en la sesión del usuario*/
							$_SESSION['registrado'] -> setIcono($destino);
							/*Modificamos la variable creada anteriormente*/
							$icono = $_SESSION['registrado'] -> getIcono();

							}else{

							$semaforoError++;
							$telefono = $_SESSION['registrado'] -> getTelefono();
							/*En caso de que la imágen no se haya podido guardar se le indica al usuario*/
							echo '<script language="javascript">alert("Se ha producido un error al guardar la imagen!");</script>';

							}

						}
								
					}



				/*Si el semáforo esta a 0 quiere decir que no se ha producido ningún error */
				if($semaforoError == 0){

				/*Almacenamos los valores que nos interesan*/
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
						echo "<script> window.location.href='incidenciassinasignar.php'</script>";
					}else{
						echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
						echo "<script> window.location.href='incidenciassinasignar.php'</script>";
					}
				
				}else{
					/*En caso de que la variable semáforo sema mayor a 0, quiere decir que se ha producido algún error. */
          echo '<script language="javascript">alert("Se ha producido un error al guardar en la base de datos");</script>';
					echo "<script> window.location.href='incidenciassinasignar.php'</script>";
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
