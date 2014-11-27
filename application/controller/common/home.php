<?php
	class Home extends Controller
	{
		public function index($param1 = 10)
		{
			echo "<strong>{$param1}</strong>";
		}
		
	}
?>