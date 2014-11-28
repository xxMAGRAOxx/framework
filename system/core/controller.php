<?php
	Abstract class Controller
	{		
		function __construct()
		{
			$this->loadClasses();
		}
		
		//Cria um super objeto
		function loadClasses()
		{
			foreach($GLOBALS['classes'] as $var => $class)
			{
				$this->$var = $class;
			}
			
			$this->load = _new('loader');
		}
		
	}
?>