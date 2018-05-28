

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="card">
               <div class="header">Examinarion Result </div>
               <div class="content">
                  <div class="row">
                     <?php
                        //  print_r($stud_details);
                            if(empty($stud_details)){   ?>
                     <div class="col-md-2">
                        <p>No Records Found</p>
                     </div>
                     <?php  }  else{   ?>
                     <?php  foreach($stud_details as $rows){
                        ?>
                     <div class="col-md-2">
                        <a href="<?php echo  base_url(); ?>adminparent/exam_calender/<?php echo $rows->enroll_id; ?>" class="btn btn-wd">
                        <?php echo $rows->name; ?></a>
                     </div>
                     <?php   }  }
                        ?>
                  </div>
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
     $('#examinationmenu').addClass('collapse in');
     $('#exam').addClass('active');
     $('#exam1').addClass('active');
    
     });
   
</script>

