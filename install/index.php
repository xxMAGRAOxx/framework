<?php
    error_reporting(E_ALL);
    
    define('DIR_APPLICATION', realpath(dirname(__FILE__) . '../../') . '/install/');

    define('DEBUG_MODE', FALSE);

    define('DIR_SYSTEM', realpath(dirname(__FILE__) . '../../') . '/system/');
    
    define('DEFAULT_CONTROLLER', 'install');
	
    //Inclui os arquivos do sistema
    require(DIR_SYSTEM . 'autoload.php');

    //Log de erros padrão do PHP
    ini_set("error_log", 0);

    /*** Começa a brincadeira ***/

    $registry = new Registry();

    /*$database = new Database(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $registry->set('db', $database);*/

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