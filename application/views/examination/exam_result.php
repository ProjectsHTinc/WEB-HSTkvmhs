<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css">
<script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Class & Section</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php
                           if(empty($cls)){   ?>
                        <div class="col-md-2">
                           <p>No Marks Added</p>
                        </div>
                        <?php  }  else{
                                  foreach($cls as $rows){
 					    ?>

                        <div class="col-md-2">
                           <a rel="tooltip" href="<?php echo base_url(); ?>examination/exam_mark_details_cls_teacher?var1=<?php echo $rows->classmaster_id; ?>&var2=<?php echo $rows->exam_id; ?>" class="btn btn-wd"><?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a>
                        </div>

                        <?php  } }  ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
      </div>
   </div>
</div>
<script type="text/javascript">

   $(document).ready(function () {
   $('#exammenu').addClass('collapse in');
        $('#exam').addClass('active');
        $('#exam3').addClass('active');
    $('#classsection').validate({ // initialize the plugin
        rules: {
            test_type:{required:true },
			title:{required:true },
			subject_name:{required:true },
			tet_date:{required:true },
			details:{required:true },
			class_id:{required:true }
        },
        messages: {
              test_type: "Please Select Type Of Test",
			  title: "Please Enter Title Name",
			  subject_name: "Please Select Subject Name",
			  tet_date: "Please Select Date",
			  details: "Please Enter Details",
			  class_id: "Please Enter Class Name"

            }
    });
   });

</script>
