<?php
ini_set('display_errors', 1);
include_once('connection.php');

$showAlert = false;
$pswdMismatch = false;
$username = '';
$password = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];

  if ($_POST['password'] != $_POST['confirm_password']) {
    $pswdMismatch = "Password Mismatch";
  } else {
    $query = "INSERT INTO `users` (`username`, `password`, `email`, `mobile`, `address`) VALUES ('$username', '$password', '$email', '$mobile', '$address')";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if ($result) {
      $showAlert = true;
      header('location: login.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once('header.php'); ?>
  <title>CRUD | Form</title>
</head>

<body>
  <form method="POST" class="max-w-md mx-auto my-36 p-6 bg-gray-200 rounded-md shadow-md">
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="username">
        Username
      </label>
      <input name="username"
        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text" placeholder="Enter your name" />
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="message">
        Password
      </label>
      <span class="text-red-500">
        <?php echo $pswdMismatch; ?>
      </span>
      <input name="password"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="password" placeholder="Enter your password" />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="message">
        Confirm Password
      </label>
      <input name="confirm_password"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="password" placeholder="Confirm your password" />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="email">
        Email
      </label>
      <input name="email"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="email" placeholder="Enter your email" />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="message">
        Phone No.
      </label>
      <input name="mobile"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="tel" placeholder="Enter your phone number" pattern="[0-9]{10}" />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="message">
        Address
      </label>
      <input name="address"
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        type="text" placeholder="Enter your address" />
    </div>

    <div class="flex items-center justify-center">
      <button
        class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
        Send
      </button>
    </div>
  </form>
</body>

</html>