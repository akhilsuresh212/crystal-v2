<?php

class DB_model
{
    private $db_host = "";
    private $db_user = "";
    private $db_pass = "";

    public function __construct()
    {
        require_once '../../api/core/database/class.databasedriver.php';
        require_once '../../api/core/database/class.database.php';
    }

    private function _connect($host, $user, $pass)
    {
        $this->db_host = $host;
        $this->db_pass = $pass;
        $this->db_user = $user;
    }

    public function get_database($host, $user, $pass)
    {
        $sql_obj = $this->_connect($host, $user, $pass);

        if ($databases = mysqli_query('SHOW DATABASES', $sql_obj)) {
            return $databases;
        }

        Response::error("Failed to list database");
    }
}
