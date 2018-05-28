<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  ×</button> <?php echo $this->session->flashdata('msg'); ?>
               </div>
               <?php endif; ?>
               <div class="card">
                  <div class="header">  
                     <legend> Circular Details</legend>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>communication/create" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validates()" name="form" id="myformsection">


						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-4">
							   <button type="button" id="teacher" onclick="myFunction()" class="btn btn-info btn-fill ">Teachers</button>
							   <button type="button" id="classes" onclick="myFunction1()" class="btn btn-info btn-fill ">Classes</button>
							   <button type="button" id="parents" onclick="myFunction2()" class="btn btn-info btn-fill ">Parents</button>
                              </div>
                           </div>
                        </fieldset>

						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-4">
                          <div id="myDIV">
                                 <select multiple name="teacher[]" class="selectpicker form-control"  id="multiple-teacher" onchange="select_class('teacher')" data-menu-style="dropdown-blue" >
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->teacher_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select>
                              </div>
							  <p id="erid" style="color:red;"> </p>
							   <div id="myDIV1" style="display:none">
							  <select multiple  name="class_name[]" id="multiple-class" class="selectpicker" onchange="select_class('classname')" data-menu-style="dropdown-blue">
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select></div>
                              </div>
                           </div>
                        </fieldset>

                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-4">
                                 <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title" >
                              </div>
                              <label class="col-sm-2 control-label">Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Enter Date" >
                              </div>
                           </div>
                        </fieldset>
                        <br/>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Notes</label>
                              <div class="col-sm-4">
                                 <textarea name="notes" id="notes" class="form-control"  rows="4" cols="80"></textarea>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" onclick="getcube()" class="btn btn-info btn-fill center">Save</button>
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
     $('#communcicationmenu').addClass('collapse in');
     $('#communication').addClass('active');
     $('#communication1').addClass('active');
	  $('#myformsection').validate({ // initialize the plugin
       rules: {
         teacher:{required:true },
   		 class_name:{required:true },
   		 title:{required:true },
   		 date:{required:true },
   		 notes:{required:true },
        },
        messages: {
		  teacher:"Select Teachers",
		  class_name:"Select Classes",
		  title:"Enter Title",
		  date:"Enter Date",
		  notes:"Enter The Details",
               }
    }); 
	
   });
  
  
</script>
<script>
function validates()
{
		var tea = document.getElementById("multiple-teacher").value;
		var cls = document.getElementById("multiple-class").value;
	if(tea=="" && cls=="")
     {
		 $("#erid").html("Please Select Teachers Or Class");
		 //alert( "Please Select Teachers Or Class" );
		 document.form.teacher.focus() ;
		 return false;
     }
	
} 

</script>


<script>
   function myFunction() 
   {
       var x = document.getElementById('myDIV');

       if (x.style.display === 'none')
   	   {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV1").hide();
	   $("#myDIV2").hide();
   }

   function myFunction1() {
       var x = document.getElementById('myDIV1');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV").hide();
	   $("#myDIV2").hide();
   }
   
   function myFunction2() {
       var x = document.getElementById('myDIV2');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV").hide();
	   $("#myDIV1").hide();
   }
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
