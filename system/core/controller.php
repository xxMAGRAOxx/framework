<?php
	final class Controller
	{		
		public function dispatch(Action $action)
		{
			if (file_exists($action->getFile())) 
			{
				require_once($action->getFile());

				$class = $action->getClass();

				$controller = new $class($this->registry);

				if (is_callable(array($controller, $action->getMethod()))) {
					$action = call_user_func_array(array($controller, $action->getMethod()), $action->getArgs());
				} else {
					$action = $this->error;

					$this->error = '';
				}
			} else {
				$action = $this->error;

				$this->error = '';
			}

			return $action;
		}
	}
?>