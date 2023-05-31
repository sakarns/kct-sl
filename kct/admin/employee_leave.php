<?php

include_once __dir__.'/../config/connection.php';
include __dir__.'/../include/page_section/header.php';
$showAlert='';
$id='';

echo($_SESSION['userId']);
$error_array = array();







$doc_path =dirname(__FILE__);
$lastId= $lst_insert_id='';

if($_SERVER["REQUEST_METHOD"]=="POST"){
  print_r($_FILES['leaveFile']);
  exit;

  if(isset($_SESSION['userId']))
    $userId = $_SESSION['userId'];
  else
    $error_array = "invalid user id";

  $reason = $_POST['reason'];
  $description = $_POST['description'];
  $type = $_POST['leaveType'];
  date_default_timezone_set('Asia/Kathmandu');
  $date_time_now = date('d-m-y h:i:s');
  echo $date_time_now;
  if(isset($_FILES['leaveFile'])){
    $file_name = $_FILES['leaveFile']['name'];
    $file_size = $_FILES['leaveFile']['size'];
    $file_type = $_FILES['leaveFile']['type'];
    $file_tmp = $_FILES['leaveFile']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_enc_name = md5($date_time_now);
    $new_file_name = $file_enc_name.".".$file_ext;
    $allowed_ext = array("jpeg","jpg","pdf","png");

    // move_uploaded_file($file_tmp,"../images"."/".$new_file_name);
    
    if(in_array($file_ext,$allowed_ext)==false){
      $error_array = "File format not allowed";
    }
    if($file_size > 2097152){
      $error_array = "File size exceeded";
    }

      if(count($error_array) <= 0)
      {
        $query = "INSERT INTO employee_leave_request (employee_user_id,leave_reason,leave_description,leave_type)
                  VALUES (?,?,?,?)";
        
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ssss",$userId,$reason,$description,$type);
      if($stmt->execute()){
        $lst_insert_id = mysqli_insert_id($conn);
        $query = "INSERT INTO employee_leave_documents(emp_leave_request_id,leave_document)
                  VALUES(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss",$lst_insert_id,$new_file_name);
        if($stmt->execute()){
          move_uploaded_file($file_tmp,"../images"."/".$new_file_name);
          echo "success";
        }       
        else
          echo "error";
      }
      
      















      
        
       
      // if(move_uploaded_file($file_tmp,"../images"."/".$new_file_name)){
      //   echo "file uploaded";
      // }
      // else
      // {
      //   echo "failed";
      // }
    }
    else{
      echo "error occured" ;
    }
      

    // if(empty($errors)==true){
    //   $uploaded =  move_uploaded_file($file_tmp,"/images".$file_name);
    //   echo $uploaded;
    //   echo "success";
    // }else{
    //   print_r($errors);
    // }

  }
}
 ?>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/kct/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <?php include __DIR__.'/../include/page_section/content_header.php';?>
  </nav>
  <!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <?php include __DIR__.'/../include/page_section/sidebar.php';?>
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
        if(isset($err) ) {
          foreach($err as $e){
            echo ' 
            <div class="alert alert-danger 
              alert-dismissible fade show" role="alert"> 
              <strong>Error!</strong> '. $e.'        
              <button type="button" class="close" 
                    data-dismiss="alert aria-label="Close">
                    <span aria-hidden="true">×</span> 
              </button> 
            </div> '; 
          }        
            
       }
       
       if(isset($_GET['deletion'])){
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
                <h3 class="card-title">Employee Leave Management</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="employee_leave.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">                  
                  <div class="form-group">
                  <input type="hidden" name="hdnId" value="<?php echo $id;?>">
                    <label for="reason">Leave Reason</label>
                    <input type="text" name="reason" value="" class="form-control" id="reason" placeholder="Enter Leave Subject/Reason">
                  </div>
                  <div class="form-group">
                    <label for="description">Leave Description</label></br>
                    <textarea class="form-control" name="description" rows="2" cols="100"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="leaveType">Leave Type</label>
                    <select name="leaveType" class="form-control" type="dropdown">
                        <option value="" selected>Select Here</option>
                        <option value="1">Short-term Leave</option>
                        <option value="2">Long-term</option>
                        <option value="3">Emergency LEave</option>
                        <option value="4">Sick Leave</option>
                        <option value="5">Department Incharge</option>                                               
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="appointment_date">Appointment Date</label>
                    <input type="file" name="leaveFile" class="form-control" id="leaveFile" >
                  </div>
                      
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="button"  class="btn btn-default float-right">Cancel</button>
                  <button type="submit"  class="btn btn-primary float-right" style="margin-right: 5px;">Submit</button>
                  
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
              <input type="search" class="form-control form-control-lg" id="user_search" 
              placeholder="Search.....">
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
  
  <?php include __DIR__.'/../include/page_section/footer.php';?>
 
  </body>

</html>