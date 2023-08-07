<?php

include_once __dir__ . '/../config/connection.php';
include __dir__ . '/../include/page_section/header.php';

if (!isset($_SESSION['username']))
  header("location:login.php");




$showAlert = false;
$id = $firstname = $lastname = $appointment_date = $designation = $tbl_users_id = '';
$err = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  var_dump($_POST);

  // Validate firstname
  if (empty($_POST["firstname"])) {
    $err['firstname_err'] = "Please enter a firstname.";
  } elseif (strlen($_POST["firstname"]) > 20) {
    $err['firstname_err'] = "Firstname Too Long";
  } else
    $firstname = $_POST["firstname"];

  //Validate lastname
  if (empty($_POST["lastname"])) {
    $err['lastname_err'] = "Please enter a lastname.";
  } elseif (strlen($_POST["lastname"]) > 20) {
    $err['lastname_err'] = "Lastname Too Long";
  } else
    $lastname = $_POST["lastname"];

  // Validate designation
  if ($_POST["designation"] == 0) {
    $err['designation_err'] = "Please select a designation.";
  } else {
    $designation = $_POST["designation"];
  }

  //Validate Email
  if (empty($_POST['appointment_date'])) {
    $err['appointment_err'] = "Please enter valid date";
  } else
    $appointment_date = $_POST['appointment_date'];

  //Validate has tbl_user_id
  if (empty($_POST['hdnEmpAcUserId'])) {
    $err['no_user_id'] = "Invalid user id";
  } else
    $tbl_users_id = $_POST['hdnEmpAcUserId'];

  // Check input errors before inserting in database
  if (count($err) == 0) {
    $query = "INSERT INTO `employee_profile` ( `firstname`, 
          `lastname`, `designation_id`,`appointment_date`,`tbl_users_id`) 
          VALUES ('$firstname', '$lastname','$designation',
          '$appointment_date','$tbl_users_id' )";

    $result = mysqli_query($conn, $query);
    //var_dump($result);
    if ($result) {
      $showAlert = true;
      header('location:employee_profile.php');
    }
  }
}

?>


<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
                <h3 class="card-title">Employee Profile Management</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="employee_profile.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" id="hdnEmpAcUserId" name="hdnEmpAcUserId" readonly>
                  </div>
                  <div class="form-group">

                    <label for="acUsername">Username</label>
                    <input type="text" id="acUsername" name="acUsername" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                    <input type="text" name="hdnId" value="<?php echo $id; ?>">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" value="" class="form-control" id="firstname" placeholder="Enter firstname">
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" value="" class="form-control" id="lastname" placeholder="Enter lastname">
                  </div>
                  <div class="form-group">
                    <label for="designation">Designation</label>
                    <select name="designation" class="form-control" type="dropdown">
                      <option value="" selected>Select Here</option>
                      <option value="1">CEO</option>
                      <option value="2">CTO</option>
                      <option value="3">COO</option>
                      <option value="4">Manager</option>
                      <option value="5">Department Incharge</option>
                      <option value="6">Supervisor</option>
                      <option value="7">Clerk</option>
                      <option value="8">others</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control" id="userPassword" placeholder="Enter Password">
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
                <table id="profileTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Appointment Date</th>
                      <th>User Account</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sn = 1;
                    $query = "SELECT concat(a.firstname,' ',a.lastname) as name,b.designation,a.hasUserAccount,a.appointment_date FROM employee_profile a LEFT JOIN employee_designation b ON a.designation_id=b.id";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['designation']; ?></td>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td>
                          <?php
                          if ($row['hasUserAccount'] == 0)
                            echo '<span class="badge badge-danger">Not Created</span>';
                          else
                            echo '<span class="badge badge-success">Created</span>';

                          ?>
                        </td>

                      </tr>
                    <?php
                      $sn++;
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
      let acUserId = sessionStorage.getItem('empAcUserId');
      let acUsername = sessionStorage.getItem('empAcUsername');
      $('#hdnEmpAcUserId').val(acUserId);
      $('#acUsername').val(acUsername);
      //alert(sessionStorage.getItem('empUserId'));
    });
  </script>
  </body>

  </html>