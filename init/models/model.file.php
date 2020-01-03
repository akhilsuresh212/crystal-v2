<?php

class File
{
    public function __construct()
    {
        require_once '../library/library.response.php';
    }
    public function createFile()
    {
        if ($file = fopen('../../api/crystal.json', 'w')) {
            $info = json_encode([
                'project'=> [
                    'title'=>'test Project',
                    'description' => 'project desc'
                ]
            ]);
            fwrite($file, $info );
            fclose($file);
            return Response::success("File created.");
        }
        return Response::error("Failed to crated file. This could be due to some permission issue");
    }
}
