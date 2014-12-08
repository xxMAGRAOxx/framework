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
					$customError['code'] = $this->getCode();
					$customError['message'] = $this->getMessage();
					$customError['fullMessage'] = 'Database connection error. Error: (' . $this->getCode() . ') - ' . $this->getMessage(); 
					break;
				
				default :
					$customError['code'] = $this->getCode();
					$customError['message'] = $this->getMessage();
					$customError['fullMessage'] = 'Query error. Error: (' . $this->getCode() . ') - ' . $this->getMessage(); 
					break;
			}
			
			return $customError;
		}
	}
?>