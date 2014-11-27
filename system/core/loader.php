<?php 
	require('exception/loader.php');
	
	class Loader extends LoaderException
	{
		public function __construct(Router $router)
		{
			if(DEBUG_MODE) var_dump($router);
			
			if (file_exists($router->getFile()))
			{
				require($router->getFile());
				
				$Class = $router->getClass();
				
				$Controller = new $Class();
				
				if(method_exists($Controller, $router->getMethod()))
				{
					call_user_func_array(array($Controller, $router->getMethod()), $router->getArgs());//Faz a chamada a funcao
				}
				else
				{
					throw new LoaderException(LoaderException::METHOD_NOT_EXIST);
				}
			}
			else
			{
				throw new LoaderException(LoaderException::FILE_NOT_EXIST);
			}
			
		}
	}
?>