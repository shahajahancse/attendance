<?php 
  include "../../common/header.php";
  include "../nav.php"; 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>

      <h1>
        Course
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
                  <label for="email">Number of class*</label>
                  <input type="number" name="number_of_class" class="form-control" id="number_of_class" placeholder="Number of class" required="required">
                </div>
                <div class="form-group">
                  <label for="email">Total Hours*</label>
                  <input type="number" name="duration" class="form-control" id="duration" placeholder="Total Hours" required="required">
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
