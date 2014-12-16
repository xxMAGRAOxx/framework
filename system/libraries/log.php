<?php
    class Log
    {
        public static function write($customMessage = null)
        {
            $_ERROR = error_get_last();

            $message = !isset($customMessage) ? self::friendlyErrorType($_ERROR['type']). ':  ' . $_ERROR['message'] . ' in ' . $_ERROR['file'] . ' on line ' . $_ERROR['line'] : $customMessage;

            $fileError = fopen(DIR_SYSTEM . 'logs/errors.log', 'a+');
            $fileErrorDetailed = fopen(DIR_SYSTEM . 'logs/detailed_erros.log', 'w');//Apaga e escreve no arquivo

            fwrite($fileError, date('d-m-Y G:i:s') . ' - ' . $message . "\n");
            fwrite($fileErrorDetailed, date('d-m-Y G:i:s') . ' - ' . print_r(debug_backtrace(), true)  . "\n");

            fclose($fileError);
            fclose($fileErrorDetailed);
        }

        private static function friendlyErrorType($type) 
        {
            $return =""; 
            if($type & E_ERROR) // 1 // 
                    $return.='& E_ERROR '; 
            if($type & E_WARNING) // 2 // 
                    $return.='& E_WARNING '; 
            if($type & E_PARSE) // 4 // 
                    $return.='& E_PARSE '; 
            if($type & E_NOTICE) // 8 // 
                    $return.='& E_NOTICE '; 
            if($type & E_CORE_ERROR) // 16 // 
                    $return.='& E_CORE_ERROR '; 
            if($type & E_CORE_WARNING) // 32 // 
                    $return.='& E_CORE_WARNING '; 
            if($type & E_COMPILE_ERROR) // 64 // 
                    $return.='& E_COMPILE_ERROR '; 
            if($type & E_COMPILE_WARNING) // 128 // 
                    $return.='& E_COMPILE_WARNING '; 
            if($type & E_USER_ERROR) // 256 // 
                    $return.='& E_USER_ERROR '; 
            if($type & E_USER_WARNING) // 512 // 
                    $return.='& E_USER_WARNING '; 
            if($type & E_USER_NOTICE) // 1024 // 
                    $return.='& E_USER_NOTICE '; 
            if($type & E_STRICT) // 2048 // 
                    $return.='& E_STRICT '; 
            if($type & E_RECOVERABLE_ERROR) // 4096 // 
                    $return.='& E_RECOVERABLE_ERROR '; 
            if($type & E_DEPRECATED) // 8192 // 
                    $return.='& E_DEPRECATED '; 
            if($type & E_USER_DEPRECATED) // 16384 // 
                    $return.='& E_USER_DEPRECATED '; 
            return substr($return, 4); 
        } 
    }
?>