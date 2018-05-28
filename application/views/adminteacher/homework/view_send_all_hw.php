<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
	  <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            
               <div class="card">
                  <div class="header">
                     <legend>Send Homework Details   <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>
                  </div>
                  <div class="content">
                           <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                             <th>S.no</th>
							 <th>Teacher Name</th>
							 <th>Type</th>
							 <th>Title</th>
							 <th>subject Name</th>
							 <th>Home Work / Class Test Date</th>
							 <th>Details</th>
                           </thead>
                           <tbody>
					 <?php
						$i=1;
						foreach ($view_all as $rows) { 
						$type=$rows->hw_type;
						 ?>
					 <tr>
						<td><?php  echo $i; ?></td>
						<td><?php  echo $rows->name; ?></td>
						<td><?php if($type=='HW'){ ?> Home Work <?php }else{ ?> Class Test  <?php } ?> </td>
						<td><?php  echo $rows->title; ?></td>
						<td><?php  echo $rows->subject_name; ?></td>
						<td> Test Date :<?php if($type=='HW'){  $dateTime=new DateTime($rows->test_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate; ?><br> Due Date : <?php  $ddate=new DateTime($rows->due_date); $duedate=date_format($ddate,'d-m-Y' ); echo $duedate; }else { $dateTime=new DateTime($rows->test_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate;  } ?>
						</td>
						<td><?php echo $rows->hw_details;?></td>
						
					

					 </tr>
					 <?php $i++;  }  ?>
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
     $('#homeworkmenu').addClass('collapse in');
     $('#home').addClass('active');
     $('#home1').addClass('active');
	demo.initFormExtendedDatetimepickers();
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




   $().ready(function(){

     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
	    minDate: new Date(),
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

