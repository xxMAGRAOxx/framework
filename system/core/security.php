<?php
   /*
    *** Dicas básicas de segurança ***
    *   
    * - Desabilitar erros para dificultar a análise do Hacker. error_reporting(0);
    * - Desabilitar recursos do PHP. Ex: register_globals = Off, magic_quotes_gpc = Off
    * - Cuidado com injeções de Script(XSS). htmlspecialchars($string)
    * - Prevenir sql injection. Ex: addslashes($_POST["password"])
    * - Verificar questões de session. Ex: session_regenerate_id()
    */
    class Security
    {
        public function check()
        {
            if (get_magic_quotes_gpc())
            {
                $_GET = array_map('stripslashes', $_GET);

                $_POST = array_map('stripslashes', $_POST);

                $_COOKIE = array_map('stripslashes', $_COOKIE);
            }
        }
    }
 ?>