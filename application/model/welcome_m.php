<?php
    class Welcome_m extends Model
    {		
        public function helloWorld()
        {
            $this->db->query('select * from contacts');
            return $this->db->resultArrayAssoc();
        }
    }
?>