<?php

/********************************************************************************
 * 
 ********************************************************************************/

class Log
{
    private static $device;

    public static function setDevice($dev)
    {
        Log::$device = $dev;
    }

    public static function error($message)
    {
        $file = API_ABSPATH . "core/log/error_log.log";
        $msg = "[";
        $msg .= date('d-m-y, h:i:s A');
        $msg .= "] - [ ";
        $msg .= Log::$device;
        $msg .= " ] ------------ ";
        $msg .= $message;
        $msg .= "\n";

        file_put_contents($file, $msg, FILE_APPEND);
    }

    public static function access($path)
    {
        $file = API_ABSPATH . "core/log/access_log.log";
        $msg = "[";
        $msg .= date('d-m-y, h:i:s A');
        $msg .= "] - Request From [";
        $msg .= Log::$device;
        $msg .= "][" . $_SERVER['REMOTE_ADDR'] . "] ------- ";
        $msg .= " Path : [" . $_SERVER['REQUEST_METHOD'] . "]";
        $msg .= $path;
        $msg .= "\n";
        file_put_contents($file, $msg, FILE_APPEND);
    }
    public static function blocked_access($path)
    {
        $file = API_ABSPATH . "core/log/access_log.log";
        $msg = "[";
        $msg .= date('d-m-y, h:i:s A');
        $msg .= "] - [ UNAUTHORIZED REQUEST ] / (" . $_SERVER['REMOTE_ADDR'] . ")(" . $_SERVER['HTTP_USER_AGENT'] . ")";
        $msg .= " ------- ";
        $msg .= " Path : [" . $_SERVER['REQUEST_METHOD'] . "]";
        $msg .= $path;
        $msg .= "\n";
        file_put_contents($file, $msg, FILE_APPEND);
    }
}
