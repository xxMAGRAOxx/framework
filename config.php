<?php
	define('DIR_APPLICATION', __DIR__ . '/application/');
	define('DIR_DATABASE', __DIR__ . '/database/');	
	define('DIR_SYSTEM', __DIR__ . '/system/');
	define('DIR_CORE', DIR_SYSTEM . 'core/');
	
	define('CHARSET', 'UTF-8');
	define('TIMEZONE', 'America/Sao_Paulo');

	// Banco de dados
	define('DB_DRIVER', 'mysqli');	
	define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'head_first');
	define('DB_PREFIX', '');
?>