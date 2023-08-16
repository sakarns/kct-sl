<?php
include 'include/page_section/header.php';

ini_set("display_errors", 1);
include_once("config/connection.php");

?>
<div class="wrapper">

  Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/kct/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <?php include('include/page_section/content_header.php') ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('include/page_section/sidebar.php') ?>
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
        <!-- /.row -->
        <!-- Main row -->
        <!-- Search Bar -->
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <input type="search" class="form-control form-control-lg" id="user_search" placeholder="Search...">
              <div class="input-group-append">
                <button type="submit" class="btn btn-lg btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Search Bar -->



        <table class="table table-bordered mt-2" id="userTable" >
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Username</th>
              <th>Email</th>
              <th>Is Active</th>
              <th>Action</th>
              <th>Create Profile</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT username,email,is_active,id FROM `tbl_users`order by id DESC";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo
                "<tr>

                      <td>" . $row['id'] . "</td>
                      <td>" . $row['username'] . "</td>
                      <td>" . $row['email'] . "</td>
                      <td>
                      <input type='checkbox'" . (($row['is_active'] == '1') ? 'checked' : '') . ">
                      </td>
                      <td>
                      <a href='user_mgmt.php?id=" . $row['id'] . "'id='btnEditUser_" . $row['id'] . "'>
                      <i class='fas fa-edit' style='color:#6b8fcc;'></i>
                      </a>
                      <a href='delete_user.php?id= " . $row['id'] . " ' id='btnDeleteUser'>
                      <i class='fas fa-trash' style='color:#c85f65;'></i>
                      </a>
                      </td>
                      <td><a href='/SL/user_details.php' id='btnCreateProfile" . $row['id'] . "'><button id='goToProfile' class='btn btn-primary btn-block' data-id='" . $row['id'] . "' data-user='" . $row['username'] . "'>Create Profile</button></a></td>
                    </tr>";
              }
            }
            ?>
          </tbody>
        </table>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include __dir__ . '/include/page_section/footer.php'; ?>