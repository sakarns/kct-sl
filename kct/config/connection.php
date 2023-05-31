<?php

$servername = "localhost"; 
$username = "root"; 
$password = "";
$database = "employee_mgmt";
$conn = mysqli_connect($servername, 
         $username, $password, $database);
//var_dump($conn);

// if($conn)
//     echo "successful database connection";
// else
//     echo "Could not connect to database";



/*---------------DATABASE SETTINGS---------------*/
// $db_host = "localhost";
// $db_name = "employee_mgmt";
// $db_user = "root";
// $db_pass = "";


// try {
//     $dbcon = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass);
//     $dbcon->exec('SET NAMES utf8');
//     $dbcon->exec("SET character_set_client=utf8");
//     $dbcon->exec("SET character_set_connection=utf8");
//     $dbcon->exec("SET character_set_results=utf8");
//     echo "connection successfull";

// } catch (PDOException $e) {
//     print "Error!: " . $e->getMessage() . "<br/>";
//     die();
// }

?>