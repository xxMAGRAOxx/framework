<?php
	class Home extends Controller
	{
		public function index($param1 = 10)
		{
			echo "<strong>{$param1}</strong>";
			echo $this->request->get('route');
			echo $this->load->view('welcome', array('val1' => 1, 'val2' => 2));
		}	
	}
?>