<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Change Password</h4>
                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                   </div>

             <?php endif; ?>
                       </div>
                       <?php
                       //print_r($result);
                       foreach ($result as $rows) {

                       }
                        ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>studentprofile/changepwd" method="post" enctype="multipart/form-data" id="myformpass">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Name</label>
                <input type="text" class="form-control" readonly placeholder="" name="name" value="<?php echo $rows->name; ?>">
                <input type="hidden" class="form-control" readonly placeholder="" name="user_id" value="<?php echo $rows->user_id; ?>">
                <input type="hidden" class="form-control" readonly placeholder="" name="user_pic_old" value="<?php echo $rows->user_pic; ?>">
                <input type="hidden" class="form-control" readonly placeholder="" name="user_password_old" value="<?php echo $rows->user_password; ?>">
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1">User Name</label>
                                           <input type="email" class="form-control" disabled placeholder="Email" value="<?php echo $rows->user_name; ?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Old Password</label>
                                           <input type="password" class="form-control" name="oldpassword" placeholder="Current Password" value="">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                     <!-- <label>Profile Pic</label>
                                     <input type="file" class="form-control" placeholder="" value="" name="profile" onchange="loadFile(event)" accept="image/*" > -->
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>New Password</label>
                                           <input type="password" class="form-control"  name="newpassword" id="newpassword" placeholder="New Password" value="">
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Re-type Password</label>
                                           <input type="password" class="form-control" name="retypepassword" placeholder="Re-type Password" value="">
                                       </div>
                                   </div>
                               </div>





                               <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                               <div class="clearfix"></div>
                           </form>
                       </div>
                   </div>
               </div>
               <div class="col-md-4">
                   <!-- <div class="card card-user">
                       <div class="image">
                           <img src="<?php echo base_url(); ?>assets/img/full-screen-image-3.jpg" alt="..."/>
                       </div>
                       <div class="content">
                           <div class="author">
                                <a href="#">
                                  <img class="avatar border-gray" id="output" src="<?php echo base_url(); ?>assets/admin/profile/<?php echo $rows->user_pic; ?>" alt="..."/>

                               <h4 class="title"><?php echo $rows->name;  ?><br />
                                  <small><?php echo $rows->user_name;  ?></small>
                                 </h4>
                               </a>
                           </div>

                       </div>


                   </div> -->
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
$(document).ready(function () {

 $('#myformpass').validate({ // initialize the plugin
     rules: {


         oldpassword:{required:true },
         newpassword:{required:true  },
         retypepassword:{required:true, equalTo: "#newpassword", },

     },
     messages: {


           oldpassword: "Please Enter Old Password",
           newpassword: "Please Enter New Password",
           retypepassword: "Please Enter Confirm Password Should Same as New",

         }
 });
});
</script>
