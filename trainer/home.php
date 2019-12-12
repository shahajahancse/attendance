<?php 
  include "../common/header.php";

  include "nav.php"; 

  $condition_one = array('field_name' => 'trainer_id', 'condition' => 'equal', 'field_value' => $_SESSION['user']['id'] );
  $condition_two = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');

  $batches = selectSingleTableWithTwoCondition($conn, 'batches', $condition_one, $condition_two);

  



?>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php include "../common/message.php"; ?>
      <h1>
        Trainer Dashboard
      </h1>
    </section>
      
    
    

    <section class="content">
      <h3>All Batches</h3>
      <div class="row">

            
            <?php if (mysqli_num_rows($batches) > 0) { ?>
              <?php while ($batch = mysqli_fetch_array($batches)) { ?>
             <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3><?php echo $batch['title']; ?></h3>

                    <!-- <p>students : </p> -->
                  </div>
                  <div class="icon">
                    <i class="fa fa-mortar-board"></i>
                  </div>
                  <a href="<?php echo $base_url; ?>/trainer/student/read.php?status=1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            <?php } ?>
            <?php } ?>
          </div>

    <!-- Main content -->
    </section>
    <!-- /.content -->
    <section class="content">
      <h2>Pending Attendances</h2>
      <div class="row">

        <?php 
            // $condition_one =  array('field_name' => 'batch_id', 'condition' => 'equal', 'field_value' => $batch['id'] );
            // $condition_two =  array('field_name' => 'approved', 'condition' => 'equal', 'field_value' => '0' );

            // $all_attendances = selectSingleTableWithTwoCondition($conn, 'attendances', $condition_one, $condition_two);
         // $condition_one = array('field_name' => 'trainer_id', 'condition' => 'equal', 'field_value' => $_SESSION['user']['id'] );
         //  $condition_two = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');

          // $batchs = selectSingleTableWithTwoCondition($conn, 'batches', $condition_one, $condition_two);
                  
             // if (mysqli_num_rows($batchs) > 0) {
             //   $batch_data = mysqli_fetch_array($batchs);
             // }
             // print_r($batch_data);

        $batchs = selectBatchForTrainer($conn, $_SESSION['user']['id']);

            if(mysqli_num_rows($batchs) > 0){

              $all_batchs = "(";

              $i = 1;
              while($batch = mysqli_fetch_array($batchs)) {
                
                if($i == mysqli_num_rows($batchs)){
                  $end = ")";
                }else{
                  $end = ",";
                }

                $all_batchs = $all_batchs.$batch['batch_id'].$end;

                $i++;

              }

            }else{
              $all_batchs = '(0)';
            }

        $all_attendances = pendingAttendances($conn, $all_batchs, $_SESSION['user']['id']);
           
         ?>


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
                    <th>Student Name</th>
                    <th>Batch Name</th>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Approve</th>
                    <th>Reject</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($all_attendances) > 0){ ?>

                      <?php while($attendances = mysqli_fetch_array($all_attendances)) { ?>
                          
                        <tr>
                          <td><?php echo $attendances["name"]; ?></td>
                          <td><?php echo $attendances["title"]; ?></td>
                          <td><?php echo $attendances["date"]; ?></td>
                          <td><?php echo $attendances["rating"]; ?></td>
                          <td><?php echo $attendances["review"]; ?></td>
                          <td style="text-align: center;">
                            <a href='approve.php?approve=<?php echo $attendances["id"]; ?>'>
                              <i class="fa fa-check"></i>
                            </a>
                          </td>
                          <td style="text-align: center;">
                            <a href='approve.php?reject=<?php echo $attendances["id"]; ?>'>
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
  </div>
  <!-- /.content-wrapper -->

   <script src="<?php echo $base_url; ?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $base_url; ?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(function() {
        nav_highlight("dashboard", "dashboard");
    });
  </script>

<?php include "../common/footer.php"; ?>
