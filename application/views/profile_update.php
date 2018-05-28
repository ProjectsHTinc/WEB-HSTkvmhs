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
                       foreach ($result as $rows) {

                       }
                        ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>adminlogin/profileupdate" method="post" id="profileedit" enctype="multipart/form-data">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>User Name</label>
                          <input type="text" class="form-control" readonly placeholder="" name="name" value="<?php echo $rows->user_name; ?>">
                          <input type="hidden" class="form-control" readonly placeholder="" name="user_id" value="<?php echo $rows->user_id; ?>">
                          <input type="hidden" class="form-control" readonly placeholder="" name="user_pic_old" value="<?php echo $rows->user_pic; ?>">
                          <input type="hidden" class="form-control" readonly placeholder="" name="user_password_old" value="<?php echo $rows->user_password; ?>">
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Name</label>
                                           <input type="text" class="form-control" name="sname" placeholder="" value="<?php echo $rows->name; ?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                         <label>Profile Pic</label>
                                         <input type="file" class="form-control" placeholder="" value="" name="profile" onchange="loadFile(event)" accept="image/*" >
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                   </div>
                               </div>






                               <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
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
                               <img class="avatar border-gray" id="output" src="<?php echo base_url(); ?>assets/admin/profile/<?php echo $rows->user_pic; ?>" alt="..."/>

                                 <h4 class="title"><?php echo $rows->name;  ?><br />
                                    <small><?php echo $rows->user_name;  ?></small>
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



  var elmt = document.getElementById('sname');

  elmt.addEventListener('keydown', function (event) {
      if (elmt.value.length === 0 && event.which === 32) {
          event.preventDefault();
      }
  });

$('#profileedit').validate({ // initialize the plugin
    rules: {
        sname:{required:true,noSpace: true },


    },
    messages: {


          sname: "Please Enter  Name"


        }
});
</script>
