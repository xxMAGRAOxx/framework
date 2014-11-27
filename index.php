<?php
	// Versão do Framework
	define('VERSION', '0');
	
	define('ENVIRONMENT', 'development');
	define('DEBUG_MODE', TRUE);
	
	//Inclui os arquivos do sistema
	require('config.php');	
	require(DIR_SYSTEM . 'core/request.php');
	require(DIR_SYSTEM . 'core/router.php');
	require(DIR_SYSTEM . 'core/loader.php');
	require(DIR_SYSTEM . 'core/autoload.php');	
	
	//Seta o charset
	if(defined(CHARSET))
	{
		mb_internal_encoding(CHARSET);
	}
	
	//Ambiente de desenvolvimento
	if (defined('ENVIRONMENT'))
	{
		switch(ENVIRONMENT)
		{
			case 'development' :
				error_reporting(E_ALL);
				break;
				
			case 'production' :
				error_reporting(0);
				break;
				
			default:
				exit('O ambiente de desenvolvimento não foi setado corretamente!');
				
		}
	}
	
	//Log de erros
	ini_set("error_log", DIR_SYSTEM . "logs/php-error.log");
	
	//Timezone
	if(defined('TIMEZONE'))
	{
		date_default_timezone_set(TIMEZONE);
	}
	
	//Faz o roteamento
	$request = new Request();
	
	if ($request->get('route'))
	{
		$router = new Router($request->get('route'));
	}
	else
	{
		$router = new Router('home');//Página padrão
	}
	
	try
	{
		$loader = new Loader($router);
	}
	catch(LoaderException $loaderEX)	
	{
		die($loaderEX->errorMessage());
	}
	
	
?>