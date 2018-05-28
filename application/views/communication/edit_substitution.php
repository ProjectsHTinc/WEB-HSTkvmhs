<div class="main-panel">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="card">
  <div class="header">
	 <legend>Edit Substitution</legend>
  </div>
		   <?php foreach($result as $res){}  $id=$this->input->get('v3');  ?>
  <div class="content">
	 <form method="post" action="<?php echo base_url(); ?>communication/update_substition" class="form-horizontal" enctype="multipart/form-data" id="myformsection" name="myformsection">

		<fieldset>
		   <div class="form-group">
		   
						<label class="col-sm-2 control-label">Substitution Class</label>
			  <div class="col-sm-4">
				 <select class="selectpicker form-control"  name="sub_cls" >
				 <?php
						if(empty($class_id)){   ?>
						<div class="col-md-2">  <p>NO Records Found</p></div>
				  <?php  }  else{   ?>
				  <?php   $cnt= count($class_id);
				   for($i=0;$i<$cnt;$i++){ ?>
						<option value="<?php echo $class_id[$i]; ?>"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></option>
								<?php }}?>
							 </select>
		<script language="JavaScript">document.myformsection.sub_cls.value="<?php echo $res->class_master_id; ?>";</script>
			  </div>
			  <input type="hidden" name="cls_id" value="<?php echo $res->class_master_id;?>">
					   <input type="hidden" name="teacher_id" value="<?php echo $res->teacher_id;?>">
						<input type="hidden" name="id" value="<?php echo $res->id;?>">
						<input type="hidden" name="lid" value="<?php echo $id;?>">
								
			  
			  <label class="col-sm-2 control-label">Substitution Date</label>
				<div class="col-sm-4">
					<input type="text" name="leave_date" class="form-control datepicker" placeholder="Registration Date"  value="<?php $date=date_create($res->sub_date);
					  echo date_format($date,"d-m-Y");  ?>" />                             
					  </div>
		   </div>
		</fieldset>

		<fieldset>
		   <div class="form-group">
			  <label class="col-sm-2 control-label">Teachers</label>
			  <div class="col-sm-4">
			   
				<select class="selectpicker form-control" data-title="Select Substitution Teacher" name="sub_teacher">
					<?php
						  $tea_name=$res->sub_teacher_id;
						  $sQuery = "SELECT * FROM edu_teachers";
						  $objRs=$this->db->query($sQuery);
						  $row=$objRs->result();
						  foreach ($row as $rows1)
									   {
											 $s= $rows1->teacher_id;
											 $sec=$rows1->name;
											 $arryPlatform = explode(",",$tea_name);
											 $sPlatform_id  = trim($s);
											 $sPlatform_name  = trim($sec);
											 if (in_array($sPlatform_id, $arryPlatform ))
												{
									 echo "<option value=\"$s\"selected/> $sec</option>";
								  }else {
										   echo "<option value=\"$s\" />$sec</option>";
										}
								  }
						?>
								
							 </select>
			  </div>
							 <label class="col-sm-2 control-label">Period</label>
			  <div class="col-sm-4">
				 <select name="period_id" class="selectpicker form-control" >
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
								 </select>
											 <script language="JavaScript">document.myformsection.period_id.value="<?php echo $res->period_id; ?>";</script>
			  </div>
						</div>
					 </fieldset>
					<fieldset>
		   <div class="form-group">
					   <label class="col-sm-2 control-label">Status</label>
		   <div class="col-sm-4">
		   <select name="status"  class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
			  <option value="Active">Active</option>
			  <option value="De-Active">De-Active</option>
		   </select>
							  <script language="JavaScript">document.myformsection.status.value="<?php echo $res->status; ?>";</script>
					  </div>
			  <label class="col-sm-2 control-label">&nbsp;</label>
			  <div class="col-sm-4">
				 <button type="submit" id="save" class="btn btn-info btn-fill center">Update</button>
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

</script>
