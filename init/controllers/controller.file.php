<?php

require_once '../models/model.file.php';

$file = new File();

$action = $_POST['action'];

switch ($action) {
    case 'create_file':
        echo json_encode($file->createFile());
        break;

    default:
        # code...
        break;
}
