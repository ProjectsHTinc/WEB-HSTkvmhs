
<div class="main-panel">
<div class="content">
<div class="col-md-12">

<div class="card">
	<div class="header">
		<legend>Fees Master
		 <a href="<?php echo base_url(); ?>feesstructure/view_fees_master" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">View Fees Details</a>
		 </legend>
	</div>
	<?php if($this->session->flashdata('msg')): ?>
	  <div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	×</button> <?php echo $this->session->flashdata('msg'); ?>
</div>

<?php endif; ?>

	<div class="content">
		<form method="post" action="<?php echo base_url(); ?>feesstructure/create_fees_structure" class="form-horizontal" enctype="multipart/form-data" id="feesform" name="feesform">

			<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Academic Year</label>
					<div class="col-sm-4">
					  <?php  $status=$years['status']; if($status=="success"){
					   foreach($years['all_years'] as $rows){}?>
						<input type="hidden" name="year_id"  value="<?php  echo $rows->year_id; ?>">
						<input type="text" name="year_name"  class="form-control" value="<?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?>" readonly="">
					   <?php   }else{  ?>
					  <input type="text" name="year_name"  class="form-control" value="" readonly="">
					   <?php  } ?>
					</div>
					
				</div>
			</fieldset>

			<fieldset>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Terms</label>
				  <div class="col-sm-4">
				 <select name="terms" id="terms"  class="selectpicker form-control" data-title="Select Terms" >
							<?php foreach ($terms as $row) {  ?>
						<option value="<?php echo $row->term_id; ?>"><?php echo $row->term_name; ?></option>
					  <?php      } ?>
						  </select>
					   
				  </div>

				</div>
			</fieldset>

			<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Class</label>
					<div class="col-sm-4">
					   <select name="class_name" class="selectpicker" data-title="Select Class" data-style="btn-default btn-block" onchange="getsecnamefun(this.value)" data-menu-style="dropdown-blue">
						  <?php foreach ($enr_cls as $clas) {  ?>
					  <option value="<?php  echo $clas->class_id; ?>"><?php  echo $clas->class_name; ?></option>
					  <?php } ?>
				  </select>
					</div>

				</div>
			</fieldset>
			<fieldset>
				<div class="form-group">
					 
					<label class="col-sm-2 control-label" id="lab"></label>
					
					<div class="col-sm-2">
					 <div id="sec"></div>
					</div>
				   <div class="col-sm-2">
						<div id="msg"></div>
					  <div id="amt"></div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Quota</label>
					<div class="col-sm-4">
												<select name="quota_name"  class="selectpicker form-control" data-title="Select quota name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
							<?php foreach ($quota as $rows) {  ?>
							<option value="<?php echo $rows->id; ?>"><?php echo $rows->quota_name; ?></option>
						   <?php } ?>
						  </select>
					</div>

				</div>
			</fieldset>
							  <fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Due Date (From)</label>
					<div class="col-sm-4">
						<input type="text" name="due_date_from"  class="form-control datepicker" placeholder=" Select Due Date"/>
					</div>
				</div>
			</fieldset>
							 <fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Due Date (To)</label>
					<div class="col-sm-4">
						<input type="text" name="due_date_to"  class="form-control datepicker" placeholder=" Select Due Date"/>

					</div>

				</div>
			</fieldset>
			
								<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Notes</label>
					<div class="col-sm-4">
					  <textarea name="notes" MaxLength="250" placeholder="MaxCharacters 250" class="form-control" rows="4" cols="80"></textarea>
					  
					</div>
				</div>
			</fieldset>
			
							<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-sm-4">
					  <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">

						  <option value="Active">Active</option>
							<option value="Deactive">DeActive</option>
					  </select>
					
					</div>
				</div>
			</fieldset>
			
			<fieldset>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-10">
				<button type="submit" id="save1" class="btn btn-info btn-fill center">Save </button>
					</div>

				</div>
			</fieldset>
		</form>

	</div>
</div>  <!-- end card -->

</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
$('#feesmenu').addClass('collapse in');
$('#payment').addClass('active');
$('#fees').addClass('active'); 

$('#feesform').validate({ // initialize the plugin
rules: {
year_id:{required:true},
year_name:{required:true},
terms:{required:true},
class_name:{required:true },
quota_name:{required:true },
fees_amount:{required:true },
due_date_from:{required:true },
due_date_to:{required:true },
notes:{required:true },
status:{required:true }

},
messages: {
year_id:"Academic Year not enable",
year_name:"Academic Year not enable",
terms: "Select Terms",
class_name: "Select Class",
quota_name: "Enter Quota Name",
fees_amount: "Enter The Fees Amount",
due_date_from: "Select due date ",
due_date_to: "Select due date ",
notes: "Enter notes",
status: "Select Status"

}
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

<script type="text/javascript">
function getsecnamefun(class_name)
{ //alert(class_name);
var groups = new Array;
$.ajax({
type:'post',
url:'<?php echo base_url(); ?>/feesstructure/get_all_section',
data:'clsid='+class_name,
dataType: "JSON",
cache: false,
success:function(test)
{
//alert(test);
var len = test.length;
//alert(len);
var secction='';
var amount='';

		if(test!='')
		{       //alert(len);
		for(var i=0; i<len; i++)
		{
		var clsid = test[i].class_sec_id;
		var sec_name = test[i].sec_name;
		secction += '<input name="subject_name" readonly type="text" required class="form-control"  value="' + sec_name + '"><input name="class_id[]" required type="hidden" class="form-control"  value="' + clsid + '"></br>';
		amount += '<input type="text" name="fees_amount[]"  class="form-control" placeholder="Enter Fees Amount"/></br>';
		}
		$("#sec").html(secction);
		$("#amt").html(amount);
		$("#lab").html('Section & Fees Amount');
		$("#sec").show();
		$("#amt").show();
		$("#lab").show();
		$("#msg").hide();
		}else{
		//alert('Faild');
		$("#msg").html('<p style="color: red;">Section Not Found</p>');
		$("#sec").hide();
		$("#amt").hide();
		$("#lab").hide();
		$("#msg").show();

		}

}
});
}
</script>


