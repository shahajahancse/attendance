<?php

  include "../../common/header.php";

  if(!isset($_GET['id']) || $_GET['id'] == ""){
    goToError($base_url."/common/403.php");
  }

  include "../nav.php";

  // Fatching Roles
  $role_condition = array('field_name' => 'status', 'condition' => 'equal', 'field_value' => '1');
  $roles = selectSingleTableWithOneCondition($conn, 'roles', $role_condition);

  $user_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
  $user = selectSingleTableWithOneCondition($conn, 'users', $user_condition);
  if(mysqli_num_rows($user) > 0){
    $user = mysqli_fetch_array($user);
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
        User
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
              <div class="box-body">
                <input type="hidden" name="id" required="required" value="<?php echo $user['id']; ?>">
                <div class="form-group">
                  <label for="name">Name*</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required" value="<?php echo $user['name']; ?>">
                </div>
                <div class="form-group">
                  <label for="msisdn">Mobile number*</label>
                  <input type="text" name="msisdn" class="form-control" id="msisdn" placeholder="Enter mobile number" required="required" value="<?php echo $user['msisdn']; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email address*</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" value="<?php echo $user['email']; ?>">
                </div>
                <div class="form-group">
                  <label for="password">Password*</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="password">Confirm password*</label>
                  <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password">
                </div>

                <?php if(mysqli_num_rows($roles) > 0){ ?>

                    <div class="form-group">
                      <label for="role_id">Type*</label>

                      <select name="role_id" class="form-control" required="required">
                        <option value="">Edit Role</option>
                        <?php while($role = mysqli_fetch_array($roles)) { ?>
                            <option value="<?php echo $role['id']; ?>" <?php if($role['id'] == $user['role_id']){ echo 'selected="selected"'; } ?>>
                              <?php echo $role['title']; ?>                              
                            </option>
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
                <button type="submit" class="btn btn-primary">Update</button>
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
