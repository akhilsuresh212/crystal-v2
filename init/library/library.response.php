<?php

class Response
{
    public static function success($data = "", $msg = "")
    {
        $data = [
            'status'    => "success",
            'message'   => (!empty($msg)) ? $msg : null,
            'data'      => (!empty($data)) ? $data : null
        ];

        return $data;
    }

    public static function error($msg)
    {
        $data = [
            'status'    => 'error',
            'message'   => $msg
        ];
        return $data;
    }
}
