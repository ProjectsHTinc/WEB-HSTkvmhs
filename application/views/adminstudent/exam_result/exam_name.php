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
                     <h4 class="title">Examination Calendar</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                       <?php if(empty($exam_view)){
						   echo "<p style=text-align:center;color:red;>Admin doesn't Approve The Reportcard </p>"; 
					   }else{
					   foreach($exam_view as $row)
					   {
						  $ex_name=$row->exam_name;
						  $exams_id=$row->exam_id;
						  //  echo $ex_name;
						 // echo $exam_year;
					   ?>
                        <div class="col-md-2">
                           <a rel="tooltip" href="<?php echo base_url(); ?>student/exam_calender/<?php echo $exams_id; ?>"  class="btn btn-wd"><?php echo $ex_name; ?></a>
                        </div>
					   <?php } }?>
						
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
		 
	
     
         <!-- end row -->
        
   
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
