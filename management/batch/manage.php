<?php 
  include "../../common/header.php";
  include "../nav.php";


  if(isset($_GET)) {
      $batches = selectBatchList($conn, 'batches', $_GET);

  }else{
      $batches = selectBatchList($conn, 'batches');

  }
  $condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $condition_two = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => '2');
  $trainers = selectSingleTableWithTwoCondition($conn, 'users', $condition_one, $condition_two);

  $condition = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $courses = selectSingleTableWithOneCondition($conn, 'courses', $condition);

?>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php include "../../common/message.php"; ?>

      <h1>
        Batch
        <small>View</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Filter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="GET">
                <div class="box-body">
                  <div class="form-group col-md-4">
                    <label>Code</label>
                    <?php if(isset($_GET['code'])){$code = $_GET['code'];}else{$code = "";} ?>
                    <input type="text" name="code" class="form-control" placeholder="Batch Code" value="<?php echo $code; ?>" id="">
                  </div>

                  <div class="form-group col-md-4">
                    <label>Title</label>
                    <?php if (isset($_GET['title'])) { $title = $_GET['title']; }else{$title ="";} ?>
                    <input type="text" name="title" class="form-control" placeholder="Batch Title" value="<?php echo $title; ?>" id="">
                  </div>
                  
                  <div class="form-group col-md-4">
                    <label>Trainer</label>
                    <?php if(isset($_GET['trainer_id'])){$trainer_id = $_GET['trainer_id'];}else{$trainer_id = "";} ?>
                    <?php if(mysqli_num_rows($trainers) > 0) { ?>

                       <select name="trainer_id" id="trainer_id" class="form-control">
                        <option value="">All</option>
                        <?php while ($trainer = mysqli_fetch_array($trainers)) { ?>

                        <option value="<?php echo $trainer['id']; ?>" <?php if($trainer_id == $trainer['id']){ echo "selected='selected'";} ?>>
                          <?php echo $trainer['name']; ?>
                        </option>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  </div>
                

                  <div class="form-group col-md-4">
                    <label>Course Name</label>
                    <?php if(isset($_GET['course_id'])){ $course_id = $_GET['course_id'];}else{ $course_id = "";} ?>
                    <?php if(mysqli_num_rows($trainers) > 0) { ?>

                       <select name="course_id" id="course_id" class="form-control">
                        <option value="">All</option>
                        <?php while ($course = mysqli_fetch_array($courses)) { ?>

                        <option value="<?php echo $course['id']; ?>" <?php if($course_id == $course['id']){ echo "selected='selected'";} ?>>
                          <?php echo $course['title']; ?>
                        </option>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  </div>

                  
                  
                <?php if(isset($_GET['status'])){ $status = $_GET['status']; } else { $status = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Status</label>
                    <select name="status" class="form-control" id="status">
                      <option value="">All</option>
                        <option value="1" <?php if($status == 1){ echo "selected='selected'"; } ?> >
                          Active                          
                        </option>
                        <option value="0" <?php if($status === '0'){ echo "selected='selected'"; } ?> >
                          Inactive                          
                        </option>
                    </select>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <a class="btn btn-default" href="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>">
                    Reset
                  </a>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Limit</th>
                    <th>Trainer Name</th>
                    <th>Course Name</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($batches) > 0){ ?>

                      <?php while($batch = mysqli_fetch_array($batches)) { ?>
                          
                        <tr>
                          <td><?php echo $batch["code"]; ?></td>
                          <td><?php echo $batch["title"]; ?></td>
                          <td><?php echo $batch["class_limit"]; ?></td>
                          <td><?php echo $batch["name"]; ?></td>
                          <td><?php echo $batch["cname"]; ?></td>
                          <td style="text-align: center;">
                            <a href='edit.php?id=<?php echo $batch["id"]; ?>'>
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>
                          <td style="text-align: center;">
                            <a href='delete.php?id=<?php echo $batch["id"]; ?>'>
                              <i class="fa fa-close"></i>
                            </a>
                          </td>
                        </tr>

                      <?php } ?>

                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Number of class</th>
                    <th>Total Hours</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- DataTables -->
  <script src="<?php echo $base_url; ?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(function() {
        nav_highlight("batch", "batch-manage");
    });
  </script>

<?php include "../../common/footer.php"; ?>
