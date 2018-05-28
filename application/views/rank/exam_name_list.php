<style>
   .col-md-2{
   width: 13%;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <?php if(empty($exam_view)){  }else{ ?>
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title"> Rank System</h4>
                  </div>
                  <div class="content">
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>rank/get_all_rank" enctype="multipart/form-data" id="rankform" name="rankform">
                           <div class="form-group">
                              <label class="col-sm-2 control-label"> YEAR</label>
                              <div class="col-sm-4">
                                 <select name="year_id"  required class="selectpicker" data-title="Select From & To Year " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php foreach($result as $rows)
                                       {
                                         $fyear=$rows->from_month;
                                         $month= strtotime($fyear);
                                         $eyear=$rows->to_month;
                                         $month1= strtotime($eyear);
                                         ?>
                                    <option value="<?php  echo $rows->year_id; ?>"><?php  echo  date('Y',$month); ?> (To) <?php  echo  date('Y',$month1); ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                               <label class="col-sm-2 control-label">Select Exam</label>
                              <div class="col-sm-4">
                                 <select name="exam_id[]"  class="selectpicker" multiple="multiple" data-title="Select Exam" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php  foreach($exam_view as $rows)
                                       {
                                        $exam_id=$rows->exam_id;
                                        $exname=$rows->exam_name; ?>
                                    <option value="<?php  echo $exam_id; ?>"><?php  echo $exname; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                       
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Select Class</label>
                           <div class="col-md-4">
                              <select name="class_id" id="class_id" class="selectpicker" data-title="Select Class " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                 <?php foreach($cls_view as $rows)
                                    {
                                     $cls_id=$rows->class_sec_id;
                                     $clsname=$rows->class_name;
                                     $sec_name=$rows->sec_name;
                                    ?>
                                 <option value="<?php  echo $cls_id; ?>"><?php  echo $clsname; ?> ( <?php  echo $sec_name; ?> ) </option>
                                 <?php } ?>
                              </select>
                           </div>

                            <label class="col-lg-2 control-label">Select Subjects</label>
                           <div class="col-sm-4">
                              <select  id="sub_id" name="sub_name_id[]" class="selectpicker" multiple data-title="Select Subjects" >
                              </select>
                           </div>
                           <div id="msg"></div>
                        </div>
                     
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Filter By Marks</label>
                           <div class="col-sm-4">
                           <input type="text" class="form-control" name="pass_mark"  placeholder="Enter The Marks">
                           </div>
                           <label class="col-lg-2 control-label"></label>
                           <div class="col-md-4">
                              <button type="submit" class="btn btn-fill btn-info">Search</button>
                           </div>
                        </div>
                     </form>
                     <div class="col-md-4">
                        <!--a href="<?php echo base_url();?>rank/class_name_list/<?php echo $exam_id; ?>" class="btn btn-wd"><?php echo $exname; ?></a-->
                     </div>
                     <?php  }  ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  
  jQuery('#rank').addClass('collapse in');
   $('#rank').addClass('active');
   $('#rank').addClass('active');

  $("#class_id").on('change',function()
  {
     //alert('hi');
     var cls_id=$(this).val();
     //alert(cls_id);
     $.ajax({
          url:'<?php echo base_url(); ?>rank/get_subject_list',
          type:'post',
          data:'clsid=' + cls_id,
          dataType: 'json',
          cache: false,
          success: function(test){
          var sts=test.status;
           if(sts=="success")
            {
             var len=test.result.length;
             //alert(len);
             var sub=test.result;
             var sub_id_name='';
              //sub_id_name +='<option value="">Select Subjects</option>';
             for(var i=0; i<len; i++)
             {
               var subid=sub[i].subject_id;
               var subname=sub[i].subject_name;
               sub_id_name+='<option value="'+subid+'">'+subname+'</option>';
                $("#sub_id").html(sub_id_name);
               //alert(sub_id_name);
             }
             $('#sub_id').selectpicker('refresh');
            }else{
            $("#msg").html('<p style="color: red;">Subjects Not Found</p>');
            $("#sub_id").html('');
            }
        }
      })
  })

   $('#rankform').validate({ // initialize the plugin
       rules: {
          year_id: {required: true},
         'exam_id[]': {required: true},
          class_id: {required: true},
         'sub_name_id[]': {required: true},
         pass_mark:{required: true}
       },
       messages: {
          year_id: "Please Select Year",
         'exam_id[]': "Please Select Exame",
          class_id: "Please Select Class",
         'sub_name_id[]': "Please Select Subjects",
         pass_mark:"Enter The Marks"
       }
    });
});
</script>

