<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <legend>Add Substitution</legend>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>communication/create_substition" class="form-horizontal" enctype="multipart/form-data" id="myformsection" name="myformsection">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Substitution Class</label>
                              <div class="col-sm-4">
                                 <select class="selectpicker form-control" data-title="Select Substitution Class" name="sub_cls" >
                                    <?php
                                       if(empty($class_id)){   ?>
                                    <div class="col-md-2">
                                       <p>No Records Found</p>
                                    </div>
                                    <?php }else{ ?>
                                    <?php   $cnt= count($class_id);
                                       for($i=0;$i<$cnt;$i++){ ?>
                                    <option value="<?php echo $class_id[$i]; ?>"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></option>
                                    <?php }}?>
                                 </select>
                              </div>
                              <input type="hidden" name="teacher_id" value="<?php echo $teacher_id;?>">
							  <input type="hidden" name="tname" value="<?php echo $teaname;?>">
							    <input type="hidden" name="num" value="<?php echo $cell;?>">
                              <input type="hidden" name="leave_id" value="<?php echo $leave_id;?>">
                              <label class="col-sm-2 control-label">Substitution Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="leave_date"  value="<?php $dateTime = new DateTime($from_leave_date);$fdate=date_format($dateTime,'d-m-Y' );echo $fdate;  ?>" class="form-control datepicker">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Teachers</label>
                              <div class="col-sm-4">
                                 <select class="selectpicker form-control" data-title="Select Substitution Teacher" name="sub_teacher" id="subteacher" onChange="get_teacher_name()">
                                    <?php foreach($teachers as $tec){ ?>
                                    <option value="<?php echo $tec->teacher_id; ?> - <?php echo $tec->name; ?>"><?php echo $tec->name; ?></option>
                                    <?php }?>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">Period</label>
                              <div class="col-sm-4">
                                 <select name="period_id" class="selectpicker form-control" data-title="Select Period">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="Active">Active</option>
                                    <option value="De-Active">De-Active</option>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Assign</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th>S.no</th>
                                 <th>Substitution Teacher</th>
                                 <th>Substitution Date</th>
                                 <th>Class</th>
                                 <th>Period</th>
                                 <th>Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($view as $rows) {
                                    //echo $rows->id;
                                     ?>
                                 <tr>
                                    <td><?php  echo $i; ?></td>
                                    <td><?php  echo $rows->name;?></td>
                                    <td><?php   $date=date_create($rows->sub_date);
                                       echo date_format($date,"d-m-Y"); ?></td>
                                    <?php
                                      $cn=$rows->class_name;$sn=$rows->sec_name;?>
                                    <td><?php  echo $cn; ?> <?php  echo $sn; ?></td>
                                    <td><?php  echo $rows->period_id; ?></td>
                                    <td>
                                       <a href="<?php echo base_url();?>communication/sub_edit?v=<?php echo $rows->id; ?>&v1=<?php echo $teacher_id; ?>&v3=<?php echo $leave_id; ?>" title="Edit Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit" aria-hidden="true"></i> 
                                    </td>
                                 </tr>
                                 <?php $i++;  }  ?>
                              </tbody>
                           </table>
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
   $(document).ready(function() {
     $('#teachermenu').addClass('collapse in');
     $('#teacher').addClass('active');
     $('#teacher3').addClass('active');
    $('#myformsection').validate({ // initialize the plugin
       rules: {
         sub_cls:{required:true },
   		   leave_date:{required:true },
   		   sub_teacher:{required:true },
    		 period_id:{required:true },
    		 status:{required:true },
        },
        messages: {
              sub_cls:"Select Class",
              leave_date:"Select Leave Date",
              sub_teacher:"Select Substitution Teacher",
      			  period_id:"Select Period Time",
      			  status:"Select To Status",
            }
    });
   
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
   
   /* function get_teacher_name()
   {
	   var tname=document.getElementById('subteacher').value ;
	   alert(tname);
	   var a=document.getElementById('choose').value ;
   } */
   
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

