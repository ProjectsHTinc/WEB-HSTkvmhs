<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-10">
<div class="card">
   <div class="header"> 
	   <h4 class="title">Add Leaves</h4>
   </div>
   <div class="content">
	   <form method="post" action="<?php echo base_url(); ?>userleavemaster/create_leave" class="form-horizontal" enctype="multipart/form-data" id="leaveformsection" name="leaveformsection">
			 <fieldset>
				  <div class="form-group">
					  <label class="col-sm-2 control-label">Leave Name</label>
					  <div class="col-sm-4"> 
						<input type="text" name="leave_name" class="form-control"  value="">
					  </div>
					  <label class="col-sm-2 control-label">Leave Type</label>
					  <div class="col-sm-4">
					   <select name="leave_type"  class="selectpicker form-control" data-title="Leave Type" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
							  <option value="1">Leave</option>
							  <option value="0">Permission</option>
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
							  <option value="Deactive">DeActive</option>
						</select>
					  </div>
					  
					<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-4">
		                 <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Save">
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
			<th>Leave Name</th>
			<th>Leave Type</th>
			<th>Status</th>
			<th class="disabled-sorting text-right">Actions</th>
		  </thead>
		  <tbody>
			<?php
			  $i=1;
			  foreach($result as $rows){$stu=$rows->status;$per=$rows->leave_type;
			?>
			  <tr>
				<td><?php  echo $i; ?></td>
				<td><?php  echo $rows->leave_title; ?></td>
				<td><?php if($per==0){ echo "Permission"; }else { echo "Leave"; }?></td>
				
				 <td><?php 
					  if($stu=='Active'){?>
						<button class="btn btn-success btn-fill btn-wd">Active</button>
					 <?php  }else{?>
					  <button class="btn btn-danger btn-fill btn-wd">DeActive</button>
					  <?php } ?></td>
				<td class="text-right">
				  <a href="<?php echo base_url(); ?>userleavemaster/edit_leave/<?php echo $rows->id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
				</td>
			  </tr>
						  <?php $i++;   } ?>
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
</div>


<script type="text/javascript">
$(document).ready(function () {

/* $('#mastersmenu').addClass('collapse in');
$('#master').addClass('active');
$('#masters10').addClass('active'); */

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
