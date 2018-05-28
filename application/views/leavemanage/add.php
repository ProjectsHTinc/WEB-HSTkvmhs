<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Create Leave  <span><a href="<?php echo base_url(); ?>leavemanage/view" class="pull-right btn btn-wd" style="margin-top:-10px;">View Leaves</a></span></legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" class="form-horizontal" enctype="multipart/form-data" id="leaveform">
                  <p style="margin-left:200px;" id="errormsg"></p>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                           <select name="leave_type" id="leave_type" class="selectpicker form-control" data-title="Leave type" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Regular Holiday">Regular Holiday</option>
                              <option value="Special Holiday">Special Holiday</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset id="leave_years">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Years</label>
                        <div class="col-sm-4">
                           <select name="years" id="leave_years1" class="selectpicker form-control" data-title="Years" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                           </select>
                           <p id="erroryears"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset id="leave_class">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Class</label>
                        <div class="col-sm-4">
                           <select multiple name="class_name[]" data-title="Classes" id="leave_class" class="selectpicker" >
                              <?php foreach ($getall_class as $rows) {  ?>
                              <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                              <?php      } ?>
                           </select>
                           <p id="errorclass"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset id="days">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Days</label>
                        <div class="col-sm-4">
                           <select name="days" id="leave_days" class="selectpicker form-control" data-title="Days" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Sunday">Sunday</option>
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thursday">Thursday</option>
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>
                           </select>
                           <p id="errordays"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset id="weeks">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Weeks</label>
                        <div class="col-sm-4">
                           <select name="weeks" id="leave_weeks" class="selectpicker form-control" data-title="Weeks" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                           </select>
                           <p id="errorweeks"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset  id="leaves_date">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Date</label>
                        <div class="col-sm-4">
                           <input type="text" name="leave_date" id="leave_date" class="form-control datepicker" placeholder="Leave Date"/>
                           <p id="errordates"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset id="leaves_name">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="leave_name" id="leave_name" class="form-control">
                           <p id="errorname"></p>
                        </div>
                     </div>
                  </fieldset>
                  <!-- <fieldset id="leaves_details">
                     <div class="form-group">
                         <label class="col-sm-2 control-label">Leave Details</label>
                         <div class="col-sm-4">
                             <textarea type="text" name="leave_details" class="form-control"></textarea>

                         </div>

                     </div>
                     </fieldset> -->
                  <fieldset id="leave_status">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Status</label>
                        <div class="col-sm-4">
                           <select name="leave_status" id="leave_status1" class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">De-Active</option>
                           </select>
                           <p id="errorstatus"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div id="div_name"></div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                           <!-- <input type="button" id="more" value="Add more" /> -->
                           <input type="submit" id="leave_submit" name="leave_submit" class="btn btn-info btn-fill center" value="Save" >
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#eventmenu').addClass('collapse in');
   $('#event').addClass('active');
   $('#leave1').addClass('active');

   $(document).ready(function () {

     $('#leaves_name').hide();
     $('#leaves_date').hide();
     $('#weeks').hide();
     $('#leave_years').hide();
     $('#leave_class').hide();
     $('#leave_status').hide();
     $('#days').hide();
     $('#leaves_details').hide();

     $('#leave_type').change(function () {
   	   //alert("hi");
         if ($('#leave_type').val() == 'Special Holiday') {

           $('#weeks').hide();
           $('#days').hide();
           $('#leave_years').hide();
   		    $('#leave_class').show();
           $('#leaves_name').show();
           $('#leaves_details').show();
           $('#leaves_date').show();
           $('#leave_status').show();
         }else if ($('#leave_type').val() == 'Regular Holiday'){
           //alert("rh");
          $('#leaves_details').hide();
          $('#leaves_name').hide();
          $('#leaves_date').hide();
          $('#weeks').show();
          $('#days').show();
          $('#leave_years').show();
   	   $('#leave_class').show();
          $('#leave_status').show();
         }
         else {


         }
     });

   });




   $('#leaveform').validate({ // initialize the plugin
       rules: {
           leave_type:{required:true },
           years:{required:true },
           "class_name[]":{required:true},
           leave_name:{required:true },
           weeks:{required:true },
           leave_status:{required:true },
           leave_date:{required:true},
           days:{required:true}

       },
       messages: {
             leave_type: "Select Type",
             years:"Select Years",
             leave_name:"Enter name",
             weeks:"Select Weeks",
             leave_date:"Pick the Date",
             leave_status:"Select Status",
             "class_name[]":"Select the Class",
             days:"Select Days"

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
                                         type: "POST",
                                         url: "<?php echo base_url(); ?>leavemanage/add",
                                         data: $("#leaveform").serialize(),
                                         success: function(data){
                                            if(data=="success"){
                                              swal({
                                                 title: "Success!",
                                                 text: "Redirecting in 2 seconds.",
                                                 type: "success",
                                                 timer: 2000,
                                                 showConfirmButton: false
                                                 }, function(){
                                                   window.location.href = "<?php echo base_url(); ?>leavemanage/view";
                                                 });
                                            }
                                            else if(data=="special leave already Added for this date"){
                                               sweetAlert("Oops...", data, "error");
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




</script>
