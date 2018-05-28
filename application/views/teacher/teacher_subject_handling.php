<div class="main-panel">
   <div class="content">
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
                     <div class="content" id="content1">
                        <div class="fresh-datatables">
                           <h4 class="title" style="padding-bottom: 20px;">List of Teacher Handling Subject
                            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                          </h4>
                           <form method="post" action="<?php echo base_url(); ?>teacher/get_sorting_details" class="form-horizontal" enctype="multipart/form-data" name="myformsection">

                              <div class="col-sm-4">


                              </div>
                           </form>
                          <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                              <thead>
                                 <th>S.No</th>
                                 <th>Name</th>
                                 <th>Class</th>
                                 <th>Subject</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </thead>
                              <tbody>
                                <?php $i=1; foreach($res as $rows){ ?>
                                 <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $rows->name; ?></td>
                                    <td class="text-center"><?php echo $rows->class_name;?>-<?php echo $rows->sec_name; ?></td>
                                    <td class="text-center"><?php echo $rows->subject_name; ?></td>

                                    <td><?php
                                       if($rows->status=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                          ?>
                                    </td>
                                    <td class="text-center">
                                       <a href="<?php echo base_url(); ?>teacher/edit_subject_teacher/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++; }
                                    ?>

                              </tbody>
                           </table>
                           <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add Subject To Teacher</h4>
                        </div>
                        <div class="modal-body">
                          <form action="" method="post" class="form-horizontal" id="subject_handling_form">
                            <fieldset>
                               <div class="form-group">
                                  <label class="col-sm-4 control-label">Select Subject</label>
                                  <div class="col-sm-6">
                                    <select  name="subject_id" id="subject_id"  data-title="Select Subject" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="getListClass()">
                                       <?php foreach ($resubject as $rows) {  ?>
                                       <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                       <?php      } ?>
                                    </select>
                                     <input type="hidden" name="teacher_id" id="teacher_id" class="form-control" value="">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Select Class</label>
                                  <div class="col-sm-6">

                                     <select   name="class_master_id" id="class_master_id" class="form-control">
                                     </select>
                                  </div>
                               </div>
                               <div class="form-group">
                                 <label class="col-sm-4 control-label">Select Status</label>
                                 <div class="col-sm-6">

                                    <select   name="status" id="status" class="form-control">
                                      <option value="Active">Active</option>
                                      <option value="Deactive">Deactive</option>
                                    </select>
                                 </div>
                              </div>
                               <div class="form-group">
                                 <label class="col-sm-4 control-label">&nbsp;</label>
                                 <div class="col-sm-6">
                                    <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                 </div>
                              </div>
                            </fieldset>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
                        </div>
                     </div>
					 <div id="editor"></div>
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
$('#teachermenu').addClass('collapse in');
$('#teacher').addClass('active');
$('#teacher2').addClass('active');
function getListClass(){

var subject_id=$('#subject_id').val();
//alert(subject_id);
$.ajax({
url:'<?php echo base_url(); ?>classmanage/getListClass',
method:"POST",
data:{subject_id:subject_id},
dataType: "JSON",
cache: false,
success:function(data)
{
var stat=data.status;
$("#class_master_id").empty();
if(stat=="success"){
var res=data.res;
//alert(res.length);
var len=res.length;

for (i = 0; i < len; i++) {
$('<option>').val(res[i].class_sec_id).text(res[i].class_name + res[i].sec_name).appendTo('#class_master_id');
}

}else{
$("#class_master_id").empty();
}
}
});

}
$('#subject_handling_form').validate({ // initialize the plugin
  rules: {
      subject_id:{required:true },
      class_master_id:{required:true },
  },
  messages: {
        subject_id: "Select Subject",
        class_master_id:"Select Class"
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
         url: "<?php echo base_url(); ?>teacher/subject_handling",
          type:'POST',
         data: $('#subject_handling_form').serialize(),
         success: function(response) {
           //alert(response);
             if(response=="success"){
              //  swal("Success!", "Thanks for Your Note!", "success");
                $('#subject_handling_form')[0].reset();
                swal({
         title: "Wow!",
         text: "Message!",
         type: "success"
     }, function() {
         window.location = "<?php echo base_url(); ?>teacher/view";
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

      	$('#example').DataTable({
          dom: 'lBfrtip',
          buttons: [
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                      columns: ':visible'
                  }
              },
              {
                  extend: 'pdfHtml5',
                  exportOptions: {
                       columns: ':visible'
                  }
              },
              'colvis'
          ],
      		"pagingType": "full_numbers",
      		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      		responsive: true,
      		language: {
      		search: "_INPUT_",
      		searchPlaceholder: "Search ",
      		}
      	});


</script>
