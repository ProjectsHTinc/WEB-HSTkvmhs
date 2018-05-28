<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Create Grouping</h4>
                       </div>

                       <div class="content">
                           <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="grouping_form">

                                 <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Group Title</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="group_title" class="form-control" value="">

                                          </div>
                                            </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Group Lead</label>
                                          <div class="col-sm-4">
                                            <select name="group_lead"  data-title="Select" class="selectpicker form-control">
                                              <?php foreach($list_of_teacher as $rows){ ?>
                                                 <option value="<?php echo $rows->user_id; ?>"><?php echo $rows->name; ?></option>
                                          <?php    } ?>


                                           </select>
                                          </div>

                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Status</label>
                                          <div class="col-sm-4">
                                            <select name="status" data-title="Select status" class="selectpicker form-control">
                                               <option value="Active">Active</option>
                                               <option value="Deactive">De-Active</option>
                                           </select>
                                          </div>

                                      </div>
                                  </fieldset>
                                        <div class="form-group">
											                               <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Create</button>
                                            </div>

                                            </div>
                                    </fieldset>

                             </form>
                       </div>
                   </div>
               </div>
           </div>

           <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="toolbar">
                         <div class="header">List of Grouping </div>
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
                                 <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url(); ?>grouping/edit_group/<?php  echo $rowsclass->id; ?>">
                                    <i class="fa fa-edit"></i></a>

                                    <a rel="tooltip" href="<?php echo base_url(); ?>grouping/view_members/<?php echo  $rowsclass->id; ?>"  title="View Members" class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit">
                                    <i class="fa fa-th">  </i></a>

                               </td>

                             </tr>

                             <?php $i++;  }  ?>

                         </tbody>
                     </table>

                       </div><!--  end card  -->
             </div> <!-- end col-md-12 -->
           </div>

       </div>
   </div>


</div>

<script type="text/javascript">

$('#grouping_form').validate({ // initialize the plugin
  rules: {
      group_title:{required:true },
      group_lead:{required:true },
      status:{required:true },
  },
  messages: {
        group_title: "Enter Grouping Name",
        group_lead:"Select group incharge",
        status:"select status"

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
               closeOnCancel: false
           },
           function(isConfirm) {
               if (isConfirm) {
$.ajax({
    url: "<?php echo base_url(); ?>grouping/create_group",
     type:'POST',
    data: $('#grouping_form').serialize(),
    success: function(response) {
        if(response=="success"){
         //  swal("Success!", "Thanks for Your Note!", "success");
           $('#grouping_form')[0].reset();
           swal({
    title: "Wow!",
    text: "Message!",
    type: "success"
}, function() {
     location.reload();
});
        }else{
          sweetAlert("Oops...", "Something went wrong!", "error");
        }
    }
});
}else{
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
</script>
