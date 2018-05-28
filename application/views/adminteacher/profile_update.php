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
                     <h4 class="title">Edit Profile</h4>
                  </div>
                  <?php
                     // print_r($result);
                      foreach ($result as $rows) { }
                       ?>
                  <div class="content">
                     <form action="<?php echo base_url(); ?>teacherprofile/profileupdate" method="post" enctype="multipart/form-data" name="teacherform">
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Profile Pic</label>
                                 <input type="file" name="user_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                                 <input type="hidden" class="form-control" readonly placeholder="" name="user_id" value="<?php echo $rows->teacher_id; ?>">
                                 <input type="hidden" class="form-control" readonly placeholder="" name="user_pic_old" value="<?php echo $rows->user_pic; ?>">
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Name</label>
                                 <input type="text" class="form-control" name="name" readonly placeholder="Email" value="<?php echo $rows->name; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Gender</label>
                                 <input type="text" readonly name="sex" class="form-control" value="<?php echo $rows->sex; ?>">
                                
                                 <script language="JavaScript">document.teacherform.sex.value="<?php echo $rows->sex; ?>";</script>
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Mobile</label>
                                 <input type="text" placeholder="Mobile Number" readonly name="mobile" class="form-control" value="<?php echo $rows->phone; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Date of birth</label>
                                 <input type="text" name="dob" id="dob" class="form-control datepicker" readonly placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Nationality</label>
                                 <input type="text" placeholder="Nationality" readonly name="nationality" class="form-control"  value="<?php echo $rows->nationality; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Age</label>
                                 <input type="text" placeholder="Age" name="age" id="age" readonly class="form-control"  value="<?php echo $rows->age; ?>">
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Religion</label>
                                 <input type="text" placeholder="Religion" readonly name="religion" class="form-control"  value="<?php echo $rows->religion; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Community Class</label>
                                 <input type="text" placeholder="Community Class" readonly name="community_class" class="form-control"  value="<?php echo $rows->community_class; ?>">
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Community</label>
                                 <input type="text" placeholder="Community" name="community" readonly class="form-control" value="<?php echo $rows->community; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Secondary Email</label>
                                 <input type="text" name="sec_email" placeholder="Email Address" readonly class="form-control" value="<?php echo $rows->sec_email;?>">
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1"> Secondary Mobile</label>
                                 <input type="text" name="sec_phone" readonly value="<?php echo $rows->sec_phone;?> " class="form-control" placeholder="Mobile Number" />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea name="address" class="form-control" readonly rows="4" cols="80"><?php echo $rows->address; ?></textarea>
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Subject</label>
                                 <?php
                                    $tea_name=$rows->subject;
                                       $sQuery = "SELECT * FROM edu_subject WHERE subject_id='$tea_name'";
                                       $objRs=$this->db->query($sQuery);
                                       $row=$objRs->result();
                                       foreach ($row as $rows1)
                                    {
                                      $sub=$rows1->subject_name;
                                    }
                                    ?>
                                 <input type="text" readonly name="subject"  class="form-control" value="<?php echo $sub; ?>">
                                 <label for="exampleInputEmail1"> Email</label>
                                 <input type="text" name="email" disabled class="form-control " id="email" placeholder="Email Address" onblur="checkMailStatus()"  value="<?php echo $rows->email; ?>"/>
                              </div>
                           </div>
                        </div>
						
						<div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Qualification</label>
                                 <input type="text" readonly value="<?php echo $rows->qualification; ?>" name="qualification" class="form-control">
                         
                              </div>
                           </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile Picture</button>
                        <div class="clearfix"></div>
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
                           <img class="avatar border-gray" id="output" src="<?php echo base_url(); ?>assets/teachers/profile/<?php echo $rows->user_pic; ?>" alt="..."/>
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

