<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "sl_mgmt";
$con = mysqli_connect($servername, $db_username, $db_password, $database);

if(!$con){
	die(mysqli_error($con));
}
?>