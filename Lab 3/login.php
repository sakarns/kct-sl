<?php
session_start();
ini_set('display_errors', 1);
include_once('connection.php');
$exists = false;
$wrongPswd = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "Select * from users where username='$username'";

  $result = mysqli_query($con, $sql);

  $num = mysqli_num_rows($result);
  if ($num == 0) {
    $exists = "User not available";
  } else {
    $sql = "Select * from users where password='$password'";
    $result = mysqli_query($con, $sql);

    $num = mysqli_num_rows($result);
    if ($num > 0) {
      $_SESSION['username'] = $username;
      header('location: table.php');
    } else {
      $wrongPswd = "Wrong Password! Try again";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once('header.php'); ?>
  <title>CRUD | Login</title>
</head>

<body>
  <form method="POST" class="max-w-md mx-auto my-36 p-6 bg-gray-200 rounded-md shadow-md">
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="username">
        Username
      </label>
      <!-- Error username exist alert -->
      <span class="text-red-500">
        <?php echo $exists; ?>
      </span>
      <input name="username"
        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text" placeholder="Enter your username" />
    </div>

    <div class="mb-4">

      <label class="block text-gray-700 font-bold mb-2" for="message">
        Password
      </label> <!-- Error password alert -->
      <span class="text-red-500">
        <?php echo $wrongPswd; ?>
      </span>
      <input name="password"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="password" placeholder="Enter your password" />
    </div>

    <div class="flex items-center justify-center">
      <button
        class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
        Login
      </button>
    </div>
  </form>
</body>

</html>