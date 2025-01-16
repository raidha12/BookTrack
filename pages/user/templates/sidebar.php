<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="../../assets/img/Book Track.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">Book Track Pro</span>
  </a>




  <div class="sidebar">
    <br>
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

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Explore Books -->
        <li class="nav-item <?php echo ($current_page == 'author.php' || $current_page == 'categories.php' || $current_page == 'books.php' || $current_page == 'latestbk.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'author.php' || $current_page == 'categories.php'  || $current_page == 'books.php'  || $current_page == 'latestbk.php') ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-book-open"></i>
            <p>
              Explore Books
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="author.php" class="nav-link <?php echo ($current_page == 'author.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Author</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="categories.php" class="nav-link <?php echo ($current_page == 'categories.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="books.php" class="nav-link <?php echo ($current_page == 'books.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Books</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="latestbk.php" class="nav-link <?php echo ($current_page == 'latestbk.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Latest Books</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Messages -->
        <li class="nav-item <?php echo ($current_page == 'sendmessage.php' || $current_page == 'viewmessage.php' || $current_page == 'viewmessagead.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'sendmessage.php' || $current_page == 'viewmessage.php'  || $current_page == 'viewmessagead.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Messages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sendmessage.php" class="nav-link <?php echo ($current_page == 'sendmessage.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Message</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewmessage.php" class="nav-link <?php echo ($current_page == 'viewmessage.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Member Message</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewmessagead.php" class="nav-link <?php echo ($current_page == 'viewmessagead.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Admin Message</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- User -->
        <li class="nav-item">
          <a href="viewusers.php" class="nav-link <?php echo ($current_page == 'viewusers.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-light fa-users"></i>
            <p>User Profile</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>