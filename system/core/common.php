<?php
	
	/***
	 * A ideía aqui é manter um registro de todas as classes que foram instanciadas. 
	 * Com isso podemos criar superobjetos como eh o caso Controller
	 *
	***/
	function &_new($Class, $contruct = null)
	{
		if (!class_exists($Class))
		{
			die("A Classe {$Class} não foi carregada!");
		}
		else
		{
			$GLOBALS['classes'][$Class] = new $Class();
			
			if(DEBUG_MODE) var_dump($GLOBALS['classes']);
			
			return $GLOBALS['classes'][$Class];
		}
	}
	
?>