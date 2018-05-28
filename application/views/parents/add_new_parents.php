

<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <h4 class="title">Parents Details</h4>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
			<?php //print_r($relation); ?>
               <form method="post" action="<?php echo base_url(); ?>parents/create_new_parents" class="form-horizontal" enctype="multipart/form-data" id="parentform">

                  <input type="hidden" name="admission_id" id="stuid" class="form-control"  value="<?php echo $aid;?>">
				  <?php if($eid==0){
					  //print_r($alldetails);
					  foreach($alldetails as $all) {} $asid=$all->admission_id;?>
					  <input type="hidden" name="insertadmission_no" class="form-control" value="<?php echo $asid;?>">
				  <?php }else{?>
				  <input type="hidden" name="insertadmission_no" class="form-control"  value="<?php echo $eid;?>,<?php echo $aid;?>">
				  <?php }?>
                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Relationship</label>
                       <div class="col-sm-4">
                         
              <select name="relationship" class="selectpicker form-control" data-title="Select Relationship"  onchange="checkrelationfun(this.value)" />
                            <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Guardian">Guardian</option>
             </select>
             <p id="msg1" style="color:red;"> </p>
                       </div>
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" placeholder="Enter Name" class="form-control" value="">
                        </div>

                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Occupation</label>
                        <div class="col-sm-4">
                           <input type="text" name="occupation" placeholder="Occupation" class="form-control" value="">
                        </div>
                        <label class="col-sm-2 control-label">Income</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Income" name="income" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Home Address</label>
                        <div class="col-sm-4">
                           <textarea name="haddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Primary Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="pemail" id="pemail"  class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                           <p id="msg" style="color:red;"> </p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="semail" class="form-control " id="email" placeholder="Email Address" />
                        </div>
                        <label class="col-sm-2 control-label">Primary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number"  name="pmobile" maxlength="10"  class="form-control" onblur="checkcellfun(this.value)">
						   <p id="gmsg1"></p>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" pattern="[1-9]{1}[0-9]{9}" maxlength="10" name="smobile" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Home Phone</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Home Phone" name="home_phone" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Office Address</label>
                        <div class="col-sm-4">
                           <textarea name="office_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Office Phone</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Office Phone" name="office_phone" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">Picture</label>
                        <div class="col-sm-4">
                           <input type="file" name="parents_picture" id="pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                        </div>
						<label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                   <select name="priority" class="selectpicker form-control" data-title="Select Login Priority">
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
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Submit</button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var loadFile = function(event)
   {
   var output = document.getElementById('output');
   output.src = URL.createObjectURL(event.target.files[0]);
   };
   $(document).ready(function ()
   {
      $('#parentform').validate({ // initialize the plugin
      rules: {
          admission_no:{required:true, number: true },
          name:{required:true },
          occupation:{required:true },
          income:{required:true },
          haddress:{required:true},
		  //office_address:{required:true},
          //pemail:{required:true,email1:true},
          //home_phone:{required:true },
          //office_phone:{required:true },
          pmobile:{required:true },
          status:{required:true },
		  priority:{required:true },
   },
      messages: {
            admission_no: "Enter Admission No",
            name: "Enter Name",
            occupation: "Enter Occupation",
            income: "Enter Income",
            haddress: "Enter Home Address",
			//office_address: "Enter Office Address",
            //pemail: "Enter Primary Email Address",
            //home_phone: "Enter the Home Phone",
            //office_phone:"Enter the Office Phone",
            community_class:"Enter the Community Class",
            pmobile:"Enter The Primary Mobile Number",
            status:"Select Status",
			priority:"Select Priority"
          }
   });
   });
</script>
<script type="text/javascript">

function checkrelationfun(val)
   {
	   //alert('hi');
	   var sid = document.getElementById('stuid').value;
	   //alert(sid);
   $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checkrelation',
   data:'relation='+ val +'&aid='+sid,
   success:function(test)
   {
   if(test=="Email Id already Exist")
   {
   $("#msg1").html(test);
   $("#save").hide();
   }
   else{
   $("#msg1").html(test);
   $("#save").show();
   }

   }
   });
   }


   function checkemailfun(val)
   {   //alert('hi');
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checker',
   data:'email='+val,
   success:function(test)
   {
   	if(test=="Email Id already Exist")
   	{
           $("#msg").html(test);
           $("#save").hide();
   	}
   	else{
   		$("#msg").html(test);
        $("#save").show();
   	}

   }
   });
   }

   function checkcellfun(val)
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
</script>
