

<style>
   .formdesign
   {
   padding-bottom: 48px;
   padding-top: 10px;
   border-radius: 12px;
   }
</style>
<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <div class="fresh-datatables">
                           <h4 class="title" style="padding-bottom:10px;">List of Admission</h4>
                           <form method="post" action="<?php echo base_url(); ?>admission/view" class="form-horizontal formdesign" enctype="multipart/form-data" name="myformsection">
                              <div class="col-sm-2">
                                 <select name="gender" style="margin-top:30px;"  class="selectpicker">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                 </select>
                              </div>
                              <div class="col-sm-10">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Search</button>
                              </div>
                           </form>
                           <div class="toolbar">
                              <!--        Here you can write extra buttons/actions for the toolbar              -->
                           </div>
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                              <thead>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Admission No</th>
                                 <th>Parents Name</th>
                                 <th>Blood Group</th>
                                 <th>Gender</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    if(!empty($gender))
                                    {
                                    foreach ($gender as $rows)
                                    {$stu=$rows->status; $pname=$rows->parentsname;?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->admisn_no; ?></td>
                                    <td><?php echo $pname; ?></td>
                                    <td><?php echo $rows->blood_group_name; ?></td>
                                    <td><?php echo $rows->sex; ?></td>
                                    <td><?php
                                       if($stu=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                          ?>
                                    </td>
                                    <td>
                                       <?php
                                          $enrollment_status=$rows->enrollment;
                                          if($enrollment_status==0)
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>enrollment/add_enrollment/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Registration" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                          <i class="fa fa-address-book" aria-hidden="true"></i>
                                          <!--  <i class="fa fa-address-card-o" aria-hidden="true"></i> -->
                                       </a>
                                       <?php
                                          }
                                          else{
                                             ?>
                                       <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Registration Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                       <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                       </a>
                                       <?php
                                          }
                                          ?>
                                       <?php
                                          $parent_status=$rows->parents_status;
                                          if($parent_status==0)
                                          {
                                             ?>
                                       <a href="<?php echo base_url(); ?>parents/home/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Parent" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          else
                                          {
                                             // echo base_url(); parents/edit_parent/ echo $rows->parnt_guardn_id;
                                          ?>
                                       <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Parent Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          ?>
                                       <a href="<?php echo base_url(); ?>admission/get_ad_id/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php  $i++;  }
                                    }else{
                                       //echo'<pre>';print_r($result);exit;
                                    foreach ($result as $rows)
                                     { 
                                       $stu=$rows->status;
                                       $pname=$rows->parentsname;
                                      ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->admisn_no; ?></td>
                                    <td><?php echo $pname; ?></td>
                                    <td><?php echo $rows->blood_group_name; ?></td>
                                    <td><?php echo $rows->sex; ?></td>
                                    <td><?php
                                       if($stu=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                          ?>
                                    </td>
                                    <td>
                                       <?php
                                          $enrollment_status=$rows->enrollment;
                                          if($enrollment_status==0)
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>enrollment/add_enrollment/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Registration" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                          <i class="fa fa-address-book" aria-hidden="true"></i>
                                          <!--  <i class="fa fa-address-card-o" aria-hidden="true"></i> -->
                                       </a>
                                       <?php
                                          }
                                          else{
                                             ?>
                                       <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Registration Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                       <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                       </a>
                                       <?php
                                          }
                                          ?>
                                       <?php
                                          $parent_status=$rows->parents_status;
                                          if($parent_status==0)
                                          {
                                             ?>
                                       <a href="<?php echo base_url(); ?>parents/home/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Parent" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          else
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Parent Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          ?>
                                       <a href="<?php echo base_url(); ?>admission/get_ad_id/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  }  }?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->
               </div>
               <!-- end col-md-12 -->
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
      jQuery('#admissionmenu').addClass('collapse in');
   $('#admission').addClass('active');
   $('#admission2').addClass('active');
         $('#example').DataTable({
            dom: 'lBfrtip',
            buttons: [
                 {
                     extend: 'excelHtml5',
                     exportOptions: {
                     columns: ':visible'
                     }
                 },
                 {
                     extend: 'pdfHtml5',
                     exportOptions: {
                     columns: ':visible'
                     }
                 },
                 'colvis'
             ],
             "pagingType": "full_numbers",
             "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
             responsive: true,
             language: {
             search: "_INPUT_",
             searchPlaceholder: "Search records",
             }
         });
      });
   
       
</script>

