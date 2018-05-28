<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-8">
<div class="card">
<div class="header"> 
   <h4 class="title">Edit Leave Master</h4>
</div>
<?php foreach ($edit as  $res) { } ?>
<div class="content">
   <form method="post" action="<?php echo base_url(); ?>userleavemaster/update_leave" class="form-horizontal" enctype="multipart/form-data" id="leaveformsection" name="leaveformsection">
		 <fieldset>
			  <div class="form-group">
				  <label class="col-sm-2 control-label">Leave Name</label>
				  <div class="col-sm-4"> 
					<input type="text" name="leave_name" class="form-control"  value="<?php echo $res->leave_title; ?>">

					  <input type="hidden" name="id" class="form-control"  value="<?php echo $res->id; ?>">

				  </div>
				  <label class="col-sm-2 control-label">Leave Type</label>
				  <div class="col-sm-4">
					  <select name="leave_type"  class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
							  <option value="1">Leave</option>
							  <option value="0">Permission</option>
						</select>
					<script language="JavaScript">
						document.leaveformsection.leave_type.value="<?php echo $res->leave_type; ?>";
					</script>
				  </div>
			  </div>
		  </fieldset>
		   <fieldset>
				<div class="form-group">
				 <label class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-4">
					   <select name="status" class="selectpicker form-control">
							  <option value="Active">Active</option>
							  <option value="Deactive">DeActive</option>
						</select>
					<script language="JavaScript">
						document.leaveformsection.status.value="<?php echo $res->status; ?>";
					</script>
				  </div>
				
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-4">
					 <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Update">
					</div>
					</div>
		   </fieldset>

	 </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function () {

$('#mastersmenu').addClass('collapse in');
$('#master').addClass('active');
$('#masters10').addClass('active');

$('#leaveformsection').validate({ // initialize the plugin
rules: {
leave_name:{required:true },
leave_type:{required:true },
status:{required:true }
},
messages: {
leave_name:"Please Enter Leave Name",
leave_type:"Please Enter Leave Type",
status:"select Status"
}
});
});

</script>
