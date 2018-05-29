<?php

/*Done*/
/*Se declara una clase usuario con sus respetivos getters y setters, esta clase se utilizará para tratar los datos del usuario
loggeado de diferentes maneras en las distintas páginas, principalmente se utilizará para mostrar nombre e icono del usuario*/
	class Usuario{

		private $email;
		private $contrasenya;
		private $permiso;
		private $icono;
		private $departamento;
		private $telefono;

			public function setEmail($email){
				$this->email = $email;
			}
			public function setContrasenya($contrasenya){
				$this->contrasenya = $contrasenya;
			}
			public function setPermiso($permiso){
				$this->permiso = $permiso;
			}
			public function setIcono($icono){
				$this->icono = $icono;
			}
			public function setDepartamento($departamento){
				$this->departamento = $departamento;
			}
			public function setTelefono($telefono){
				$this->telefono = $telefono;
			}
			

			public function getEmail(){
				return $this->email;
			}
			public function getContrasenya(){
				return $this->contrasenya;
			}
			public function getPermiso(){
				return $this->permiso;
			}
			public function getIcono(){
				return $this->icono;
			}
			public function getDepartamento(){
				return $this->departamento;
			}
			public function getTelefono(){
				return $this->telefono;
			}
			
		}
?>


<?php
	/*Funcion para obtener sólo el nombre del usuario*/
	function cortarNombre($email){

        $arrayEmail = explode("@", $email);

        return $arrayEmail[0];

    }

?>


<?php
	/*Funcion para obtener el tercer valor mostrado en el select a la hora de asignar
  equipos del inventario a un usuario*/
	function obtenerNumeroSerie($stringAcortar){

        $arrayEmail = explode(",", $stringAcortar);

        return $arrayEmail[2];

    }

?>


<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerMarcaImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `nombre` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin marca";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }

?>


<?php
  /*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerSoImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `so` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin sistema operativo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerModeloImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `modelo` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin modelo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerEstadoImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `estado` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "En Stock";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerUsuarioImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `usuarioAsignado` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);


                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin asignar";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerIpImpresora($IdImpresora){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `ip` FROM `impresora` WHERE `numeroDeSerie` = '$IdImpresora'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "255.255.255.255";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>


<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerMarcaEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `nombre` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin marca";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }

?>


<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerSoEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `so` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin sistema operativo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerModeloEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `modelo` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin modelo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerEstadoEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `estado` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "En Stock";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerUsuarioEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `usuarioAsignado` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);

                                          
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin asignar";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerIpEquipo($IdEquipo){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `ip` FROM `equipo` WHERE `numeroDeSerie` = '$IdEquipo'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "255.255.255.255";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>


<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerMarcaServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `nombre` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin marca";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }

?>


<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerSoServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `so` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin sistema operativo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerModeloServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");
        
			$test = $mysqli->query("SELECT `modelo` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin modelo";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerEstadoServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `estado` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "En Stock";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerUsuarioServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `usuarioAsignado` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);

                                          
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "Sin asignar";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

<?php
	/*Funcion para obtener un dato de un ítem pasándole el id en cuestión*/
	function obtenerIpServidor($IdServidor){

        $mysqli = new mysqli("mysql.hostinger.es","u752761204_jj","1neesf_","u752761204_helpd");
        $mysqli->set_charset("utf8");

			$test = $mysqli->query("SELECT `ip` FROM `servidor` WHERE `numeroDeSerie` = '$IdServidor'");
				
				$testDatos = $test->fetch_array(MYSQLI_NUM);
                                                  
                         if ($testDatos[0] != ""){

                               return $testDatos[0];

                          }else{

                               return "255.255.255.255";
                                                                       
                          }
                                                    
                       /*Cerramos la conexión con la base de datos*/
                       $mysqli->close();

    }
?>

