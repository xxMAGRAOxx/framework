<?php
	require(DIR_SYSTEM . 'libraries/exceptions/response_exception.php');
	
	class Response
	{
		private $output = array();
		private $headers = array();
		
		public function setOutput($output)
		{
			$this->output[] = $output;
		}
		
		public function setHeader($header)
		{
			$this->headers[] = $header;
		}
		
		public function output()
		{
			if(!headers_sent() AND count($this->headers) > 0)
			{
				foreach($this->headers as $header)
				{
					header($header);
				}
			}
			
			foreach($this->output as $output)
			{
				echo $output;
			}
		}
	}
?>