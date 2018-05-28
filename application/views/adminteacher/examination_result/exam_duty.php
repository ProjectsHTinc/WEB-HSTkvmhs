<div class="main-panel">
<div class="content">

       <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
           ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
       <?php endif; ?>

       <div class="content">
            <div class="container-fluid">
                <div class="row">
                 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Exam Duty Details</h4>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
								 <?php
									  if(empty($duty)){
										  echo "<p style=padding:10px;color:red;text-align:center;>No Exam Duty Allocated</p>";
									  }else{?>
                                    <thead>
                                        <th>S.No</th>
                                    	<th>Exam Name</th>
                                    	<th>Subject Name</th>
                                    	<th>Exam Date</th>
                                    	<th>Time</th>
										<th>Class & Section </th>
                                    </thead>
                                    <tbody>
									 
                                           <?php $i=1;
										   
										   foreach ($duty as $res)
										   {
											 $exdate=date_create($res->exam_date);            
											?>
                                        <tr>
                                        	<td><?php echo $i; ?></td>
                                        	<td><?php echo $res->exam_name;  ?></td>
                                        	<td><?php echo $res->subject_name;  ?></td>
                                        	<td><?php echo date_format($exdate,"d-m-Y"); ?></td>
                                        	<td><?php echo $res->times;  ?></td>
                                        	<td><?php echo $res->class_name;  ?><?php echo $res->sec_name; ?></td>
                                        </tr>
									  <?php $i++;  } } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->

            </div>
        </div>

   </div>


</div>

<script type="text/javascript">
 var $table = $('#bootstrap-table');
       $().ready(function(){
		   $('#examinationmenu').addClass('collapse in');
				$('#exam').addClass('active');
				$('#exam3').addClass('active'); 
				
         jQuery('#admissionmenu').addClass('collapse in');
         $('#admission').addClass('active');
         $('#admission2').addClass('active');
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
