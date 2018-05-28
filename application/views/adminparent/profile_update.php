

<style>
   input[type=text] {
   border: none;
   border-bottom: 1px solid grey;
   }
</style>
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
                        ×</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                     <h4 class="title">Parents Edit Profile</h4>
                  </div>
                  <?php
                     foreach ($result as $rows) { }
                      ?>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>parentprofile/update_parents" class="form-horizontal" enctype="multipart/form-data" id="parentform" name="parentform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Profile Pic</label>
                              <div class="col-sm-4">
                                 <input type="file" name="user_pic" class="form-control" onchange="loadFile(event)" accept="image/*">
                                 <input type="hidden" class="form-control"  name="user_pic_old" value="<?php echo $rows->user_pic; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Student Name</label>
                              <div class="col-sm-4">
                                 <select multiple name="student[]" class="selectpicker form-control">
                                 <?php
                                    $tea_name=$rows->   admission_id;
                                    $sQuery = "SELECT * FROM edu_admission";
                                    $objRs=$this->db->query($sQuery);
                                    $row=$objRs->result();
                                    foreach ($row as $rows1)
                                    {
                                    $s= $rows1->admission_id;
                                    $sec=$rows1->name;
                                    $arryPlatform = explode(",",$tea_name);
                                    $sPlatform_id  = trim($s);
                                    $sPlatform_name  = trim($sec);
                                    if (in_array($sPlatform_id, $arryPlatform ))
                                    {
                                                 echo "<option  value=\"$s\"selected/> $sec</option>";
                                            }
                                      }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Name</label>
                              <div class="col-sm-4">
                                 <input type="hidden" class="form-control" name="parent_id" value="<?php echo $rows->id; ?>">
                                 <input type="text" name="name" placeholder="Enter Name"  class="form-control" value="<?php echo $rows->name; ?>">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Occupation</label>
                              <div class="col-sm-4">
                                 <input type="text" name="occupation" placeholder="Occupation"  class="form-control" value="<?php echo $rows->occupation; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Income</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Income" name="income"  value="<?php echo $rows->income; ?>" class="form-control">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Home Address</label>
                              <div class="col-sm-4">
                                 <textarea name="haddress"  MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80">
                                 <?php echo $rows-> home_address; ?>
                                 </textarea>
                              </div>
                              <label class="col-sm-2 control-label">Primary Email</label>
                              <div class="col-sm-4">
                                 <input type="text" name="pemail" id="pemail"  value="<?php echo $rows->email; ?>" class="form-control" placeholder="Email Address" />
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Secondary Email</label>
                              <div class="col-sm-4">
                                 <input type="text" name="semail" class="form-control"  value="<?php echo $rows->sec_email; ?>" id="email" placeholder="Email Address" />
                              </div>
                              <label class="col-sm-2 control-label">Primary Mobile</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Mobile Number"  name="pmobile" maxlength="12" value="<?php echo $rows->mobile; ?>" class="form-control">
                                 <p id="gmsg1"></p>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Secondary Mobile</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Mobile Number"  maxlength="10" value="<?php echo $rows->sec_mobile; ?>" name="smobile" class="form-control">
                              </div>
                              <label class="col-sm-2 control-label">Home Phone</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Home Phone"  value="<?php echo $rows->home_phone; ?>" name="home_phone" class="form-control">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Office Address</label>
                              <div class="col-sm-4">
                                 <textarea name="office_address"  MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80">
                                 <?php echo $rows->office_address   ; ?>
                                 </textarea>
                              </div>
                              <label class="col-sm-2 control-label">Office Phone</label>
                              <div class="col-sm-4">
                                 <input type="text" placeholder="Office Phone"  value="<?php echo $rows->office_phone; ?>" name="office_phone" class="form-control">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Relationship</label>
                              <div class="col-sm-4">
                                 <input type="text" name="relationship"  class="form-control" value="<?php echo $rows->relationship; ?>">
                              </div>
                              <label class="col-sm-2 control-label">Picture</label>
                              <div class="col-sm-4">
                            <input type="hidden" name="old_pic"  class="form-control" value="<?php echo $rows->profile_pic; ?>">
                                 <img src="<?php echo base_url(); ?>assets/parents/<?php echo $rows->user_pic; ?>" class="img-circle" style="width:110px;">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-4">
                                 <img id="output" class="img-circle" style="width:110px;">
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Update Profile Picture</button>
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
                     <img src="<?php echo base_url(); ?>assets/img/full-screen-image-3.jpg" alt="..." />
                  </div>
                  <div class="content">
                     <div class="author">
                        <a href="#">
                            <?php if(empty($rows->profile_pic)){ ?>
                            <img class="avatar border-gray" src="http://localhost/ensyfi/assets/noimg.png">
                           <?php  }else{ ?>
                        <img class="avatar border-gray" id="output23" src="<?php echo base_url(); ?>assets/parents/profile/<?php echo $rows->profile_pic; ?>" alt="..."/>
                         <?php } ?>
                        </a>
                        <h4 class="title" style="line-height:100px;"><?php echo $rows->name; ?></h4>
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
       var output = document.getElementById('output23');
       output.src = URL.createObjectURL(event.target.files[0]);
   };
   
   function validates() {
       //alert("hi");
       var fname = document.getElementById("father_name").value;
       var mname = document.getElementById("mother_name").value;
       var gname = document.getElementById("guardn_name").value;
       //alert(fname);alert(gname);
       if (fname == "" && gname == "") {
           $("#erid").html("Please Enter Parents Details Or Guardain Details");
           document.formadmission.father_name.focus();
           return false;
       }
       document.getElementById("parentform").submit();
   
   }
   
   $(function() {
       $("#choose").change(function() {
           if ($(this).val() == "parents") {
               $("#stuparents").show();
               $("#stuguardian").hide();
               $("#msg").hide();
               $("#msg1").hide();
   
           } else {
               $("#stuguardian").show();
               $("#stuparents").hide();
               $("#msg").hide();
               $("#msg1").hide();
   
           }
       });
   });
</script>

