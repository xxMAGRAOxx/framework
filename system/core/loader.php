<?php
	final class Loader
	{
		public function view($view, $_VARS = array(), $return = FALSE)
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
				extract($_VARS);
				
				/*** Utilizamos um buffer para controlar a saída ***/
				
				ob_start();
				
				require($file);
				
				$buffer = ob_get_contents();
				
				ob_end_clean();
				
				
				/*** Para o caso de o Usuário querer controlar o ouput do seu controlador ***/
				if($return)
				{
					return $buffer;
				}
				else
				{	
					/*** Temos que pegar a instância do controlador pois daqui não temos acesso **/
					$instance =& Controller::getInstance();
					$instance->response->setOutput($buffer);
				}
			}
			else
			{
				die('Página '.basename($file).' não encontrada!');
			}
		}
		
		public function model($model)
		{
			$file = DIR_APPLICATION . 'model/' . $model . '.php';
			
			if(file_exists($file))
			{
				require($file);
				
				/* Temos que pegar a instância do controlador pois daqui não temos acesso.
				 * Em seguida transformamos o modelo em um objeto.
				 * O nome do objeto será o nome do modelo. Bacana, não?
				 */
				$Class = basename($model);
				$var = basename($model);
				
				$instance =& Controller::getInstance();
				$instance->$var = new $Class();
			}
			else
			{
				die('Não foi possível localizar o modelo '.basename($model).'!');
			}
		}
	}
?>