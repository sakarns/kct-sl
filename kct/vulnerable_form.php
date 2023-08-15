<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo htmlspecialchars($_POST['name']);
    echo $_POST['name'];
}
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
    <form action="vulnerable_form.php" method="POST">
        <label>Username</label>
        <input type="text" name="name" placeholder="username">
        <button>Submit</button>
    </form>
</body>

</html>