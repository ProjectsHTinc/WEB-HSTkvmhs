<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Students On Duty Form</h4>
                       </div>
						<?php foreach($editstu as $res){}	?>
                       <div class="content">
                                 <form method="post" action="<?php echo base_url(); ?>teacheronduty/update_stu_onduty_list" class="form-horizontal" enctype="multipart/form-data" id="ondutysection" name="ondutysection">
                            <?php foreach($clsstudlist as $rows){} ?>
							 <input type="hidden" name="cls_tea_id" value="<?php echo $rows->class_id; ?>" class="form-control">
                        <fieldset>
                           <div class="form-group">
						   
						    <label class="col-sm-2 control-label">Students Name</label>
                              <div class="col-sm-4">
							     <select name="stu_userid" class="selectpicker form-control">
								 <?php foreach($clsstudlist as $rows){?>
									<option value="<?php echo $rows->user_id; ?>"><?php echo $rows->name; ?></option>
								 <?php } ?>
								  </select>
								  <script language="JavaScript">document.ondutysection.stu_userid.value="<?php echo $res->user_id; ?>";</script>
                              </div>  
						   
						   
                              <label class="col-sm-2 control-label">Reason Out</label>
                              <div class="col-sm-4">
							   <input type="text" name="reason" value="<?php echo $res->od_for; ?>" class="form-control">
							    <input type="hidden" name="id" value="<?php echo $res->id; ?>" class="form-control">
                              </div>
                              
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">From Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="fdate"  class="form-control datepicker" value="<?php $dateTime=new DateTime($res->from_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate; ?>">
                              </div>
							  
                              <label class="col-sm-2 control-label">To Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="tdate" class="form-control datepicker" value="<?php $dateTime=new DateTime($res->to_date); $tdate=date_format($dateTime,'d-m-Y' ); echo $tdate; ?>">
                              </div>
                             
                           </div>
                        </fieldset>
						
						 <fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">Notes</label>
                              <div class="col-sm-4">
                                 <textarea rows="4" cols="80" MaxLength="250" placeholder="MaxLength 250" name="notes" class="form-control"><?php echo $res->notes; ?></textarea>
                              </div>
						   </div>
                        </fieldset>
                        <div class="form-group">
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
      $().ready(function(){
       $('#stuonduty').addClass('collapse in');
       $('#stuonduty').addClass('active');
       $('#stuonduty').addClass('active');
		
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
