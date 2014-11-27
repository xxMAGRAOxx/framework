<?php
	final class Router
	{
		protected $file;
		protected $class;
		protected $method;
		protected $args;
		
		function __construct($router)
		{
			$_URL = explode('/', $router);
			
			if(DEBUG_MODE) var_dump($_URL);
			
			$fullpath = '';
			
			foreach($_URL as $part_url)
			{
				$fullpath .= $part_url;
				
				//Primeiramente verificamos se é um diretório
				if(is_dir(DIR_APPLICATION . 'controller/' . $fullpath))
				{
					$fullpath .= '/';
					
					array_shift($_URL);
					
					continue;
				}
				
				//Não sendo, pode ser que seja um arquivo e consequentemente uma classe
				if(is_file(DIR_APPLICATION . 'controller/' . $fullpath . '.php'))
				{					
					$this->file = DIR_APPLICATION . 'controller/' . $fullpath . '.php';
					
					$this->class = basename($fullpath);//A última parte é a Classe
					
					array_shift($_URL);
					
					//continue;
				}
				
				//Só pode ter metodo se existir classe
				if($this->class)
				{
					$method = array_shift($_URL);
					
					if ($method)
					{
						$this->method = $method;
						$this->args = array_values($_URL);//Se encontrou o metodo o restante so pode ser argumentos
						break;
					} else
					{
						$this->method = 'index';
						$this->args = array();
					}
				}
			}
		}
		
		public function getFile() 
		{
			return $this->file;
		}
		
		public function getClass() 
		{
			return $this->class;
		}
		
		public function getMethod() 
		{
			return $this->method;
		}
		
		public function getArgs() 
		{
			return $this->args;
		}
	}
?>