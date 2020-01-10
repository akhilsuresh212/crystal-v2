<?php

class Response
{
    public static function success($respose_code, $data = "", $msg = "")
    {
        $data = [
            'status_code'   => $respose_code,
            'status'       => (!empty($msg)) ? $msg : null,
            'data'          => (!empty($data)) ? $data : null
        ];

        return $data;
    }

    public static function error($respose_code, $msg)
    {
        $data = [
            'status_code'   => $respose_code,
            'status'       => $msg
        ];
        return $data;
    }
}
