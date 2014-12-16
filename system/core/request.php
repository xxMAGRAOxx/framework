<?php
   // require(DIR_SYSTEM . 'libraries/exceptions/request_exception.php');

    class Request
    {
        private $__GET;
        private $__POST;
        private $param;
        private $requestType;

        public function __construct()
        {
            /** Assinamos as superglobais para uma espécie de ?garantia de segurança? **/
            $this->__GET  = $_GET;
            $this->__POST = $_POST;

            unset($_GET);
            unset($_POST);
            unset($_REQUEST);
        }

        public function post($param = NULL, $xss = FALSE)
        {            
            if($xss)
            {
                $this->param        = $param;
                $this->requestType  = 'POST';

                $this->produceSecurity();
            }
            
            if(isset($param))
            {
                return array_key_exists($param, $this->__POST) ? $this->__POST[$param] : FALSE;                
            }
            else /*Se não for especificado parâmetro devolvemos o array inteiro */
            {
                return $this->__POST;
            }
        }
        
        public function get($param = NULL, $xss = FALSE)
        {
            if($xss)
            {
                $this->param        = $param;
                $this->requestType  = 'GET';

                $this->produceSecurity();
            }

            if(isset($param))
            {
                return array_key_exists($param, $this->__GET) ? $this->__GET[$param] : FALSE;
            }
            else /*Se não for especificado parâmetro devolvemos o array inteiro */
            {
                return $this->__GET;
            }
        }

        private function produceSecurity()
        {
            if(isset($this->param))
            {
                if($this->requestType == 'POST')
                {
                    $value =& $this->__POST[$this->param];
                    $this->xssClean($value);
                }
                else if($this->requestType == 'GET')
                {
                    $value =& $this->__GET[$this->param];
                    $this->xssClean($value);
                }
            }
            else //Se não foi especificado então fazemos para todo o array
            {
                $requestType = '__' . $this->requestType;
                
                foreach($this->$requestType as &$value)
                {
                    $this->xssClean($value);
                }
            }
        }
        
        private function xssClean(&$value)
        {
            $value = htmlspecialchars($value);
        }
    }
?>