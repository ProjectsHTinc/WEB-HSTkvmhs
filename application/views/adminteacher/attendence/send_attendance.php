<div class="main-panel">
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">

      </div>

      <div class="card">

        <div class="content">
          <legend>List of Record in
            <?php foreach($get_name_class as $rows){} echo $rows->class_name; echo "-";echo $rows->sec_name;  ?>
            <button onclick="history.go(-1);" class="btn btn-wd btn-default" style="margin-left:62%;">Go Back</button>
          </legend>

          <div class="fresh-datatables">

            <table id="bootstrap-table" class="table">
              <thead>

                <th data-field="id" class="text-center">S.No</th>
                <th data-field="date" class="text-center" data-sortable="true">Date</th>
                <th data-field="year" class="text-center" data-sortable="true">Total Students </th>
                <th data-field="no" class="text-center" data-sortable="true">No.Of.Present</th>
                <th data-field="name" class="text-center" data-sortable="true">no.Of.Absent</th>
                <th data-field="taken" class="text-center" data-sortable="true">Attendance Taken by</th>
                <th data-field="Section" class="text-center" data-sortable="true">View Absent</th>
                <th data-field="send" class="text-center" data-sortable="true">Send Attendance</th>
                <th data-field="send_status" class="text-center" data-sortable="true">Send Status</th>

              </thead>
              <tbody>
                <?php
                $i=1;
                foreach ($result as $rows) {

                  ?>
                  <tr>
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php  $dateTime = new DateTime($rows->created_at); echo   $cur_d=$dateTime->format("d-m-Y :A");  ?>
                    </td>
                    <td>
                      <?php echo $rows->class_total; ?>
                    </td>
                    <td>
                      <?php echo $rows->no_of_present; ?>
                    </td>

                    <td>
                      <?php echo $rows->no_of_absent; ?>
                    </td>
                    <td>
                      <?php echo $rows->name; ?>
                    </td>

                    <td>
                      <a href="<?php echo base_url(); ?>teacherattendence/view_all/<?php echo $rows->at_id; ?>/<?php echo $rows->class_id; ?>" rel="tooltip" title="View " class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
                    </td>
                    <td>
                      <a href="#" rel="tooltip" title="Send" data-toggle="modal" data-target="#myModal" data-id="<?php echo $rows->at_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
                    </td>
                    <td>
                      <?php $sent=$rows->sent_status;
                      if($sent=="1"){
                        echo "<i class='fa fa-check' ></i>";
                      }else{
                          echo "";
                      }
                       ?>
                    </td>
                  </tr>
                  <?php $i++;  }  ?>
                </tbody>
              </table>

              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title" id="myModalLabel">Send Attendance To Parents</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post" class="form-horizontal" id="send_attendance_parents">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-4 control-label">Select type</label>
                              <div class="col-sm-6">
                                <select multiple name="msg_type[]" id="msg_type" data-title="Select  Type" class="selectpicker form-control">
                                   <option value="SMS">SMS</option>
                                   <option value="Mail">Mail</option>
                                   <option value="Notification">Notification</option>
                                </select>
                                <input type="hidden" name="attend_id" id="attend_id" class="form-control" value="">

                              </div>
                           </div>
                        </fieldset>

                         <fieldset>
                            <div class="form-group">
                               <label class="col-sm-4 control-label">&nbsp;</label>
                               <div class="col-sm-4">
                                  <button type="submit" class="btn btn-info btn-fill center">Send Message </button>
                               </div>
                            </div>
                         </fieldset>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#send_attendance_parents').validate({ // initialize the plugin
  rules: {
      "msg_type[]":{required:true },
  },
  messages: {
        "msg_type[]": "Select Type"
      },
    submitHandler: function(form) {
      //alert("hi");
      swal({
                    title: "Are you sure?",
                    text: "You Want Confirm this form",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                },
                function(isConfirm) {
                    if (isConfirm) {

     $.ajax({
         url: "<?php echo base_url(); ?>teacherattendence/send_attendance_parents",
          type:'POST',
         data: $('#send_attendance_parents').serialize(),
         success: function(response) {
             if(response=="success"){
                $('#send_attendance_parents')[0].reset();
                swal({
         title: "Wow!",
         text: response,
         type: "success"
     }, function() {
        location.reload();
     });
             }else{
               sweetAlert("Oops...", response, "error");
             }
         }
     });
   }else{
       swal("Cancelled", response , "error");
   }
 });
}
});
$('#myModal').on('show.bs.modal', function (e) {
    var myRoomNumber = $(e.relatedTarget).attr('data-id');
    $(this).find('#attend_id').val(myRoomNumber);
});

$('#attendmenu').addClass('collapse in');
$('#atten').addClass('active');
$('#atten2').addClass('active');
var $table = $('#bootstrap-table');
$().ready(function() {
  $table.bootstrapTable({
    toolbar: ".toolbar",
    clickToSelect: true,
    showRefresh: true,
    search: true,
    showToggle: true,
    showColumns: true,
    pagination: true,
    searchAlign: 'left',
    pageSize: 8,
    clickToSelect: false,
    pageList: [8, 10, 25, 50, 100],

    formatShowingRows: function(pageFrom, pageTo, totalRows) {
      //do nothing here, we don't want to show the text "showing x of y from..."
    },
    formatRecordsPerPage: function(pageNumber) {
      return pageNumber + " rows visible";
    },
    icons: {
      refresh: 'fa fa-refresh',
      toggle: 'fa fa-th-list',
      columns: 'fa fa-columns',
      detailOpen: 'fa fa-plus-circle',
      detailClose: 'fa fa-minus-circle'
    }
  });

  //activate the tooltips after the data table is initialized
  $('[rel="tooltip"]').tooltip();

  $(window).resize(function() {
    $table.bootstrapTable('resetView');
  });

});
</script>
