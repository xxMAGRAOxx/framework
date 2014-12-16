<?php
    require(DIR_SYSTEM . 'libraries/exceptions/sql_exception.php');

    class Database
    {
        private $driver;//O cara que é direcionado para o banco em questão. Ex: Mysql, Postgress etc.

        private $errorMessage;
        private $errorCode;
        private $hasError = FALSE;

        public function __construct($driver, $hostname, $username, $password, $database)
        {
            $this->connect($driver, $hostname, $username, $password, $database);
        }

        private function connect($driver, $hostname, $username, $password, $database)
        {
            $file = DIR_SYSTEM . 'database/drivers/' . $driver . '.php';

            if (file_exists($file))
            {
                require($file);

                $Class = 'DB_' . $driver;

                try
                {
                    $this->driver = @new $Class($hostname, $username, $password, $database);

                    $this->driver->setCharset();
                }
                catch(SQLException $sqlEXC)
                {
                    $this->hasError = TRUE;
                    $this->errorMessage = $sqlEXC->getCustomError()['message'];
                    $this->errorCode = $sqlEXC->getCustomError()['code'];
                    Log::write();
                }
            }
            else
            {
                die('Não foi possível localizar o driver ' . $driver . '!');
            }
        }

        public function query($sql)
        {
            if(is_object($this->driver))
            {
                try
                {
                    $this->escape($sql);
                    $this->driver->query($sql);
                }
                catch(SQLException $sqlEXC)
                {
                    $this->hasError = TRUE;
                    $this->errorMessage = $sqlEXC->getCustomError()['message'];
                    $this->errorCode = $sqlEXC->getCustomError()['code'];
                    Log::write($sqlEXC->getCustomError()['fullMessage']);
                }
            }
        }

        private function escape($value)
        {
            return $this->driver->escape($value);
        }

        public function getNumRows()
        {
            return $this->driver->getNumRows();
        }

        public function getNumFields()
        {
            return $this->driver->getNumFields();
        }

        public function getLastId()
        {
            return $this->driver->getLastId();
        }

        public function resultArrayAssoc()
        {
            return $this->driver->resultArrayAssoc();
        }

        public function getErrorCode()
        {
            return $this->errorCode();
        }

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        public function hasError()
        {
            return $this->hasError;
        }
    }
?>