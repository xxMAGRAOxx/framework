<?php
	class Loader
	{
		public function view($view, $vars, $return = FALSE)
		{
			$file = DIR_APPLICATION . 'view/' . $view;
			
			$fileFounded = FALSE;
			
			foreach(array('.php', '.html', '.htm') as $fileExtension)
			{				
				if(file_exists($file . $fileExtension))
				{
					$fileFounded = TRUE;
					
					$file .= $fileExtension;
				}				
			}
			
			if($fileFounded)
			{
				extract($vars);
				
				ob_start();
				
				require($file);
				
				if($return)
				{
					$buffer = ob_get_contents();
					@ob_end_clean();
					return $buffer;
				}
				else
				{	
					echo ob_get_contents();
					@ob_end_clean();
				}
			}
			else
			{
				die('Página não encontrada!');
			}
		}
	}
?>