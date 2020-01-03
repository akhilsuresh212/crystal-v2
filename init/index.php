<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/**************************************************************
 * For initaising tables and datas to be used in api
 **************************************************************/

class init
{
    public function __construct()
    {
        // require_once '../core/database/class.databasedriver.php';
        // require_once '../core/database/class.database.php';
    }

    private function create_tables()
    {
        // table for storing auth key
        // Db::query('CREATE DATABASE IF NOT EXISTS crystal_data ');
        // Db::executeOnly();

        // Db::query('USE crystal_data');
        // Db::executeOnly();

        // Db::query('CREATE TABLE')
    }

    private function create_user()
    {
    }
}

$init = new init();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <title>Initiating Crystal</title>
</head>

<body class="mt-10">
    <div class="container py-5">
        <div class="col-sm-6 col-lg-6 m-auto">
            <div class="border p-3">
                <h3>Configure Crystal</h3>
                <hr>
                <div class="form-group" id="config-default">
                    <small class="text-primary">
                        Initiate Crystal with default settings:
                        <ul>
                            <li>Default Database</li>
                            <li>Dafault configuration</li>
                            <li>Default Admin Panel</li>
                        </ul>
                    </small>
                    <button class="btn btn-sm btn-primary px-3"> Initiate with default settings </button>
                </div>
                <div class="form-group" id="">
                    <button id="config-default-btn" class="btn btn-sm btn-success px-3">I want to customise</button>
                </div>
                <div id="config-custom-div">
                    <form class="form" action="" method="post">
                        <div class="form-group py-2 px-3">
                            <div class="form-row">
                                <label for="db_host">Host</label>
                                <input class="form-control" placeholder="https://myhost.com" type="text" name="db_host" id="db_host">
                            </div>
                            <div class="form-row">
                                <label class="mt-2" for="db_user">Username</label>
                                <input class="form-control" type="text" name="db_user" id="db_user" placeholder="root">
                            </div>
                            <div class="form-row">
                                <label class="mt-2" for="db_pass">Password</label>
                                <input class="form-control" type="password" name="db_pass" id="db_pass">
                            </div>
                            <div class="form-row">
                                <label class="mt-2" for="db_name">Database</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button">Fetch DB</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</html>