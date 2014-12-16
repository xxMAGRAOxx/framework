<?php
	Abstract class Controller
	{		
		private static $instance;
		
		function __construct()
		{
			self::$instance =& $this;
			$this->loadClasses();
		}
		
		/*** Cria um super objeto ***/
		private function loadClasses()
		{
			// foreach($GLOBALS['classes'] as $var => $class)
			// {
				// $this->$var = $class;
			// }
			
			// $this->load = _new('loader');
			
			/** Registramos todos os objetos que serão necessários **/
			foreach(Registry::getAll() as $var => $object)
			{
				$this->$var = $object;
			}
			
			// E também a classe loader
			$this->load = Registry::get('loader');
		}
		
		public static function &getInstance()
		{
			return self::$instance;
		}
		
	}
?>