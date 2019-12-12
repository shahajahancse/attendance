<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $base_url; ?>/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['user']['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <li class="nav" id="dashboard"><a href="<?php echo $base_url; ?>/management/home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li class="nav treeview" id="batch">
          <a href="#">
            <i class="fa fa-mortar-board"></i> <span>Batchs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav" id="batch-add"><a href="<?php echo $base_url; ?>/management/batch/add.php"><i class="fa fa-plus-square-o"></i> Add</a></li>
            <li class="nav" id="batch-manage"><a href="<?php echo $base_url; ?>/management/batch/manage.php"><i class="fa fa-square"></i> Manage</a></li>
          </ul>
        </li>

        <li class="nav treeview" id="course">
          <a href="#">
            <i class="fa fa-book"></i> <span>Courses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav" id="course-add"><a href="<?php echo $base_url; ?>/management/course/add.php"><i class="fa fa-plus-square-o"></i> Add</a></li>
            <li class="nav" id="course-manage"><a href="<?php echo $base_url; ?>/management/course/manage.php"><i class="fa fa-square"></i> Manage</a></li>
          </ul>
        </li>

        <li class="nav treeview" id="user">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav" id="user-add"><a href="<?php echo $base_url; ?>/management/user/add.php"><i class="fa fa-plus-square-o"></i> Add</a></li>
            <li class="nav" id="user-manage"><a href="<?php echo $base_url; ?>/management/user/manage.php"><i class="fa fa-square"></i> Manage</a></li>
          </ul>
        </li>

         <li class="nav treeview" id="notice">
          <a href="#">
            <i class="fa fa-warning"></i> <span>Notice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav" id="notice-add"><a href="<?php echo $base_url; ?>/management/notice/add.php"><i class="fa fa-plus-square-o"></i> Add</a></li>
            <li class="nav" id="notice-manage"><a href="<?php echo $base_url; ?>/management/notice/manage.php"><i class="fa fa-square"></i> Manage</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>