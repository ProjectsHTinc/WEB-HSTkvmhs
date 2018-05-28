<style>

.trheight{
	height: 50px;
}
</style>
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
						     <div class="content">
                                <ul role="tablist" class="nav nav-tabs" style="border-bottom: none;padding-left:165px;">
                                    <li class="active">
                                        <a href="#company" class="btn btn-info btn-fill"  id="teacher"   data-toggle="tab">Parents</a>
                                    </li>
                                    <li>
                                        <a href="#style"  class="btn btn-info btn-fill" id="classes"  data-toggle="tab">Teachers</a>
                                    </li>
                                    <li>
                                        <a href="#settings" class="btn btn-info btn-fill" id="parents" data-toggle="tab">Students</a>
                                    </li>
                                </ul>
                            </div>
                           </div>
                        </fieldset>
						
						 <!--fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-6">
							   <button type="button" id="teacher" onclick="myFunction()" class="btn btn-info btn-fill ">Teachers</button>
							   <button type="button" id="classes" onclick="myFunction1()" class="btn btn-info btn-fill ">Parents</button>
							   <button type="button" id="parents" onclick="myFunction2()" class="btn btn-info btn-fill ">Students</button>
                              </div>
                           </div>
                        </fieldset-->
							<!-- Parents---->
                   <div class="tab-content">
				     <div id="company" class="tab-pane active">
                        <div class="fresh-datatables">
                            
                                  <table id="bootstrap-table" class="table">
                              <thead>
                                <th class="text-left">S.No</th>
                                 <th class="text-left" data-sortable="true">Users</th>
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
									$cls=$rows1->class_id;
									$query="select cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='$cls' AND c.class_id=cm.class AND s.sec_id=cm.section";
								   $result1=$this->db->query($query);
								   $result2= $result1->result();
								   foreach($result2 as $cls_sec){}
								   $cs=$cls_sec->class_name;
								   $se=$cls_sec->sec_name;
									if($type==4){
									?>
                                 <tr class="trheight">
                                    <td class="text-left"><?php echo $i; ?></td>
                                    <td class="text-left"><?php echo $cs; ?> <?php echo $se; ?></td>
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

						<!-- Teachers---->
               <div id="style" class="tab-pane">
                        <div class="fresh-datatables">
                            <table id="bootstrap-table" class="table">
                              <thead>
                                 <th class="text-left">S.No</th>
                                 <th class="text-left" data-sortable="true">Users</th>
                                 <th class="text-left" data-sortable="true">Title</th>
                                 <th class="text-left" data-sortable="true">Circular Type</th>
								 <th class="text-left" data-sortable="true">Status</th>
                                 <th class="text-left" data-sortable="true">Circular Date</th>
                              </thead>

                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($teachers as $rows) {
									$type=$rows->user_type;
									if($type==2){
									?>
                                 <tr class="trheight">
                                    <td class="text-left"><?php echo $i; ?></td>
                                    <td class="text-left"><?php echo $rows->name;  ?></td>
                                   <td class="text-left"><?php echo $rows->circular_title;?></td>

									 <td class="text-left"><?php echo $rows->circular_type;?></td>
									  <td class="text-left"><?php echo $rows->status;?></td>
                                    <td class="text-left"><?php $date=date_create($rows->circular_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
                                 </tr>
									<?php $i++;  } }  ?>
                              </tbody>
                           </table>
                        </div>
				</div>

				<!-- Students---->
                      <div id="settings" class="tab-pane">
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                <th class="text-left">S.No</th>
                                 <th class="text-left" data-sortable="true">Users</th>
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
									$cls=$rows->class_id;
									$query="select cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='$cls' AND c.class_id=cm.class AND s.sec_id=cm.section";
								   $result1=$this->db->query($query);
								   $result2= $result1->result();
								   foreach($result2 as $cls_sec){}
								   $cs=$cls_sec->class_name;
								   $se=$cls_sec->sec_name;
									if($type==3){
									?>
                                 <tr class="trheight">
                                    <td class="text-left"><?php echo $i; ?></td>
                                     <td class="text-left"><?php echo $cs; ?> <?php echo $se; ?></td>
                                   <td class="text-left"><?php echo $rows->circular_title;?></td>

									 <td class="text-left"><?php echo $rows->circular_type;?></td>
									  <td class="text-left"><?php echo $rows->status;?></td>
                                    <td class="text-left"><?php $date=date_create($rows->circular_date);
                                       echo date_format($date,"d-m-Y");
                                       ?></td>
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
$('#communcicationmenu').addClass('collapse in');
     $('#communication').addClass('active');
     $('#communication2').addClass('active');
	 
	 
   var $table = $('#bootstrap-table');
   
   
         $().ready(function()
		 {
            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize:10,
                clickToSelect: false,
                pageList: [10,25,50,100,200],

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
