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
                     <h4 class="title">Examination Name</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                       <?php
					   if(empty($result))
						{?>
							<p style="padding:10px;color:red;text-align:center;">No Exam Added</p>
						<?php }else{
					   foreach($result as $row)
					   {
						  $ex_name=$row->exam_name;
						  $exam_id=$row->exam_id;
					   ?>
                        <div class="col-md-2">
                           <a rel="tooltip" href="<?php echo base_url(); ?>examinationresult/view_all_subject?var=<?php echo $exam_id; ?>"  class="btn btn-wd"><?php echo $ex_name; ?></a>
                        </div>
						<?php } }?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end row -->
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
</script>
<script type="text/javascript">
   function changeText(id)
   {
    $('#myModal').modal('show');
    //alert(id);
       $.ajax({
             type: 'post',
             url: '<?php echo base_url(); ?>homework/checker',
             data: {
                 id:id
             },
           dataType: 'json',

            success: function(test1)
      {


                 if (test1.status=='Success') {

                     var sub = test1.subject_name;
   			//alert(sub.length);
                     var sub_id = test1.subject_id;
                     var len=sub.length;
   			//alert(len);
                     var i;
                     var name = '';

                     for (i = 0; i < len; i++) {
                         name += '<option value='+ sub_id[i] +'>'+ sub[i] + '</option> ';
                         $("#ajaxres").html(name);
                         $('#msg').html('');
                     }
                 } else {

   			$('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   			  $("#ajaxres").html('');

                 }
             }


   });
   }

   $(document).on("click", ".open-AddBookDialog", function () {
      var eventId = $(this).data('id');
      $(".modal-body #event_id").val( eventId );
   });

</script>
