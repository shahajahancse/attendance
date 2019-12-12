<?php

  include "../../common/header.php";
  include "../nav.php";
 // for insert data into batches_ table

  if (isset($_POST['user_id'])) {

  	$user_id = $_POST['user_id'];
  	$batch_ids = $_POST['batch_ids'];
    $course_condition = array('field_name' => 'user_id', 'condition' => 'equal', 'field_value' => $user_id);
    $result = deleteRowWithOneCondition($conn, 'user_batch', $course_condition);

  	foreach ($batch_ids as $batch_id) {
	  	
	  	$fields = array('user_id', 'batch_id');
	  	$values = array($user_id, $batch_id);
	  	$new_id = insertNew($conn, "user_batch", $fields, $values);
  	}
  }
// For Fetching Batches
  if (isset($_GET['user_id'])) {
  	$condition = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  	$batches = selectSingleTableWithOneCondition($conn, 'batches', $condition);
    $selected_batches_condition = array('field_name' => 'user_id', 'condition' => 'equal', 'field_value' => $_GET['user_id']);
    $selected_batches = selectSingleTableWithOneCondition($conn, 'user_batch', $selected_batches_condition);

      if(mysqli_num_rows($selected_batches) > 0){

        $all_selected_batches = array();

        while($batch = mysqli_fetch_array($selected_batches)) {
          
          $all_selected_batches[] = $batch['batch_id'];

        }

      }else{
        $all_selected_batches = array();
      }

    }else{
      $_SESSION['success'] = "Not permitted";
      goToError($base_url."/management/user/manage.php");
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
        Users
        <small>Batch</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-xs-12">
          <div class="box">

            <form method="POST" action="">

            <div class="box-header">
              <h3 class="box-title">Select Batches</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">

                <table class="table table-bordered table-striped example1">
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>Batch Code</th>
                      <th>Batch Title</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php if (mysqli_num_rows($batches) > 0) { ?>

                  		<?php while ($batch = mysqli_fetch_array($batches)) { ?>

                        <tr>
                          <td>
                            <input type="checkbox" id="bach-check-<?php echo $batch['id']; ?>" name="batch_ids[]" value="<?php echo $batch['id']; ?>" <?php if(in_array($batch['id'], $all_selected_batches)){ echo "checked"; } ?> >
                          </td>
                          <td><?php echo $batch['code']; ?></td>
                          <td><?php echo $batch['title']; ?></td>
                        </tr>
                      <?php } ?>

                  <?php } ?>

                  </tbody>
                </table>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>

            </form>

          </div>
          <!-- /.box -->
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
        nav_highlight("user", "user-manage");
    });

    $(".batch-form-button").click(function(){
      var user_id = $(this).attr('user_id');
      // alert(user_id);
      $('#user_id').val(user_id);
    });

    // function customReset(){
    //     document.getElementById("name").value = "";
    //     document.getElementById("msisdn").value = "";
    //     document.getElementById("email").value = "";
    //     document.getElementById("role_id").value = "";
    // }

  </script>

 <?php include '../../common/footer.php'; ?>