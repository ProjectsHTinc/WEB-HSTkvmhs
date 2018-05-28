<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  ×</button> <?php echo $this->session->flashdata('msg'); ?>
               </div>
               <?php endif; ?>
               <div class="card">
                  <div class="header">
                     <legend> User Leave Details</legend>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>communication/update_status" class="form-horizontal" enctype="multipart/form-data" id="myformsection" name="myformsection">
                       <input type="hidden" name="leave_id" value="<?php echo $leaveid; ?>">

					   <?php 
                           //print_r($res);
                           foreach($res as $row){ 
                           $id=$row->leave_id;
                           $date1=date_create($row->from_leave_date);
                           $leave=$row->type_leave;
                           $cell=$row->phone;
                           } ?>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Type of Leave</label>
                              <div class="col-sm-4">
                                 <input type="text" name="leaves_type" id="leaves_type" readonly value="<?php echo  $row->leave_title; ?>" class="form-control">
                              </div>
                              <label class="col-sm-2 control-label">From Leave Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="leave_date" readonly value="<?php $date1=date_create($row->from_leave_date);
                                    echo date_format($date1,"d-m-Y"); ?>" class="form-control">
                                 <input type="hidden" name="leave_id" value="<?php echo $id;?>" class="form-control">
                                 <input type="hidden" name="cell" value="<?php echo $cell;?>" class="form-control">
                              </div>
                           </div>
                        </fieldset>
                        <?php if($leave==0){?>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Time</label>
                              <div class="col-sm-2">
                                 <input type="text" disabled class="form-control timepicker" value="<?php echo $row->frm_time;?>" name="frm_time" placeholder="From Time"/>
                              </div>
                              <div class="col-sm-2">
                                 <input type="text" disabled name="to_time" value="<?php echo $row->to_time;?>" class="form-control timepicker" placeholder="To Time"/>
                              </div>
                           </div>
                        </fieldset>
                        <?php }?>
                        <br/>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">To Leave Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="tleave_date" readonly value="<?php $date1=date_create($row->to_leave_date);
                                    echo date_format($date1,"d-m-Y"); ?>" class="form-control">
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select class="form-control" name="status" id="choose" >
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Reject</option>
                                 </select>
                                 <script language="JavaScript">document.myformsection.status.value="<?php echo $row->status; ?>";</script>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Leave Description</label>
                              <div class="col-sm-4">
                                 <textarea name="leave_description" disabled class="form-control"  rows="4" cols="80"><?php echo $row->leave_description;?></textarea>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Update</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
    $('#teachermenu').addClass('collapse in');
    $('#teacher').addClass('active');
    $('#teacher3').addClass('active');
    $('#myformsection').validate({ // initialize the plugin
       rules: {
         leave_type:{required:true },
   		 leave_date:{required:true },
   		 leave_description:{required:true },
   frm_time:{required:true },
   to_time:{required:true },
   
        },
        messages: {
              leave_type:"Select Type Of Leave",
              leave_date:"Select Leave Date",
              leave_description:"Enter The Leave Description",
     frm_time:"Select From Time",
     to_time:"Select To Time",
            }
    });
   demo.initFormExtendedDatetimepickers();
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
                 pageSize: 8,
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
   
   
   $(function () {
        $("#choose").change(function () {
            if ($(this).val() == "Permisssion") {
                $("#permissiontime").show();
   	
            } else {       }
        });
    }); 
   
   
   $().ready(function(){
   
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
     minDate: new Date(),
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
</script>

