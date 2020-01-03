<?php

require_once '../library/library.response.php';
require_once '../models/model.databse.php';

$action = $_POST['action'];

$db_model = new DB_model();

print_r($db_model->get_database('localhost', 'phpmyadmin', 'root'));
switch ($action) {
    case 'get_db':
        echo json_encode($db_model->get_database($_POST['host'], $_POST['user'], $_POST['password']));
        break;
    case 'init_default':

        break;
}

exit;
