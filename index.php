<?php
	// Versão do Framework
	define('VERSION', '0');
	
	define('ENVIRONMENT', 'development');
	
	/*Controlador Padrão*/
	define('DEFAULT_CONTROLLER', 'welcome');
	
	define('DEBUG_MODE', FALSE);
	
	//Inclui os arquivos do sistema
	require('config.php');
	require(DIR_SYSTEM . '/autoload.php');
	
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
	
	/*** Começa a brincadeira ***/
	
	$registry = new Registry();
	
	$database = new Database(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$registry->set('db', $database);
	
	$request = new Request();
	$registry->set('request', $request);
	
	$response = new Response();
	$registry->set('response', $response);
	
	$loader = new Loader();
	$registry->set('loader', $loader);
	
	try
	{
		/*** Faz o roteamento e consequentemente a chamada ao controlador do Usuário e vamo que vamo! ***/
		$router = new Router($request->get('route'));
		
		/*** Envia para o Browser e seja o que Deus quiser! **/
		$response->output();
	}
	catch(RouterException $routerEX)	
	{
		die($routerEX->errorMessage());
	}
	/*catch(RequestException $requestEX)	
	{
		die($requestEX->errorMessage());
	}*/
	catch(ResponseException $responseEX)	
	{
		die($responseEX->errorMessage());
	}
	
?>