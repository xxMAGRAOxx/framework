<?php
	Abstract class Model
	{		
		function __construct()
		{
			$this->loadClasses();
		}
		
		/*** Cria um super objeto ***/
		function loadClasses()
		{
			/** Registramos todos os objetos que serão necessários. No caso do Model apenas o Banco de Dados **/
			$this->db = Registry::get('db');
		}		
	}
?>