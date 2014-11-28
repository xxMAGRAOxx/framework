<?php
	require('exception/router.php');
	
	final class Router extends RouterException
	{
		protected $file;
		protected $class;
		protected $method;
		protected $args;
		
		function __construct($router)
		{
			//Padrão
			if($router == 'default')
			{
				$this->file = DIR_APPLICATION . 'controller/' . DEFAULT_CONTROLLER . '.php';						
				$this->class = basename(DEFAULT_CONTROLLER);
				$this->method = 'index';
				$this->args = array();
			}
			else
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
					
					//Se ja encontramos a classe resta apenas os métodos e argumentos
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
		}
		
		public function action()
		{
			if(DEBUG_MODE) var_dump($this);
			
			if (file_exists($this->file))
			{
				require($this->file);
				
				$Class = $this->class;
				
				$Controller = new $Class();
				
				if(method_exists($Controller, $this->method))
				{
					call_user_func_array(array($Controller, $this->method), $this->args);//Faz a chamada a funcao
				}
				else
				{
					throw new RouterException(RouterException::METHOD_NOT_EXIST);
				}
			}
			else
			{
				throw new RouterException(RouterException::FILE_NOT_EXIST);
			}
		}
	}
?>