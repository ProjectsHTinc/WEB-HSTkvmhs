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
                     <legend>On Duty Details</legend>
                  </div>
                  <div class="content">
                           <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
							 
                                 <th>Reason Out</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <th>Status</th>
                           </thead>
                           <tbody>
					 <?php
						$i=1;
						foreach ($result as $rows) { $stu=$rows->status;
						 ?>
					 <tr>
						<td><?php  echo $i; ?></td>
						<td><?php  echo $rows->od_for; ?></td>
						<td><?php $dateTime=new DateTime($rows->from_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate; ?></td>
						<td><?php $dateTime=new DateTime($rows->to_date); $tdate=date_format($dateTime,'d-m-Y' ); echo $tdate; ?></td>
						
					<td><?php if($stu=='Pending'){ ?>
					 <button class="btn btn-warning btn-fill btn-wd">Pending</button>
					 <?php }elseif($stu=='Rejected'){?>
					 <button class="btn btn-danger btn-fill btn-wd">Reject</button>
					 <?php }else{ ?>
					 <button class="btn btn-success btn-fill btn-wd">Approved</button>
					 <?php }?>
					  </td>
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
     $('#ondutydetails').addClass('collapse in');
     $('#ondutydetails').addClass('active');
     $('#onduty2').addClass('active');
    $('#myformsection').validate({ // initialize the plugin
       rules: {
         leave_type:{required:true },
   		 leave_date:{required:true },
   		 leave_description:{required:true },
        },
        messages: {
              leave_type:"Select Type Of Leave",
              leave_date:"Select Leave Date",
              leave_description:"Enter The Leave Description",
            }
    });
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
