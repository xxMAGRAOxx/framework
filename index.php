<?php
	// Versão do Framework
	define('VERSION', '0');
	
	define('ENVIRONMENT', 'development');
	
	define('DIR_APPLICATION', __DIR__ . '/application/');
	
	define('DIR_SYSTEM', __DIR__ . '/system/');
	
	define('DEBUG_MODE', FALSE);
	
	//Inclui os arquivos do sistema
	require(DIR_SYSTEM . 'autoload.php');
	
	//Inclui as bibliotecas que o Usuário definiu como Autoload
	require(DIR_APPLICATION . 'autoload.php');
	
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
				die('O ambiente de desenvolvimento não foi setado corretamente!');
				
		}
	}
	
	//Log de erros padrão do PHP
	ini_set("error_log", DIR_SYSTEM . "logs/php_default_errors.log");
	
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
		
		/*** Depois de um carnaval do cacete, envia para o Browser e seja o que Deus quiser! **/
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