<!-- <footer class="footer">
          <div class="container-fluid">

              <p class="copyright pull-right">
                  &copy; 2017 <a href="">Happy Sanz Tech</a> </p>
          </div>
      </footer> -->
</div>



</body>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

  <!--  Date Time Picker Plugin is included in this js file -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>

  <!--  Select Picker Plugin -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-selectpicker.js"></script>

<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>

<!--  Charts Plugin -->
<script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

  <!-- Sweet Alert 2 plugin -->
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js"></script>

  <!-- Vector Map plugin -->
<script src="<?php echo base_url(); ?>assets/js/jquery-jvectormap.js"></script>

<!-- Wizard Plugin    -->
  <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.wizard.min.js"></script>

  <!--  Bootstrap Table Plugin    -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-table.js"></script>
  <!--  Full Calendar Plugin    -->
  <script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script>

  <!-- Light Bootstrap Dashboard Core javascript and methods -->
<script src="<?php echo base_url(); ?>assets/js/light-bootstrap-dashboard.js"></script>

<!--   Sharrre Library    -->
  <script src="<?php echo base_url(); ?>assets/js/jquery.sharrre.js"></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<script type="text/javascript">
      $().ready(function(){

        $('.datepicker').datetimepicker({
          format: 'YYYY-MM-DD',
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });
      });
      $("input").on("keypress", function(e) {
          if (e.which === 32 && !this.value.length)
              e.preventDefault();
      });
  </script>

</html>
