<?php 
  include "../common/header.php";
  include "nav.php"; 

  $selected_batches_condition = array('field_name' => 'user_id', 'condition' => 'equal', 'field_value' => $_SESSION['user']['id']);
  $selected_batches = selectSingleTableWithOneCondition($conn, 'user_batch', $selected_batches_condition);

  if(mysqli_num_rows($selected_batches) > 0){

    $all_selected_batches = "(";

    $i = 1;
    while($batch = mysqli_fetch_array($selected_batches)) {
      
      if($i == mysqli_num_rows($selected_batches)){
        $end = ")";
      }else{
        $end = ",";
      }

      $all_selected_batches = $all_selected_batches.$batch['batch_id'].$end;

      $i++;

    }

  }else{
    $all_selected_batches = '(0)';
  }

  $notices = selectNotice($conn, $all_selected_batches);
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

      <?php if(mysqli_num_rows($notices) > 0){ ?>

        <?php while($notice = mysqli_fetch_array($notices)) { ?>

            <div class="callout callout-<?php echo $notice['bootstrap_class']; ?>">
              <h4><?php echo $notice['title']; ?></h4>
              <p><?php echo $notice['description']; ?></p>
            </div>

        <?php } ?>

      <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include "../common/footer.php"; ?>
