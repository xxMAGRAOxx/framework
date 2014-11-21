<?php
	final class Router
	{
		protected $file;
		protected $class;
		protected $method = 'index';//Padrão
		
		function __construct($router)
		{
			$_URL = explode('/', $router);
			
			$fullpath = '';
			
			foreach($_URL as $part_url)
			{
				$fullpath .= $part_url;
				
				if(is_dir(DIR_APPLICATION . 'controller/' . $fullpath))
				{					
					$fullpath .= '/';
					
					array_shift($_URL);				
					
					continue;
				}
				else if(is_file(DIR_APPLICATION . 'controller/' . $fullpath . '.php'))
				{					
					$this->file = DIR_APPLICATION . 'controller/' . $fullpath . '.php';
					
					$this->class = 'Controller' . $fullpath;
					
					array_shift($_URL);
					
					continue;
				}
				else //Método
				{
					$this->method = $part_url;
				}
			}
		}
		
		public function get_file() 
		{
			return $this->file;
		}
		
		public function get_class() 
		{
			return $this->class;
		}
		
		public function get_method() 
		{
			return $this->method;
		}
	}
?>