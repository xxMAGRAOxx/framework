<?php
	require(DIR_SYSTEM . 'libraries/exceptions/router_exception.php');
	
	final class Router
	{
		protected $file;
		protected $class;
		protected $method;
		protected $args;
		
		function __construct($url)
		{
			/*** Vai para a página padrão ***/
			if(empty($url))
			{
				$this->file = DIR_APPLICATION . 'controller/' . DEFAULT_CONTROLLER . '.php';						
				$this->class = basename(DEFAULT_CONTROLLER);
				$this->method = 'index';
				$this->args = array();
			}
			/*** Somente para tornar a url mais amigável, pois não faz sentido não ter a palavra route ***/
			/*else if(explode('=', $url)[0] != 'route')
			{
				header('Location: http://localhost/framework/index.php');
			}*/
			
			/*** Começa a brincadeira ***/
			else
			{
				$_URL = explode('/', $url);
				
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
			
			$this->action();
		}
		
		private function action()
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