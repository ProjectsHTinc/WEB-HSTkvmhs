<div class="main-panel">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="header">
              <legend>Leave Application</legend>
            </div>
            <div class="content">
              <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="myformsection">
                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Type of Leave</label>
                    <div class="col-sm-4">
                      <select class="selectpicker form-control" data-title="Select Type Of Leave" name="leave_type" id="choose" onChange="changefunction()">
                        <?php foreach($leave as $row){?>
                        <option value="<?php echo $row->leave_type; ?>-<?php echo $row->id; ?>">
                        <?php  echo $row->leave_title; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div id="res"></div>
                    <label class="col-sm-2 control-label">From Date</label>
                    <div class="col-sm-4">
                      <input type="text" name="leave_date" class="form-control datepicker" placeholder="Enter Date" >
                    </div>
                  </div>
                </fieldset>
                <div id="permissiontime" style="display: none">
                  <fieldset>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Time</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control timepicker" name="frm_time" placeholder="From Time"/>
                      </div>
                      <div class="col-sm-2">
                        <input type="text" name="to_time" class="form-control timepicker" placeholder="To Time"/>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <br/>
                <fieldset>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">To Date</label>
                    <div class="col-sm-4">
                      <input type="text" name="to_leave_date" class="form-control datepicker" placeholder="Enter Date" >
                    </div>
                    <label class="col-sm-2 control-label">Leave Description</label>
                    <div class="col-sm-4">
                      <textarea name="leave_description" MaxLength="300" placeholder="MaxCharacters 300" class="form-control"  rows="4" cols="80"></textarea>
                    </div>
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-4"><!-- onclick="return confirm('Are you sure you want to Save')" -->
                      <button type="submit" id="save" class="btn btn-info btn-fill center">Save</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
        <?php echo $this->session->flashdata('msg'); ?> </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="content">
              <div class="fresh-datatables">
                <table id="bootstrap-table" class="table">
                  <thead>
                  <th>S.no</th>
                    <th>Leave Type</th>
                    <th>From Leave Date</th>
                    <th>To Leave Date</th>
                    <th>Leave Description</th>
                    <th>Status</th>
                    <th></th>
                    </thead>
                  <tbody>
                    <?php
                                 $i=1;
                                 foreach($result as $rows)
								 { $status=$rows->status;
								  $type=$rows->type_leave;
                                  ?>
                    <tr>
                      <td><?php   echo $i; ?></td>
                      <td><?php echo $rows->leave_title; /* if($type==0)
									 {echo "Permission";}else{echo"Leave";} */?></td>
                      <td><?php $date=date_create($rows->from_leave_date);
                                     echo date_format($date,"d-m-Y");
									  if($type==0)
									 {?>
                        <?php echo $rows->frm_time; ?> <?php echo $rows->to_time; ?>
                        <?php }?></td>
                      <td><?php $date=date_create($rows->to_leave_date);
									 echo date_format($date,"d-m-Y");?></td>
                      <td><?php echo $rows->leave_description; ?></td>
                      <td><?php if($status=='Pending'){ ?>
                        <button class="btn btn-warning btn-fill btn-wd">Pending</button>
                        <?php }elseif($status=='Rejected'){?>
                        <button class="btn btn-danger btn-fill btn-wd">Reject</button>
                        <?php }else{ ?>
                        <button class="btn btn-success btn-fill btn-wd">Approval</button>
                        <?php }?></td>
                      <td><!-- <a href="<?php echo base_url();?>teachercommunication/edit/<?php echo $rows->leave_id; ?>" title="Edit Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit" aria-hidden="true"></i> --></td>
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
    </div>
  </div>
</div>
<script type="text/javascript">
  function changefunction()
  { 
   //var example = "1,2";
   //var numbers = example.split(',',true);
   
	   var a=document.getElementById('choose').value ;
	   var numbers = a.split('-',true);
	   //alert(a);alert(numbers);
	   if (numbers==0) {
			$("#permissiontime").show();
		} else {
	   $("#permissiontime").hide();

		}
  }

   $(document).ready(function () {
     $('#commmenu').addClass('collapse in');
     $('#comm').addClass('active');
     $('#comm1').addClass('active');
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
            },
			
		  submitHandler: function(form) {
	        //alert("hi");
	        swal({
	                      title: "Are you sure?",
	                      text: "You Want Confirm this form",
	                      type: "success",
	                      showCancelButton: true,
	                      confirmButtonColor: '#DD6B55',
	                      confirmButtonText: 'Yes, I am sure!',
	                      cancelButtonText: "No, cancel it!",
	                      closeOnConfirm: false,
	                      closeOnCancel: false
	                  },
	                  function(isConfirm) {
	                      if (isConfirm) {
	       $.ajax({
	           url: "<?php echo base_url(); ?>teachercommunication/create",
	            type:'POST',
	           data: $('#myformsection').serialize(),
	           success: function(response) {
				   //alert(response);
	               if(response=="success"){
	                //  swal("Success!", "Thanks for Your Note!", "success");
	                  $('#myformsection')[0].reset();
	                  swal({
	           title: "Wow!",
	           text: "Message!",
	           type: "success"
	       }, function() {
	           window.location = "<?php echo base_url(); ?>teachercommunication/home";
	       });
	               }else if(response=="exist"){
					   sweetAlert("Oops...", "Leave Date Already Exist", "error");
				   }else{
	                 sweetAlert("Oops...", "Something went wrong!", "error");
	               }
	           }
	       });
	     }else{
	         swal("Cancelled", "Process Cancel :)", "error");
	     }
	   });
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


/* $(function () {
        $("#choose").change(function () {
            if ($(this).val()==0) {
                $("#permissiontime").show();
            } else {
           $("#permissiontime").hide();

            }
        });
    }); */


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
