<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

                        <div class="card">
                            <div class="header">Class for Timetable</div>
                            <div class="content">
                                <div class="row">
                              <?php
                                foreach($res as $rows){


                                ?>
                                <div class="col-md-2">
                                  <a href="<?php echo  base_url(); ?>teachertimetable/view/<?php echo base64_encode($rows->class_master_id); ?>" class="btn btn-wd"><?php echo $rows->class_name.'-'.$rows->sec_name; ?></a>
                                 </div>

                               <!-- <div class="col-md-2">
                                 <!-- <a href="<?php echo  base_url(); ?>teachertimetable/view/<?php  echo $class_id[$i]; ?>" class="btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a></div> -->



                              <?php } ?>
                              <!-- </div>  -->
                            </div>
                        </div> <!-- end card -->

          </div>
       </div>
   </div>
</div>

<script type="text/javascript">
$('#timetablemenu').addClass('collapse in');
$('#timetable').addClass('active');
$('#timetable2').addClass('active');

$(document).ready(function () {
  $('#classmenu').addClass('collapse in');

 $('#myformclassmange').validate({ // initialize the plugin
     rules: {

          class_name:{required:true },
         section_name:{required:true },
     },
     messages: {
           class_name: "Select Class Name",
           section_name:"Select Section Name"

         }
 });
});




</script>
