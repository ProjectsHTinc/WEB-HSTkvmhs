<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Update Staff</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php foreach ($res as $rows) { } ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>teacher/save" class="form-horizontal" enctype="multipart/form-data" id="admissionform" name="teacherform">
                 <fieldset>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Select Role </label>
                       <div class="col-sm-4">
                          <select name="role_type_id" id="role_type_id" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($res_user_role as $res_user_role_name){ ?>
                               <option value="<?php echo $res_user_role_name->role_id; ?>"><?php echo $res_user_role_name->user_type_name; ?></option>
                          <?php   } ?>
                            </select>
                             <script language="JavaScript">document.teacherform.role_type_id.value="<?php echo $rows->role_type_id; ?>";</script>
                       </div>
                    </div>
                 </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" value="<?php echo $rows->name; ?>">
                           <input type="hidden" placeholder="Community" name="teacher_id" class="form-control" value="<?php echo $rows->teacher_id; ?>">
                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email" required  class="form-control" id="email" value="<?php echo $rows->email; ?>"/>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                           <select name="sex" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                           <script language="JavaScript">document.teacherform.sex.value="<?php echo $rows->sex; ?>";</script>
                        </div>
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?php echo $rows->phone; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_email" placeholder="Email Address" class="form-control" value="<?php echo $rows->sec_email;?>">
                        </div>
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_phone" value="<?php echo $rows->sec_phone;?> " class="form-control" placeholder="Mobile Number" />
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of birth</label>
                        <div class="col-sm-4">
                           <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                        </div>
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" name="nationality" class="form-control"  value="<?php echo $rows->nationality; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" id="age" class="form-control"  value="<?php echo $rows->age; ?>">
                        </div>
                        <label class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Religion" name="religion" class="form-control"  value="<?php echo $rows->religion; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Community Class</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community Class" name="community_class" class="form-control"  value="<?php echo $rows->community_class; ?>">
                        </div>
                        <label class="col-sm-2 control-label">Community</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community" name="community" class="form-control" value="<?php echo $rows->community; ?>">
                           <input type="hidden" placeholder=" " name="old_pic" class="form-control" value="<?php echo $rows->profile_pic; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <textarea name="address" MaxLength="150" class="form-control" rows="4" cols="80" placeholder="Max Characters 150"><?php echo $rows->address; ?></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Main Subject</label>
                        <div class="col-sm-4">
                           <select   name="subject" id="subject_id" class="selectpicker" data-style="btn-block" onchange="getListClass()"  data-menu-style="dropdown-blue">
                              <?php foreach ($resubject as $rows3) {  ?>
                              <option value="<?php echo $rows3->subject_id; ?>"><?php echo $rows3->subject_name; ?></option>
                              <?php      } ?>
                           </select>
                           <script language="JavaScript">document.teacherform.subject.value="<?php echo $rows->subject; ?>";</script>
                        </div>
                     </div>
                  </fieldset>
				   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Qualification</label>
                        <div class="col-sm-4">
                           <input type="text" value="<?php echo $rows->qualification; ?>" name="qualification" class="form-control">
                        </div>

                        <div id="class_tutor_teacher">
                        <label class="col-sm-2 control-label">CLASS TUTOR</label>
                        <div class="col-sm-4">
                           <select   name="class_teacher"  class="selectpicker" data-style="btn-block"  data-menu-style="dropdown-blue">
                             <option value="">None</option>
                              <?php foreach ($getall_class as $rows2) {  ?>
                              <option value="<?php echo $rows2->class_sec_id; ?>"><?php echo $rows2->class_name; ?>&nbsp; - &nbsp;<?php echo $rows2->sec_name; ?></option>
                              <?php      } ?>
                           </select>
                           <script language="JavaScript">document.teacherform.class_teacher.value="<?php echo $rows->class_teacher; ?>";</script>
                        </div>
                      </div>


                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">


                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Curreent Pic</label>
                        <div class="col-sm-4">
                           <img src="<?php echo base_url(); ?>assets/teachers/<?php echo $rows->profile_pic; ?>" class="img-circle" style="width:150px;">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Teacher  Pic</label>
                        <div class="col-sm-4">
                           <input type="file" name="teacher_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                        <label class="col-sm-2 control-label">Groups Name</label>
                        <div class="col-sm-4">
                           <select name="groups_id" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($groups as $row2) {  ?>
                              <option value="<?php echo $row2->id; ?>"><?php echo $row2->group_name; ?></option>
                              <?php      } ?>
                           </select>
                           <script language="JavaScript">document.teacherform.groups_id.value="<?php echo $rows->house_id; ?>";</script>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Extra curricular Activities</label>
                        <div class="col-sm-4">
                           <select name="activity_id[]" multiple="multiple" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
							  <?php
                                 $activity_id=$rows->extra_curicullar_id;
                                 $Query = "SELECT * FROM edu_extra_curricular";
                                 $obj=$this->db->query($Query);
                                 //print_r($objRs);
                                 $row=$obj->result();
                                 foreach ($row as $rows1)
                                 {
                                 $aid= $rows1->id;
                                 $activityname=$rows1->extra_curricular_name;
                                 $arryPlatform = explode(",", $activity_id);
                                 $sPlatform_id  = trim($aid);

                                 if (in_array($sPlatform_id, $arryPlatform )) {
                                 ?>
                              <?php
                                 echo "<option  value=\"$sPlatform_id\" selected />$activityname</option>";
                                 ?>
                              <?php }
                                 else {
                                 echo "<option value=\"$sPlatform_id\"/>$activityname</option>";
                                 }
                                     }
                                       ?>
                           </select>
                           <!-- <script language="JavaScript">document.teacherform.activity_id.value="<?php echo $rows->extra_curicullar_id; ?>";</script> -->
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                           <script language="JavaScript">document.teacherform.status.value="<?php echo $rows->status; ?>";</script>
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
                           <button type="submit" class="btn btn-info btn-fill center">Save Profile</button>
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
   $("#multiple-class").empty();
   if(stat=="success"){
   var res=data.res;
   //alert(res.length);
   var len=res.length;

   for (i = 0; i < len; i++) {

   $('<option>').val(res[i].class_sec_id).text(res[i].class_name + res[i].sec_name).appendTo('#multiple-class');
   }

   }else{
   $("#multiple-class").empty();
   }



   }
   });

   }
   var loadFile = function(event) {
   var output = document.getElementById('output');
   output.src = URL.createObjectURL(event.target.files[0]);
   };


   $(document).ready(function () {

   $('#teachermenu').addClass('collapse in');
   $('#teacher').addClass('active');
   $('#teacher2').addClass('active');
   $('#admissionform').validate({ // initialize the plugin
   rules: {

   name:{required:true }, address:{required:true },
   email:{required:true,email:true,  remote: {
                url: "<?php echo base_url(); ?>teacher/email_checker/<?php echo $rows->teacher_id; ?>",
                type: "post"
             }
           },
   sex:{required:true },
   dob:{required:true },
   age:{required:true,number:true,maxlength:2 },
   nationality:{required:true },
   "class_name[]":{required:true },
   religion:{required:true },
   community_class:{required:true },
   community:{required:true },
   status:{required:true },
   mobile:{required:true,
     remote: {
                  url: "<?php echo base_url(); ?>teacher/mobile_exist_checker/<?php echo $rows->teacher_id; ?>",
                  type: "post"
               }
              }

   },
   messages: {

   address: "Enter Address",
   admission_date: "Select Admission Date",
   name: "Enter Name",
   "class_name[]":"Select class",
   email:{
         required: "Please enter your email address.",
         email: "Please enter a valid email address.",
         remote: "Email already in use!"
   },
   sex: "Select Gender",
   dob: "Select Date of Birth",
   age: "Enter AGE",
   nationality: "Nationality",
   religion: "Enter the Religion",
   community:"Enter the Community",
   community_class:"Enter the Community Class",
   mother_tongue:"Enter The Mother tongue",
   mobile:{
     required: "Please enter your mobile Number.",
     mobile: "Please enter a valid mobile Number.",
     remote: "Mobile Number already in use!"
   },
   status:"Select Status Name"

   }
   });
   });



</script>
