<div class="main-panel">

<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header"> 
                           <h4 class="title">Edit Activities</h4>
                       </div>
                       <?php foreach ($edit as  $res) { } ?>
                       <div class="content">
                           <form method="post" action="<?php echo base_url(); ?>extracurricular/update_activities" class="form-horizontal" enctype="multipart/form-data" id="feesformsection" name="feesformsection">
                                 <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Activities Name	</label>
                                          <div class="col-sm-4"> 
										                         <input type="text" name="ext_name" class="form-control"  value="<?php echo $res->extra_curricular_name; ?>">

                                              <input type="hidden" name="id" class="form-control"  value="<?php echo $res->id; ?>">

                                          </div>
                                          <label class="col-sm-2 control-label">Status</label>
                                          <div class="col-sm-4">
                      										   <select name="status" class="selectpicker form-control">
                        											  <option value="Active">Active</option>
                        											  <option value="Deactive">DeActive</option>
                      											</select>
                                            <script language="JavaScript">
                        											document.feesformsection.status.value="<?php echo $res->status; ?>";
                        										</script>
                                          </div>
                                      </div>
                                  </fieldset>
								                   <fieldset>
                                        <div class="form-group">
										                      	<label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
											                         <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Update">
                                            </div>
                                            </div>
                                   </fieldset>

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
$('#curricular').addClass('collapse in');
$('#activities').addClass('active');
$('#curricular1').addClass('active');
   $('#feesformsection').validate({ // initialize the plugin
       rules: {
           groups_name:{required:true },
  		     status:{required:true }
       },
       messages: {
             groups_name:"Please Enter Group Name",
  		       status:"select Status"
          }
   });
});
 
</script>
