<?php
	// Versão do Framework
	define('_VERSION', '0');
	define('_DEVELOPMENT_MODE', 'developer');
	
	//Inclui os arquivos do sistema
	require('config.php');	
	require(_DIR_SYSTEM .'core/request.php');
	
	
	//Faz o roteamento
	$request = new Request();
	
	if ($request->get('route'))
	{
		echo 'go';
	}
	else 
	{
		echo 'Padrão'; //Roteador padrão
	}
	
?>