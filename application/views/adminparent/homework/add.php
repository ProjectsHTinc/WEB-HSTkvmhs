<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

                        <div class="card">
                            <div class="header">Homework For</div>
                            <div class="content">
                                <div class="row">
                              <?php
                            //  print_r($stud_details);
                                if(empty($stud_details)){   ?>
                                <div class="col-md-2">  <p>No Records Found</p></div>
                                  <?php  }  else{   ?>
                                  <?php  foreach($stud_details as $rows){
                                   ?>
                               <div class="col-md-2">
                                     <a href="<?php echo  base_url(); ?>adminparent/view_homework?var=<?php echo $rows->enroll_id; ?>" class="btn btn-wd">
                                       <?php echo $rows->name; ?></a>
                                     </div>



                              <?php   }  }
                               ?>
                              </div>
                            </div>
                        </div> <!-- end card -->

          </div>
       </div>
   </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
 $('#homework').addClass('collapse in');
   $('#homework').addClass('active');
   $('#homework').addClass('active');

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
