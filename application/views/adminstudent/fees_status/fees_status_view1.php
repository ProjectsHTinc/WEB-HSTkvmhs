<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Fees Status</h4>
                  </div>
                    <div class="content">
                     <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                           <thead>
                              <th>S.no</th>
                              <th>Year</th>
                              <th>Terms Name</th>
                              <th>Quota Name</th>
                              <th>Fees Amount</th>
                              <th>Paid Status</th>
                              <th>From DATE </th>
                              <th>To DATE </th>
                              <th>Details</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($fees as $rows) 
								 {
									 $paid=$rows->status;
                                  ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?></td>
                                 <td><?php echo $rows->term_name; ?></td>
                                 <td><?php echo $rows->quota_name; ?></td>
                                 <td><?php echo $rows->fees_amt; ?></td>
                                 <td>
									<?php 
									  if($paid=='Paid'){?>
									   <button class="btn btn-success btn-fill btn-wd">Paid</button>
									 <?php  }else{?>
									  <button class="btn btn-danger btn-fill btn-wd">Unpaid</button>
									  <?php } ?></td>
								 <td class="text-left"><?php $date=date_create($rows->due_date_from);
                                                           echo date_format($date,"d-m-Y");?></td>
                    			 <td class="text-left"><?php $date=date_create($rows->due_date_to);
                                                           echo date_format($date,"d-m-Y");?></td>
                    			<td class="text-left"><?php echo $rows->notes;?></td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  </div>
               </div>
            </div> <!-- row -->
         </div>
        
      </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
   $('#mastersmenu').addClass('collapse in');
   $('#master').addClass('active');
   $('#masters2').addClass('active');
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
