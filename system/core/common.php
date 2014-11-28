<?php
	
	function &_new($Class)
	{
		//A ideía é manter um registro de todas as classes que foram instanciadas
		if (!class_exists($Class))
		{
			die("Classe {$Class} não encontrada!");
		}
		else
		{
			$GLOBALS['classes'][$Class] = new $Class();
			
			if(DEBUG_MODE) var_dump($GLOBALS['classes']);
			
			return $GLOBALS['classes'][$Class];
		}
	}
	
?>