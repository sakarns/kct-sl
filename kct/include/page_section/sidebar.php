<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
  <img src="/../kct/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="../kct/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="dashboard.php" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="admin/user_mgmt.php" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            User Management
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="admin/employee_profile.php" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Employee Profile
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="admin/employee_leave.php" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Employee Leave
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>