<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Subject</h4>
                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                   </div>

             <?php endif; ?>
                       </div>
                       <?php
                       foreach($datas as $rows){}

                          ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>subjectadd/save_subject" method="post" enctype="multipart/form-data" id="myformsub" name="myformsub">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Name</label>
                                           <input type="text" class="form-control"  placeholder="" name="subjectname" id="subjectname" value="<?php  echo $rows->subject_name; ?>">
                                           <input type="hidden" class="form-control"  placeholder="" name="subject_id" value="<?php  echo $rows->subject_id; ?>">

                                       </div>
                                   </div>
								                           <div class="col-md-5">
                                             <div class="form-group">
                                                 <label>Status</label>
                                                <select name="status" class="selectpicker form-control">
                        												  <option value="Active">Active</option>
                        												  <option value="Deactive">DeActive</option>
                        												</select>
                        											<script language="JavaScript">document.myformsub.status.value="<?php echo $rows->status; ?>";</script>
                                             </div>
                                           </div>
                                   <div class="col-md-2"></div>
                                 </div>
                                 <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                         <label><input type="checkbox" name="is_preferred_lang" value="1" style="margin-right:10px;" <?php if ($rows->is_preferred_lang == 1) echo 'checked'; ?> >Set as Preferred Language</label>
                                         </div>
                                    </div>
                                  </div>

                           <button type="submit" class="btn btn-info btn-fill pull-left">Update</button>
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

$(document).ready(function () {
  $('#mastersmenu').addClass('collapse in');
  $('#master').addClass('active');
  $('#masters4').addClass('active');



  $('#myformsub').validate({ // initialize the plugin
      rules: {


          subjectname:{required:true },


      },
      messages: {


            subjectname: "Please Enter Subject Name"


          }
  });
 });





</script>
