<?php
	class Request
	{		
		public function get($param = null)
		{
			if(isset($param))
			{
				return (isset($_GET[$param])) ? $_GET[$param] : null;
			}	
			else
			{
				return $_GET;
			}
		}
		
		public function post($param = null)
		{
			if(isset($param))
			{
				return (isset($_POST[$param])) ? $_POST[$param] : null;
			}
			else
			{
				return $_POST;
			}
		}
	}
?>