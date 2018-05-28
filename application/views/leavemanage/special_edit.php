
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Edit Special Leave  </legend>

                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                            </div>

                     <?php endif; ?>
                     <?php foreach ($res as $rows) { } //print_r($res); ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>leavemanage/special_update" class="form-horizontal" enctype="multipart/form-data" id="eventform" name="specialleaveform">
                                  <fieldset  id="leaves_date">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Leave Type</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="leave_type" class="form-control " value="<?php echo $rows->leave_type; ?>" readonly=""/>
                                              <input type="hidden" name="leave_id" class="form-control " value="<?php echo $rows->leave_id; ?>" readonly=""/>
                                                <input type="hidden" name="leave_mas_id" class="form-control " value="<?php echo $rows->leave_mas_id; ?>" readonly=""/>

                                          </div>

                                      </div>
                                  </fieldset>
								                  <fieldset id="">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Classes</label>
                                          <div class="col-sm-4">
                                          <select multiple  name="class_name[]" id="multiple_class" class="selectpicker" data-menu-style="dropdown-blue">

	                                       <?php
                                      		    $sPlatform=$rows->leave_classes;
                                      			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                      			$objRs=$this->db->query($sQuery);
                                      		  //print_r($objRs);
                                      		    $row=$objRs->result();
                                      		  foreach ($row as $rows1)
                                      		  {
                                      		  $s= $rows1->class_sec_id;
                                      		  $sec=$rows1->class;
                                      		  $clas=$rows1->class_name;
                                      		  $sec_name=$rows1->sec_name;
                                      		  $arryPlatform = explode(",", $sPlatform);
                                      		 $sPlatform_id  = trim($s);
                                      		 $sPlatform_name  = trim($sec);
                                      		 if (in_array($sPlatform_id, $arryPlatform ))
											                       {
                                              echo "<option  value=\"$sPlatform_id\" selected />$clas-$sec_name</option>";
                                             }else {
                                                    echo "<option value=\"$sPlatform_id\"/>$clas-$sec_name</option>";
											                           		}
                                          }
                                        ?>

                                  </select>

                                          </div>
                                      </div>
                                  </fieldset>

                                    <fieldset  id="leaves_date">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_date" class="form-control datepicker" placeholder="Leave Date" value="<?php echo $rows->leave_date; ?>"/>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset id="leaves_name">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_name" class="form-control" value="<?php echo $rows->leaves_name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>


                                    <fieldset id="leave_status1">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Status</label>
                                            <div class="col-sm-4">
                                              <select name="leave_status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Active">Active</option>
                                                <option value="Deactive">De-Active</option>

                                              </select>
                                   <script language="JavaScript">document.specialleaveform.leave_status.value="<?php echo $rows->status; ?>";</script>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>

                                 <div id="div_name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                               <!-- <input type="button" id="more" value="Add more" /> -->
                                                   <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>

                            </div>

                        </div>  <!-- end card -->

                    </div>

</div>
</div>

<script type="text/javascript">
$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#leave1').addClass('active');
$(document).ready(function () {
 $('#eventform').validate({ // initialize the plugin
     rules: {
         leave_date:{required:true },
         leave_type:{required:true },
         leave_name:{required:true },
         leave_status:{required:true },
		 "class_name[]":{required:true }
     },
     messages: {
           leave_date: "Select Leave Date",
           leave_type: "Select Leave Type",
           leave_status: "Select Status",
           leave_name: "Enter Leave Name",
		   "class_name[]":"Select Classes"
         }
 });
});

</script>
