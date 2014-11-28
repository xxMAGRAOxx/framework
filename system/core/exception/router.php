<?php
	class RouterException extends Exception	
	{
		const FILE_NOT_EXIST = 1;
		const METHOD_NOT_EXIST = 2;
		const TOO_MANY_ARGS = 3;
		private $router;
		
		public function __construct($code = null)
		{
			if(!isset($code))
			{
				die('Código da exceção é obrigatório!');
			}
			else
			{
				parent::__construct(null, $code, null);
			}
		}
		
		public function errorMessage()
		{
			$errorMessage = '';
			
			switch($this->getCode())
			{					
				case self::FILE_NOT_EXIST :
					$errorMessage = 'Diretório ou Classe não existe'; 
					break;
					
				case self::METHOD_NOT_EXIST :
					$errorMessage = 'Método'; 
					break;
					
				case self::TOO_MANY_ARGS :
					$errorMessage = 'Argumentos'; 
					break;
			}
			
			return $errorMessage;
		}
	}
?>