<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Add Staff</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>teacher/create" class="form-horizontal" enctype="multipart/form-data" id="admissionform">
                 <fieldset>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Select Role </label>
                       <div class="col-sm-4">
                          <select name="role_type_id" id="role_type_id" class="selectpicker form-control" data-title="Select Role" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($res_user_role as $res_user_role_name){ ?>
                               <option value="<?php echo $res_user_role_name->role_id; ?>"><?php echo $res_user_role_name->user_type_name; ?></option>
                          <?php   } ?>
                            </select>
                       </div>
                    </div>
                 </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" value="">
                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email" class="form-control"  placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                           <p id="msg" style="color:red;"> </p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_email" placeholder="Email Address" class="form-control" value="">
                        </div>
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_phone" class="form-control" placeholder="Mobile Number" />
                        </div>
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                           <select name="sex" class="selectpicker form-control" data-title="Select Gender" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of birth</label>
                        <div class="col-sm-4">
                           <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth "/>
                        </div>
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" name="nationality" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" id="age" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Religion" name="religion" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Community Class</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community Class" name="community_class" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Community</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community" name="community" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <textarea name="address" MaxLength="150" class="form-control" rows="4" cols="80" placeholder="Max Characters 150"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Main Subject</label>
                        <div class="col-sm-4">
                           <select   name="subject" id="subject_id"  data-title="Select Subject" class="selectpicker" data-style=" btn-block" onchange="getListClass()"  data-menu-style="dropdown-blue">
                              <?php foreach ($resubject as $rows) {  ?>
                              <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>
				   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Qualification</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Qualification" name="qualification" class="form-control">
                        </div>
                        <!-- <label class="col-sm-2 control-label">SUBJECT</label>
                        <div class="col-sm-4">
                           <select multiple name="subject_multiple[]" id="subject_id"  data-title="Select Subject" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($resubject as $rows) {  ?>
                              <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div> -->
                        <div id="class_tutor_teacher">
                        <label class="col-sm-2 control-label">Class Tutor</label>
                        <div class="col-sm-4">
                           <select   name="class_teacher"  id="class_teacher" data-title="Select Class" class="selectpicker" data-style=" btn-block"  data-menu-style="dropdown-blue">
                              <?php foreach ($get_all_class_notexist as $rows) {  ?>
                              <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                     </div>
                        </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">

                        <!-- <label class="col-sm-2 control-label">Class Assigned </label>
                        <div class="col-sm-4">
                           <select multiple="multiple"  name="class_name[]" id="multiple" style="width:150px;">
                           </select>
                        </div> -->
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Teacher Picture</label>
                        <div class="col-sm-4">
                           <input type="file" name="teacher_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                        <label class="col-sm-2 control-label">House Groups</label>
                        <div class="col-sm-4">
                           <select name="groups_id" class="selectpicker form-control" data-title="Select Groups Name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($groups as $row2) {  ?>
                              <option value="<?php echo $row2->id; ?>"><?php echo $row2->group_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Extra curricular </label>
                        <div class="col-sm-4">
                           <select name="activity_id[]" multiple="multiple" class="selectpicker form-control" data-title="Select Actvities Name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($activities as $row3) {  ?>
                              <option value="<?php echo $row3->id; ?>"><?php echo $row3->extra_curricular_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control" data-title="Select Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <img  id="output" class="img-circle" style="width:200px;">
                        </div>
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group"></div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<style>
#class_tutor_teacher {
  display:none;
}
</style>
<script type="text/javascript">
   function getListClass(){

   var subject_id=$('#subject_id').val();
   //alert(subject_id);
   $.ajax({
   url:'<?php echo base_url(); ?>classmanage/getListClass',
   method:"POST",
   data:{subject_id:subject_id},
   dataType: "JSON",
   cache: false,
   success:function(data)
   {
   var stat=data.status;
   $("#multiple").empty();
   if(stat=="success"){
   var res=data.res;
   //alert(res.length);
   var len=res.length;

   for (i = 0; i < len; i++) {
   $('<option>').val(res[i].class_sec_id).text(res[i].class_name + res[i].sec_name).appendTo('#multiple');
   }

   }else{
   $("#multiple").empty();
   }
   }
   });

   }

   var loadFile = function(event) {
   var output = document.getElementById('output');
   output.src = URL.createObjectURL(event.target.files[0]);
   };

   $(document).ready(function () {


   $('#admissionform').validate({ // initialize the plugin
   rules: {
     role_type_id:{required:true },
 	   name:{required:true }, address:{required:true },
   	 email:{required:true,email:true,
                    remote: {
                               url: "<?php echo base_url(); ?>teacher/checker",
                               type: "post"
                            }
                          },
   	sex:{required:true },
   	dob:{required:true },
   	// age:{required:true,number:true,maxlength:2 },
   	nationality:{required:true },
   	religion:{required:true },
   	community_class:{required:true },
   	community:{required:true },
   	mobile:{required:true,  remote: {
                 url: "<?php echo base_url(); ?>teacher/mobile_checker",
                 type: "post"
              }
             },
   	qualification:{required:true },
   	status:{required:true }
   },
   messages: {
    role_type_id:"Select Role",
   	address: "Enter Address",
   	admission_date: "Select Admission Date",
   	name: "Enter Name",
   	email:{
          required: "Please enter your email address.",
          email: "Please enter a valid email address.",
          remote: "Email already in use!"
    },

   	sex: "Select Gender",
   	dob: "Select Date of Birth",
   	age: "Enter AGE",
   	nationality: "Nationality",
   	//subject:"Choose The Subject",
   	religion: "Enter the Religion",
   	community:"Enter the Community",
   	community_class:"Enter the Community Class",
   	mother_tongue:"Enter The Mother tongue",
   	qualification:"Enter the Qualification ",
   	mobile:{
      required: "Please enter your mobile Number.",
      mobile: "Please enter a valid mobile Number.",
      remote: "Mobile Number already in use!"
    },
   	status:"Select Status Name"
   }
   });
   });

   $('#role_type_id').on('change', function () {
       if(this.value === "2"){
           $("#class_tutor_teacher").show();
       } else {
           $("#class_tutor_teacher").hide();
       }
   });



   $().ready(function(){
   $('#teachermenu').addClass('collapse in');

   $('#teacher').addClass('active');
   $('#teacher1').addClass('active');
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
