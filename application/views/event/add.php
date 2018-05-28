<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Add Events</legend>

                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>event/add" class="form-horizontal" enctype="multipart/form-data" id="eventform">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Event Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="event_date" class="form-control datepicker" placeholder="Event Date"/>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Event Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="event_name" id="event_name" class="form-control">

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Event Details</label>
                                            <div class="col-sm-4">
                                                <textarea type="text" MaxLength="350" placeholder="MaxCharacters 350" name="event_details" class="form-control"></textarea>

                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Event Status</label>
                                            <div class="col-sm-4">
                                              <select name="event_status" class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Active">Active</option>
                                                <option value="Deactive">De-Active</option>

                                              </select>

                                            </div>

                                        </div>
                                    </fieldset>



                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>  <!-- end card -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">


                                    <div class="content">

                                      <h4 class="title">List of Events</h4>


                                        <div class="fresh-datatables">


                                  <table id="bootstrap-table" class="table">
                                      <thead>

                                          <th data-field="id">ID</th>
                                            <th data-field="year"  data-sortable="true">Event Name</th>
                                              <th data-field="no"  data-sortable="true">Event Date</th>
                                        <!-- <th data-field="name" class="text-center" data-sortable="true">Event -Details</th> -->

                                        <th data-field="status"  data-sortable="true">Status</th>
                                        <th data-field="Section" data-sortable="true">Action</th>


                                      </thead>
                                      <tbody>
                                        <?php
                                        $i=1;
                                        foreach ($result as $rows) {
                                        ?>
                                          <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $rows->event_name; ?></td>
                                            <td><?php echo $new_date = date('d-m-Y', strtotime($rows->event_date));  ?></td>

                                            <!-- <td><?php echo $rows->event_details; ?></td> -->


                                              <td><?php if($rows->status=='Active'){  ?>
                                              <button class="btn btn-success btn-fill btn-wd">Active</button>
                                                                                          <?php  } else{  ?>
                                              <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                                        <?php    } ?></td>
                                            <td>

    <a rel="tooltip" href="#myModal" data-id="<?php echo $rows->event_id; ?>" title="Add Coordinator" class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit" style="color:#eb34ff;" data-toggle="modal" data-target="#addmodel"   >
	<i class="fa fa-user-plus">  </i></a>

<a href="<?php echo base_url(); ?>event/view_sub_event/<?php echo $rows->event_id; ?>" rel="tooltip" title="View of Coordinator List" class="btn btn-xs btn-fill">View</a>

                                               <!-- <a rel="tooltip" title="Add " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
											    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                </a> -->
                                              <a href="<?php echo base_url(); ?>event/edit/<?php echo $rows->event_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                </td>
                                          </tr>
                                          <?php $i++;  }  ?>
                                      </tbody>
                                  </table>

                                </div>
                                    </div><!-- end content-->
                                </div><!--  end card  -->
                            </div> <!-- end col-md-12 -->
                        </div> <!-- end row -->

                    </div>
</div>
</div>

 <div class="modal fade" id="addmodel" role="dialog" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

		<!--  <a  style="margin-left: 500px;float: left;"  href="<?php //echo base_url(); ?>event/view_sub_event/<?php //echo $rows->event_id; ?>" rel="tooltip" title="view" class="btn btn-xs btn-fill">view</a>
		 <form style="width:0px;margin:0px;" method="post" action=""></form> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Coordinator</h4>

        </div>
        <div class="modal-body">

                        <p id="msg" style="text-align:center;"></p>

                            <div class="content">
                                <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="coordinatorform">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Sub Event Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="sub_event_name" name="sub_event_name" value="" placeholder="Sub Event Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Coordinator Name</label>
                                        <div class="col-md-9">

										<select   id="co_name"  data-title="Select Teacher" class="selectpicker" data-style=" btn-block"  data-menu-style="dropdown-blue">
                                                    <?php

													$query = "SELECT * FROM edu_teachers WHERE status='Active'";
				                                    $resultset = $this->db->query($query);
													$teacher=$resultset->result();
													foreach($teacher as $row){  ?>
                                                    <option value="<?php echo $row->teacher_id; ?>"><?php echo $row->name; ?></option>
													<?php    }  ?>
                                                  </select>

                                            <!-- <input type="text" name="co_name" placeholder="Coordinator Name" class="form-control"> -->
                                        </div>
                                    </div>
									<div class="form-group">
 <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
										 <select id="status" class="selectpicker form-control" data-title="Select Status"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">

                                                  <option value="Active">Active</option>
                                                    <option value="Deactive">DE-Active</option>

                                              </select>
											 <input type="hidden" id="event_id"  class="form-control" value="<?php ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
								<button type="button" class="btn btn-fill btn-info submitBtn" onclick="submitContactForm()">SUBMIT</button>
                                           <!-- <button type="submit" class="btn btn-fill btn-info">Save</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end card -->

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>

    </div>
  </div>

  <script  type="text/javascript">



function submitContactForm(){
    //alert("hi");
    var sub_name = $('#sub_event_name').val();
	//alert(sub_name);

    var co_name = $('#co_name').val();
    var event_id = $('#event_id').val();
    var status = $('#status').val();

    if(sub_name.trim() == '' ){
		$('#msg').html('<span style="color:red;text-align:center;">Please enter sub event name</p>');
       // alert('Please enter sub event name.');
        $('#sub_event_name').focus();
        return false;
    }else if(co_name.trim() == '' ){
		$('#msg').html('<span style="color:red;text-align:center;">Please enter coordinator name</p>');
       // alert('Please enter coordinator name.');
        $('#co_name').focus();
        return false;
   } else if(event_id.trim() == '' ){
	   $('#msg').html('<span style="color:red;text-align:center;">Please select event</p>');
       // alert('Please select event .');
        $('#event_id').focus();
        return false;
    }else if(status.trim() == '' ){
	   $('#msg').html('<span style="color:red;text-align:center;">Please select status</p>');
       // alert('Please select event .');
        $('#status').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>event/create_sub_event',
            data:'eventFrmSubmit=1&sub_name='+sub_name+'&co_name='+co_name+'&event_id='+event_id+'&status='+status,

            success:function(msg){

                if(msg == 'Added Successfully')
				{

					$('#msg').html(msg);
					$('#coordinatorform')[0].reset();
                }else{
					 $("#msg").html(msg);

                }

            }
        });
    }
}
</script>






<script type="text/javascript">
$(document).on("click", ".open-AddBookDialog", function () {
     var eventId = $(this).data('id');
     $(".modal-body #event_id").val( eventId );
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
$(document).ready(function () {

  $('#eventmenu').addClass('collapse in');
  $('#event').addClass('active');
  $('#event2').addClass('active');
 $('#eventform').validate({ // initialize the plugin
     rules: {
         event_date:{required:true },
         event_details:{required:true },
         event_name:{required:true },
         event_status:{required:true }
     },
     messages: {
           event_details: "Enter Event Details",
           event_date: "Select Event Date",
           event_name: "Enter Event Name",
           event_status: "Select Status"
         }
 });
});

</script>
