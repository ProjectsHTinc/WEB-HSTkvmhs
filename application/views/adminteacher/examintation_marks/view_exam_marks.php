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
                     <h4 class="title">View And Update Examination Marks</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                       <?php
					   foreach($result as $row)
					   {
						  $ex_name=$row->exam_name;
						  $exam_id=$row->exam_id;
						  //echo $ex_name;
						 //echo $exam_year;
					   ?>
                        <div class="col-md-2">
                           <a rel="tooltip" href="<?php echo base_url(); ?>examinationresult/marks_details_view?var=<?php echo $exam_id; ?>"  class="btn btn-wd"><?php echo $ex_name; ?></a>
                        </div>
					   <?php }?>

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
				$('#exam2').addClass('active'); 
    
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


