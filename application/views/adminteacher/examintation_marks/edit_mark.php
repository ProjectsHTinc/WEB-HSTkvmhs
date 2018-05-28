<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Edit Exam Marks <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                     <p class="category"></p>
                  </div>
                  <div class="content table-responsive table-full-width">
                     <form method="post" action="<?php echo base_url(); ?>examinationresult/update_marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform" name="markform">
                        <?php if(!empty($mark)){ echo "<p style=color:red;text-align:center;>The Reportcard Approve to Admin So Can't Update Marks</p>";}else{ } ?>
                        <table class="table table-hover table-striped">

                           <thead>
                              <th>Sno</th>
                              <th>Name</th>
                              <?php
                                foreach($edit as $row)
                                { 
                                  foreach($result as $flag){} 
                                  $eflag=$flag->is_internal_external; 
                                }
                                if($eflag==1){ ?>
                              <th>Internal <?php echo $row->subject_name;?></th>
                              <th>External <?php echo $row->subject_name;?></th>
                              <?php }else{ ?> 
                              <th>Total Marks In <?php echo $row->subject_name;?></th>
                              <?php } ?>                 
                           </thead>

                           <tbody>
                              <?php 
                                 $i=1;
                                 foreach($edit as $row)
                                  {
                                   foreach($result as $flag){} 
                                   $eflag=$flag->is_internal_external; 
								   
								    $preferlng=$row->language; 
                                      $sub="SELECT subject_name FROM edu_subject WHERE subject_id='$preferlng'";
                                      $res1= $this->db->query($sub);
                                      $subna=$res1->result();
                                      foreach ($subna as $subname) { }
                                      $sub_name=$subname->subject_name;
									  ?>
                              <tr>
                                 <input type="hidden" name="eflag" value="<?php echo $eflag; ?>">
                                  <!-- new -->
                                 <input type="hidden" name="ttlmark" value="<?php echo $flag->subject_total;?>" class="form-control"/>
                                 <input type="hidden" name="interlimit" value="<?php echo $flag->internal_mark;?>" class="form-control"/>
                                 <input type="hidden" name="exterlimit" value="<?php echo $flag->external_mark;?>" class="form-control"/>
                                 <!-- new -->
                                 <td><?php echo $i;?></td>
                                 <td style="">
                                    <?php echo $row->name; ?> ( <?php echo $sub_name; ?> )
                                    <input type="hidden" name="examid" value="<?php echo $row->exam_id; ?>" />
                                    <input type="hidden" name="subid" value="<?php echo $row->subject_id; ?>" />
                                    <input type="hidden" name="sutid[]" value="<?php echo $row->stu_id; ?>" />
                                    <input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                    <input type="hidden" name="clsmastid" value="<?php echo $row->classmaster_id; ?>" />
                                 </td>
                                 <?php if(!empty($mark)){ 
                                    if($eflag==1){ ?>
                                 <td>
                                    <input style="width:60%;" type="text" readonly value="<?php echo $row->internal_mark; ?>" class="form-control"/>
                                 </td>
                                 <td>
                                    <input style="width:60%;" type="text" readonly value="<?php echo $row->external_mark; ?>" class="form-control"/>
                                 </td>
                                 <?php }else{?>
                                 <td>
                                    <input style="width:60%;" type="text" readonly  value="<?php echo $row->total_marks; ?>" class="form-control"/>
                                 </td>
                                 <?php }
                                    }else{
                                    if($eflag==1){?>
                                 <td>
                                    <input style="width:60%;" type="text" maxlength="3" name="internal[]" value="<?php echo $row->internal_mark; ?>" class="form-control inputBox" required />
                                 </td>
                                 <td>
                                    <input style="width:60%;" type="text" maxlength='3' name="external[]" value="<?php echo $row->external_mark; ?>" class="form-control inputBox1"  required />
                                 </td>
                                 <?php }else{?>
                                 <td>
                                    <input style="width:60%;" type="text"  name="total_marks[]" value="<?php echo $row->total_marks; ?>" class="form-control inputBox2" maxlength='3' required/>
                                 </td>
                                 <td></td>
                                 <?php }
                                    } ?>
                              </tr>
                              <?php $i++;} 
                                 if(!empty($mark)){ echo "";}else{ ?> 
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td>
                                    <div class="col-sm-10">
                                       <button type="submit" id="update" class="btn btn-info btn-fill center">Update</button>
                                    </div>
                                 </td>
                                 <td></td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#examinationmenu').addClass('collapse in');
        $('#exam').addClass('active');
        $('#exam2').addClass('active'); 
  

     /*$("[name^=internal]").each(function () {
        $(this).rules("add", {
            required: true,
            checkValue: true
        });
    });

      $("[name^=external]").each(function () {
        $(this).rules("add", {
            required: true,
            checkValue: true
        });
    });

       $("[name^=total_marks]").each(function () {
        $(this).rules("add", {
            required: true,
            checkValue: true
        });
    }); */

       
      
    <?php foreach($result as $flag){} ?>

   $(".inputBox").on("keyup keydown", function(e){
     var currentValue = String.fromCharCode(e.which);
     var finalValue = $(this).val() + currentValue;
     if(finalValue > <?php echo $flag->internal_mark; ?>){
         e.preventDefault();
     }
   });
   
   $(".inputBox1").on("keyup keydown", function(e){
     var currentValue = String.fromCharCode(e.which);
     var finalValue = $(this).val() + currentValue;
     if(finalValue > <?php echo $flag->external_mark; ?>){
         e.preventDefault();
     }
   });
   
   $(".inputBox2").on("keyup keydown", function(e){
     var currentValue = String.fromCharCode(e.which);
     var finalValue = $(this).val() + currentValue;
     if(finalValue > <?php echo $flag->subject_total; ?>){
         e.preventDefault();
     }
   });

</script>

