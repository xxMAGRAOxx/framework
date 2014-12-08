<?php
	class Welcome extends Controller
	{
		public function index()
		{		
			$data = array('nome' => 'Carlos', 'idade' => 27);
			
			$this->response->setOutput('Foi');			

			$this->load->model('account/welcomes');
			
			$this->welcomes->helloWorld();
			
			$this->load->view('common/header');
			$this->load->view('body', array('body' => 'Corpo'));
			$this->load->view('footer');
		
		}
	}
?>