<?php

class File
{
    public function __construct()
    {
        require_once '../library/library.response.php';
    }
    public function createFile()
    {
        if (file_exists('../../api/crystal.json')) {
            return ([
                'status_code'    => '1',
                'status'         => 'file exists',
                'data'           => file_get_contents('../../api/crystal.json')
            ]);
        }
        if ($file = fopen('../../api/crystal.json', 'w')) {

            // general configuration 
            $info['project']['title']           = "Test Project";
            $info['project']['Description']     = "test description";
            $info['project']['Author']          = "m.l_b";
            $info['project']['date']            = '10/10/2020';

            // environment configuration
            $info['environment']['name']        = "development";
            $info['environment']['siteurl']     = "localhost";
            $info['environment']['abs_path']    = 'var/www/html/CrystalV2';

            // database configuration
            $info['environment']['database']['type']        = 'mysql';
            $info['environment']['database']['host']        = 'localhost';
            $info['environment']['database']['username']    = 'phpmyadmin';
            $info['environment']['database']['password']    = rtrim(base64_encode("root"), '=');

            fwrite($file, json_encode($info));
            fclose($file);
            return Response::success("File created.");
        }
        return Response::error("Failed to crated file. This could be due to some permission issue");
    }
}
