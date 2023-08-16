<?php

include_once __dir__ . '/../config/connection.php';
include __dir__ . '/../include/page_section/header.php';

if (!isset($_SESSION['username']))
  header("location:login.php");


$showAlert = false;
$pswdMismatch = false;
$id = $username = $email = $password = $confirm_password = "";
$username_err = '';
$password_err = '';
$confirm_password_err = '';
$email_err = '';
$err = [];
//variable for edit operation
$no_records = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //var_dump($_POST);

  $username = $_POST['username'];
  // Validate username
  if (empty(trim($_POST["username"]))) {
    $err['username_err'] = "Please enter a username.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
    $err["username_err"] = "Username can only contain letters, numbers, and underscores.";
  } else {
    $sql = "SELECT `id` FROM `tbl_users` WHERE `username` ='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      $err["username_err"] = "Username already taken!";
    } else
      $username = trim($_POST['username']);
    // Close connection statement
    //  mysqli_close($conn);
  }

  //Validate Password
  if (empty(trim($_POST["password"]))) {
    $err['password_err'] = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 5) {
    $err['password_err'] = "Password must have atleast 5 characters.";
  } else {
    $password = md5(trim($_POST["password"]));
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $err['confirm_password_err'] = "Please confirm password.";
  } else {
    $confirm_password = md5(trim($_POST["confirm_password"]));
    if (empty($password_err) && ($password != $confirm_password)) {
      $err['confirm_password_err'] = "Password did not match.";
    }
  }

  //Validate Email
  if (empty($_POST['email'])) {
    $err['email_err'] = "Please email address";
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $err['email_err'] = "Invalid email address";
  } else
    $email = trim($_POST['email']);

  // Check input errors before inserting in database
  if (count($err) == 0) {

    if (isset($_POST['hdnId']))
      $query = "UPDATE `tbl_users` SET username='" . $username . "',email='" . $email . "',password='" . $password . "' WHERE id='" . $_POST['hdnId'] . "'";
    else
      $query = "INSERT INTO `tbl_users` ( `username`, `password`, `email`) VALUES ('$username', '$password','$email' )";

    $result = mysqli_query($conn, $query);
    //var_dump($result);
    if ($result) {
      $showAlert = true;
      header('location:user_mgmt.php');
    }
  }

  unset($err);
} else {
  // for editing user records
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // var_dump($id);
    // exit;
    $query = "SELECT username, email FROM `tbl_users` WHERE id=" . $id;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $username = $row['username'];
        $email = $row['email'];
      }
    }
  }
}
?>


<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <?php include __DIR__ . '/../include/page_section/content_header.php'; ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include __DIR__ . '/../include/page_section/sidebar.php'; ?>
  </aside>
  <!-- /Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        if ($showAlert) {

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
        if (isset($err)) {
          foreach ($err as $e) {
            echo ' 
            <div class="alert alert-danger 
              alert-dismissible fade show" role="alert"> 
              <strong>Error!</strong> ' . $e . '
              <button type="button" class="close" 
                    data-dismiss="alert aria-label="Close">
                    <span aria-hidden="true">×</span> 
              </button> 
            </div> ';
          }
        }
        if ($no_records) {
          echo ' 
        <div class="alert alert-danger 
          alert-dismissible fade show" role="alert"> 
          <strong>Error!</strong> No Records Found!        
          <button type="button" class="close" 
                data-dismiss="alert aria-label="Close">
                <span aria-hidden="true">×</span> 
          </button> 
        </div> ';
        }
        if (isset($_GET['deletion'])) {
          echo '<div class="alert alert-success 
                alert-dismissible fade show" role="alert">        
                <strong>Success!</strong> User Deleted Successfully!! 
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">×</span> 
                </button> 
            </div>';
        }


        ?>


        <!-- Form row -->
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Management</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="user_mgmt.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="hdnId" value="<?php echo $id; ?>">
                    <label for="userName">Username</label>
                    <input type="text" name="username" value="<?php echo $username ?>" class="form-control" id="userName" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="userPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="userPassword" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-default float-right">Cancel</button>
                  <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Submit</button>

                </div>
              </form>
            </div>
            <!--/.card -->
          </div>
          <!--/.col-->
        </div>
        <!-- /.row (Form row) -->
        <!--Search bar-->
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <input type="search" class="form-control form-control-lg" id="user_search" placeholder="Search.....">
              <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
          <!--/.col-->
        </div>
        <!--/.search bar-->
        <div style="display:hidden;height:20px"></div>
        <!--table row-->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Records</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="userTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>IsActive</th>
                      <th>Create Profile</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $sn = 1;
                    $query = "SELECT a.id,a.username,a.email,a.is_active,b.id as emp_profile_id FROM `tbl_users` a LEFT JOIN `employee_profile` b ON b.tbl_users_id= a.id order by id DESC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {

                        echo
                        "<tr>
                                  <td>" . $sn . "</td>
                                  <td data-username=" . $row['username'] . ">" . $row['username'] . "</td>
                                  <td>" . $row['email'] . "</td>
                                  <td style='text-align:center'>
                                    <div class='form-check form-switch'>
                                      <input class='form-check-input' type='checkbox'"
                          . (($row['is_active'] == '1') ? 'checked' : '') . ">
                                    </div>
                                  </td>
                                  <td style='text-align:center'>
                                  <a  href='employee_profile.php' data-user='" . $row['username'] . "'data-id='" . $row['id'] . "' id='goToPrifile' >
                                  <i class='fas fa-list' style='color: #6b8fcc;'></i>
                                 </a>
                                  </td>
                                  <td>
                                    <a  href='user_mgmt.php?id=" . $row['id'] . "' id='btnEditUser_" . $row['id'] . "' >
                                      <i class='fas fa-edit' style='color: #6b8fcc;'></i>
                                    </a>
                                    |
                                    <a href='user_delete.php?id=" . $row['id'] . "' id='btnDeleteUser'>
                                      <i class='fas fa-trash' style='color: #c85f65;'></i>
                                    </a>
                                  </td>
                              </tr>";
                        $sn++;
                      }
                    }
                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col -->
        </div>
        <!--/. row(table row)-->


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--footer-->

  <?php include __DIR__ . '/../include/page_section/footer.php'; ?>
  <script>
    $(document).ready(function() {
      $(document).on('click', '#goToPrifile', function() {
        var user_id = $(this).attr('data-id');
        var user_name = $(this).attr('data-user');

        sessionStorage.setItem('empAcUserId', user_id);
        sessionStorage.setItem('empAcUsername', user_name);

        //$.session.set('empUserId'.user_id);
        //alert(sessionStorage.getItem('empUserId'));
        // alert(user_id);
      });
      $('#user_search').keyup(function() {
        var input = $(this).val();
        if (input != "") {
          $.ajax({
            url: "user_ajax_search.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              $('#userTable tbody tr').empty();
              $('#userTable tbody').append(data);

            }
          });
        }
      });
    });
  </script>
  </body>

  </html>