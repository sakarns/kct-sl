<?php
class DbConnection
{

    private $username = "root";
    private $password = "";
    private $database = "employee_mgmt";
    public $con;
    private $servername = "localhost";
    // Database Connection 
    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            return $this->con;
        }
    }
}


?>