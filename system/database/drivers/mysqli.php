<?php	
    require(DIR_SYSTEM . 'database/database_interface.php');

    final class DB_Mysqli implements DatabaseInterface
    {
        private $con;
        private $result;

        function __construct($hostname, $username, $password, $database)
        {			
            $this->con = new mysqli($hostname, $username, $password, $database);

            if ($this->con->connect_errno) 
            {
                throw new SQLException($this->con->connect_errno, $this->con->connect_error);
            }
        }

        public function query($sql)
        {
            $this->result = $this->con->query($sql);

            if ($this->con->errno)
            {
                throw new SQLException($this->con->errno, $this->con->error);
            }
        }

        public function resultArrayAssoc()
        {
            return (is_object($this->result)) ? $this->result->fetch_all(MYSQLI_ASSOC) : null;
        }

        public function getNumRows()
        {
            return (is_object($this->result)) ? $this->result->num_rows : null;
        }

        public function getNumFields()
        {
            return (is_object($this->result)) ? $this->result->field_count : null;
        }

        public function setCharset()
        {
            $charset = '';

            switch(CHARSET)
            {
                case 'UTF-8' :
                    $charset = 'utf8';
                    break;

                default : 
                    $charset = 'utf8';
                    break;
            }

            $this->con->set_charset($charset);
        }
        
        public function escape($value)
        {
            return $this->con->real_escape_string($value);
	}
    }
 ?>