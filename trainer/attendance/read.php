<?php 
	include '../../common/header.php';
	include '../nav.php';

 // Fatching attendances
  if(isset($_GET)){
     $attendances = selectAttendanceList($conn, $_SESSION['user']['id'], $_GET);
  }else{
     $attendances = selectAttendanceList($conn, $_SESSION['user']['id']);
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
        Attendance
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
                  <?php if(isset($_GET['title'])){ $title = $_GET['title']; } else { $title = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Batch</label>
                    <input type="text" name="title" class="form-control" placeholder="Batch" value="<?php echo $title; ?>" id="title">
                  </div>
                  <?php if(isset($_GET['date'])){ $date = $_GET['date']; } else { $date = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" placeholder="Date" value="<?php echo $date; ?>" id="date">
                  </div>
                  <?php if(isset($_GET['review'])){ $review = $_GET['review']; } else { $review = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>review</label>
                    <input type="text" name="review" class="form-control" placeholder="review" value="<?php echo $review; ?>" id="review">
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <!-- <button type="reset" class="btn btn-default" onclick="customReset();">Reset</button> -->
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
                    <th>Batch</th>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>review</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($attendances) > 0) { ?>
          				<?php while($attendace = mysqli_fetch_array($attendances)) { ?>
                        <tr>
                          <td><?php echo $attendace['title'] ?></td>
                          <td><?php echo $attendace['date'] ?></td>
                          <td><?php echo $attendace['rating'] ?></td>
                          <td><?php echo $attendace['review'] ?></td>
                          <td><?php if($attendace['approved'] == 1){ echo "Approved";}else{echo "Pending";} ?></td>
                        </tr>
                        <?php } ?>

                    <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                   <th>Batch</th>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>review</th>
                    <th>Status</th>
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
        nav_highlight("attendance", "attendance-manage");
    });

    // function customReset(){
    //     document.getElementById("name").value = "";
    //     document.getElementById("date").value = "";
    //     document.getElementById("review").value = "";
    //     document.getElementById("role_id").value = "";
    // }

  </script>

<?php include "../../common/footer.php"; ?>
