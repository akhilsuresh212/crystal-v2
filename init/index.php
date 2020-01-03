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

    public function check_php()
    {
        if (PHP_VERSION_ID < 70000) {
            echo '<div class="card p-3"> <h5>This version of PHP is not supported!</h5> <span> <p>Require 7.0+</p></span> <span> <p>Installed ' . PHP_VERSION . ' </p></span> </div>';
            exit;
        }
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>Initiating Crystal</title>
</head>

<body class="mt-10">
    <div class="container py-5">
        <!-- Default config start -->
        <div class="row">
            <div class="col-sm-6 col-lg-6 m-auto">
                <?php $init->check_php(); ?>
                <div class="border p-3">
                    <h3>Configure Crystal</h3>
                    <hr>
                    <div class="form-group" id="config-default">

                        Crystal Need to be configured before using it.
                        <small>
                            <p>Crystal might create a database and some configuration files for this environment.</p>
                            <ul id="steps" class="list-group list-group-flush">
                            </ul>
                        </small>
                        <div id="config_details_div" class="my-3">
                            <div class="form-group">
                                <label for="project.name">
                                    Project Name
                                </label>
                                <input type="text" placeholder="My project" name="project.name" id="project.name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="project.description">
                                    Description
                                </label>
                                <textarea class="form-control" name="project.description" id="project.description" cols="100" rows="3" placeholder="Project Description"></textarea>
                            </div>
                            <button class="btn btn-sm btn-primary">Next</button>
                        </div>
                        <button id="config_std_btn" class="btn btn-sm btn-primary px-3"> Start Now! </button>
                    </div>
                </div>
            </div>

            <!-- default config end -->

        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>