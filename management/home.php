<?php 
  include "../common/header.php";
  include "nav.php"; 

  $batchs_condition = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => 1);
  $batches = selectSingleTableWithOneCondition($conn, 'batches', $batchs_condition);

  $courses_condition = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => 1);
  $courses = selectSingleTableWithOneCondition($conn, 'courses', $courses_condition);

  $students_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => 1);
  $students_condition_two = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => 3);
  $students = selectSingleTableWithTwoCondition($conn, 'users', $students_condition_one, $students_condition_two);

  $trainer_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => 1);
  $trainer_condition_two = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => 2);
  $trainer = selectSingleTableWithTwoCondition($conn, 'users', $trainer_condition_one, $trainer_condition_two);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($batches); ?></h3>

              <p>Batchs</p>
            </div>
            <div class="icon">
              <i class="fa fa-mortar-board"></i>
            </div>
            <a href="<?php echo $base_url; ?>/management/batch/manage.php?status=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($courses); ?></h3>

              <p>Courses</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo $base_url; ?>/management/course/manage.php?status=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($students); ?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $base_url; ?>/management/user/manage.php?status=1&role_id=3" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo mysqli_num_rows($trainer); ?></h3>

              <p>Trainers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo $base_url; ?>/management/user/manage.php?status=1&role_id=2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(function() {
        nav_highlight("dashboard", "dashboard");
    });
  </script>

<?php include "../common/footer.php"; ?>
