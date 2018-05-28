<style>
    td{text-align:center;}
</style>
<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

<div class="col-md-6">
  <?php  if($status=="success"){ ?>
                   <div class="card">
                       <div class="header">
                           List Of Student in class
                       </div>
                       <?php

                        if(empty($res)){   ?>
                           <p class="text-center" style="margin-top:20px;">No Record Found</p> <style>#submit{display: none;}</style>
                      <?php     }else{ ?>

                     <div class="fresh-datatables">
                         <form action="" method="post" enctype="multipart/form-data" id="takeattendence">
                           <table class="table table-striped">
                               <thead>
                                   <tr>
                                       <th class="text-center">#</th>
                                       <th class="text-center">Name</th>
                                       <th class="text-center">Present  / Absent</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 <?php  $i=1;
                                 foreach($res as $rows){
                                    ?>
                                   <tr>
                                       <td class="text-center"><?php echo $i;  ?></td>
                                       <input type="hidden" name="student_count" value="<?php echo count($res); ?>">
         <td class="text-center"><?php echo $rows->name;  ?>
         <input type="hidden" name="student_id[]" value="<?php echo $rows->enroll_id; ?>">
         <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id=$this->session->userdata('user_id'); ?>">

                                       </td>
                                       <td><select name="attendence_val[]">
                                         <option value="P,<?php echo $rows->enroll_id; ?>,<?php
 $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
 echo $dateTime->format("A");
 ?>">Present</option>
                                        <option value="A,<?php echo $rows->enroll_id; ?>,<?php
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo $dateTime->format("A");
?>">Absent</option>
                                        <option value="L,<?php echo $rows->enroll_id; ?>,<?php
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo $dateTime->format("A");
?>">Leave</option>
                                        <option value="OD,<?php echo $rows->enroll_id; ?>,<?php
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo $dateTime->format("A");
?>">On-Duty</option>
                                       </select>
                                       </td>
                                        <!-- <td class="text-center">
                                           <div class="switch"
                                                data-on-label=""
                                                data-off-label="">
                                                <input type="checkbox" name="attendence_val[]" value="A,<?php echo $rows->enroll_id; ?>,<?php
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo $dateTime->format("A");
?>"/>
                                           </div>
                                       </td> -->
                                   </tr>

                            <?php
                            $i++; } }

                            ?>

                               </tbody>

                           </table>
                          <button type="button"   class="btn btn-warning btn-fill btn-wd pull-right"  id="submit" style="margin-top:20px;" onclick="submitAttendence()">
                        Submit Attendance  </button>
                         </form>

                       </div>
                   </div>
                   <?php  } else{  ?>
                     <div class="card-header" data-background-color="purple">
	                        <h4 class="title">Sorry</h4>
	                        <p class="category"><?php echo $status; ?> </p>
	                    </div>

                  <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                  <?php  } ?>
               </div>

               </div>
            </div>
        </div>
     </div>


<script type="text/javascript">
$('#attendmenu').addClass('collapse in');
$('#atten').addClass('active');
$('#atten1').addClass('active');

function submitAttendence(){
        swal({
                      title: "Are you sure?",
                      text: "You Want Confirm this form",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Yes, I am sure!',
                      cancelButtonText: "No, cancel it!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
       $.ajax({
           url: "<?php echo base_url(); ?>teacherattendence/take_attendence",
            type:'POST',
           data: $('#takeattendence').serialize(),
           success: function(response) {
             //alert(response);
               if(response=="success"){
                //  swal("Success!", "Thanks for Your Note!", "success");
                  $('#takeattendence')[0].reset();
                  swal({
           title: "Attendance Done!",
           text: "Thank You!",
           type: "success"
       }, function() {
           window.location = "<?php echo base_url(); ?>teacherattendence/view";
       });
               }else{
                 sweetAlert("Oops...", response, "error");
               }
           }
       });
     }else{
         swal("Cancelled", "Process Cancel :)", "error");
     }
   });


}
</script>
