<?php
include '../classes/class_login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $objLogin = new Login($username, $password);
    $objLogin->authUser();

}
?>