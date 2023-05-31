<?php
// define("DB_HOST","localhost");
// define("DB_USERNAME","root");
// define("DB_PASSWORD","");
// define("DB_DATABASE","employee_mgmt");

include_once("dbconnection.php");
$db = new DBConnection("localhost","root","","employee_mgmt");
if($db->openConnection())
    echo 'Database connection successful';
else
    die("couldn't connect to database !");
?>