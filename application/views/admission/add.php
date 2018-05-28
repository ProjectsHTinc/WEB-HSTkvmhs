<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Admission</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>admission/create" class="form-horizontal" enctype="multipart/form-data" id="admissionform">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Admission Year</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_year"  class="form-control datepicker1" placeholder="Select Admission Year"/>
                        </div>
                        <label class="col-sm-2 control-label">Admission No</label>
                        <div class="col-sm-4">
                           <input type="text" class="form-control" onkeyup="checkemailfun1(this.value)" name="admission_no" id="admission_no">
                           <p id="no" style="color:red;"></p>
                           <p id="no1" style="color:green;"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Admission Date</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_date" class="form-control datepicker" placeholder="Admission Date "/>
                        </div>
                        <label class="col-sm-2 control-label">EMSI Number</label>
                        <div class="col-sm-4">
                           <input type="text" name="emsi_num" class="form-control" placeholder="Enter EMSI Number "/>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email"  class="form-control"  onkeyup="checkemailfun(this.value)" id="email" placeholder="Email Address" />
                           <p id="msg" style="color:red;"></p>
                           <p id="msg1" style="color:green;"></p>
                        </div>
                        <label class="col-sm-2 control-label">Secondary-Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_email" class="form-control " id="sec_email" placeholder="Secondary Email Address" />
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" value="">
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
                           <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth "/>
                        </div>
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" name="nationality" class="form-control">
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
                        <label class="col-sm-2 control-label">Mother Tongue</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mother Tongue" name="mother_tongue" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Language Proposed</label>
                        <div class="col-sm-4">
                           <select name="lang" class="selectpicker" data-title="Language Proposed" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($lang as $res){ ?>
                              <option value="<?php echo $res->subject_id;?>"><?php echo $res->subject_name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" onblur="checkmobilefun(this.value)">
                           <p id="cellmsg1"></p>
                        </div>
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="sec_mobile" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Student Picture</label>
                        <div class="col-sm-4">
                           <input type="file" name="student_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                        <label class="col-sm-2 control-label">Blood Group</label>
                        <div class="col-sm-4">
                           <select name="blood_group" class="selectpicker" data-title="Select Blood Group" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($blood as $rows){ ?>
                              <option value="<?php echo $rows->id;?>"><?php echo $rows->blood_group_name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                       
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">School Studied</label>
                        <div class="col-sm-10">
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="text" name="sch_name" placeholder="Previous School" class="form-control">
                              </div>
                              <div class="col-md-4">
                                 <select name="class_name" class="selectpicker" data-title="Pass Out From" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php foreach ($class as $clas) {  ?>
                                    <option value="<?php  echo $clas->class_id; ?>"><?php  echo $clas->class_name; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="col-md-4">
                                 <select name="qual" class="selectpicker" data-title="Qualified for promotion" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Certificates</label>
                        <div class="col-sm-4">
                           <label class="checkbox checkbox-inline">
                           <input type="checkbox" data-toggle="checkbox" name="trn_cert" value="1">Transfer Certificate
                           </label>
                           <label class="checkbox checkbox-inline">
                           <input type="checkbox" data-toggle="checkbox" name="rec_sheet" value="1">Record Sheet
                           </label>
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                        </div>
                        <div class="col-sm-4">
                           <img  id="output" class="img-circle" style="width:100px;">
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
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
   };
   
   $(document).ready(function () {
   
   jQuery('#admissionmenu').addClass('collapse in');
   $('#admission').addClass('active');
   $('#admission1').addClass('active');
   
      $('#admissionform').validate({ // initialize the plugin
        rules: {
            admission_no:{required:true, number: true,  // will count space
               maxlength: 9 },
            admission_year:{required:true },
            admission_date:{required:true },
            name:{required:true },
            //email:{required:true,email:true},
           sex:{required:true },
            dob:{required:true },
            emsi_num:{required:true },
            age:{required:true,number:true,maxlength:2 },
            nationality:{required:true },
            religion:{required:true },
            community_class:{required:true },
            community:{required:true },
            blood_group:{required:true },
            //mobile:{required:true },
            //student_pic:{required:true }
        },
        messages: {
              admission_no: "Enter the Admission Number max length 9 Digits",
             //  minlength:"Enter the Number 6 to 9 Digits",
              admission_year: "Enter Admission Year",
              admission_date: "Select Admission Date",
              name: "Enter Name",
               //email: "Enter Email Address",
              //sec_email:"Enter Email Address",
              remote: "Email already in use!",
              sex: "Select Gender",
              dob: "Select Date of Birth",
              emsi_num:"Enter EMSI Number",
              age: "Enter AGE",
              nationality: "Nationality",
              religion: "Enter the Religion",
              community:"Enter the Community",
              community_class:"Enter the Community Class",
              blood_group:"Select Blood Group",
              //mobile:"Enter the mobile Number",
             // student_pic:"Enter the Student Picture"
            }
   
    }); 
   });
   
</script>
<script type="text/javascript">
   function checkemailfun1(val)
     {
        $.ajax({
      type:'post',
      url:'<?php echo base_url(); ?>/admission/checker1',
      data:'admission_no='+val,
      success:function(test1)
      {
        if(test1=="Admission No already Exit")
        {
        /* alert(test); */
              $("#no").html(test1);
          $("#no1").html(test1).hide();
              $("#save").hide();
        }
        else{
          /* alert(test); */
          $("#no1").html(test1);
   
              $("#save").show();
        }
   
      }
     });
   }
   
   function checkmobilefun(val)
     { //alert('hi');exit;
        $.ajax({
     type:'post',
     url:'<?php echo base_url(); ?>/admission/cellchecker',
     data:'cell='+val,
     success:function(test)
     {
      //alert(test)
      if(test=="Mobile Number Available")
      {
      $("#cellmsg1").html('<span style="color:green;">Mobile Number Available</span>');
      $("#save").show();
      }
      else{
        $("#cellmsg1").html('<span style="color:red;">Mobile number already Exist</span>');
          $("#save").hide();
    }
     }
     });
     }
     
</script>
<script type="text/javascript">
   $().ready(function(){
   
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
   
   $('.datepicker1').datetimepicker({
       format: 'YYYY',
   maxDate: new Date(),
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
<script type="text/javascript">
   function checkemailfun(val)
   {
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/admission/checker',
   data:'email='+val,
   success:function(test)
   {
    if(test=="Email Id already Exit")
    {
    /* alert(test); */
           $("#msg").html(test);
      $("#msg1").html(test).hide();
           $("#save").hide();
    }
    else{
      /* alert(test); */
      $("#msg1").html(test);
      $("#msg").html(test).hide();
           $("#save").show();
    }
   
   }
   });
   }
   
</script>

