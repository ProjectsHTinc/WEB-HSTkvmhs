<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Update Examination Calendar</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php
               foreach($res as $rows) {} ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>examination/update_exam_details" class="form-horizontal" enctype="multipart/form-data" name="examform" id="examform" onsubmit=return sum();>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Exam</label>
                        <div class="col-sm-4">
                           <input type="hidden" name="id" value="<?php echo $rows->exam_detail_id; ?>">
                           <input type="hidden" name="eid" value="<?php echo $rows->exam_id; ?>"> 
                            <input type="hidden" name="classmaster_id" value="<?php echo $rows->classmaster_id; ?>"> 
                           <?php 
                              $a=$rows->from_month;
                              $fyear= strtotime($a);
                              $fy=date('Y',$fyear);
                              
                              $b=$rows->to_month;
                              $tyear= strtotime($b);
                              $ty=date('Y',$tyear);
                              $c=$rows->exam_name;?>

                           <input type="text" readonly class="form-control" value="<?php echo $fy;?>-<?php echo $ty;?>(<?php echo $c;?>)">
                        </div>
                        <label class="col-sm-2 control-label">Class </label>
                        <div class="col-sm-4">
                           <select  id="multiple-class" disabled="" class="selectpicker" data-menu-style="dropdown-blue">
                           <?php
                              $sPlatform=$rows->classmaster_id;
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
                           <input type="hidden" readonly name="class_name" class="form-control" value="<?php echo $rows->classmaster_id;?>">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Select Subject</label>
                        <div class="col-sm-2">
                           <select disabled class="selectpicker"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                           <?php
                              $tea_name=$rows->subject_id;
                              $sQuery = "SELECT * FROM edu_subject";
                              $objRs=$this->db->query($sQuery);
                              $row=$objRs->result();
                              foreach ($row as $rows1)
                              {
                              $s= $rows1->subject_id;
                              $sec=$rows1->subject_name;
                              $arryPlatform = explode(",",$tea_name);
                              $sPlatform_id  = trim($s);
                              $sPlatform_name  = trim($sec);
                              if (in_array($sPlatform_id, $arryPlatform ))
                              {
                                  echo "<option  value=\"$s\" selected  /> $sec &nbsp;&nbsp; </option>";
                              }else {
                                    echo "<option value=\"$s\" />$sec &nbsp;&nbsp;</option>";
                                     }
                              } ?>
                           </select>
                           <input type="hidden" readonly name="subject_name" class="form-control" value="<?php echo $rows->subject_id;?>"> 
                        </div>
                        <div class="col-sm-2">
                           <input type="text" name="exam_date" class="form-control datepicker"  placeholder="Enter Exam Date" value="<?php $date=date_create($rows->exam_date);echo date_format($date,"d-m-Y");?>">
                        </div>
                        <label class="col-sm-2 control-label">Teacher</label>
                        <div class="col-sm-2">
                           <select name="teacher_id" class="selectpicker" data-title="Select Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                           <?php
                              $tea_name=$rows->teacher_id;
                              $sQuery = "SELECT * FROM edu_teachers ";
                              $objRs=$this->db->query($sQuery);
                              $row=$objRs->result();
                              foreach ($row as $rows1)
                              {
                              $s= $rows1->teacher_id;
                              $sec=$rows1->name;
                              $arryPlatform = explode(",",$tea_name);
                              $sPlatform_id  = trim($s);
                              $sPlatform_name  = trim($sec);
                              if (in_array($sPlatform_id, $arryPlatform ))
                              {
                                echo "<option  value=\"$s\" selected  /> $sec &nbsp;&nbsp; </option>";
                               }else {
                                  echo "<option value=\"$s\" />$sec &nbsp;&nbsp;</option>";
                                  }
                                } ?>
                           </select>
                        </div>
                        <div class="col-sm-2">
                           <select name="time" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                           </select>
                           <script language="JavaScript">document.examform.time.value="<?php echo $rows->times; ?>";</script>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Subject Total</label>
                         <div class="col-sm-2">
                            <input type="text"  name="sub_total" maxlength="3" id="sub_total" class="form-control" value="<?php echo $rows->subject_total;?>">
                         </div>
                       
                         <div class="col-sm-2">
                          <select name="inter_exter_mark" id="inter_exter_mark" required class="form-control" >
                            <option>Internal & External </option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                           <script language="JavaScript">document.examform.inter_exter_mark.value="<?php echo $rows->is_internal_external; ?>";</script>
                         </div>
                   <label class="col-sm-2 control-label">Internal & External Marks</label>
                  <div id="yes_inter_exter">
                         <div class="col-sm-2">
                            <input type="text"  name="inter_mark" id="im" maxlength="3" class="form-control" value="<?php echo $rows->internal_mark;?>">
                         </div>
                         <div class="col-sm-2">
                         <input type="text"  name="exter_mark" id="em" maxlength="3" class="form-control" value="<?php echo $rows->external_mark;?>">
                         </div>
                    </div>
                     </div>
                     </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                           <script language="JavaScript">document.examform.status.value="<?php echo $rows->status; ?>";</script>
                        </div>
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<script type="text/javascript">

  // $("#inter_exter_mark").change(function(){
  //        var a = this.value;
  //      // alert(a);
  //       if(a==1){
  //       $("#yes_inter_exter").show();
  //       $("#no_inter_exter").hide();
  //       }else{
  //        $("#no_inter_exter").show();
  //        $("#yes_inter_exter").hide();
  //       }
  // });

 $("form").submit(function(){
   var res = document.getElementById('inter_exter_mark').value;
   //alert("Submitted");alert(res);alert(txtFirstNumberValue);alert(txtSecondNumberValue);
      if(res==1){
          var txtFirstNumberValue = document.getElementById('im').value;
          var txtSecondNumberValue = document.getElementById('em').value;
          var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);

          var ttl=document.getElementById('sub_total').value;
           if(ttl==result){
           }else{
            alert("The internal and external total mark values must be equal to subject total value");
            return false;
           }
      }else{
        document.getElementById('im').value=0;
        document.getElementById('em').value=0;
      }
      
    });

 
  
   $(document).ready(function ()
   {
     $('#examform').validate({ // initialize the plugin
       rules: {
           exam_id:{required:true, number: true },
           subject_name:{required:true },
           exam_date:{required:true },
           class_name:{required:true },
           //teacher_id:{required:true }
   
    },
       messages: {
             exam_id: "Enter exam_id",
             subject_name: "Select Subject",
             exam_date: "Enter Exam Date",
             class_name: "Select Class",
            // teacher_id: "Select Teachers",
   
   
           }
   });
   });
</script>
<script type="text/javascript">
   $().ready(function(){
     $('#exammenu').addClass('collapse in');
     $('#exam').addClass('active');
     $('#exam2').addClass('active');
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

