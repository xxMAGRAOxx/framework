<?php
	class SQLException extends Exception
	{
		const DATABASE_ERROR = 1049;
		
		public function __construct($errorCode = null, $errorMessage = null)
		{
			if(!isset($errorMessage))
			{
				die('Código da exceção e mensagens são obrigatórios!');
			}
			else
			{
				parent::__construct($errorMessage, $errorCode, null);
			}
		}
		
		public function getCustomError()
		{
			$customError = array();
			
			switch($this->getCode())
			{					
				case self::DATABASE_ERROR :
					//$errorMessage = 'Erro de conexão ao Banco de Dados. Error: (' . $this->getCode() . ') - ' . $this->getMessage(); 
					$customError['code'] = $this->getCode();
					$customError['message'] = $this->getMessage();
					break;
				
				default :
					//$errorMessage = 'Erro de query: (' . $this->getCode() . ') - ' . $this->getMessage(); 
					$customError['code'] = $this->getCode();
					$customError['message'] = $this->getMessage();
					break;
			}
			
			return $customError;
		}
	}
?>