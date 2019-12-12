	<?php 
  include '../../common/header.php';
  include '../nav.php';

if (isset($_GET['id'])) {
  // feching notices
  $condition = array('field_name' => 'id', 'condition' => 'eqal', 'field_value' => $_GET['id']);
  $notices = selectSingleTableWithOneCondition($conn, 'notices', $condition);
  // fetching notice types
  $notice_type_condition = array('field_name' => 'status', 'condition' => 'eqal', 'field_value' => '1');
  $notice_types = selectSingleTableWithOneCondition($conn, 'notices_types', $notice_type_condition);
  // fecthing batches
  $batch_condition = array('field_name' => 'status', 'condition' => 'eqal', 'field_value' => '1');
  $batches = selectSingleTableWithOneCondition($conn, 'batches', $batch_condition);


  if (mysqli_num_rows($notices) > 0) {
    $notice = mysqli_fetch_array($notices);
  }


  
}


   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <?php include "../../common/message.php"; ?>
      
      <h1>
        Notice
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
                  <input type="hidden" name="created_by" value="<?php echo $notice['created_by']; ?>"  required="required">
                  <input type="hidden" name="id" required="required" value="<?php echo $notice['id']; ?>">

                  <?php if (mysqli_num_rows($notice_types) > 0) { ?>
                     
                    <div class="form-group">
                      <label for="notice_type">Notice Type*</label>
                    
                
                      <select name="notice_type" class="form-control" required="required">
                        <option value="">Select Option</option>

                        <?php while ($type = mysqli_fetch_array($notice_types)) { ?>

                            <option value="<?php echo $type['id']; ?>" <?php if ($type['id'] == $notice['notice_type_id']) {echo "selected='selected'";} ?>><?php echo $type['title']; ?></option>

                       <?php } ?>

                      </select>
                    </div>

                  <?php } ?>

                

              
                <div class="form-group">
                  <label for="notice_title">Notice Title*</label>
                  <input type="text" value="<?php echo $notice['title'] ?>" name="notice_title" class="form-control" id="notice_title" placeholder="Enter Notice Title" required="required">
                </div>
                <div class="form-group">
                  <label for="notice_description">Notice Description*</label>
                  <textarea name="notice_description"  id="notice_description" class="form-control"><?php echo $notice['description'] ?></textarea>
                </div>

                <?php if(mysqli_num_rows($batches) > 0) { ?>

                    <div class="form-group">
                      <label for="batch">Batch*</label>
                      <select name="batch" class="form-control" required="required">
                        <option value="">Select Batch</option>
                        <?php while($batch = mysqli_fetch_array($batches)){ ?>
                            <option value="<?php echo $batch['id']; ?>" <?php if($batch['id'] == $notice['batch_id']){echo "selected='selected'";} ?>><?php echo $batch['title']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                <?php } ?>
               
                 <!-- Date range -->
              <!-- Date -->
              <div class="form-group">
                <label>Start Date:</label>

                <div class='input-group date datetimepicker1'>
                  <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type='text' class="form-control" name="start_at" value="<?php echo $notice['start_at'] ?>" />
                    
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

               <!-- Date range -->
              <!-- Date -->
              <div class="form-group">
                <label>End Date:</label>
                <div class='input-group date datetimepicker1'>
                  <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type='text' class="form-control" name="finish_at" value="<?php echo $notice['finish_at'] ?>" />
                    
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
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
 <script src="<?php echo $base_url; ?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript">
    $(function() {
        nav_highlight("notice", "notice-manage");
         $('.datetimepicker1').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'
          });
    });
  </script>

<?php include "../../common/footer.php"; ?>