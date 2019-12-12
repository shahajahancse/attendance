<?php 
  include "../../common/header.php";
  include "../nav.php";

  // Fatching Roles
  $role_condition_one = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  // $role_condition_two = array('field_name' => 'id', 'condition' => 'not_equal', 'field_value' => '3');
  $roles = selectSingleTableWithOneCondition($conn, 'roles', $role_condition_one);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>
      
      <h1>
        User
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
                  <label for="name">Name*</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required">
                </div>
                <div class="form-group">
                  <label for="msisdn">Mobile number*</label>
                  <input type="text" name="msisdn" class="form-control" id="msisdn" placeholder="Enter mobile number" required="required">
                </div>
                <div class="form-group">
                  <label for="email">Email address*</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required">
                </div>
                <div class="form-group">
                  <label for="password">Password*</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <label for="password">Confirm password*</label>
                  <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password" required="required">
                </div>

                <?php if(mysqli_num_rows($roles) > 0){ ?>

                    <div class="form-group">
                      <label for="role_id">Type*</label>

                      <select name="role_id" class="form-control" required="required">
                        <option value="">Select Role</option>
                        <?php while($role = mysqli_fetch_array($roles)) { ?>
                            <option value="<?php echo $role['id']; ?>"><?php echo $role['title']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                <?php } ?>

                <div class="form-group">
                  <label for="image">Photo</label>
                  <input type="file" name="image" id="image">

                  <p class="help-block">Max file size: 2 MB, Format: jpeg, jpg, png</p>
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
        nav_highlight("user", "user-add");
    });
  </script>

<?php include "../../common/footer.php"; ?>
