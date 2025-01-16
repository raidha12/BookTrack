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

        <!-- Books -->
        <li class="nav-item <?php echo ($current_page == 'addbook.php' || $current_page == 'viewbook.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addbook.php' || $current_page == 'viewbook.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              Books
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addbook.php" class="nav-link <?php echo ($current_page == 'addbook.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Book</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewbook.php" class="nav-link <?php echo ($current_page == 'viewbook.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Book</p>
              </a>
            </li>
          </ul>
        </li>

        <!--Latest Books -->
        <li class="nav-item <?php echo ($current_page == 'addlatestbook.php' || $current_page == 'viewlatestbook.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addlatestbook.php' || $current_page == 'viewlatestbook.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              Latest Books
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addlatestbook.php" class="nav-link <?php echo ($current_page == 'addlatestbook.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Latest Book</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewlatestbook.php" class="nav-link <?php echo ($current_page == 'viewlatestbook.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Latest Book</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Author -->
        <li class="nav-item <?php echo ($current_page == 'addauthor.php' || $current_page == 'viewauthor.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addauthor.php' || $current_page == 'viewauthor.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-pen"></i>
            <p>
              Author
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addauthor.php" class="nav-link <?php echo ($current_page == 'addauthor.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Author</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewauthor.php" class="nav-link <?php echo ($current_page == 'viewauthor.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Author</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Category -->
        <li class="nav-item <?php echo ($current_page == 'addcategory.php' || $current_page == 'viewcategory.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addcategory.php' || $current_page == 'viewcategory.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              Category
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addcategory.php" class="nav-link <?php echo ($current_page == 'addcategory.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewcategory.php" class="nav-link <?php echo ($current_page == 'viewcategory.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Category</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Reserve Book -->
        <li class="nav-item">
          <a href="reservebook.php" class="nav-link <?php echo ($current_page == 'reservebook.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-book-open"></i>
            <p>Reserved Books</p>
          </a>
        </li>

        <!-- Issued Books -->
        <li class="nav-item <?php echo ($current_page == 'add_is_bk.php' || $current_page == 'view_is_bk.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'add_is_bk.php' || $current_page == 'view_is_bk.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-solid fa-check"></i>
            <p>
              Issued Books
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_is_bk.php" class="nav-link <?php echo ($current_page == 'add_is_bk.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Issued Book</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_is_bk.php" class="nav-link <?php echo ($current_page == 'view_is_bk.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Issued Book</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Returned Books -->
        <li class="nav-item <?php echo ($current_page == 'add_ret_bk.php' || $current_page == 'view_ret_bk.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'add_ret_bk.php' || $current_page == 'view_ret_bk.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-solid fa-calendar-check"></i>
            <p>
              Returned Books
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_ret_bk.php" class="nav-link <?php echo ($current_page == 'add_ret_bk.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Returned Book</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="view_ret_bk.php" class="nav-link <?php echo ($current_page == 'view_ret_bk.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Returned Book</p>
              </a>
            </li>
          </ul>
        </li>

         

        <!-- Messages -->
        <li class="nav-item <?php echo ($current_page == 'sendmsg.php' || $current_page == 'viewmsg.php' || $current_page == 'viewmsgst.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'sendmsg.php' || $current_page == 'viewmsg.php' || $current_page == 'viewmsgst.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Messages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sendmsg.php" class="nav-link <?php echo ($current_page == 'sendmsg.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Message</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewmsg.php" class="nav-link <?php echo ($current_page == 'viewmsg.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Admin Message</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewmsgst.php" class="nav-link <?php echo ($current_page == 'viewmsgst.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Member Message</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Membership -->
        <li class="nav-item <?php echo ($current_page == 'addmember.php' || $current_page == 'viewmember.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addmember.php' || $current_page == 'viewmember.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-light fa-id-card"></i>
            <p>
              Membership
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_member.php" class="nav-link <?php echo ($current_page == 'add_member.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Member</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewmember.php" class="nav-link <?php echo ($current_page == 'viewmember.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Member</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Payement -->
        <li class="nav-item <?php echo ($current_page == 'addpayment.php' || $current_page == 'viewpayment.php') ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?php echo ($current_page == 'addpayment.php' || $current_page == 'viewpayment.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
              Annual Payment
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addpayment.php" class="nav-link <?php echo ($current_page == 'addpayment.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Payment</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewpayment.php" class="nav-link <?php echo ($current_page == 'viewpayment.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Payment</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</aside>