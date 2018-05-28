<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

                        <div class="card">
                            <div class="header">Class for Timetable</div>
                            <div class="content">
                                <div class="row">
                              <?php

                                if(empty($class_id)){   ?>
                                <div class="col-md-2">  <p>No Records Found</p></div>
                                  <?php  }  else{   ?>
                                  <?php   $cnt= count($class_id);
                                   for($i=0;$i<$cnt;$i++){
                                   ?>
                               <div class="col-md-2">
                                     <a href="<?php echo  base_url(); ?>teachertimetable/view/<?php  echo $class_id[$i]; ?>" class="btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a></div>

                                    

                              <?php  } }  ?>
                              </div>
                            </div>
                        </div> <!-- end card -->

          </div>
       </div>
   </div>
</div>

<script type="text/javascript">
$('#timetable').addClass('collapse in');
$('#timetable').addClass('active');
$('#timetable').addClass('active');

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
