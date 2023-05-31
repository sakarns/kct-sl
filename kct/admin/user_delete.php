<?php
session_start();
ini_set('display_error',1);
include_once __DIR__.'/../config/connection.php';
if(!isset($_SESSION['username']))
    header('location:login.php');

if(isset($_GET['id']))
{
    $query = " DELETE FROM `users` WHERE id=".$_GET['id'];
    $result = mysqli_query($conn,$query);
    if($result){
        header('location:user_mgmt.php?deletion=success');
    }
}
?>