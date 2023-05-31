<?php
include 'class_calc.php';

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$calc = $_POST['calc'];

$calculator = new Calculator($num1, $num2, $calc);
$result = $calculator->calcMethod();

echo $result;

?>