<?php
	class Welcome extends Controller
	{
		public function index()
		{		
			$data = array('nome' => 'Carlos', 'idade' => 27);
			
			$this->response->setHeader(JSON_HEADER);
			
			$this->response->setOutput(json_encode($data));
			


			/*$this->load->model('account/welcomes');
			
			$this->welcomes->helloWorld();
			
			$this->load->view('common/header');
			$this->load->view('body', array('body' => 'Corpo'));
			$this->load->view('footer');*/
		
		}
	}
?>