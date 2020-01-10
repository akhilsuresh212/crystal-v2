<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/**************************************************************
 * For initaising tables and datas to be used in api
 **************************************************************/

class init
{
    private $image;
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
            <ul class="nav nav-pills">
                <li><a href="#config.database" data-toggle="pill">test</a></li>
                <li><a href="#config.project" data-toggle="pill">test</a></li>
                <li><a href="#config.environment" data-toggle="pill">test</a></li>
            </ul>
            <div class="col-sm-6 col-lg-6 m-auto">
                <?php $init->check_php(); ?>
                <div class="border p-3">
                    <h3>Configure Crystal</h3>
                    <hr>
                    <div class="form-group" id="config_div">

                        Crystal Need to be configured before using it.
                        <small>
                            <p>Crystal might create a database and some configuration files for this environment.</p>
                            <ul id="steps" class="list-group list-group-flush">
                            </ul>
                        </small>

                        <div id="config.project" class="tab-pane active fade in" class="my-3">
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
                            <div class="form-group">
                                <label for="project.author">Author</label>
                                <input type="text" class="form-control" name="project.author" id="project.author" aria-describedby="project.auther.help" placeholder="John Wick">
                                <small id="project.auther.help" class="form-text text-muted">Name of the Author</small>
                            </div>
                            <div class="form-group">
                                <label for="project.date">Date</label>
                                <input type="date" class="form-control" name="project.date" id="project.date" aria-describedby="project.date.help" value="<?php echo Date('Y-m-d'); ?>" placeholder="12/10/1024">
                                <small id="project.date.help" class="form-text text-muted">Project Start date</small>
                            </div>
                        </div>
                        <div hidden class="form-group" class="tab-pane fade" id="config.environment">
                            <div class="form-group">
                                <label for="env.type">Environment</label>
                                <select class="form-control" name="env.type" id="env.type">
                                    <option>Developement</option>
                                    <option>Test</option>
                                    <option>Production</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="env.siteurl">Siteurl</label>
                                <input type="text" class="form-control" name="env.siteurl" id="env.siteurl" aria-describedby="env.siteurl.help" placeholder="http://localhost">
                                <small id="env.siteurl.help" class="form-text text-muted">URL to the root location of site</small>
                            </div>
                            <div class="form-group">
                                <label for="env.abspath">Absoute Path</label>
                                <input type="text" class="form-control" name="env.abspath" id="env.abspath" aria-describedby="env.abspath.help" placeholder="/var/www/html/project">
                                <small id="env.abspath.help" class="form-text text-muted">Full path to project directory</small>
                            </div>
                        </div>
                        <div class="form-group" class="tab-pane fade" id="config.database">
                            <div class="form-group">
                                <label for="db.host">Host</label>
                                <input type="text" class="form-control" name="db.host" id="db.host" aria-describedby="db.host.help" placeholder="localhost">
                                <small id="db.host.help" class="form-text text-muted">Host to connect to database</small>
                            </div>
                            <div class="form-group">
                                <label for="db.user">User</label>
                                <input type="text" class="form-control" name="db.user" id="db.user" aria-describedby="db.user.help" placeholder="root">
                                <small id="db.user.help" class="form-text text-muted">MySQl database username</small>
                            </div>
                            <div class="form-group">
                                <label for="db.password">Password</label>
                                <input type="password" class="form-control" name="db.password" id="db.password" aria-describedby="db.password.help" placeholder="Password">
                                <small id="db.password.help" class="form-text text-muted">MySQL Password</small>
                            </div>
                            <div class="form-group">
                                <label for="db.database">Database</label>
                                <select class="form-control" name="db.database" id="db.database">
                                    <option>Crystal</option>
                                    <option>Crystal 2</option>
                                    <option>Crystal 3</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="db.createCrystal" id="db.createCrystal" value="createCrystalDb" checked>
                                    Create DB for Crystal
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary px-3">Next</button>
                        <!-- <button id="config_std_btn" class="btn btn-sm btn-primary px-3"> Start Now! </button> -->
                    </div>

                    <hr>
                    <small class="text-info">This page is intented to run on local</small>
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