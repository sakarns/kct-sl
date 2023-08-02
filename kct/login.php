<?php
session_start();
ini_set('display_errors',1);
include_once('config/connection.php');
$exists = false;
$wrongPswd = false;
$userId = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
  // $username = mysqli_real_escape_string($conn,$_POST["username"]); 
  // $password = mysqli_real_escape_string($conn,$_POST["password"]); 

  $username = $_POST["username"]; 
  $password = $_POST["password"]; 

  $sql = "Select * from users where username='$username'";    
  $result = mysqli_query($conn, $sql);    
  $num = mysqli_num_rows($result); 
  // var_dump($num);
  if($num == 0) {
    $exists = "User not available";
  }
  else{
    $sql = "Select id from users where password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    
    //var_dump(count($row));
    if($num > 0){  
      while($row = mysqli_fetch_array($result)){
        $userId = $row['id'];
      }    
     $_SESSION['username'] = $username;
     $_SESSION['userId'] = $userId;
      header('location:dashboard.php');
    }
    else{
      $wrongPswd = "Password mismatch! please try again";
    }
    
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <?php
  if($exists) {
    echo ' <div class="alert alert-danger 
        alert-dismissible fade show" role="alert">

    <strong>Error!</strong> '. $exists.'
    <button type="button" class="close" 
        data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">×</span> 
    </button>
   </div> '; 
 }
 if($wrongPswd) {
  echo ' <div class="alert alert-danger 
      alert-dismissible fade show" role="alert">

  <strong>Error!</strong> '. $wrongPswd.'
  <button type="button" class="close" 
      data-dismiss="alert" aria-label="Close"> 
      <span aria-hidden="true">×</span> 
  </button>
 </div> '; 
}
  ?>

  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="post">
          <div class="input-group mb-3">
            <input name="username" type="text" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>