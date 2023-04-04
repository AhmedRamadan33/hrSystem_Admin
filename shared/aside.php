
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/odc/index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Departments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/odc/departments/add.php">
              <i class="bi bi-circle"></i><span>Add Departments</span>
            </a>
          </li>
          <li>
            <a href="/odc/departments/list.php">
              <i class="bi bi-circle"></i><span>List Departments</span>
            </a>
          </li>
          <li>
            <a href="/odc/departments/departmentsnotjoin.php">
              <i class="bi bi-circle"></i><span>Empty departments</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Employee</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/odc/employees/add.php">
              <i class="bi bi-circle"></i><span>Add Employees</span>
            </a>
          </li>
          <li>
            <a href="/odc/employees/list.php">
              <i class="bi bi-circle"></i><span>List Employee</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Employees Nav -->
  

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/odc/admin/list.php">
          <i class="bi bi-files"></i>
          <span>Admins</span>
        </a>
      </li><!-- End Admin Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="/odc/admin/users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="/odc/admin/pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/odc/admin/pages-login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->