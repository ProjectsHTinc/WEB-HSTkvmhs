<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update On Duty Form</h4>
                       </div>
						<?php foreach($edit as $res){}	?>
                       <div class="content">
                                 <form method="post" action="<?php echo base_url(); ?>onduty/update_stuonduty" class="form-horizontal" enctype="multipart/form-data" id="ondutysection" name="ondutysection">
                       
                        <fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">Student Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="tname" readonly class="form-control" value="<?php echo $res->name; ?> ( <?php  echo $res->class_name	; ?> - <?php  echo $res->sec_name; ?> )">
                              </div>
							  
                              <label class="col-sm-2 control-label">Reason Out</label>
                              <div class="col-sm-4">
							   <input type="text" name="reason" readonly value="<?php echo $res->od_for; ?>" class="form-control">
							    <input type="hidden" name="id" value="<?php echo $res->id; ?>" class="form-control">
                              </div>
							  
                              
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">From Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="fdate"  readonly class="form-control datepicker" value="<?php $dateTime=new DateTime($res->from_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate; ?>">
                              </div>
							  
                              <label class="col-sm-2 control-label">To Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="tdate" readonly class="form-control datepicker" value="<?php $dateTime=new DateTime($res->to_date); $tdate=date_format($dateTime,'d-m-Y' ); echo $tdate; ?>">
                              </div>
                            
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
                               <label class="col-sm-2 control-label">Notes</label>
                              <div class="col-sm-4">
                                 <textarea rows="4" cols="80" readonly name="notes" class="form-control"><?php echo $res->notes; ?></textarea>
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select class="form-control" name="status" id="choose" >
												<option value="Pending">Pending</option>
												<option value="Approved">Approved</option>
												<option value="Rejected">Reject</option>
												
								</select>
								<script language="JavaScript">document.ondutysection.status.value="<?php echo $res->status; ?>";</script>
                           </div>
                        </fieldset>
						
                        <div class="form-group">
                           <label class="col-sm-2 control-label">&nbsp;</label>
                           <div class="col-sm-4">
                              <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>
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
      $().ready(function(){
        /* $('#mastersmenu').addClass('collapse in');
        $('#master').addClass('active');
        $('#masters2').addClass('active'); */
		
		 $('#ondutysection').validate({ // initialize the plugin
        rules: {
           reason:{required:true },
			notes:{required:true },
			fdate:{required:true },
			tdate:{required:true },
			status:{required:true }
        },
        messages: {
              reason: "Enter Reason Out",
			   notes: "Enter Notes",
			   fdate: "Select From Date",
			   tdate: "Select To Date",
			   status: "Select Status",
            }
    });
	//demo.initFormExtendedDatetimepickers();
			
        $('.datepicker').datetimepicker({
          format: 'DD-MM-YYYY',
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
