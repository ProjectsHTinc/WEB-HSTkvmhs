

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Students On Duty Form</h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>teacheronduty/apply_onduty_for_student" class="form-horizontal" enctype="multipart/form-data" id="ondutysection" name="ondutysection">
                       <?php if(!empty($clsstudlist)){ foreach($clsstudlist as $rows){}?>
					     <input type="hidden" name="cls_tea_id" value="<?php echo $rows->class_id; ?>" class="form-control">
					   <?php }else{ ?>  <input type="hidden" name="cls_tea_id" value="<?php echo $clsid; ?>" class="form-control"> <?php  }?>
                        <fieldset>
                           <div class="form-group">
						          
						   <label class="col-sm-2 control-label">Students Name</label>
                              <div class="col-sm-4">
							     <select name="stu_userid" class="selectpicker form-control" data-title="Select Students " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
								 <?php  if(!empty($clsstudlist)){ foreach($clsstudlist as $rows){?>
									<option value="<?php echo $rows->user_id; ?>"><?php echo $rows->name; ?></option>
								 <?php } }else{ } ?>
								  </select>
                              </div>  
						   
                              <label class="col-sm-2 control-label">Reason Out</label>
                              <div class="col-sm-4">
							   <input type="text" name="reason" class="form-control">
                              </div>
                              
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">From Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="fdate" required class="form-control datepicker" value="">
                              </div>
							  
                              <label class="col-sm-2 control-label">To Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="tdate" required class="form-control datepicker" value="">
                              </div>
                           </div>
                        </fieldset>
						 <fieldset>
                           <div class="form-group">
						     <label class="col-sm-2 control-label">Notes</label>
                              <div class="col-sm-4">
                                 <textarea rows="4" cols="80" MaxLength="250" placeholder="MaxLength 250" name="notes" class="form-control"></textarea>
                              </div>

                           </div>
                        </fieldset>
                        <div class="form-group">
                           <label class="col-sm-2 control-label">&nbsp;</label>
                           <div class="col-sm-4">
                              <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
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
								 <th>Students Name</th>
                                 <th>Reason Out</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <th>Status</th>
								 <th>Actions</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($stuonduty as $rows) { $stu=$rows->status;
                                     ?>
                                 <tr>
                                    <td><?php  echo $i; ?></td>
									<td><?php  echo $rows->name; ?></td>
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
								  
                                    <td><?php if($stu=='Approved' || $stu=='Rejected' ){echo"-";}else{ ?>
                                       <a href="<?php echo base_url();  ?>teacheronduty/edit_stu_onduty/<?php echo $rows->id; ?>/<?php echo $rows->class_id; ?>" class="btn btn-simple btn-warning btn-icon edit">
									<i class="fa fa-edit"></i></a><?php }?>
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
   $(document).ready(function () {
   $('#stuonduty').addClass('collapse in');
     $('#stuonduty').addClass('active');
     $('#stuonduty').addClass('active');
    $('#ondutysection').validate({ // initialize the plugin
        rules: {
            reason:{required:true },
			notes:{required:true },
			fdate:{required:true },
			tdate:{required:true },
			status:{required:true }
        },
        messages: {
               reason: "Enter Reason Out",
			   notes: "Enter Notes",
			   fdate: "Select From Date",
			   tdate: "Select To Date",
			   status: "Select Status",
            }
    });
	//demo.initFormExtendedDatetimepickers();
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

