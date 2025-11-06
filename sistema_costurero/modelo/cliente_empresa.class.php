<?php
	
	class Cliente_Empresa {
		protected $empresa;
		protected $cuit;
		protected $direccion;
		protected $altura;
		protected $localidad;
		protected $telefono;
		protected $email;
		protected $contacto;
		protected $provincia;
		protected $codpostal;
		
		function __construct($unaEmpresa, $unCUIT, $unaDireccion, $unaAltura, $unaLocalidad, $unTelefono, $unEmail, $unContacto, $unaProvincia, $unCodpostal){
			
			$this->empresa = $unaEmpresa;
			$this->cuit = $unCUIT;
			$this->direccion = $unaDireccion;
			$this->altura = $unaAltura;
			$this->localidad = $unaLocalidad;
			$this->telefono = $unTelefono;
			$this->email = $unEmail;
			$this->contacto = $unContacto;
			$this->provincia = $unaProvincia;
			$this->codpostal = $unCodpostal;
		}	
	}	
?>