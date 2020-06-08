<?php 
 namespace Core;

 class Error 
 {
    /**
     * Error Handler Convert All Errors To Exceptions by Throwing an ErrorException 
     * 
     * @param int $level - error level
     * @param string $message - error message
     * @param $file - file name the error wase raisd in 
     * @param int $line line number in the file 
     * 
     */
    public static function errorHandler($level,$message,$file,$line)
    {
        if(error_reporting() !== 0)
        {
            throw new \ErrorException($message,0,$level,$file,$line);
        }
    }

    public static function exceptionHandler($exception)
    {
        echo "<h1> Fatal Error .</h1>";
        echo "<p> Uncaught Exception".get_class($exception)."</p>";
        echo "<p> Message  : ".$exception->getMessage()."</p>";
        echo "<p> Stack Trace <pre>".$exception->getTraceAsString()."</pre></p>";
        echo "<p> Uncaught Exception".$exception->getFile()." on line : ". $exception->getLing() ."</p>";
    }
 }