 <?php
/*Se incluyen los ficheros necesarios y se incia sesión*/ /*Done*/
include_once('funciones.php');
/*Iniciamos la sesión*/
session_start();

     /*Si recibe una variable por url llamada salir, cerramos la sesión de usuario registrado e iniciamos una sesión de nuevo*/
		 if (isset($_GET['salir'])){

  				/*Vaciamos la variable de sesión del usuario registrado*/
  				unset($_SESSION['registrado']);
  				/*Eliminamos la sesión*/
  				session_destroy();
  				/*Iniciamos una sesión limpia*/
  				session_start();

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

    <title>Login | Registro</title>

    <!-- Estilos de la plantilla descargada -->
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
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
            error.innerHTML = "Las contraseñas no coinciden";
            /*Deshabilitamos el botón del formulario*/
            botonR.disabled = true;
            
          }else{
            error.innerHTML = " ";
            botonR.disabled = false;

          }
         
      }

    </script>

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action='' method='POST'>
              <h1>Iniciar sesión</h1>
              <div>
                <!-- Se muestra input con un pattern que valida la dirección de correo-->
                <input type="text" class="form-control" name="correoL" placeholder="Correo" required pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$" title="Introduzca una dirección de correo válida" />
              </div>
              <div>
                <!-- Se muestra un input con un patters que valida una contraseña-->
                <input type="password" class="form-control" name="contrasenyaL" placeholder="Contraseña" required pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,20}$" title="Debería tener 8 caracteres alfanuméricos incluyendo mayúsculas y minúsculas" />
              </div>

              <div>
                <!-- Botón para iniciar sesión-->
                <button class="btn btn-default submit" id="botonL" name="botonL" href="#signup">Log in</button>
              </div>

              <div class="clearfix"></div>
              <div class="separator">
                <p class="change_link">Nuevo en la empresa?
                  <!--  Se muestra un enlace que nos redirigirá al formulario de registro-->
                  <a href="#signup" class="to_register" > Regístrate </a>
                </p>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-cogs"></i> HelpDesk!</h1>
                  <p>©2018 All Rights Reserved. José Juan Ripoll Tous 2º DAW</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action='' method='POST'>
              <h1>Registrar usuario</h1>
              <div>
                <!-- Se muestra input con un pattern que valida la dirección de correo-->
                <input type="email" class="form-control" name="correoE" placeholder="Correo" required pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$" title="Introduzca una dirección de correo válida" />
              </div>
              <div>
                <!-- Se muestra un input con un patters que valida una contraseña, ejecuta la función on blur que valida contraseñas-->
                <input type="password" class="form-control" name="contrasenya" placeholder="Contraseña" id="password" required pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,20}$" title="Debería tener 8 caracteres alfanuméricos incluyendo mayúsculas y minúsculas" required onblur="validar()"/>
              </div>
              <!-- párrafo utilizado para mostrar errores-->
              <p id="error" style="color:red"></p>
              <div>
                 <!-- Se muestra un input para contraeña ejecuta la función on blur que valida contraseñas-->
                <input type="password" class="form-control" placeholder="Repita contraseña" id="password2" required onblur="validar()"/>
              </div>
              <div>
                <!-- Botón para registrar usuario -->
                <button class="btn btn-default submit" id="botonR" name="botonR" href="#signin">Enviar</button>
              </div>

              <div class="clearfix"></div>
              <div class="separator">
                <p class="change_link">Ya estás registrado ?
                  <!-- Nos redirigirá al formulario de inicio de sesión-->
                  <a href="#signin" class="to_register"> Log in </a>
                </p>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-cogs"></i> HelpDesk!</h1>
                  <p>©2018 All Rights Reserved. José Juan Ripoll Tous 2º DAW</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

<?php
  
  /*Si se ha pulsado el botón*/
  if (isset($_POST['botonR'])){

        /*Se almacenan las variables que necesitaremos guardar luego en la base de datos*/
        $password = $_POST['contrasenya'];
        $password = md5($password);
        $email = $_POST['correoE'];
        $email = strtolower($email);

        /*Abrimos conexión a la base de datos*/
        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

        /*Intentamos seleccionar el usuario que se quiere añadir a la base de datos*/
        $query = $mysqli->query("SELECT `email`, `contrasenya` FROM `usuario` WHERE email = '$email'");
        /*Obtenemos la fila de la consulta*/
        $fila = $query->fetch_array(MYSQLI_NUM);


        /*Si el primer valor es igual al correo*/
        if ($fila[0] == $email){

          /*Se le indica al usuario que el usuario que intenta registrarse ya está creado*/
          echo '<script language="javascript">alert("El usuario ya está registrado");</script>';
          /*Vaciamos variable del botón*/
          unset($_POST["botonR"]);
  
        }else{

          /*Si el usuario que se pretende crear no existe en la base de datos*/

          /*Insertamos los campos del usuario en nuestra base de datos*/
          $mysqli->query("INSERT INTO `usuario`(`email`, `contrasenya`) VALUES ('".$email."','".$password."')");

          /*Cerramos la conexión con el servidor*/
          $query->close();
          $mysqli->close();


          /*Indicamos al usuario que se ha registrado correctamente*/
          echo '<script language="javascript">alert("Usuario registrado correctamente");</script>';
          /*Enviamos al usuario al formulario de inicio de sesión*/
          echo "<script language='javascript'> window.location.href='#singin';</script>";
          unset($_POST["botonR"]);
  
        }
            
  }

?>

<?php

		/*Si se ha pulsado el botón Loggin*/
		if (isset($_POST['botonL'])){

            /*Obtenemos los valores del formulario que nos interesan*/
				    $passwordL = $_POST['contrasenyaL'];
            $_SESSION['contrasenyaSinCifrar'] = $passwordL;
		        $passwordL = md5($passwordL);
		        $emailL = $_POST['correoL'];
		        $emailL = strtolower($emailL);
		        
            /*Abrimos conexión a la base de datos*/
            $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
            $mysqli->set_charset("utf8");

		        /*Intentamos seleccionar el usuario que se quiere añadir a la base de datos*/
		        $query = $mysqli->query("SELECT `email`, `contrasenya`, `permiso`, `icono`, `departamento`, `telefono` FROM `usuario` WHERE email = '$emailL' and contrasenya = '$passwordL'");

		        /*Obtenemos la fila de la consulta*/
		        $fila = $query->fetch_array(MYSQLI_NUM);


				/*Si la fila no corresponde con el email quiere decir que el usuario no existe*/
				if ($fila[0] != $emailL){

					/*Se le indica al usuario que el login ha fallado*/
					echo '<script language="javascript">alert("El usuario no existe o la contraseña no es correcta");</script>';

					/*Vaciamos la variable*/
					unset($_POST["botonL"]);
				
				}else{

					/*Si el usuario corresponde con uno ya creado en la base de datos se iniciará la sesión dónde saltará un alert indicando el inicio de sesión.*/

							/*Creamos un objeto tipo usuario en la variable registrado*/
							$_SESSION['registrado'] = new Usuario();
              /*Establecemos los valores que nos interesan*/
							$_SESSION['registrado'] -> setEmail($fila[0]);
							$_SESSION['registrado'] -> setContrasenya($fila[1]);
							$_SESSION['registrado'] -> setPermiso($fila[2]);
              $_SESSION['registrado'] -> setIcono($fila[3]);
							$_SESSION['registrado'] -> setDepartamento($fila[4]);
							$_SESSION['registrado'] -> setTelefono($fila[5]);

              /*Vaciamos variable de loggin*/
							unset($_POST["botonL"]);

              /*De esta manera controlaremos los permisos y redigiremos a las páginas correspondientes*/
              if ($fila[2] == 1){
                
                 echo "<script language='javascript'> window.location.href='abririncidencia.php';</script>";

              }else if ($fila[2] == 2){

                 echo "<script language='javascript'> window.location.href='incidenciassinasignar.php';</script>";

              }else if ($fila[2] == 3){

                 echo "<script language='javascript'> window.location.href='datosusuarios.php';</script>";
                 
              }else{

                echo "<script language='javascript'> window.location.href='login.php?salir=true';</script>";
              }
					
				}

			}
?>

  </body>
</html>
