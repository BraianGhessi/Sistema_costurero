<?php
	
	class Cliente_Particular{
		protected $nombre;
		protected $apellido;
		protected $dni;
		protected $fecha_nac;
		protected $calle;
		protected $altura;
		protected $localidad;
		protected $telefono;
		protected $email;
		protected $provincia;
		protected $codpostal;

		function __construct($unNombre, $unApellido, $unDNI, $unaFecha, $unaCalle, $unaAltura, $unaLocalidad, $unTelefono, $unEmail, $unaProvincia, $unCodpostal){
			
			$this->nombre = $unNombre;
			$this->apellido = $unApellido;
			$this->dni = $unDNI;
			$this->fecha_nac = $unaFecha;
			$this->direccion = $unaDireccion;
			$this->altura = $unaAltura;
			$this->localidad = $unaLocalidad;
			$this->telefono = $unTelefono;
			$this->email = $unEmail;
			$this->provincia = $unaProvincia;
			$this->codpostal = $unCodpostal;
		}	
	}
	
?>