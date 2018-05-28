<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-8">
               <div class="card">
                  <div class="header">
                     <?php if($this->session->flashdata('msg')): ?>
                     <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                     <h4 class="title">Student Edit Profile</h4>
                  </div>
                  <?php
                     // print_r($result);
                     foreach ($res as $rows) { } ?>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>studentprofile/update_stu_details" class="form-horizontal" enctype="multipart/form-data" id="admissionform" name="formadmission">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Admission Year</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="admission_year" id="admission_year" value="<?php echo $rows->admisn_year; ?>" readonly>
                              </div>
                              <label class="col-sm-2 control-label">Admission No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="admission_no" id="admission_no" value="<?php echo $rows->admisn_no; ?>" readonly>
                                 <input type="hidden" class="form-control" name="admission_id" id="admission_no" value="<?php echo $rows->admission_id; ?>" readonly>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Profile Pic</label>
                              <div class="col-sm-4">
                                 <input type="file" name="user_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                              </div>
                              <label class="col-sm-2 control-label">Admission Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="admission_date" class="form-control datepicker" readonly value="<?php echo $rows->admisn_date; ?>"  placeholder="Admission Date "/>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Email</label>
                              <div class="col-sm-4">
                                 <input type="text" name="email" class="form-control" readonly placeholder="Email Address" value="<?php echo $rows->email; ?>"/>
                              </div>
                              <label class="col-sm-2 control-label">Secondary Email</label>
                              <div class="col-sm-4">
                                 <input type="text" name="sec_email" class="form-control" readonly placeholder="Secondary Email Address" value="<?php echo $rows->sec_email; ?>" />
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="name" readonly class="form-control"  value="<?php echo $rows->name; ?>" >
                              </div>
                              <label class="col-sm-2 control-label">Gender</label>
                              <div class="col-sm-4">
                                 <input type="text" name="sex" readonly class="form-control"  value="<?php echo $rows->sex; ?>" >
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Date of birth</label>
                              <div class="col-sm-4">
                                 <input type="text" name="dob" readonly class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                              </div>
                              <label class="col-sm-2 control-label">Age</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Age" readonly name="age" class="form-control" value="<?php echo $rows->age; ?>">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Nationality</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Nationality" name="nationality" class="form-control" value="<?php echo $rows->nationality; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Religion</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Religion" name="religion" class="form-control" value="<?php echo $rows->religion; ?>">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Community Class</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Community Class" readonly  name="community_class" class="form-control" value="<?php echo $rows->community_class; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Community</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Community"  readonly name="community" class="form-control" value="<?php echo $rows->community; ?>">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Mother Tongue</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Mother Tongue" readonly name="mother_tongue" class="form-control" value="<?php echo $rows->mother_tongue; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Mobile</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Mobile Number" readonly name="mobile" class="form-control" value="<?php echo $rows->mobile; ?>">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Secondary Mobile</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Mobile Number" readonly name="sec_mobile" class="form-control" value="<?php echo $rows->sec_mobile; ?>">
                              </div>
                              <label class="col-sm-2 control-label">EMSI Number</label>
                              <div class="col-sm-4">
                                 <input type="text" name="emsi_num" readonly value="<?php echo $rows->emsi_num; ?>" class="form-control" />
                              </div>
                           </div>
                        </fieldset>
                 
                        <fieldset>
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Preferred Language</label>
                              <div class="col-sm-4">
                                 <input type="text"  readonly value="<?php echo $rows->subject_name; ?>" class="form-control" />
                              </div>
                              <label class="col-sm-2 control-label">Current  Pic</label>
                              <div class="col-sm-4">
                                 <input type="hidden" name="user_pic_old" class="form-control" value="<?php echo $rows->user_pic; ?>">
                                 <?php   $spic=$rows->user_pic; if(empty($spic)){?> 
                                 <img src="<?php echo base_url(); ?>assets/noimg.png" class="img-circle" style="width:110px;">
                                 <?php }else{?>
                                 <img class="img-circle" style="width:110px;" src="<?php echo base_url(); ?>assets/students/profile/<?php echo $spic; ?>" >
                                 <?php } ?>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-10">
                                 <button type="submit" class="btn btn-info btn-fill center">Update Profile Picture</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="card card-user">
                  <div class="image">
                     <img src="<?php echo base_url(); ?>assets/img/full-screen-image-3.jpg" alt="..."/>
                  </div>
                  <div class="content">
                     <div class="author">
                        <a href="#">
                           <img class="avatar border-gray" id="output" src="<?php echo base_url(); ?>assets/students/profile/<?php echo $rows->user_pic; ?>" alt="..."/>
                           <h4 class="title"><?php echo $rows->name;  ?><br />
                           </h4>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
   };
</script>
<script type="text/javascript">
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
   };
   
   $(document).ready(function () {
   jQuery('#admissionmenu').addClass('collapse in');
   $('#admission').addClass('active');
   $('#admission2').addClass('active');
    $('#admissionform').validate({ // initialize the plugin
        rules: {
            admission_no:{required:true, number: true },
            admission_year:{required:true },
            admission_date:{required:true },
            name:{required:true },
            email:{required:true,email:true},
            sex:{required:true },
            dob:{required:true },
            age:{required:true,number:true,maxlength:2 },
            nationality:{required:true },
            religion:{required:true },
            community_class:{required:true },
            community:{required:true },
            mother_tongue:{required:true },
            mobile:{required:true }
   
        },
        messages: {
              admission_no: "Enter Admission No",
              admission_year: "Enter Admission Year",
              admission_date: "Select Admission Date",
              name: "Enter Name",
               email: "Enter Email Address",
              sex: "Select Gender",
              dob: "Select Date of Birth",
              age: "Enter AGE",
              nationality: "Nationality",
              religion: "Enter the Religion",
              community:"Enter the Community",
              community_class:"Enter the Community Class",
              mother_tongue:"Enter The Mother tongue",
              mobile:"Enter the mobile Number",
              student_pic:"Enter the Student Picture"
            }
    });
   });
   
</script>

