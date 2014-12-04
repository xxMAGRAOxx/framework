<?php
	final class Registry 
	{
		private static $_OBJECTS = array();
		
		public static function get($key)
		{
			return (array_key_exists($key, self::$_OBJECTS)) ? self::$_OBJECTS[$key] : null;
		}
		
		public static function getAll()
		{
			return self::$_OBJECTS;
		}
		
		public function set($key, $object)
		{
			if(array_key_exists($key, self::$_OBJECTS))
			{
				die('Objeto já adicionado!');
			}
			else
			{
				self::$_OBJECTS[$key] = $object;
			}
		}
		
		public static function removeAll()
		{
			self::$_OBJECTS = [];
		}
	}
?>