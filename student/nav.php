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
        <li><a href="<?php echo $base_url; ?>/student/home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="nav treeview" id="attendance">
          <a href="#">
            <i class="fa fa-mortar-board"></i> <span>Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav" id="attendance-add"><a href="<?php echo $base_url; ?>/student/attendance/add.php"><i class="fa fa-plus-square-o"></i> Add</a></li>
            <li class="nav" id="attendance-manage"><a href="<?php echo $base_url; ?>/student/attendance/manage.php"><i class="fa fa-square"></i> Manage</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>