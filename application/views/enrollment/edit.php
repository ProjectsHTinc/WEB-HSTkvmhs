
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Edit Student Registration</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>
                     <?php foreach ($res as $rows) { } ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>enrollment/save" name="enrollform" class="form-horizontal" enctype="multipart/form-data" id="admissionform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Academic Year</label>
                                            <div class="col-sm-4">
         <?php
		    $yid=$rows->admit_year;
			$sQuery = "SELECT * FROM edu_academic_year WHERE year_id='$yid'";
			$objRs=$this->db->query($sQuery);
			$row=$objRs->result();
		   foreach ($row as $rows1)
		   { $fy=$rows1->from_month;
		     $ty=$rows1->to_month;
			 $fy=date_create($rows1->from_month);
			 $ty=date_create($rows1->to_month);
             
		   }
            ?> <input type="hidden" class="form-control" name="admit_year" value="<?php echo $yid; ?>" >
          <input type="text" class="form-control"  value="<?php echo date_format($fy,"Y"); ?>- <?php echo date_format($ty,"Y"); ?>" readonly="">
		   </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Admission No</label>
                                          <div class="col-sm-4">
                                              <input type="text" class="form-control" name="admisn_no" id="admission_no" value="<?php echo $rows->admisn_no; ?>" readonly="">
                                              <input type="hidden" class="form-control" name="enroll_id" id="admission_no" value="<?php echo $rows->enroll_id; ?>" readonly="">
											  <input type="hidden" class="form-control" name="admission_id" id="admission_no" value="<?php echo $rows->admission_id; ?>" readonly="">
                                          </div>

                                        </div>
                                    </fieldset>




                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Registration Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="admit_date" class="form-control datepicker" placeholder="Registration Date"  value="<?php $date=date_create($rows->admit_date);
echo date_format($date,"d-m-Y");  ?>" />

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Student Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="name" readonly class="form-control"  value="<?php echo $rows->name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>



                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class</label>
                                            <div class="col-sm-4">
											
											 <select  name="class_name" class="selectpicker"  data-menu-style="dropdown-blue">

	<?php
		    $sPlatform=$rows->class_id;
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
		  //print_r($objRs);
		  $row=$objRs->result();
		  foreach ($row as $rows1)
		  {
		  $s= $rows1->class_sec_id;
		 // $sec=$rows1->class;
		  $clas=$rows1->class_name;
		  $sec_name=$rows1->sec_name;
		  $arryPlatform = explode(",", $sPlatform);
		 $sPlatform_id  = trim($s);
		 $sPlatform_name  = trim($sec);
		 if (in_array($sPlatform_id, $arryPlatform )) {
  ?>
          <?php
                  echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
             ?>

                                <?php }
                                  else {
                                echo "<option value=\"$sPlatform_id\" />$clas-$sec_name &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>

                                  </select>
								  
                                                  <script language="JavaScript">document.enrollform.class.value="<?php echo $rows->class_id; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset>
									
									<fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Quota</label>
                                            <div class="col-sm-4">
											
											 <select name="quota_id" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach ($quota as $row1) {  ?>
                                                    <option value="<?php echo $row1->id; ?>"><?php echo $row1->quota_name; ?></option>
                                              <?php      } ?>
                                                  </select>
												   <script language="JavaScript">document.enrollform.quota_id.value="<?php echo $rows->quota_id; ?>";</script>
												  
                                            </div>

                                        </div>
                                    </fieldset>
									
									<fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">House Groups</label>
                                            <div class="col-sm-4">
											
											 <select name="groups_id" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach ($groups as $row2) {  ?>
                                                    <option value="<?php echo $row2->id; ?>"><?php echo $row2->group_name; ?></option>
                                              <?php      } ?>
                                                  </select>
												   <script language="JavaScript">document.enrollform.groups_id.value="<?php echo $rows->house_id; ?>";</script>
												  
                                            </div>

                                        </div>
                                    </fieldset>
									
									<fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Extra curricular Activities</label>
                                            <div class="col-sm-4">
											
											 <select multiple name="activity_id[]" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                     <?php
                                 $activity_id=$rows->extra_curicullar_id;
                                 $Query = "SELECT * FROM edu_extra_curricular";
                                 $obj=$this->db->query($Query);
                                 //print_r($objRs);
                                 $row=$obj->result();
                                 foreach ($row as $rows1)
                                 {
                                 $aid= $rows1->id;
                                 $activityname=$rows1->extra_curricular_name;
                                 $arryPlatform = explode(",", $activity_id);
                                 $sPlatform_id  = trim($aid);
                                
                                 if (in_array($sPlatform_id, $arryPlatform )) {
                                 ?>
                              <?php
                                 echo "<option  value=\"$sPlatform_id\" selected />$activityname</option>";
                                 ?>
                              <?php }
                                 else {
                                 echo "<option value=\"$sPlatform_id\"/>$activityname</option>";
                                 }
                                     }
                                       ?>

                                                  </select>
												<script language="JavaScript">document.enrollform.activity_id.value="<?php echo $rows->extra_curicullar_id; ?>";</script>  
                                            </div>

                                        </div>
                                    </fieldset>
									
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-4">
                                              <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">

                                                  <option value="Active">Active</option>
                                                    <option value="Deactive">DeActive</option>

                                              </select>
                                              <script language="JavaScript">document.enrollform.status.value="<?php echo $rows->status; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Update Registration</button>
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
$(document).ready(function () {
 jQuery('#enrollmentmenu').addClass('collapse in');
 $('#admissionform').validate({ // initialize the plugin
     rules: {
         admit_year:{required:true },
         admisn_no:{required:true },
         admit_date:{required:true },
         name:{required:true },
         admit_date:{required:true },
         class:{required:true },
         section:{required:true },
		 quota_id:{required:true },
		 groups_id:{required:true },
		 //"activity_id[]":{required:true },
		  status:{required:true }

     },
     messages: {
           admit_year: "Enter Admission Year",
           admisn_no: "Enter Admission No",
           admit_date: "Select Admission Date",
           name: "Enter Name",
            admit_date: "Select The Date",
           class: "Select Class",
           section: "Select Section",
		    quota_id: "Select Quota",
            groups_id: "Select House Groups ",
           //"activity_id[]": "Select Extra Curricular  ",
           status: "Select Status"

         }
 });
});

</script>
<script type="text/javascript">
      $().ready(function(){
 $('#enrollmentmenu').addClass('collapse in');
 $('#enroll').addClass('active');
 $('#enroll1').addClass('active');
        $('.datepicker').datetimepicker({
          format: 'DD-MM-YYYY',
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });
      });
  </script>
