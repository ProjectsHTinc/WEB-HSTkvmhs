<div class="main-panel">
   <div class="content">
      <div class="container-fluid">

         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title"> Get Marks Average</h4>
                  </div>
                  <div class="content">
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>rank/get_marks_average_result" enctype="multipart/form-data" id="rankform" name="rankform">
                    <fieldset>
                      <div class="form-group">
                         <label class="col-lg-2 control-label">Select Class</label>
                         <div class="col-md-4">
                           <select class="selectpicker" name="class_id" id="class_id" data-title="Select Class">
                             <?php foreach($getall_class as $row_class){ ?>
                               <option value="<?php echo $row_class->class_sec_id; ?>"><?php echo $row_class->class_name;  ?>-<?php echo $row_class->sec_name;  ?></option>
                            <?php } ?>
                           </select>
                         </div>
                      </div>
                    </fieldset>
                      <fieldset>
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Select Exams</label>
                           <div class="col-md-4">
                             <select class="selectpicker" name="exam_id[]" id="sub_id" multiple data-title="Select Exam">
                             </select>
                           </div>
                        </div>
                      </fieldset>
                      <fieldset>
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Mark Type</label>
                           <div class="col-md-4">
                             <select class="selectpicker" name="marktype" id="marktype"  data-title="Select Type">
                               <option value="Totals">Totals</option>
                              <option value="Average">Average</option>
                             </select>
                           </div>
                        </div>
                      </fieldset>
                      <fieldset>
                        <div class="form-group">
                             <label class="col-lg-2 control-label"></label>
                           <div class="col-md-4">
                             <button type="submit" class="btn btn-fill btn-info">Submit</button>
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

  $('#rankmenu').addClass('collapse in');
   $('#rank').addClass('active');
   $('#rank3').addClass('active');

  $("#class_id").on('change',function()
  {
     var cls_id=$(this).val();
     $.ajax({
          url:'<?php echo base_url(); ?>rank/get_exam_for_class',
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
               var subid=sub[i].exam_id;
               var subname=sub[i].exam_name;
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
