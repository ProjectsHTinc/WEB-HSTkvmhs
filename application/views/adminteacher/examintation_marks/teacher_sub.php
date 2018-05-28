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
                     <h4 class="title">Teacher Class & Section
					 <?php  $exam_id=$this->input->get('var'); 
					     //echo $exam_id?>
					 <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php
                           if(empty($result)){   ?>
                        <div class="col-md-2">
                           <p>No Records Found</p>
                        </div>
                        <?php }else{?>
                        <?php  
                         foreach($result as $row)
						   {
							 $cmid=$row->class_master_id;
							 $clsname=$row->class_name;
							 $sec_name=$row->sec_name;
							?>
						   <div class="col-md-2">
                       <a rel="tooltip" href="<?php echo base_url(); ?>examinationresult/view_all_subject_name?var1=<?php echo $cmid; ?>&var2=<?php echo $exam_id; ?>" class="btn btn-wd"> <?php echo $clsname; echo "-"; echo $sec_name; ?></a>
                        </div>
						 <?php } }?>
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
     $('#examinationmenu').addClass('collapse in');
     $('#exam').addClass('active');
     $('#exam4').addClass('active');

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
<script type="text/javascript">
   $().ready(function(){

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
