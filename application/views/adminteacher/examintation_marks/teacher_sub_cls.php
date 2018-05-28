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
                     <h4 class="title">Teacher Handling Subject 
					 <?php  $exam_id=$this->input->get('var2'); 
					        $sub_id=$this->input->get('var1'); 
					     //echo $exam_id?>
					 <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                  </div>
                
				  <?php
						/* if(empty($result))
						{?>
							<p style="padding:10px;color:red;text-align:center;">No Exam Added For Any Class</p>
						<?php }else{
						        foreach($result as $row)
								 {
									$a=$row->exam_id;
									$b=$row->subject_id;
									$c=$row->exam_date;
									$d=$row->times;
									$e=$row->classmaster_id;
									//echo $e;
								}
                          } */
						 ?>

                  <div class="content">
                     <div class="row">
                        <?php
                           if(empty($clssec)){   ?>
                        <div class="col-md-2">
                           <p>No Records Found</p>
                        </div>
                        <?php }else{
							foreach($clssec as $rows)
							 {
								$cmid=$rows->class_master_id;
								$subject_name=$rows->subject_name;
								$sub_id=$rows->subject_id;
								//echo $class_id[$i];
                     	 ?>
						   <div class="col-md-2">
                       <a rel="tooltip" href="<?php echo base_url(); ?>examinationresult/exam_mark_details?var1=<?php echo $cmid; ?>&var2=<?php echo $exam_id; ?>&var3=<?php echo $sub_id; ?>"class="btn btn-wd"><?php echo $subject_name; ?></a>
                        </div>
						 <?php }} ?>

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

   var $table = $('#bootstrap-table');
         $().ready(function(){
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: true,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize: 8,
                 clickToSelect: false,
                 pageList: [8,10,25,50,100],

                 formatShowingRows: function(pageFrom, pageTo, totalRows){
                     //do nothing here, we don't want to show the text "showing x of y from..."
                 },
                 formatRecordsPerPage: function(pageNumber){
                     return pageNumber + " rows visible";
                 },
                 icons: {
                     refresh: 'fa fa-refresh',
                     toggle: 'fa fa-th-list',
                     columns: 'fa fa-columns',
                     detailOpen: 'fa fa-plus-circle',
                     detailClose: 'fa fa-minus-circle'
                 }
             });

             //activate the tooltips after the data table is initialized
             $('[rel="tooltip"]').tooltip();

             $(window).resize(function () {
                 $table.bootstrapTable('resetView');
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

  /*  function changeText(id)
   {
    //$('#myModal').modal('show');
  alert(id);
       $.ajax({
             type: 'post',
             url: '<?php echo base_url(); ?>examinationresult/checker',
             data: {
                 id:id
             },
           dataType: 'json',

            success: function(test1)
               {
   	          alert(test1.status);
                 if (test1.status=='Success') {

                     var sub = test1.subject_name;
   			//alert(sub.length);
                     var sub_id = test1.subject_id;
                     var len=sub.length;
   			//alert(len);
                     var i;
                     var name = '';

                     for (i = 0; i < len; i++)
					 {
                         name += '<input name="subject_name" type="text" required class="form-control"  value="' + sub[i] + '"><input name="subject_id[]" required type="hidden" class="form-control"  value="' + sub_id[i] + '"></br>';
                         $("#ajaxres").html(name);
                         $('#msg').html('');
                     }
                 } else {

   			  $('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   			  $("#ajaxres").html('');

                 }
             }


   });
   } */



</script>
