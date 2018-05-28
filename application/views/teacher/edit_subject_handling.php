<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="toolbar">
      <div class="header">
          <legend>Edit Teacher Subject
            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

      </div>
    </div>
      <div class="row">
    <div class="container">
  <?php foreach($res  as $rows1){} ?>
  <form action="<?php echo base_url(); ?>teacher/save_subject_handling" method="post" class="form-horizontal" id="subject_handling_form" name="subject_handling_form">
     <fieldset>
       <div class="form-group">
          <label class="col-sm-2 control-label">Select Subject</label>
          <div class="col-sm-6">
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $rows1->id; ?>" readonly="">
             <input type="text" name="teacher_name" id="teacher_name" class="form-control" value="<?php echo $rows1->name; ?>" readonly="">
          </div>
       </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">Select Subject</label>
           <div class="col-sm-6">
             <select  name="subject_id" id="subject_id"   class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="getListClass()">
                <?php foreach ($resubject as $rows) {  ?>
                <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                <?php      } ?>
             </select>
               <script language="JavaScript">document.subject_handling_form.subject_id.value="<?php echo $rows1->subject_id; ?>";</script>
              <!-- <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $rows->id; ?>"> -->
           </div>
        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">Class name</label>
           <div class="col-sm-6">
             <select   name="class_master_id" id="class_master_id" class="form-control">
               <?php foreach($getall_class as $rows){ ?>
                 <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>

              <?php } ?>

             </select>
              <script language="JavaScript">document.subject_handling_form.class_master_id.value="<?php echo $rows1->class_master_id; ?>";</script>
        </div>
</div>
        <div class="form-group">
           <label class="col-sm-2 control-label">Select Status</label>
           <div class="col-sm-6">
              <select   name="status" id="status" class="form-control" >
                 <option value="Active">Active</option>
                 <option value="Deactive">Deactive</option>
              </select>
              <script language="JavaScript">document.subject_handling_form.status.value="<?php echo $rows1->status; ?>";</script>
           </div>

        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">&nbsp;</label>
           <div class="col-sm-6">
              <button type="submit" id="save" class="btn btn-info btn-fill center">Update  </button>
           </div>
        </div>
     </fieldset>
  </form>
  </div>
</div></div>
</div>
</div>
<script>
$('#subject_handling_form').validate({ // initialize the plugin
  rules: {
      subject_id:{required:true },
      class_master_id:{required:true }


  },
  messages: {
        subject_id: "Select Subject",
          class_master_id: "Select Class"


      },
    submitHandler: function(form) {
      //alert("hi");
      swal({
                    title: "Are you sure?",
                    text: "You Want confirm  this form",
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
     $.ajax({
         url: "<?php echo base_url(); ?>teacher/save_subject_handling",
          type:'POST',
         data: $('#subject_handling_form').serialize(),
         success: function(response) {
           //alert(response);
             if(response=="success"){
              //  swal("Success!", "Thanks for Your Note!", "success");
                $('#subject_handling_form')[0].reset();
                swal({
         title: "Wow!",
         text: "Updated !",
         type: "success"
     }, function() {
         window.location = "<?php echo base_url(); ?>teacher/view_subject_handling";
     });
             }else{
               sweetAlert("Oops...",response, "error");
             }
         }
     });
   }else{
       swal("Cancelled", "Process Cancel :)", "error");
   }
 });
}
});


function getListClass(){

        var subject_id=$('#subject_id').val();
        // alert(subject_id);
        $.ajax({
        url:'<?php echo base_url(); ?>classmanage/getListClass',
        method:"POST",
        data:{subject_id:subject_id},
        dataType: "JSON",
        cache: false,
        success:function(data)
        {
          //alert(data);
        var stat=data.status;
        $("#class_master_id").empty();
        if(stat=="success"){
        var res=data.res;
        //alert(res.length);
        var len=res.length;

        for (i = 0; i < len; i++) {
        $('<option>').val(res[i].class_master_id).text(res[i].class_name + res[i].sec_name).appendTo('#class_master_id');
        }

        }else{
        $("#class_master_id").empty();
        }
        }
        });

}
$('#teachermenu').addClass('collapse in');
$('#teacher').addClass('active');
$('#teacher2').addClass('active');
</script>
