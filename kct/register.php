<?php
ini_set('display_errors',1);
include_once('config/connection.php');

$showAlert = false; 
$pswdMismatch = false;
$username = $email = $password = $confirm_password = "";
$username_err='';
$password_err='';
$confirm_password_err = '';
$email_err = '';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    //var_dump($_POST);
    
    $username = $_POST['username'];
    // Validate username
    if(empty(trim($_POST["username"]))){
      $username_err = "Please enter a username.";
    
    } else{
        $sql = "SELECT `id` FROM `users` WHERE `username` ='$username'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num > 0){
          $username_err = "Username already taken!";
        }else
          $username = trim($_POST['username']);
       
    }

    //Validate Password
    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Please confirm password.";     
    } else{       
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }else
          $confirm_password = trim($_POST["confirm_password"]);
    }

    //Validate Email
    if(empty($_POST['email'])){
       $email_err = "Please email address";
    }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      $email_err = "Invalid email address";
      //$email = trim($_POST['email']);
    }else
        $email = trim($_POST['email']);

     // Check input errors before inserting in database
     if(empty($username_err) && empty($password_err) && 
        empty($confirm_password_err && empty($email_err))){
              
        $query = "INSERT INTO `users` ( `username`, 
        `password`, `email`) VALUES ('$username', 
        '$password','$email' )";
  	    $result = mysqli_query($conn, $query);
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
  <style>

    div .error_msg{
      color:red;
    }
  </style>

<?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> '; 
    }
    if($pswdMismatch) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $pswdMismatch.'
    
       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span> 
       </button> 
     </div> '; 
   }
       
?>
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      
      <form action="register.php" method="post">
        <div class="error_msg">
          <span><?php echo $username_err; ?></span>
        </div>
        <div class="input-group mb-3">          
          <input name="username" type="text" class="form-control" 
          value="<?php echo $username;?>" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>         
        </div>   
        <div class="error_msg">
          <span><?php echo $email_err; ?></span>
        </div>     
        <div class="input-group mb-3">
          <input name="email" type="text" class="form-control" value="<?php echo $email;?>"  placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>          
        </div>     
        <div class="error_msg">
          <span class="invalid-msg">
            <?php echo $password_err; ?>
          </span>
        </div>   
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>          
        </div> 
        <div class="error_msg">
          <span class="invalid-msg">
            <?php echo $confirm_password_err; ?></span>
        </div>       
        <div class="input-group mb-3">
        
          <input name="confirm_password" type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>          
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
