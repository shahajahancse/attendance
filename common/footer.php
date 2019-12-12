<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="home.php">Attendance System</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $base_url; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $base_url; ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $base_url; ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_url; ?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $base_url; ?>/assets/dist/js/demo.js"></script>

<!-- Navigation Custom JS -->
<script src="<?php echo $base_url; ?>/assets/custom/js/navigator.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo $base_url; ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('#example1').DataTable();
  });
</script>
</body>
</html>