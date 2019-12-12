<?php 
  include "../../common/header.php";
  include "../nav.php";

  // Fatching Users
  if(isset($_GET)){
     $users = selectUserList($conn, $_GET);
  }else{
     $users = selectUserList($conn);
  }

  // Fatching Roles
  $roles = selectSingleTableWithNoCondition($conn, 'roles');

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
        <small>View</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Filter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="GET">
                <div class="box-body">
                  <?php if(isset($_GET['name'])){ $name = $_GET['name']; } else { $name = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>" id="name">
                  </div>
                  <?php if(isset($_GET['msisdn'])){ $msisdn = $_GET['msisdn']; } else { $msisdn = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Mobile</label>
                    <input type="text" name="msisdn" class="form-control" placeholder="Mobile" value="<?php echo $msisdn; ?>" id="msisdn">
                  </div>
                  <?php if(isset($_GET['email'])){ $email = $_GET['email']; } else { $email = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" id="email">
                  </div>

                  <?php if(mysqli_num_rows($roles) > 0){ ?>

                    <?php if(isset($_GET['role_id'])){ $role_id = $_GET['role_id']; } else { $role_id = ""; } ?>
                    <div class="form-group col-md-4">
                      <label>Role</label>
                      <select name="role_id" class="form-control" id="role_id">
                        <option value="">All</option>
                        <?php while ($role = mysqli_fetch_array($roles)) { ?>
                          <option value="<?php echo $role['id']; ?>" <?php if($role_id == $role['id']){ echo "selected='selected'"; } ?> >
                            <?php echo $role['title']; ?>                            
                          </option>
                        <?php } ?>
                      </select>
                    </div>

                  <?php } ?>

                  <?php if(isset($_GET['status'])){ $status = $_GET['status']; } else { $status = ""; } ?>
                  <div class="form-group col-md-4">
                    <label>Status</label>
                    <select name="status" class="form-control" id="status">
                      <option value="">All</option>
                        <option value="1" <?php if($status == 1){ echo "selected='selected'"; } ?> >
                          Active                          
                        </option>
                        <option value="0" <?php if($status === '0'){ echo "selected='selected'"; } ?> >
                          Inactive                          
                        </option>
                    </select>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <!-- <button type="reset" class="btn btn-default" onclick="customReset();">Reset</button> -->
                  <a class="btn btn-default" href="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>">
                    Reset
                  </a>
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Batch</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($users) > 0){ ?>

                      <?php while($user = mysqli_fetch_array($users)) { ?>
                          
                        <tr>
                          <td><?php echo $user["name"]; ?></td>
                          <td><?php echo $user["msisdn"]; ?></td>
                          <td><?php echo $user["email"]; ?></td>
                          <td><?php echo $user["title"]; ?></td>
                          <td>
                            <?php if ($user['role_id'] == 3) { ?>
                              <a href='assign-batch.php?user_id=<?php echo $user["id"]; ?>'>
                                <i class="fa fa-asterisk"></i>
                              </a>
                            <?php } ?>
                          </td>
                          <td style="text-align: center;">
                            <a href='edit.php?id=<?php echo $user["id"]; ?>'>
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>
                          <td style="text-align: center;">
                            <a href='delete.php?id=<?php echo $user["id"]; ?>'>
                              <i class="fa fa-close"></i>
                            </a>
                          </td>
                        </tr>

                      <?php } ?>

                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Batch</th>
                    <th>Update</th>
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

    // function customReset(){
    //     document.getElementById("name").value = "";
    //     document.getElementById("msisdn").value = "";
    //     document.getElementById("email").value = "";
    //     document.getElementById("role_id").value = "";
    // }

  </script>

<?php include "../../common/footer.php"; ?>
