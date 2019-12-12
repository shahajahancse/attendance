<?php 


include '../../common/header.php';
include '../nav.php';

// fetching notices
// $condition = array('field_name' => 'status', 'condition' => 'eqal', 'field_value' => '1');
if (isset($_GET)) {
  $notices = selectNoticeList($conn, $_GET);
}else{
  $notices = selectNoticeList($conn);
}

// if (mysqli_num_rows($notices) > 0) {
//   $notice = mysqli_fetch_array($notices);
// }
$conditions = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => '1');
$managements = selectSingleTableWithOneCondition($conn, 'users', $conditions);

$batches = selectBatchList($conn, 'batches');

 ?>


  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php include "../../common/message.php"; ?>

      <h1>
        Notice
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
                    <label>Created By</label>
                    <?php if(isset($_GET['role_id'])){$management_id = $_GET['role_id'];}else{$management_id = "";} ?>
                    <?php if(mysqli_num_rows($managements) > 0) { ?>

                       <select name="role_id" id="role_id" class="form-control">
                        <option value="">All</option>
                        <?php while ($management = mysqli_fetch_array($managements)) { ?>

                        <option value="<?php echo $management['id']; ?>" <?php if($management_id == $management['id']){ echo "selected='selected'";} ?>>
                          <?php echo $management['name']; ?>
                        </option>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  </div>

                  <div class="form-group col-md-4">
                    <label>title</label>
                    <?php if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = "";} ?>
                    <input type="text" name="title" class="form-control" placeholder="Batch title" value="<?php echo $title; ?>" id="">
                  </div>

                  <div class="form-group col-md-4">
                    <label>description</label>
                    <?php if (isset($_GET['description'])) { $description = $_GET['description']; }else{$description ="";} ?>
                    <input type="text" name="description" class="form-control" placeholder="Batch description" value="<?php echo $description; ?>" id="">
                  </div>
                  
                  
                

                  <div class="form-group col-md-4">
                    <label>batch Name</label>
                    <?php if(isset($_GET['batch_id'])){ $batch_id = $_GET['batch_id'];}else{ $batch_id = "";} ?>
                    <?php if(mysqli_num_rows($batches) > 0) { ?>

                       <select name="batch_id" id="batch_id" class="form-control">
                        <option value="">All</option>
                        <?php while ($batch = mysqli_fetch_array($batches)) { ?>

                        <option value="<?php echo $batch['id']; ?>" <?php if($batch_id == $batch['id']){ echo "selected='selected'";} ?>>
                          <?php echo $batch['title']; ?>
                        </option>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  </div>

                  
                  
               

                  <?php if(isset($_GET['start_at'])){ $start_at = $_GET['start_at']; } else { $start_at = ""; } ?>
                  <div class="form-group col-md-4">
                    <label for="start_at">Start Date</label>
                    <input type="date" value="<?php echo $start_at; ?>" class="form-control" name="start_at">
                  </div>

                  <?php if(isset($_GET['finish_at'])){ $finish_at = $_GET['finish_at']; } else { $finish_at = ""; } ?>
                  <div class="form-group col-md-4">
                    <label for="finish_at">Finish Date</label>
                    <input type="date" value="<?php echo $finish_at; ?>" class="form-control" name="finish_at">
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
            <!-- /.box-header -->
            

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
                    <th>Created by</th>
                    <th>title</th>
                    <th>description</th>
                    <th>batch</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($notices) > 0){ ?>

                      <?php while($notice = mysqli_fetch_array($notices)) { ?>
                          
                        <tr>
                          <td><?php echo $notice["name"]; ?></td>
                          <td><?php echo $notice["title"]; ?></td>
                          <td><?php echo $notice["description"]; ?></td>
                          <td><?php echo $notice["batch_title"]; ?></td>
                          <td><?php echo $notice["start_at"]; ?></td>
                          <td><?php echo $notice["finish_at"]; ?></td>
                          <td style="text-align: center;">
                            <a href='edit.php?id=<?php echo $notice["notice_id"]; ?>'>
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>
                          <td style="text-align: center;">
                            <a href='delete.php?id=<?php echo $notice["notice_id"]; ?>'>
                              <i class="fa fa-close"></i>
                            </a>
                          </td>
                        </tr>

                      <?php } ?>

                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Created by</th>
                    <th>title</th>
                    <th>description</th>
                    <th>batch</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
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
        nav_highlight("notice", "notice-manage");
    });
  </script>

<?php include "../../common/footer.php"; ?>
