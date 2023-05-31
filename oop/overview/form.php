<?
include 'class_calc.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="calc.php">
        <input class="form-control" name="num1"><br />
        <input class="form-control" name="num2"><br />
        <select class="form-control" name="calc">
            <option value="add" selected>Add</option>
            <option value="sub">Subtact</option>
            <option value="mul">Multiply</option>
        </select>
        <button type="submit" class="form-control" name="btnCalculate">Calculate</button>
    </form>
</body>

</html>