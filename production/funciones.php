<?php
	/*Se declara una clase usuario con sus respetivos getters y setters, se le crean las variables de fecha y hora por comodidad de uso en el código*/
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
	/*Funcion para abrir un conexión a la base de datos*/
	function cortarNombre($email){

        $arrayEmail = explode("@", $email);

        return $arrayEmail[0];

    }

?>

<?php
	/*Funcion para abrir un conexión a la base de datos*/
	function obtenerNumeroSerie($stringAcortar){

        $arrayEmail = explode(",", $stringAcortar);

        return $arrayEmail[2];

    }

?>