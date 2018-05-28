<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <h4 class="title">Parents Details</h4>
            </div>
            <div class="content">
               <ul role="tablist" class="nav nav-tabs">
                  <li role="presentation" class="active">
                     <a href="#agency" data-toggle="tab">New</a>
                  </li>
                  <li>
                     <a href="#company" data-toggle="tab">Existing</a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div id="agency" class="tab-pane active">
                     <?php if($this->session->flashdata('msg')): ?>
                     <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                     <div class="content">
                        <form method="post" action="<?php echo base_url(); ?>parents/create" class="form-horizontal" enctype="multipart/form-data" id="parentform" onsubmit="return validates()">
                           <div class="content">
                                <ul role="tablist" class="nav nav-tabs" style="border-bottom: none;padding-left:05px;">
                                    <li role="presentation" class="active" >
                                      <a href="#father" class="btn btn-info btn-fill" style="border-bottom-color:#976dea;" data-toggle="tab">Father</a>
                                    </li>
                                    <li>
                                      <a href="#mothers" class="btn btn-info btn-fill" style="border-bottom-color:#976dea;" data-toggle="tab">Mother</a>
                                    </li>
                                    <li>
                                     <a href="#guardian"  class="btn btn-info btn-fill"  style="border-bottom-color:#976dea;" data-toggle="tab">Guardian</a>
                                    </li>
                                </ul>
                            </div>
							<p id="erid" style="color:red;"></p>
							  <input type="hidden" name="admission_no" class="form-control"  value="<?php echo $result; ?>">
							<div class="tab-content">
					<div id="father" class="tab-pane active">
					           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Father Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fname" id="fname" placeholder="Enter Name" class="form-control" value="">
                                 </div>
                              </div>
                           </fieldset>

							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="foccupation" id="foccupation" placeholder="Occupation" class="form-control" value="">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" name="fincome" id="fincome" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="fhaddress" id="fhaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fpemail" id="fpemail"  class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                                    <p id="msg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fsemail" class="form-control " id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="fpmobile" id="fpmobile" class="form-control" onblur="fcheckmobilefun(this.value)">
									<p id="fmsg1"> </p>
                                 </div>


                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">

							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="fsmobile" class="form-control">
                                 </div>


								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" name="fhome_phone" id="fhome_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="foffice_address" id="foffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>

                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" name="foffice_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
                                    <select name="frelationship" id="frelationship" class="selectpicker form-control"  >
                                       <option value="Father">Father</option>
									</select>

                                 </div>

                                 <label class="col-sm-2 control-label">Father Pic</label>
                                    <div class="col-sm-4">
                                       <input type="file" name="father_pic" id="fpic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                                    </div>
                              </div>

                           </fieldset>

						   <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Status</label>
                                 <div class="col-sm-4">
                                    <select name="fstatus" id="fstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
                                 </div>

                               <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                    <select name="flogin" id="flogin" class="selectpicker form-control" data-title="Select Login Priority">
                                       <option value="Yes">Yes</option>
                                       <option value="No">No</option>
                                    </select>
                                 </div>
								  </div>
                           </fieldset>

                           <fieldset>
                              <div class="form-group">
							  <label class="col-sm-2 control-label"></label>
                                 <div class="col-sm-4">
                                     <img  id="output" class="img-circle" style="width:110px;">
                                 </div>
								 </div>
                           </fieldset>

			</div>
							<!-- Mother-->
                <div id="mothers" class="tab-pane">
				               <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Mother Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="mname" id="mname" placeholder="Enter Name" class="form-control" value="">
                                 </div>
                              </div>
                           </fieldset>

							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="moccupation" id="moccupation" placeholder="Occupation" class="form-control" value="">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" name="mincome" id="mincome" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="mhaddress" id="mhaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="mpemail" id="mpemail"  class="form-control" placeholder="Email Address" onkeyup="mcheckemailfun(this.value)"/>
                                    <p id="mmsg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="msemail" class="form-control " id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="mpmobile" id="mpmobile" class="form-control" onblur="mcheckmobilefun(this.value)">
									<p id="mmsg1"> </p>
                                 </div>


                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">

							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="msmobile" class="form-control">
                                 </div>


								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" name="mhome_phone" id="mhome_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="moffice_address" id="moffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>

                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" name="moffice_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
								 <select name="mrelationship" id="mrelationship" class="selectpicker form-control"  >
                                       <option value="Mother">Mother</option>
									</select>

                                 </div>

                                 <label class="col-sm-2 control-label">Mother Pic</label>
                                    <div class="col-sm-4">
                                       <input type="file" name="mother_pic" id="mpic" class="form-control" onchange="loadFile1(event)" accept="image/*" >
                                    </div>
                              </div>

                           </fieldset>

						   <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Status</label>
                                 <div class="col-sm-4">
                                    <select name="mstatus" id="mstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
                                 </div>

								  <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                    <select name="mlogin" id="mlogin" class="selectpicker form-control" data-title="Select Login Priority">
                                       <option value="Yes">Yes</option>
                                       <option value="No">No</option>
                                    </select>
                                 </div>
								  </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							  <label class="col-sm-2 control-label"></label>
                                 <div class="col-sm-4">
                                     <img  id="output1" class="img-circle" style="width:110px;">
                                 </div>
								 </div>
                           </fieldset>
				     </div>

					 <!-- Guardian -->
						<div id="guardian" class="tab-pane">

						       <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Guardian Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gname" id="gname" placeholder="Enter Name" class="form-control" value="">
                                 </div>
                              </div>
                           </fieldset>

							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="goccupation" id="goccupation" placeholder="Occupation" class="form-control" value="">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" name="gincome" id="gincome" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="ghaddress" id="ghaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gpemail" id="gpemail" class="form-control" placeholder="Email Address" onkeyup="gcheckemailfun(this.value)" />
                                    <p id="gmsg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gsemail" class="form-control " id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="gpmobile" id="gpmobile" class="form-control" onblur="gcheckmobilefun(this.value)">
									<p id="gmsg1"> </p>
                                 </div>



                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">

							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" name="gsmobile" class="form-control">
                                 </div>


								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" name="ghome_phone" id="ghome_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="goffice_address" id="goffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                 </div>

                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" name="goffice_phone" class="form-control">
                                 </div>

                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
								 <select name="grelationship" id="grelationship" class="selectpicker form-control"  >
                                       <option value="Guardian">Guardian</option>
									</select>
                                    <!-- <input type="text" placeholder="Enter Relationship" name="grelationship" class="form-control">-->
                                 </div>

                                 <label class="col-sm-2 control-label">Guardian Pic</label>
                                    <div class="col-sm-4">
                                       <input type="file" name="guardian_pic" id="gpic" class="form-control" onchange="loadFile2(event)" accept="image/*" >
                                    </div>
                              </div>

                           </fieldset>

						   <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Status</label>
                                 <div class="col-sm-4">
                                    <select name="gstatus" id="gstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
                                 </div>

								 <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                    <select name="glogin" id="glogin" class="selectpicker form-control" data-title="Select Login Priority">
                                       <option value="Yes">Yes</option>
                                       <option value="No">No</option>
                                    </select>
                                 </div>
								  </div>
                           </fieldset>

                                <fieldset>
                              <div class="form-group">
							  <label class="col-sm-2 control-label"></label>
                                 <div class="col-sm-4">
                                     <img  id="output2" class="img-circle" style="width:110px;">
                                 </div>
								 </div>
                           </fieldset>
				     </div>
				    <!-- Guardian -->
                     </div>
					 <fieldset style="background-color: rgba(237, 237, 242, 0.68);padding-top: 18px;">
                              <div class="form-group">
					 <label class="col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-4">
						 <button type="submit" id="save1" class="btn btn-info btn-fill center">Submit</button>
					  </div>
					  </div>
                    </fieldset>
					 </form>
                  </div>
				  </div>
                  <!-- Existing-->
                  <div id="company" class="tab-pane">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="content">
                                 <form method="post" action="<?php echo base_url(); ?>parents/search" class="form-horizontal" enctype="multipart/form-data" id="parentform">
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Mobile</label>
                                          <div class="col-sm-4">
                                             <input type="hidden" name="admission_no" class="form-control" placeholder=""  value="<?php echo $result; ?>">
                                             <input type="text" required name="cell" placeholder="Enter Your Mobile Number" class="form-control" onblur="checkcellfun(this.value)" value="">
                                             <p id="msg1"> </p>
                                          </div>
                                          <label class="col-sm-2 control-label">&nbsp;</label>
                                          <div class="col-sm-4">
                                             <button type="submit" id="save" class="btn btn-info btn-fill center">Search </button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div><!-- Existing -->

               </div>
            </div>

         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
function validates()
{        //alert("hi");
		var fname = document.getElementById("fname").value;
		var mname = document.getElementById("mname").value;
		var gname = document.getElementById("gname").value;

		var foccupation = document.getElementById("foccupation").value;
		var moccupation = document.getElementById("moccupation").value;
		var goccupation = document.getElementById("goccupation").value;

		var fincome = document.getElementById("fincome").value;
		var mincome = document.getElementById("mincome").value;
		var gincome = document.getElementById("gincome").value;

		var fhaddress = document.getElementById("fhaddress").value;
		var mhaddress = document.getElementById("mhaddress").value;
		var ghaddress = document.getElementById("ghaddress").value;

		var fstatus = document.getElementById("fstatus").value;
		var mstatus = document.getElementById("mstatus").value;
		var gstatus = document.getElementById("gstatus").value;

		/* var fpemail = document.getElementById("fpemail").value;
		var mpemail = document.getElementById("mpemail").value;
		var gpemail = document.getElementById("gpemail").value; */

		var fpmobile = document.getElementById("fpmobile").value;
		var mpmobile = document.getElementById("mpmobile").value;
		var gpmobile = document.getElementById("gpmobile").value;

		var frelationship = document.getElementById("frelationship").value;
		var mrelationship = document.getElementById("mrelationship").value;
		var grelationship = document.getElementById("grelationship").value;

		var flogin = document.getElementById("flogin").value;
		var mlogin = document.getElementById("mlogin").value;
		var glogin = document.getElementById("glogin").value;

	if(fname=="" && mname=="" && gname=="")
     {   //alert("Please Enter anyone Name");
		 $("#erid").html("Please Enter anyone Name");
		 //document.form.teacher.focus() ;
		 return false;
     }
	 if(foccupation=="" && moccupation=="" && goccupation=="")
     {   //alert("Please Enter Occupation");
		 $("#erid").html("Please Enter Occupation");
		 //document.form.teacher.focus() ;
		 return false;
     }
	 //if(fpemail=="" && mpemail=="" && gpemail=="")
     //{   //alert("Please Enter Email Id");
		// $("#erid").html("Please Enter Email Id");
		 //document.form.teacher.focus() ;
		 //return false;
     //}
	 if(fpmobile=="" && mpmobile=="" && gpmobile=="")
     {   //alert("Please select priority for login");
		 $("#erid").html("Please select priority for login");
		 //document.form.teacher.focus() ;
		 return false;
     }
	 if(frelationship=="" && mrelationship=="" && grelationship=="")
     {   //alert("Please select Relationship Of Students");
		 $("#erid").html("Please select Relationship Of Students");
		 //document.form.teacher.focus() ;
		 return false;
     }

	 if(fincome=="" && mincome=="" && gincome=="")
     {   //alert("Please select Relationship Of Students");
		 $("#erid").html("Please Enter Income");
		 //document.form.teacher.focus() ;
		 return false;
     }
	 if(fhaddress=="" && mhaddress=="" && ghaddress=="")
     {   //alert("Please select Relationship Of Students");
		 $("#erid").html("Please select Home Address");
		 //document.form.teacher.focus() ;
		 return false;
     }
	 if(fstatus=="" && mstatus=="" && gstatus=="")
     {   //alert("Please select Relationship Of Students");
		 $("#erid").html("Please select Status");
		 //document.form.teacher.focus() ;
		 return false;
     }

	 if(flogin=="" && mlogin=="" && glogin=="")
     {   //alert("Please select priority for login");
		 $("#erid").html("Please select priority for login");
		 //document.form.teacher.focus() ;
		 return false;
     }

}

     var loadFile = function(event)
     {
     var output = document.getElementById('output');
     output.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadFile1 = function(event)
     {
     var output1 = document.getElementById('output1');
     output1.src = URL.createObjectURL(event.target.files[0]);
   };

   var loadFile2 = function(event)
    {
     var output2 = document.getElementById('output2');
     output2.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
<script type="text/javascript">
   function checkemailfun(val)
   { //alert("hi");
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checker',
   data:'email='+val,
   success:function(test)
   {
   	if(test=="Email Id already Exist")
   	{
           $("#msg").html(test);
           $("#save1").hide();
   	}
   	else{
   		$("#msg").html(test);
        $("#save1").show();
   	}

   }
   });
   }

   function mcheckemailfun(val)
   { //alert("hi");
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checker',
   data:'email='+val,
   success:function(test)
   {
   	if(test=="Email Id already Exist")
   	{
           $("#mmsg").html(test);
           $("#save1").hide();
   	}
   	else{
   		$("#mmsg").html(test);
        $("#save1").show();
   	}

   }
   });
   }

   function gcheckemailfun(val)
   { //alert("hi");
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checker',
   data:'email='+val,
   success:function(test)
   {
   	if(test=="Email Id already Exist")
   	{
           $("#gmsg").html(test);
           $("#save1").hide();
   	}
   	else{
   		$("#gmsg").html(test);
        $("#save1").show();
   	}
   }
   });
   } //gcheckmobilefun

   function fcheckmobilefun(val)
   { //alert('hi');
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/cellchecker1',
   data:'cell='+val,
   success:function(test)
   {
	   //alert(test)
   	if(test=="Mobile Number Available")
   	{
	   $("#fmsg1").html('<span style="color:green;">Mobile Number Available</span>');
	   $("#save1").show();
   	}
   	else{
   		$("#fmsg1").html('<span style="color:red;">Mobile number already Exist</span>');
        $("#save1").hide();
		}
   }
   });
   }

   function mcheckmobilefun(val)
   { //alert('hi');
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/cellchecker1',
   data:'cell='+val,
   success:function(test)
   {
	   //alert(test)
   	if(test=="Mobile Number Available")
   	{
	   $("#mmsg1").html('<span style="color:green;">Mobile Number Available</span>');
	   $("#save1").show();
   	}
   	else{
   		$("#mmsg1").html('<span style="color:red;">Mobile number already Exist</span>');
        $("#save1").hide();
		}
   }
   });
   }

   function gcheckmobilefun(val)
   { //alert('hi');
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/cellchecker1',
   data:'cell='+val,
   success:function(test)
   {
	   //alert(test)
   	if(test=="Mobile Number Available")
   	{
	   $("#gmsg1").html('<span style="color:green;">Mobile Number Available</span>');
	   $("#save1").show();
   	}
   	else{
   		$("#gmsg1").html('<span style="color:red;">Mobile number already Exist</span>');
        $("#save1").hide();
		}
   }
   });
   }

   function checkcellfun(val)
   {
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/cellchecker',
   data:'cell='+val,
   success:function(test)
   {
   	if(test=="Mobile Number Available")
   	{
	   $("#msg1").html('<span style="color:green;">Mobile Number Available</span>');
	   $("#save").show();
   	}
   	else{
   		$("#msg1").html('<span style="color:red;">Mobile Number Not Available</span>');
        $("#save").hide();
   	}
   }
   });
   }

</script>
<script type="text/javascript">
   $(function () {
       $("#choose").change(function () {
           if ($(this).val() == "parents") {
               $("#stuparents").show();
   $("#stuguardian").hide();

           } else {
               $("#stuguardian").show();
    $("#stuparents").hide();
           }
       });
   });
</script>
