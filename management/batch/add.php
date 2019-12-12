<?php 
  include "../../common/header.php";
  include "../nav.php"; 

// select trainer
  $role_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $role_condition_two = array('field_name' => 'role_id', 'condition' => 'equal', 'field_value' => '2');


  $roles = selectSingleTableWithTwoCondition($conn, 'users', $role_condition_one, $role_condition_two);


  // select courses

  $batch_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $courses = selectSingleTableWithOneCondition($conn, 'courses', $batch_condition_one);



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
            <form role="form" method="POST" action="insert.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Code*</label>
                  <input type="text" name="code" class="form-control" id="code" placeholder="Enter Code" required="required">
                </div>
                <div class="form-group">
                  <label for="msisdn">Title*</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" required="required">
                </div>
                <div class="form-group">
                  <label for="email">Description*</label>
                  <textarea class="form-control" name="description" required="required"></textarea>
                </div>
                <div class="form-group">
                  <label for="limit">Limit*</label>
                  <input type="number" name="limit" class="form-control" id="limit" placeholder="Limit of class" required="required">
                </div>
                 <?php if(mysqli_num_rows($roles) > 0){ ?>

                    <div class="form-group">
                      <label for="trainer_id">Add Trainer*</label>

                      <select name="trainer_id" class="form-control" required="required">
                            <option value="">Select Trainer</option>
                            <?php while($role = mysqli_fetch_array($roles)) { ?>
                            <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
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
                            <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
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
