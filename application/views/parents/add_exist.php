<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <h4 class="title">Edit Parents Details</h4>
            </div>
                     <?php if($this->session->flashdata('msg')): ?>
                     <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                     <div class="content">
                        <form method="post" action="<?php echo base_url(); ?>parents/update_exiting_parents" class="form-horizontal" enctype="multipart/form-data" id="parentform" name="parentform">
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
									<?php  $s=count($editres);
 									if($s==3){ }else{ foreach($editres as $prow){ $aid=$prow->admission_id;}
									?> 
									<!-- <li style="margin-left:560px;">
                                     <a href="<?php echo base_url(); ?>parents/create_new_parents_details/<?php echo $newstu;?>/<?php echo $aid;?>" class="btn btn-info btn-fill">Add More Details</a>
                                    </li> -->
									<?php } ?>
                                </ul>
								
                            </div>
							
				<div class="tab-content">
					<div id="father" class="tab-pane active">
					<input type="hidden" name="newstu" class="form-control"  value="<?php echo $newstu; ?>">
					 <?php  
						 foreach($editres as $prow){  
						  $relation1=$prow->relationship;
						    if($relation1=="Father"){
					  ?>
					    <input type="hidden" name="oldstu" class="form-control" value="<?php echo $prow->admission_id; ?>">
						 <input type="hidden" name="newstu" class="form-control" value="<?php echo $newstu; ?>">
							  <!-- <input type="text" name="admission_no" class="form-control"  value="<?php echo $prow->admission_id; ?>"> -->
							  <input type="hidden" name="morestu" class="form-control"  value="<?php echo $prow->admission_id; ?>,<?php echo $newstu; ?>">
							  
							  <input type="hidden" name="fid" class="form-control"  value="<?php echo $prow->id; ?>">
					           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Father Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fname" placeholder="Enter Name" class="form-control" value="<?php echo $prow->name; ?>">
                                 </div>
								 <label class="col-sm-2 control-label">Students Name</label>
                                 <div class="col-sm-4">
								 <?php foreach($stuname as $sname){ }?>
                                    <input type="text" name="stu_name" readonly class="form-control" value="<?php echo $prow->stuname; ?>,<?php echo $sname->name; ?>">
								 
                                 </div>
								 
                              </div>
                           </fieldset>
						   
							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="foccupation" placeholder="Occupation" class="form-control" value="<?php echo $prow->occupation; ?>">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" name="fincome" class="form-control" value="<?php echo $prow->income; ?>" >
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="fhaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->home_address; ?></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fpemail" id="txtuser" value="<?php echo $prow->email; ?>"  class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                                    <p id="msg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="fsemail" class="form-control" value="<?php echo $prow->sec_email; ?>" id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->mobile; ?>" name="fpmobile" class="form-control">
                                 </div>
								 
                                 
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->sec_mobile; ?>" name="fsmobile" class="form-control">
                                 </div>
								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" value="<?php echo $prow->home_phone; ?>" name="fhome_phone" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="foffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->office_address; ?></textarea>
                                 </div>
								 
                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" value="<?php echo $prow->office_phone; ?>" name="foffice_phone" class="form-control">
                                 </div>
                                 
                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
								 
							<input type="text" name="frelationship" value="<?php echo "Father";?>" readonly class="form-control"  > 
								  
								 <!-- <select name="frelationship" class="selectpicker form-control"  >
                                       <option value="Father">Father</option>
									</select> -->
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
                                    <select name="fstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
									<script language="JavaScript">document.parentform.fstatus.value="<?php echo $prow->status; ?>";</script>
                                 </div>
								 
								  <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                   <select name="flogin" class="selectpicker form-control">
                                       <option value="Yes">Yes</option>
									   <option value="No">No</option>
                                    </select>
				 <script language="JavaScript">document.parentform.flogin.value="<?php echo $prow->primary_flag; ?>";</script> 
                                 </div>

								 </div>
                           </fieldset>
						   <fieldset>
                              <div class="form-group">
					<label class="col-sm-2 control-label">Old Picture</label>
                                 <div class="col-sm-4">
								 <img src="<?php echo base_url(); ?>assets/parents/<?php echo $prow->user_pic; ?>" class="img-circle" style="width:110px;">
								 <input type="hidden" name="old_father_pic" class="form-control"  value="<?php echo $prow->user_pic; ?>">
                                   <img  id="output" class="img-circle" style="width:110px;">
                                 </div>
					  </div>
                    </fieldset>
					<fieldset>
                              <div class="form-group">
					 <label class="col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-4">
						 <button type="submit" id="save1" class="btn btn-info btn-fill center">Update Father</button>
					  </div>
					  </div>
                    </fieldset>
						 <?php } }?>
					</div>	 
					<!-- Mother-->
                <div id="mothers" class="tab-pane">
				<?php  
				      foreach($editres as $prow){ 
					  $relation=$prow->relationship;
					  if($relation=="Mother"){
						//echo $prow->name; ?>
				    <input type="hidden" name="oldstu" class="form-control" value="<?php echo $prow->admission_id; ?>">
						
					<!-- <input type="text" name="admission_no" class="form-control"  value="<?php echo $prow->admission_id; ?>"> -->
					 <input type="hidden" name="newstu" class="form-control" value="<?php echo $newstu; ?>">
				   <input type="hidden" name="morestu" class="form-control"  value="<?php echo $prow->admission_id; ?>,<?php echo $newstu; ?>">
						<input type="hidden" name="mid" class="form-control"  value="<?php echo $prow->id; ?>">
				               <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Mother Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="mname" placeholder="Enter Name" class="form-control" value="<?php echo $prow->name; ?>">
                                 </div>
								 <label class="col-sm-2 control-label">Students Name</label>
                                 <div class="col-sm-4">
								 <?php foreach($stuname as $sname){ }?>
                                    <input type="text" name="stu_name" readonly class="form-control" value="<?php echo $prow->stuname; ?>,<?php echo $sname->name; ?>">
								 
                                 </div>
                              </div>
                           </fieldset>
						   
							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="moccupation" placeholder="Occupation" class="form-control"value="<?php echo $prow->occupation; ?>">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" value="<?php echo $prow->income; ?>" name="mincome" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="mhaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->home_address; ?></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="mpemail" id="txtuser" value="<?php echo $prow->email; ?>" class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                                    <p id="msg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="msemail" value="<?php echo $prow->sec_email; ?>" class="form-control " id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->mobile; ?>" name="mpmobile" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							  
							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->sec_mobile; ?>" name="msmobile" class="form-control">
                                 </div>
								
								 
								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" value="<?php echo $prow->home_phone; ?>" name="mhome_phone" class="form-control">
                                 </div>
								 
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="moffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->office_address; ?></textarea>
                                 </div>
								 
                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" value="<?php echo $prow->office_phone; ?>" name="moffice_phone" class="form-control">
                                 </div>
                                 
                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
								 <select name="mrelationship" class="selectpicker form-control"  >
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
                                    <select name="mstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
									<script language="JavaScript">document.parentform.mstatus.value="<?php echo $prow->status; ?>";</script>
                                 </div>
                                 <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                   <select name="mlogin" class="selectpicker form-control">
                                       <option value="Yes">Yes</option>
									   <option value="No">No</option>
                                    </select>
				         <script language="JavaScript">document.parentform.mlogin.value="<?php echo $prow->primary_flag; ?>";</script> 
                                 </div>
							  
								 </div>
                           </fieldset>
						   <fieldset>
                              <div class="form-group">
							  
							  <label class="col-sm-2 control-label">Old Picture</label>
                                 <div class="col-sm-4">
								 <img src="<?php echo base_url(); ?>assets/parents/<?php echo $prow->user_pic; ?>" class="img-circle" style="width:110px;">
								 <input type="hidden" name="old_mother_pic" class="form-control"  value="<?php echo $prow->user_pic; ?>">
                                     <img  id="output1" class="img-circle" style="width:110px;">
                                 </div>

					  </div>
                    </fieldset>
					<fieldset>
                              <div class="form-group">
					 <label class="col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-4">
						 <button type="submit" id="save1" class="btn btn-info btn-fill center">Update Mother</button>
					  </div>
					  </div>
                    </fieldset>
							<?php } }?>
				     </div>
					 <!-- Guardian -->
						<div id="guardian" class="tab-pane">
						<?php 
						foreach($editres as $prow){  
					     $relation=$prow->relationship;
						 if($relation=="Guardian"){
								?>
								<!-- <input type="text" name="admission_no" class="form-control"  value="<?php echo $prow->admission_id; ?>"> -->
							  <input type="hidden" name="oldstu" class="form-control" value="<?php echo $prow->admission_id; ?>">
							  <input type="hidden" name="newstu" class="form-control" value="<?php echo $newstu; ?>">
							  <input type="hidden" name="morestu" class="form-control"  value="<?php echo $prow->admission_id; ?>,<?php echo $newstu; ?>">
							  
								<input type="hidden" name="gid" class="form-control"  value="<?php echo $prow->id; ?>">
						       <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Guardian Name</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gname" placeholder="Enter Name" class="form-control" value="<?php echo $prow->name; ?>">
                                 </div>
								 <label class="col-sm-2 control-label">Students Name</label>
                                 <div class="col-sm-4">
								 <?php foreach($stuname as $sname){ }?>
                                    <input type="text" name="stu_name" readonly class="form-control" value="<?php echo $prow->stuname; ?>,<?php echo $sname->name; ?>">
								 
                                 </div>
                              </div>
                           </fieldset>
						   
							   <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Occupation</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="goccupation" placeholder="Occupation" class="form-control" value="<?php echo $prow->occupation; ?>">
                                 </div>
                                 <label class="col-sm-2 control-label">Income</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Income" value="<?php echo $prow->income; ?>" name="gincome" class="form-control">
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Home Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="ghaddress" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->home_address; ?></textarea>
                                 </div>
                                 <label class="col-sm-2 control-label">Primary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gpemail" id="txtuser"  value="<?php echo $prow->email; ?>" class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
                                    <p id="msg" style="color:red;"> </p>
                                 </div>
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Secondary Email</label>
                                 <div class="col-sm-4">
                                    <input type="text" name="gsemail" value="<?php echo $prow->sec_email; ?>" class="form-control " id="email" placeholder="Email Address" />
                                 </div>
								 <label class="col-sm-2 control-label">Primary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->mobile; ?>" name="gpmobile" class="form-control">
                                 </div>
								 
                                 
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							  
							  <label class="col-sm-2 control-label">Secondary Mobile</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile Number" value="<?php echo $prow->sec_mobile; ?>" name="gsmobile" class="form-control">
                                 </div>
								
								 
								 <label class="col-sm-2 control-label">Home Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Home Phone" value="<?php echo $prow->home_phone; ?>" name="ghome_phone" class="form-control">
                                 </div>
								 
                              </div>
                           </fieldset>
                           <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Office Address</label>
                                 <div class="col-sm-4">
                                    <textarea name="goffice_address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"><?php echo $prow->office_address; ?></textarea>
                                 </div>
								 
                                  <label class="col-sm-2 control-label">Office Phone</label>
                                 <div class="col-sm-4">
                                    <input type="text" placeholder="Office Phone" value="<?php echo $prow->office_phone; ?>" name="goffice_phone" class="form-control">
                                 </div>
                                 
                              </div>
                           </fieldset>
						    <fieldset>
                              <div class="form-group">
							   <label class="col-sm-2 control-label">Relationship</label>
                                 <div class="col-sm-4">
                                    <select name="grelationship" class="selectpicker form-control"  >
                                       <option value="Guardian">Guardian</option>
									</select>
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
                                    <select name="gstatus" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                       <option value="Active">Active</option>
                                       <option value="Deactive">DeActive</option>
                                    </select>
									<script language="JavaScript">document.parentform.gstatus.value="<?php echo $prow->status; ?>";</script>
									
                                 </div>
								 <label class="col-sm-2 control-label">Login</label>
                                 <div class="col-sm-4">
                                   <select name="glogin" class="selectpicker form-control">
                                       <option value="Yes">Yes</option>
									   <option value="No">No</option>
                                    
                                    </select>
				 <script language="JavaScript">document.parentform.glogin.value="<?php echo $prow->primary_flag; ?>";</script> 
                                 </div>

							
								 </div>
                           </fieldset>
						   <fieldset>
                              <div class="form-group">
							<label class="col-sm-2 control-label">Old Picture</label>
							 <div class="col-sm-4">
							 
							 <img src="<?php echo base_url(); ?>assets/parents/<?php echo $prow->user_pic; ?>" class="img-circle" style="width:110px;">
							 <input type="hidden" name="old_guardian_pic" class="form-control"  value="<?php echo $prow->user_pic; ?>">
								 <img  id="output2" class="img-circle" style="width:110px;">
							 </div>
					       </div>
                    </fieldset>
					<fieldset>
                              <div class="form-group">
					 <label class="col-sm-2 control-label">&nbsp;</label>
					  <div class="col-sm-4">
						 <button type="submit" id="save1" class="btn btn-info btn-fill center">Update Guardian</button>
					  </div>
					  </div>
                    </fieldset>
						<?php } //else{ echo "No Details";} 
						}?>
				     </div>
                     </div>
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
   {
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/checker',
   data:'email='+val,
   success:function(test)
   {
   	if(test=="Email Id already Exit")
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
   {
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/parents/cellchecker',
   data:'cell='+val,
   success:function(test)
   {
   	if(test=="Mobile Number Available")
   	{
   	/* alert(test); */
           $("#msg1").html('<span style="color:green;">Mobile Number Available</span>');
           $("#save1").show();
   	}
   	else{
   		/* alert(test); */
   		$("#msg1").html('<span style="color:red;">Mobile Number Not Available</span>');
        $("#save1").hide();
   	}
   
   }
   });
   }
   
</script>


