<style>
   .txt{
   font-weight: 200;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="col-md-10">
               <div class="card">
                  <div class="content">
                     <legend>  <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:10px;">Go Back</button>  </legend>
                     <h4 class="title"> Edit  Class Attendance for  <?php foreach($get_name_class as $rows){} echo $rows->class_name; echo "-";echo $rows->sec_name;  ?></h4>
                     <div class="fresh-datatables">
                       <form action="" method="post" enctype="multipart/form-data" name="attendanceform" id="update_attendance">
                         <input type="hidden" name="attend_id" value="<?php echo $attend_id; ?>">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th data-field="id" class="text-center"  data-sortable="true">S.No</th>
                              <th data-field="date" class="text-center" data-sortable="true">Name</th>
                              <th data-field="year" class="text-center" data-sortable="true">Current Status </th>
                              <th data-field="Status" class="text-center" data-sortable="true">Update Attendance </th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows) {

                                 ?>
                              <tr>
                                 <td class="text-center"><?php echo $i;  ?></td>
                                 <td class="text-center  txt" ><?php echo $rows->name; ?></td>
                                 <td class="text-center"><?php $stat=$rows->a_status;
                                    if($stat=="OD"){ ?>
                                    <button class="btn btn-info btn-fill btn-wd">OD</button>
                                    <?php }else if($stat=="A"){ ?>
                                    <button class="btn btn-danger btn-fill btn-wd">ABSENT</button>
                                    <?php }
                                       else if($stat=="L"){ ?>
                                    <button class="btn btn-warning btn-fill btn-wd">LEAVE</button>
                                    <?php }
                                       else{  ?>
                                    <button class="btn btn-success btn-fill btn-wd">PRESENT</button>
                                    <?php  }
                                       ?>
                                 </td>

                                   <td>
                                     <select name="attendence_val[]">
                                     <option value="P" <?php if($stat=="P") echo 'selected="selected"'; ?>>Present</option>
                                    <option value="A"  <?php if($stat=="A") echo 'selected="selected"'; ?>>Absent</option>
                                    <option value="L" <?php if($stat=="L") echo 'selected="selected"'; ?>>Leave</option>
                                    <option value="OD" <?php if($stat=="OD") echo 'selected="selected"'; ?>>On-Duty</option>
                                   </select>
                                   <input type="hidden" name="enroll_id[]" value="<?php echo $rows->enroll_id; ?>">
                                   <input type="hidden" name="class_id" value="<?php  echo $class_id;; ?>">
                                   		<!-- <script language="JavaScript">document.attendanceform.attendence_val.value="<?php echo $stat; ?>";</script> -->
                                   </td>


                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>

                        </table>
                        <button type="button"   class="btn btn-warning btn-fill btn-wd pull-right"  id="submit" style="margin-top:20px;" onclick="submitAttendence()">
                       Submit Attendance  </button>
                      </form>
                     </div>
                  </div>
                  <!-- end content-->
               </div>
               <!--  end card  -->
               </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<script type="text/javascript">
   var $table = $('#bootstrap-table');
         $().ready(function(){
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: false,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize:50,
                 clickToSelect: false,
                 pageList: [50,100],

                 formatShowingRows: function(pageFrom, pageTo, totalRows){
                     //do nothing here, we don't want to show the text "showing x of y from..."
                 },
                 formatRecordsPerPage: function(pageNumber){
                     return pageNumber + " rows visible";
                 },
                 icons: {

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
         $('#attend').addClass('collapse in');
         $('#attendance').addClass('active');
         $('#attend1').addClass('active');

         function submitAttendence(){
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
                $.ajax({
                    url: "<?php echo base_url(); ?>adminattendance/update_attendance",
                     type:'POST',
                    data: $('#update_attendance').serialize(),
                    success: function(response) {

                        if(response=="success"){
                         //  swal("Success!", "Thanks for Your Note!", "success");
                           $('#update_attendance')[0].reset();
                           swal({
                    title: "Attendance Done!",
                    text: "Thank You!",
                    type: "success"
                }, function() {
                    window.location = "<?php echo base_url(); ?>adminattendance/home";
                });
                        }else{
                          sweetAlert("Oops...", response, "error");
                        }
                    }
                });
              }else{
                  swal("Cancelled", "Process Cancel :)", "error");
              }
            });


         }

</script>
