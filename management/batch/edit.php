<?php 
  include "../../common/header.php";


    if(!isset($_GET['id']) || $_GET['id'] == ""){
      goToError($base_url."/common/403.php");
    }

  include "../nav.php"; 


// select trainer
  $trainer_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $trainer_condition_two = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => '2');
  $trainers = selectSingleTableWithTwoCondition($conn, 'users', $trainer_condition_one, $trainer_condition_two);

  // select courses

  $course_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $courses = selectSingleTableWithOneCondition($conn, 'courses', $course_condition_one);

  // feching batches

   $batch_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
   $batch = selectSingleTableWithOneCondition($conn, 'batches', $batch_condition);

     if(mysqli_num_rows($batch) > 0){
      $batch = mysqli_fetch_array($batch);
    }else{
      goToError($base_url."/common/403.php");
    }



?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>

      <h1>
        Batch
        <small>Add</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fill the form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="update.php">
              <div class="box-body">
                <input type="hidden" name="id" required="required" value="<?php echo $batch['id']; ?>">
                <div class="form-group">
                  <label for="name">Code*</label>
                  <input type="text" name="code" class="form-control" id="code" value="<?php echo $batch['code']; ?>" placeholder="Enter Code" required="required">
                </div>
                <div class="form-group">
                  <label for="msisdn">Title*</label>
                  <input type="text" name="title" class="form-control" id="title" value="<?php echo $batch['title']; ?>" placeholder="Enter Title" required="required">
                </div>
                <div class="form-group">
                  <label for="email">Description*</label>
                  <textarea class="form-control" name="description" required="required"><?php echo $batch['description']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="limit">Limit*</label>
                  <input type="number" name="limit" class="form-control" id="limit" value="<?php echo $batch['class_limit']; ?>" placeholder="Limit of class" required="required">
                </div>
                 <?php if(mysqli_num_rows($trainers) > 0){ ?>

                    <div class="form-group">
                      <label for="trainer_id">Add Trainer*</label>

                      <select name="trainer_id" class="form-control" required="required">
                            <option value="">Select Trainer</option>
                            <?php while($trainer = mysqli_fetch_array($trainers)) { ?>
                            <option value="<?php echo $trainer['id']; ?>" <?php if ($trainer['id'] == $batch['trainer_id']){echo 'selected="selected"';} ?>><?php echo $trainer['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                <?php } ?>

                <?php if(mysqli_num_rows($courses) > 0){ ?>

                    <div class="form-group">
                      <label for="course_id">Add Course*</label>

                      <select name="course_id" class="form-control" required="required">
                        <option value="">Select Course</option>
                        <?php while($course = mysqli_fetch_array($courses)) { ?>
                            <option value="<?php echo $course['id']; ?>" <?php if ($course['id'] == $batch['course_id']) {echo 'selected="selecte"';}?> ><?php echo $course['title']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                <?php } ?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(function() {
        nav_highlight("batch", "batch-add");
    });
  </script>

<?php include "../../common/footer.php"; ?>
