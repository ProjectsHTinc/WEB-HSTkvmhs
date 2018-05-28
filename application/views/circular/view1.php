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
                     <div class="content">
                        <h4 class="title">Circular Details</h4>
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-6">
							   <button type="button" id="teacher" onclick="myFunction()" class="btn btn-info btn-fill ">Teachers</button>
							   <button type="button" id="classes" onclick="myFunction1()" class="btn btn-info btn-fill ">Parents</button>
							   <button type="button" id="parents" onclick="myFunction2()" class="btn btn-info btn-fill ">Students</button>
                              </div>
                           </div>
                        </fieldset>
						
					 <div id="teachers1">
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th class="text-left">S.No</th>
                                 <th class="text-left" data-sortable="true">Users Type</th>
                                 <th class="text-left" data-sortable="true">Name</th>
								 <th class="text-left" data-sortable="true">Title</th> 
                                 <th class="text-left" data-sortable="true">Circular Type</th>
								 <th class="text-left" data-sortable="true">Status</th> 
                                 <th class="text-left" data-sortable="true">Circular Date</th>
                              </thead>
							  
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($all_circulars as $rows) { 
									$type=$rows->user_type;
									if($type==2){
									?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
									<td class="text-left"><?php echo "Teacher";  ?></td>
                                    <td class="text-left"><?php echo $rows->name;  ?></td>
                                   <td class="text-left"><?php echo $rows->circular_title;?></td>
								     <!--<td class="text-left"><?php echo $rows->notes;?></td>-->
									 <td class="text-left"><?php echo $rows->circular_type;?></td>
									  <td class="text-left"><?php echo $rows->status;?></td>
                                    <td class="text-left"><?php $date=date_create($rows->circular_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
                                   <!--<td>
                                      <a href="<?php echo base_url(); ?>communication/edit_commu/<?php echo $rows1->id;; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a> 
                                    </td>-->
                                 </tr>
									<?php $i++;  } }  ?>
                              </tbody>
                           </table>
                        </div>
				</div> 
						<!-- Parents---->
						
					<div id="parents1" style="display:none">
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                <th class="text-left">S.No</th>
								<th class="text-left" data-sortable="true">User Type</th> 
                                 <th class="text-left" data-sortable="true">Name</th>
                                 <th class="text-left" data-sortable="true">Title</th>
                                 <th class="text-left" data-sortable="true">Circular Type</th>
								 <th class="text-left" data-sortable="true">Status</th> 
                                 <th class="text-left" data-sortable="true">Circular Date</th>
                              </thead>
							  
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($parents as $rows1) { 
									$type=$rows1->user_type;
									if($type==4){
									?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
									  <td class="text-left"><?php echo "Parent"; ?></td>
                                    <td class="text-left"><?php echo $rows1->name; ?></td>
                                   <td class="text-left"><?php echo $rows1->circular_title;?></td>
									 <td class="text-left"><?php echo $rows1->circular_type;?></td>
									  <td class="text-left"><?php echo $rows1->status;?></td>
                                    <td class="text-left"><?php $date=date_create($rows1->circular_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
                                    
                                 </tr>
									<?php $i++;  } }  ?>
                              </tbody>
                           </table>
                        </div>
				</div> 
				
				<!-- Students---->
						
							 <div id="Students1" style="display:none">
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                <th class="text-left">S.No</th>
                                 <th class="text-left" data-sortable="true">Users Type</th>
                                 <th class="text-left" data-sortable="true">Name</th>
								  <th class="text-left" data-sortable="true">Title</th> 
                                 <th class="text-left" data-sortable="true">Circular Type</th>
								 <th class="text-left" data-sortable="true">Status</th> 
                                 <th class="text-left" data-sortable="true">Circular Date</th>
                              </thead>
							  
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($students as $rows) { 
									$type=$rows->user_type;
									if($type==3){
									?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
									<td class="text-left"><?php echo "Student";?></td>
                                     <td class="text-left"><?php echo $rows->name; ?> </td>
                                   <td class="text-left"><?php echo $rows->circular_title;?></td>
									 <td class="text-left"><?php echo $rows->circular_type;?></td>
									  <td class="text-left"><?php echo $rows->status;?></td>
                                    <td class="text-left"><?php $date=date_create($rows->circular_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
                                   <!--<td>
                                      <a href="<?php echo base_url(); ?>communication/edit_commu/<?php echo $rows1->id;; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a> 
                                    </td>-->
                                 </tr>
									<?php $i++;  } }  ?>
                              </tbody>
                           </table>
                        </div>
				</div> 
						
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->
               </div>
               <!-- end col-md-12 -->
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">

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

function myFunction() 
   {
       var x = document.getElementById('teachers1');

       if (x.style.display === 'none')
   	   {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#parents1").hide();
	   $("#Students1").hide();
   }		
   
   function myFunction1() 
   {
       var x = document.getElementById('parents1');

       if (x.style.display === 'none')
   	   {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#teachers1").hide();
	   $("#Students1").hide();
	 }	
	 
	 function myFunction2() 
     {
       var x = document.getElementById('Students1');

       if (x.style.display === 'none')
   	   {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#teachers1").hide();
	   $("#parents1").hide();
	 }	
</script>
