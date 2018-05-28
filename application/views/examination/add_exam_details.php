<style>
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{height: 20px;width: 22px;padding: 5px 5px 5px 5px;}
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{border: none !important;}
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{border-radius: initial !important;}
   .formdesign
   {
   padding-bottom: 48px;
   padding-top: 10px;
   background-color: rgba(209, 209, 211, 0.11);
   border-radius: 12px;
   }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Examination Calendar</h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>examination/add_exam_details" class="form-horizontal" enctype="multipart/form-data" id="examform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Exam</label>
                              <div class="col-sm-4">
                                 <input type="hidden" name="admit_date" class="form-control datepicker" placeholder="Enrollment Date"/>
                                 <select name="exam_year" required id="exam_year" onchange="checksubject(this.value)" class="selectpicker" data-title="Select Exam Year" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php foreach ($year as $sect)
                                       {
                                       $fyear=$sect->from_month;
                                       $month= strtotime($fyear);
                                       $eyear=$sect->to_month;
                                       $month1= strtotime($eyear);
                                       ?>
                                    <?php  //echo $sect->exam_id; ?>
                                    <option value="<?php  echo $sect->exam_id; ?>">
                                       <?php  echo  date('Y',$month); ?> (To)
                                       <?php  echo  date('Y',$month1); ?> (
                                       <?php  echo $sect->exam_name; ?>)
                                    </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">Class</label>
                              <div class="col-sm-4">
                                 <select name="class_name" required id="class_name" class="selectpicker" data-title="Select class" onchange="checksubject(this.value)" >
                                    <?php foreach ($getall_class as $rows) {  ?>
                                    <option value="<?php echo $rows->class_sec_id; ?>">
                                       <?php echo $rows->class_name; ?>&nbsp; - &nbsp;
                                       <?php echo $rows->sec_name; ?>
                                    </option>
                                    <?php      } ?>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <p id="msg" style="text-align:center;"></p>
                              <p id="msg1" style="text-align:center;"></p>
                              <div class="row">
                                 <div class="col-sm-2">
                                    <div id="ajaxres" style="padding-left:20px;"></div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div id="ajaxres1"></div>
                                 </div>
                                 <div class="col-sm-1">
                                    <div id="ajaxres3"></div>
                                 </div>
                                 <div class="col-sm-1">
                                    <div id="ajaxres2"></div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div id="subtlt"></div>
                                 </div>
                                 <div class="col-sm-1">
                                    <div id="is_inter_exter"></div>
                                 </div>
                                 <div class="col-sm-2">
                                    <div id="inter"></div>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">DeActive</option>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <input type="submit" id="save" class="btn btn-info btn-fill center" value="Save">
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
         ×</button>
         <?php echo $this->session->flashdata('msg'); ?>
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
                 <th data-field="id">ID</th>
                 <th data-field="exam_year"  data-sortable="true">Exam Year</th>
                 <th data-field="exam_name"  data-sortable="true">Exam Name</th>
                 <th data-field="class_section"  data-sortable="true">Class/Section</th>
                 <th data-field="Status"  data-sortable="true">Status</th>
                 <th>Action</th>
              </thead>
              <tbody>
                 <?php
                    $i=1;
                    foreach ($result as $rows)
                    {
                    $exid=$rows->exam_id;  ?>
                  <tr>
                    <td>
                       <?php echo $i; ?>
                    </td>
                    <td>
                       <?php     
                       $fyear=$sect->from_month;
                       $month= strtotime($fyear);
                       $eyear=$sect->to_month;
                       $month1= strtotime($eyear);
                        echo  date('Y',$month);  echo'-';
                       echo  date('Y',$month1);
                       ?>
                    </td>
                    <td>
                       <?php echo $rows->exam_name; ?>
                    </td>
                    
                    <td>
                       <?php echo $rows->class_name;?>
                       <?php echo $rows->sec_name; ?> 
                    </td>
                    <td>
                       <?php $sta=$rows->status;
                          if($sta=='Active'){?>
                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                       <?php  }else{?>
                       <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                       <?php } ?>
                    </td>
                    <td>
                       <!--a href="<?php echo base_url(); ?>examination/edit_exam_details/<?php echo $rows->exam_detail_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a-->
                       <a href="<?php echo base_url(); ?>examination/view_exam_details/<?php echo $rows->exam_id; ?>/<?php echo $rows->classmaster_id; ?>" rel="tooltip" title="View All Exam Details" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-th"></i></a>
                    </td>
                 </tr>
                 <?php $i++;  }
                     ?>
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

  function showdiv(dyid,val)
   {
   //alert(dyid);
   var inter_exter_val = '';
   if(val==1)
   { 
   inter_exter_val +='<input style="width:48%;float:left;margin-bottom:22px;" type="text" required name="inter_mark[]" id="im'+ dyid +'" class="form-control immarks" placeholder="Internal Mark"/><input type="text"  required name="exter_mark[]"  class="form-control emmarks" id="em'+ dyid +'" placeholder="External Mark" style="width:48%;float:left;margin-left:05px;margin-bottom:22px;"/></br>';

   var b=$("#"+ dyid +"").html(inter_exter_val);
   b.show();
   
   // $("#em" + dyid +"").mouseout(function()
   // {
   //  if(Number($("#im" + dyid +"").val()!=''))
   //  {
   //     //var ttl=document.getElementById('sub_total').value;
   //     var ttl=$("#sub_total"+ dyid +"").val(); 
   //     var ids = $('input[name*="exam_dates"]');
   //      //alert(ids.length);
   //     var c=Number($("#im" + dyid +"").val())+Number($("#em" + dyid +"").val());
   //     if(ttl==c)
   //     {   var k=0;
   //       for(k=1;k<ids.length;k++)
   //       {
   //         $('#save').attr('type','submit');
   //         $("#inter_exter_mark"+(dyid+k)+"").attr("disabled", false);
   //         $("#im" + dyid +"").css("border-color","#E3E3E3");
   //         $("#em" + dyid +"").css("border-color", "#E3E3E3");
   //       }
   //     }else{  
   //       var k=1;
   //       alert("The internal and external marks must be equal to subject total value");
   //       for(k=1;k<ids.length;k++){
   //        $('#save').attr('type','-');
   //        $("#inter_exter_mark"+(dyid+k)+"").attr("disabled", true);
   //        $("#im" + dyid +"").css("border-color","red");
   //        $("#em" + dyid +"").css("border-color", "red");
   //       } return false;
   //     }
   // }
   // });
    
   //   $("#im" + dyid +"").mouseout(function()
   //   {
   //    if(Number($("#em" + dyid +"").val()!='')){
   //       var ids = $('input[name*="exam_dates"]');
   //    // var ttl=document.getElementById('sub_total').value;
   //  var ttl=$("#sub_total"+ dyid +"").val(); 
   //     var c=Number($("#im" + dyid +"").val())+Number($("#em" + dyid +"").val());
   //     if(ttl==c){
   //      var k=0;
   //       for(k=1;k<ids.length;k++)
   //       {
   //       $('#save').attr('type','submit');
   //       $("#inter_exter_mark"+(dyid+k)+"").attr("disabled", false);
   //       $("#im" + dyid +"").css("border-color","#E3E3E3");
   //       $("#em" + dyid +"").css("border-color", "#E3E3E3");
   //     }
   //     }else{
   //      alert("The internal and external marks must be equal to subject total value");
   //       var k=0;
   //       for(k=1;k<ids.length;k++)
   //       {
   //       $('#save').attr('type','-');
   //       $("#inter_exter_mark"+(dyid+k)+"").attr("disabled", true);
   //       $("#im" + dyid +"").css("border-color","red");
   //       $("#em" + dyid +"").css("border-color", "red");
   //     }
   //       return false;
   //     } 
   //    }
   //   })
   }else{
   var no_inter_exter_val = '<input style="width:48%;float:left;margin-bottom:18px;" type="text" readonly  name="inter_mark[]" class="form-control" placeholder="Internal Mark"/><input type="text" readonly name="exter_mark[]" class="form-control" placeholder="External Mark" style="width:48%;float:left;margin-left:05px;margin-bottom:18px;"/></br>';
   var a=$("#"+ dyid +"").html(no_inter_exter_val);
   a.show();
   }
   }


// new methode 
 $('#save').click(function ()
 { 
    var ids = $('input[id*="sub_total"]');
    var x='';
    for(x=0;x<ids.length;x++)
     {
        var a =$("#sub_total"+x+"").val();
        var b=$("#inter_exter_mark"+x+"").val();
        var inm1=$("#im"+x+"").val();
        var exm1=$("#em"+x+"").val();
      if(b==1)
      {
         var tl=Number(inm1)+Number(exm1);
         if(a==tl){
             $("#im" + x +"").css("border-color","#E3E3E3");
             $("#em" + x +"").css("border-color", "#E3E3E3");
         }else{
           alert("The internal and external marks must be equal to subject total value");
            $("#im" + x +"").css("border-color","red");
            $("#em" + x +"").css("border-color", "red");
           return false;
         }
      }else{
      }
    }
        
  });

   function checksubject(exam_year,class_name)
   { //alert(val);exit;
   var exam_year = document.getElementById('exam_year');
   var class_name = document.getElementById('class_name');
   
   var eid = exam_year.value;
   var cid = class_name.value;
   //alert(eid);alert(cid);
   if(eid!='' && cid!=''){
   //alert(eid);alert(cid);exit;'code=' + code + '&userid=' + userid
   $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>examination/subcheck',
   data:'clsmasid=' + eid + '&examid=' + cid,
   success:function(test)
   {
   //alert(test);
   if(test=="Already Exam Added")
   {
   $("#msg1").html(test);
   $('#msg').html('');
   $("#ajaxres").html('');
   $("#ajaxres1").html('');
   $("#ajaxres2").html('');
   $("#ajaxres3").html('');
   $("#save").hide();
   }else{
   $("#msg1").html('');
   $("#save").show();
   //alert(cid);
   checknamefun(cid);
   }
   }
   });
   }
   }
   
   function checknamefun(cid) {
   //alert(classid);exit;
   $.ajax({
   type: 'post',
   url: '<?php echo base_url(); ?>examination/checker',
   data: {
   classid:cid
   },
   dataType: 'json',
   
   success: function(test1) {
   //alert(test1.subject_name);
   //console.log(test1);
   //var test=test1.status;
   //alert(test);
   if (test1.status=='Success') {
   var sub = test1.subject_name;
   //alert(sub.length);
   var sub_id = test1.subject_id;
   var len=sub.length;
   //alert(len);
   var i;
   var name = '';
   var exam_date = '';
   var exam_secction = '';
   var teacher = '';
   
   var stlt = '';
   var internal = '';
   var external = '';
   var inter_exter = '';
   
   
   for (i = 0; i < len; i++) {
   '<form name="exam" id="examvalidate">';

   name += '<p style="padding-top:06px;">' + sub[i] + '</p><input name="subject_id[]" required type="hidden" class="form-control"  value="' + sub_id[i] + '"></br>';
   
   exam_date += '<input type="text"  required name="exam_dates[]"  class="form-control datepicker"   placeholder="Enter The Exam Date"/></br>';
   
   stlt +='<input type="text"  required name="sub_total[]"  id="sub_total'+i+'" class="form-control"   placeholder="Subject Total"/></br>';
   
   internal +='<div id="'+ i +'"></div>';
   
   external +='<div id="'+ i +'"></div>';
   
   //internal +='<input type="text"  required name="inter_mark[]"  class="form-control"   placeholder="Internal Mark"/></br>';
   
   //external +='<input type="text"  required name="exter_mark[]"  class="form-control"   placeholder="External Mark"/></br>';
   
   inter_exter +='<select name="inter_exter_mark[]" required id="inter_exter_mark'+i+'" onchange="showdiv('+i+',this.value)"   class="form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue"><option value="">Internal Or External </option><option value="1">Yes</option><option value="0">No</option></select></br>';
   
   exam_secction += '<select name="time[]" required class="form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue"><option value="">Time</option><option value="AM">AM</option><option value="PM">PM</option></select></br>';
   
   teacher += '<select name="teacher_id[]" id="teacher_id" class="form-control" ><option value="">Select Invigilator</option><?php foreach ($teacheres as $rows) {  ?><option value="<?php echo $rows->teacher_id; ?>"><?php echo $rows->name; ?></option><?php  } ?></select></br>';
   
   '</form>';
   
   $("#ajaxres").html(name);
   $("#ajaxres1").html(exam_date).find('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
   $("#ajaxres2").html(exam_secction);
   $("#ajaxres3").html(teacher);
   $("#subtlt").html(stlt);
   $("#is_inter_exter").html(inter_exter);
   $("#inter").html(internal);
   $("#exter").html(external);
   $('#msg').html('');
   }
   } else {
   $('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   $("#ajaxres").html('');
   $("#ajaxres1").html(' ');
   $("#ajaxres2").html(' ');
   $("#ajaxres3").html(' ');
   $("#subtlt").html(' ');
   $("#is_inter_exter").html(' ');
   $("#inter").html(' ');
   $("#exter").html('  ');
   }
   }
   });
   }
   
</script>
<script type="text/javascript">
   function myFunction(){
   $( "#datepicker" ).datepicker();
   }
   
   $(document).ready(function() {
   
   $('#examvalidate').validate({ // initialize the plugin
   rules: {
   exam_year: {required: true},
   class_name: {required: true},
   subject_name: {required: true},
   exam_date: {required: true},
   time: {required: true},
   teacher_id: {required: true},
   'inter_exter_mark[]':{required: true}
   },
   messages: {
   exam_year: "Please Select Exam Year",
   class_name: "Please Select Class and Section Name",
   subject_name: "Please Select Subject Name",
   exam_date: "Please Enter Exam Date",
   time: "Please Select Time",
   teacher_id: "Please Select Teacher Name",
   'inter_exter_mark[]':"Select Internal Or External"
   }
   });
   });

   var $table = $('#bootstrap-table');
   $().ready(function() {
   $table.bootstrapTable({
   toolbar: ".toolbar",
   clickToSelect: true,
   showRefresh: true,
   search: true,
   showToggle: true,
   showColumns: true,
   pagination: true,
   searchAlign: 'left',
   pageSize: 10,
   clickToSelect: false,
   pageList: [10, 25, 50, 100, 150],
   
   formatShowingRows: function(pageFrom, pageTo, totalRows) {
   //do nothing here, we don't want to show the text "showing x of y from..."
   },
   formatRecordsPerPage: function(pageNumber) {
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
   
   $(window).resize(function() {
   $table.bootstrapTable('resetView');
   });
   
   });
   
   $().ready(function() {
   $('#exammenu').addClass('collapse in');
   $('#exam').addClass('active');
   $('#exam2').addClass('active');
   //$("#datepicker").attr('data-uk-datepicker','{format:"DD.MM.YYYY"}');
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

