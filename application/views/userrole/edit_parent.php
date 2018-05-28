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
                           <h4 class="title">User Profile</h4>
                       </div>
                       <?php
                       //print_r($result);
                       foreach ($result as $rows) {

                       }
                        ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>userrolemanage/save_parents" method="post" enctype="multipart/form-data" name="save_form">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>User Name</label>
                                           <input type="text" class="form-control" readonly placeholder="" name="name" value="<?php echo $rows->user_name; ?>">
                                           <input type="hidden" class="form-control" readonly placeholder="" name="user_profile_id" value="<?php echo $rows->user_id; ?>">

                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Name</label>
                                           <input type="text" class="form-control" readonly name="name" placeholder="Enter Name" value="<?php echo $rows->name; ?>">
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Status</label>
                                           <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                             <option value="Active">Active</option>
                                             <option value="Deactive">De-Active</option>

                                           </select>
                                           <script language="JavaScript">document.save_form.status.value="<?php echo $rows->status; ?>";</script>

                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Last Login</label>
                                           <input type="text" class="form-control" readonly name="name" placeholder="Email" value="<?php echo  $new_date = date('d-m-Y - h:i', strtotime($rows->updated_date)); ?>">
                                       </div>
                                   </div>
                               </div>








                               <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                               <div class="clearfix"></div>
                           </form>
                       </div>
                   </div>
               </div>




           </div>
       </div>
   </div>
</div>
<script type="text/javascript">
$('#usermanagement').addClass('collapse in');
$('#user').addClass('active');
$('#user2').addClass('active');
</script>
