<?php

class AI_Log
{

    /**
     * Log message to file
     * @param string $message
     * @param string $file
     * @return void 
     */

    public static function write($message, $file = 'system.log')
    {
        $log = new Zend_Log(
            new Zend_Log_Writer_Stream(APPLICATION_PATH . '/logs/' . $file)
        );
        $log->debug($message);
    }
}

