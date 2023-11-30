 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-light">Fitness Club</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['adminFullName']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          

          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewAllUsers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Users</p>
                </a>
              </li>
              
            </ul>
          </li>


          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Consultants
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="viewAllDoctors.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Nutritionists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewGymTrainers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Gym Trainers</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item">
            <a href="addArticles.php" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Add Articles
              </p>
            </a>
            
          </li>
           <li class="nav-item">
            <a href="addCategory.php" class="nav-link">
              <i class="nav-icon fas fa-list-alt "></i>
              <p>
                Add Articles Category
              </p>
            </a>
            
          </li>

          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="gymTrainerGraphReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gym Trainers Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="NutritionistsReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nutritionists Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="UserReport.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Report</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log Out
              </p>
            </a>
            
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>