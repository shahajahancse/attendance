<?php 
  include "../../common/header.php";
  include "../nav.php";

  $course_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
  $course = selectSingleTableWithOneCondition($conn, 'courses', $course_condition);
  if(mysqli_num_rows($course) > 0){
    $course = mysqli_fetch_array($course);
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>

      <h1>
        Course
        <small>Edit</small>
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
              <input type="hidden" name="id" required="required" value="<?php echo $course['id']; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Code*</label>
                  <input type="text" name="code" class="form-control" id="code" placeholder="Enter Code" required="required" value="<?php echo $course['code']; ?>">
                </div>
                <div class="form-group">
                  <label for="msisdn">Title*</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" required="required" value="<?php echo $course['title']; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Description*</label>
                  <textarea class="form-control" name="description" required="required">
                    <?php echo $course['description']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="email">Number of class*</label>
                  <input type="number" name="number_of_class" class="form-control" id="number_of_class" placeholder="Number of class" required="required" value="<?php echo $course['number_of_class']; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Total Hours*</label>
                  <input type="number" name="duration" class="form-control" id="duration" placeholder="Total Hours" required="required" value="<?php echo $course['duration']; ?>">
                </div>
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
        nav_highlight("course", "course-add");
    });
  </script>

<?php include "../../common/footer.php"; ?>
