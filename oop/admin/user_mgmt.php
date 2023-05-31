<?php
include __DIR__ . '/../include/page_section/header.php';
?>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/oop/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
                    <input type="hidden" name="hdnId" value="">
                    <label for="userName">Username</label>
                    <input type="text" name="username" value="" class="form-control" id="userName"
                      placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="" class="form-control" id="exampleInputEmail1"
                      placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="userPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="userPassword"
                      placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword"
                      placeholder="Confirm Password">
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
                    include '../include/classes/class_user.php';
                    $obj = new User();
                    $result = $obj->get_user();
                    $sn = 1;
                    if ($result) {
                      foreach ($result as $row) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $sn; ?>
                          </td>
                          <td>
                            <?php echo $row["username"]; ?>
                          </td>
                          <td>
                            <?php echo $row["email"]; ?>
                          </td>
                          <td>
                            <?php echo $row["is_active"]; ?>
                          </td>
                        </tr>


                        <?php
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
    $(document).ready(function () {
      $(document).on('click', '#goToPrifile', function () {
        var user_id = $(this).attr('data-id');
        var user_name = $(this).attr('data-user');

        sessionStorage.setItem('empAcUserId', user_id);
        sessionStorage.setItem('empAcUsername', user_name);

        //$.session.set('empUserId'.user_id);
        //alert(sessionStorage.getItem('empUserId'));
        // alert(user_id);
      });
      $('#user_search').keyup(function () {
        var input = $(this).val();
        if (input != "") {
          $.ajax({
            url: "user_ajax_search.php",
            method: "POST",
            data: { input: input },
            success: function (data) {
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