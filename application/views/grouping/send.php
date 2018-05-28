<div class="main-panel">
<div class="content">
       <div class="container-fluid">


           <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="">
                           <div class="header">
                              List Grouping
                              <a href="<?php echo base_url(); ?>grouping/message_history" class="btn btn pull-right">Message History</a>
                           </div>
                     </div>

                     <table id="bootstrap-table" class="table">
                         <thead>

                           <th data-field="id" class="text-left">S.No</th>
                           <th data-field="name" class="text-left" data-sortable="true">Group Name</th>
                           <th data-field="Section" class="text-left" data-sortable="true">Lead</th>
                           <th data-field="status" class="text-left" data-sortable="true">status</th>
                           <th data-field="actions" class="td-actions text-left" data-events="operateEvents">Actions</th>
                         </thead>
                         <tbody>
                           <?php $i=1; foreach ($list_of_grouping as $rowsclass) { $sta=$rowsclass->status; ?>
                             <tr>
                                <td><?php echo $i;  ?></td>
                               <td><?php echo $rowsclass->group_title;  ?></td>
                               <td><?php echo $rowsclass->name;  ?></td>
                                <td>
                                    <?php
                                    if($sta=='Active'){?>
                                    <button class="btn btn-success btn-fill btn-wd">Active</button>
                                    <?php  }else{?>
                                    <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                                    <?php } ?>
                                  </td>
                               <td>


                                    <a href="#myModal" data-toggle="modal" data-target="#myModal"  data-id="<?php echo $rowsclass->id; ?>" rel="tooltip" title="SEND"  class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit">
                                  <i class="fa fa-paper-plane"> </i></a>

                               </td>

                             </tr>

                             <?php $i++;  }  ?>

                         </tbody>
                     </table>

                     <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Send Message To Group</h4>
                              </div>
                              <div class="modal-body">
                                 <form action="" method="post" class="form-horizontal" id="send_msg">
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">Notification Type </label>
                                          <div class="col-sm-6">

                                            <select multiple name="circular_type[]" id="circular_type" data-title="Select Circular Type" class="selectpicker form-control">
                                              <option value="SMS">SMS</option>
                                              <option value="Mail">Mail</option>
                                              <option value="Notification">Notification</option>
                                          </select>
                                             <input type="hidden" name="group_id" id="group_id" class="form-control" value="">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">Board Memebers </label>
                                          <div class="col-sm-6">

                                            <select multiple name="members_id[]" id="members_id" data-title="Select Board Members" class="selectpicker form-control">
                                              <?php foreach($get_board_members as $res_member){ ?>
                                                  <option value="<?php echo $res_member->teacher_id ?>"><?php echo $res_member->name ?></option>
                                            <?php   } ?>


                                          </select>
                                             <input type="hidden" name="group_id" id="group_id" class="form-control" value="">
                                          </div>
                                       </div>

                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">Notes </label>
                                          <div class="col-sm-6">

                                            <textarea name="notes" MaxLength="160" placeholder="MaxLength 160" id="notes" class="form-control"  rows="4" cols="80"></textarea>

                                          </div>
                                       </div>

                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">&nbsp;</label>
                                          <div class="col-sm-6">
                                             <button type="submit" id="save" class="btn btn-info btn-fill center">Send </button>
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

                       </div><!--  end card  -->
             </div> <!-- end col-md-12 -->
    <div id="loading">
       <center><img src="<?php echo base_url(); ?>assets/loader.gif" id="loading" style="position: absolute;    top: 50%;    left: 80%;"></center>
    </div>
           </div>

       </div>
   </div>


</div>

<script type="text/javascript">
  $("#loading").hide();
    // $("#loading").show();
$('#send_msg').validate({ // initialize the plugin
  rules: {
      "circular_type[]":{required:true },
      notes:{required:true },

  },
  messages: {
        "circular_type[]": "Select Type",
        notes:"Enter Notes "


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
              $("#loading").show();

$.ajax({
    url: "<?php echo base_url(); ?>grouping/send_msg",
     type:'post',
    data: $('#send_msg').serialize(),
    success: function(response) {
      //alert(response);
      $("#loading").show();
        if(response=="success"){
            $("#loading").hide();
         //  swal("Success!", "Thanks for Your Note!", "success");
          $('#send_msg')[0].reset();
          swal({
    title: "Wow!",
    text: "Message!",
    type: "success"
}, function() {
     location.reload();
});
        }else{
          sweetAlert("Oops...",response , "error");
        }
    }
});
}else{
    $("#loading").hide();
  swal("Cancelled", "Process Cancel :)", "error");
}
});


}

});



var $table = $('#bootstrap-table');
      $().ready(function(){
          $table.bootstrapTable({
              toolbar: ".toolbar",
              clickToSelect: true,
              showRefresh: true,
              search: true,
              showToggle: true,
              showColumns: true,
              pagination: true,
              searchAlign: 'left',
              pageSize: 10,
              clickToSelect: false,
              pageList: [8,10,25,50,100],

              formatShowingRows: function(pageFrom, pageTo, totalRows){
                  //do nothing here, we don't want to show the text "showing x of y from..."
              },
              formatRecordsPerPage: function(pageNumber){
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

          $(window).resize(function () {
              $table.bootstrapTable('resetView');
          });


      });
      $(document).on("click", ".open-AddBookDialog", function () {
           var eventId = $(this).data('id');
           $(".modal-body #group_id").val( eventId );
      });

</script>
