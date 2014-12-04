<?php
	class Welcomes extends Model
	{
		
		public function helloWorld()
		{
			$this->db->query('select * from contacts');					
		}
	}
?>