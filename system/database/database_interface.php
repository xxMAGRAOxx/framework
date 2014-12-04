<?php
	interface DatabaseInterface
	{
		 public function query($query);
		 public function getNumRows();
		 public function getNumFields();
		 public function setCharset();
		 public function resultArrayAssoc();
	}
?>