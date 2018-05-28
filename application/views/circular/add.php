<style>
   .myBtn{
   background-color: rgba(68, 125, 247, 0.59);
   cursor: pointer;
   width: 15%;
   border-radius: 5px;
   height: 40px;
   }
   .myBtn:focus{
   background-color:#642160;
   color: #fff;
   }
   .center img
   {
   height: 128px;
   width: 128px;
   margin:200px auto;
   float:right;
   margin-right:200px;
   }
</style>
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
                     <legend> Circular Details  <a href="<?php echo base_url(); ?>circular/view_circular" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">View Circular</a></legend>
                  </div>
                  <div class="content">
                     <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validates()" name="form" id="myformsection">
                        <fieldset>
                           <div class="form-group">
                              <div class="content">
                                 <ul role="tablist" class="nav nav-tabs" style="border-bottom: none;padding-left:165px;">
                                    <li role="presentation" class="active" >
                                       <a href="#agency" class="btn btn-info btn-fill" id="all" data-toggle="tab">ALL</a>
                                    </li>
                                    <li>
                                       <a href="#company" class="btn btn-info btn-fill"  id="teacher"   data-toggle="tab">Teachers</a>
                                    </li>
                                    <li>
                                       <a href="#style"  class="btn btn-info btn-fill" id="classes"  data-toggle="tab">Students</a>
                                    </li>
                                    <li>
                                       <a href="#settings" class="btn btn-info btn-fill" id="parents" data-toggle="tab">Parents</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="tab-content">
                              <p id="erid" style="color:red;"> </p>
                              <div id="agency" class="tab-pane active">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">ALL</label>
                                    <div class="col-sm-4">
                                       <select  name="users" class="selectpicker" data-title="Select" id="multiple-admin" data-menu-style="dropdown-blue">
                                          <?php foreach ($role as $row) { ?>
                                          <option value="<?php echo $row->role_id;?>"><?php echo $row->user_type_name; ?></option>
                                          <?php  }?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div id="company" class="tab-pane">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Teachers</label>
                                    <div class="col-sm-4">
                                       <select multiple name="tusers[]" class="selectpicker form-control" data-title="Select Teachers" id="multiple-teacher" data-menu-style="dropdown-blue">
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->user_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div id="style" class="tab-pane">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Students</label>
                                    <div class="col-sm-4">
                                       <select multiple name="stusers[]" id="multiple-students" data-title="Select Students" class="selectpicker"  data-menu-style="dropdown-blue">
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>  - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div id="settings" class="tab-pane">
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Parents</label>
                                    <div class="col-sm-4">
                                       <select  multiple name="pusers[]" id="multiple-parents" data-title="Select Parents" class="selectpicker" data-menu-style="dropdown-blue">
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Circular Type</label>
                              <div class="col-sm-4">
                                 <select multiple name="citrcular_type[]" id="citrcular_type" data-title="Select Circular Type" class="selectpicker form-control">
                                    <option value="SMS">SMS</option>
                                    <option value="Mail">Mail</option>
                                    <option value="Notification">Notification</option>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Enter Date" >
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-4">
                                 <div id="tnone">
                                    <select name="ctitle" id="cititle" class="selectpicker form-control" data-title="Select Title" onchange="circulardescription(this)">
                                       <?php foreach($cmaster as $cmtitle) {?>
                                       <option value="<?php echo $cmtitle->id; ?>"><?php echo $cmtitle->circular_title; ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div id="cirtitle" style="display:none;">
                                    <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title" >
                                 </div>
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">De-Active</option>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                 <div id="msg"></div>
                                 <textarea name="notes" readonly class="form-control"  id="descriptions" rows="4" cols="80"></textarea>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center" >Save</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
               <div class="modal" style="display:none">
                  <div class="center">
                     <img alt="" src="<?php echo base_url(); ?>assets/loader.gif" />
                  </div>
               </div>
               <!--div id="loading" style="display: none;">
                  <center><img src="<?php echo base_url(); ?>assets/loader.gif" id="loading" ></center> 
                  </div-->
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   //$("#loading").hide();
   $(document).ready(function () {
   $('#communcicationmenu').addClass('collapse in');
   $('#communication').addClass('active');
   $('#communication1').addClass('active');
   
   $('#myformsection').validate({ // initialize the plugin
    rules: {
      teacher:{required:true },
   class_name:{required:true },
   title:{required:true },
   ctitle:{required:true },
   date:{required:true },
   notes:{required:true },
   citrcular_type:{required:true },
   status:{required:true }
     },
     messages: {
   teacher:"Select Teachers",
   class_name:"Select Classes",
   ctitle:"Enter Title",
   title:"Enter Title",
   date:"Enter Date",
   notes:"Enter The Details",
   citrcular_type:"Select Circular Type",
   status:"Select Status"
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
      //$("#loading").show();
     $.ajax({
        beforeSend: function() 
          {
            $(".modal").show();
            //$(".sweet-alert show-sweet-alert visible").hide();
          },
       complete: function() 
          {
            $(".modal").hide();
            //$(".sweet-alert show-sweet-alert visible").show();
          },

         url: "<?php echo base_url(); ?>circular/create",
         type:'POST',
         data: $('#myformsection').serialize(),
         success: function(response) {
            //alert(response);
        
		if(response=="success")
        {      
           $('#myformsection')[0].reset();
             swal({
                     title: "Wow!",
                     text: "Message!",
                     type: "success"
                  },
      function(){
             window.location = "<?php echo base_url(); ?>circular/add_circular";
         });
          // $("#loading").hide();
     }else{
            sweetAlert("Oops...", "Something went wrong!", "error");
           }
         }
     });
   }else{
   //$("#loading").hide();
       swal("Cancelled", "Process Cancel :)", "error");
   }
   });
   } 
  }); 
});
   
   
</script>
<script>
   function validates()
   {
      var tea = document.getElementById("multiple-teacher").value;
      var par = document.getElementById("multiple-parents").value;
      var cls = document.getElementById("multiple-students").value;
      var admin = document.getElementById("multiple-admin").value;
      //alert(tea);alert(par);alert(cls);alert(admin);
    if(tea=="" && par=="" && cls=="" && admin=="")
        {
       $("#erid").html("Please Select Admin Or Teachers Or Parents Or Students  ");
       //document.form.teacher.focus() ;
       return false;
        }
   } 
   
</script>
<script>
   /*  function circulartitle(selectObject) {
     var ct = selectObject.value; 
       //alert(ct);//exit;
    if(ct=='create'){
       alert("Hi");
       $("#cirtitle").show();
       $("#tnone").hide();
       $("#descriptions").html('');
    }else{
   $.ajax({
    url:'<?php echo base_url(); ?>circular/get_circular_title_list',
    type:'post',
    data:{ctype:ct},
    dataType:"JSON",
       cache: false,
    success: function(data) {
       var test=data.status;
             //alert(test);
       if(test=="success"){
           var stu=data.res1;
           var len=stu.length;
                  //alert(len);
           var stu=data.res1;
           // alert(stu);        
           var i;
           var ctitle='';
           ctitle +='<option value="">select Circular Title</option>';
           for (i=0;i<len;i++) {
              ctitle +='<option value="'+stu[i].circular_title+'">'+stu[i].circular_title+'</option>';
            $("#cirtitle").hide();
            $("#tnone").show();
            $("#cititle").html(ctitle);
          }
           
         } else {
            $('#msg1').html('<span style="color:red;text-align:center;">Circular Title</p>');
          $("#cititle").html('');
          //alert("Error");
         }
    }
   });
    }
   } */
   
    function circulardescription(cde1) {
      var cde= document.getElementById('cititle').value;
      //var ctype=document.getElementById('citrcular_type').value;   
     // alert (cde); 
   $.ajax({
    url:'<?php echo base_url(); ?>circular/get_description_list',
    type:'post',
    //data:'clsmasid=' + eid + '&examid=' + cid,
    data:'ctitle=' + cde,
    dataType:"JSON",
       cache: false,
    success: function(test1) {
       var test=test1.status1;
       //alert(test);
       if(test=="success"){
           var res=test1.res2;
           var len=res.length;
                  //alert(len);
           var cdescription=test1.res2;
           var i;
           var description='';
            var description1='';
           for (i=0;i<len;i++) {
              description +=''+cdescription[i].circular_description+'';
              $("#descriptions").html(description);
          }
         } else {
            $('#msg').html('<span style="color:red;text-align:center;">Description Not Found</p>');
          $("#descriptions").html('');
         }
    }
   });
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

