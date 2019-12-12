<?php 
  include "../../common/header.php";
  include "../nav.php";

  // Fatching Users
  if(isset($_GET)){
     $courses = selectCourseList($conn, 'courses', $_GET);
  }else{
     $courses = selectCourseList($conn, 'courses');
  }

?>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php include "../../common/message.php"; ?>

      <h1>
        Courses
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
                  <?php if(isset($_GET['code'])){ $code = $_GET['code']; } else { $code = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" placeholder="Code" value="<?php echo $code; ?>" id="code">
                  </div>
                  <?php if(isset($_GET['title'])){ $title = $_GET['title']; } else { $title = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $title; ?>" id="title">
                  </div>
                  <?php if(isset($_GET['number_of_class'])){ $number_of_class = $_GET['number_of_class']; } else { $number_of_class = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>No. of Class</label>
                    <input type="text" name="number_of_class" class="form-control" placeholder="No. of Class" value="<?php echo $number_of_class; ?>" id="number_of_class">
                  </div>
                  <?php if(isset($_GET['duration'])){ $duration = $_GET['duration']; } else { $duration = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="Duration" value="<?php echo $duration; ?>" id="duration">
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
                    <th>Number of class</th>
                    <th>Total Hours</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($courses) > 0){ ?>

                      <?php while($course = mysqli_fetch_array($courses)) { ?>
                          
                        <tr>
                          <td><?php echo $course["code"]; ?></td>
                          <td><?php echo $course["title"]; ?></td>
                          <td><?php echo $course["number_of_class"]; ?></td>
                          <td><?php echo $course["duration"]; ?></td>
                          <td style="text-align: center;">
                            <a href='edit.php?id=<?php echo $course["id"]; ?>'>
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>
                          <td style="text-align: center;">
                            <a href='delete.php?id=<?php echo $course["id"]; ?>'>
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
        nav_highlight("course", "course-manage");
    });
  </script>

<?php include "../../common/footer.php"; ?>
