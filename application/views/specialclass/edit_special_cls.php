<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Special Class</h4>

                       </div>
<?php foreach($edit as $res)
{
}	?>
                       <div class="content">
                             <form method="post" action="<?php echo base_url(); ?>specialclass/update_special_cls" class="form-horizontal" enctype="multipart/form-data" id="specialclasssection" name="specialclasssection">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Class</label>
                              <div class="col-sm-4">
                                 <select  name="class_name" id="multiple-class" onchange="checksubject(this.value)" class="selectpicker" data-menu-style="dropdown-blue">
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
								  <script language="JavaScript">
                        			document.specialclasssection.class_name.value="<?php echo $res->class_master_id; ?>";
                        		</script>
                              </div>
                              <label class="col-sm-2 control-label">Teacher</label>
                              <div class="col-sm-4">
                                <select  name="teacher" class="selectpicker form-control"  id="multiple-teacher"  data-menu-style="dropdown-blue" >
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->teacher_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select>
								   <script language="JavaScript">
                        			document.specialclasssection.teacher.value="<?php echo $res->teacher_id; ?>";
                        		</script>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Subject</label>
                              <div class="col-sm-4">
							   <select  name="subject_name" class="form-control" id="ajaxres">
							   <option value="<?php echo $res->subject_id;  ?>"><?php echo $res->subject_name; ?></option>
							   </select>
								
                              </div>
                              <label class="col-sm-2 control-label">Subject Title</label>
                              <div class="col-sm-4">
                                 <input type="text" name="sub_topic" required class="form-control" value="<?php echo $res->subject_topic;?>"  />
								 <input type="hidden" name="id" required class="form-control" value="<?php echo $res->id;?>"  />
                              </div>
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="spe_date" required class="form-control datepicker" value="<?php $date=date_create($res->special_class_date);echo date_format($date,"m-d-Y");?>">
                              </div>
                              <label class="col-sm-2 control-label">Start Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="stime" value="<?php echo $res->start_time;?>"  class="form-control timepicker"  />
                              </div>
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">End Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="etime" value="<?php echo $res->end_time;?>" class="form-control timepicker" >
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                <select name="status"  class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
								  <option value="Active">Active</option>
								  <option value="Deactive">DeActive</option>
							  </select>
							  <script language="JavaScript">
                        			document.specialclasssection.status.value="<?php echo $res->status; ?>";
                        		</script>
                              </div>
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
        $('#mastersmenu').addClass('collapse in');
        $('#master').addClass('active');
        $('#masters2').addClass('active');
		
		 $('#specialclasssection').validate({ // initialize the plugin
        rules: {
            class_name:{required:true },
			teacher:{required:true },
			sub_topic:{required:true },
			spe_date:{required:true },
			stime:{required:true },
			etime:{required:true },
			status:{required:true },
			
        },
        messages: {
              class_name: "Select Class",
			   teacher: "Select Teacher",
			   sub_topic: "Enter Subject Topic",
			   spe_date: "Select Date",
			   stime: "Select Start Time",
			   etime: "Select End Time",
			   status: "Select Status",
			   
			  
            }
    });
	demo.initFormExtendedDatetimepickers();
			
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
