<?php 

	include '../../common/header.php';
	include '../nav.php';

	$batches = selectBatch($conn);

?>
	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>

      <h1>
        Attendance
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if(mysqli_num_rows($batches) > 0){ ?>

            <div class="row">
                <div class="col-md-12">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Select Batch</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                        <?php $i = 1; while($batch = mysqli_fetch_array($batches)) { ?>

                          <div class="panel box box-primary">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i; ?>">
                                  <?php echo $batch['title']; ?> #<?php echo $batch['code']; ?>
                                </a>
                              </h4>
                            </div>
                            <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse in">
                              <div class="box-body">

                                <?php

                                  $condition_one = array('field_name' => 'user_id', 'condition' => 'eqal', 'field_value' => $_SESSION['user']['id']);
                                  $condition_two = array('field_name' => 'batch_id', 'condition' => 'eqal', 'field_value' => $batch['id']);
                                  $condition_three = array('field_name' => 'date', 'condition' => 'eqal', 'field_value' => date('Y-m-d'));
                                  $attendance = selectSingleTableWithThreeCondition($conn, 'attendances', $condition_one, $condition_two, $condition_three);

                                  if(mysqli_num_rows($attendance) == 0){

                                ?>

                                  <form action="insert.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                                    <input type="hidden" name="batch_id"  value="<?php echo $batch['id']; ?>">

                                    <div class="form-group">
                                      <label>Today's class Rating*</label>
                                      <select name="rating" class="form-control" id="rating" required="required">
                                        <?php for($i = 5; $i >= 1; $i--){ ?>
                                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="review">Today's class Review</label>
                                      <textarea name="review" id="review" class="form-control"></textarea>
                                    </div>

                                    <?php

                                      $condition_one = array('field_name' => 'user_id', 'condition' => 'eqal', 'field_value' => $_SESSION['user']['id']);
                                      $condition_two = array('field_name' => 'batch_id', 'condition' => 'eqal', 'field_value' => $batch['id']);
                                      $classes = selectSingleTableWithTwoCondition($conn, 'attendances', $condition_one, $condition_two);

                                      if(mysqli_num_rows($classes) == $batch['class_limit'] - 1){

                                    ?>

                                    <div class="form-group">
                                      <label>Full course rating*</label>
                                      <select name="own_rating" class="form-control" id="own_rating" required="required">
                                        <?php for($i = 5; $i >= 1; $i--){ ?>
                                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="own_review">Full course Review</label>
                                      <textarea name="own_review" id="own_review" class="form-control"></textarea>
                                    </div>

                                  <?php } ?>

                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                  </form>

                                <?php }else{ echo "Your attendace is already counted."; } ?>

                              </div>
                            </div>
                          </div>

                        <?php $i++; } ?>

                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
              <!-- /.row -->
              <!-- END ACCORDION & CAROUSEL-->

        <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function() {
        nav_highlight("attendance", "attendance-add");
    });
  </script>

<?php include '../../common/footer.php'; ?>