

<style>
   fieldset{
   margin-left:30px;
   margin-top:15px;
   }
   select{width:100px;}
</style>
<div class="main-panel">
<div class="content">
<div class="card1">
   <?php if($this->session->flashdata('msg')): ?>
   <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
      ×</button> <?php echo $this->session->flashdata('msg'); ?>
   </div>
   <?php endif; ?>
</div>
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="header">
            <legend>Time Table</legend>
         </div>
         <div class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <form method="post" action="<?php echo base_url(); ?>timetable/create_timetable" class="form-horizontal" enctype="multipart/form-data" id="timetableform">
                        <div class="row">
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Current Year</label>
                                 <div class="col-sm-3">
                                    <?php  $status=$years['status']; if($status=="success"){
                                       foreach($years['all_years'] as $rows){}
                                         ?>
                                    <input type="hidden" name="year_id"  value="<?php  echo $rows->year_id; ?>">
                                    <input type="text" name="year_name"  class="form-control" value="<?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?>" readonly="">
                                    <?php   }else{  ?>
                                    <input type="text" name="year_id"  class="form-control" value="" readonly="">
                                    <?php     } ?>
                                 </div>
                              </div>
                           </fieldset>
                            <fieldset>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Select Term</label>
                              <div class="col-sm-3">
                                <select   name="term_id"  data-title="Select Term" class="selectpicker" data-style="btn-block"  data-menu-style="dropdown-blue">
                                  <?php foreach ($resterms as $rows) {  ?>
                                  <option value="<?php echo $rows->term_id; ?>"><?php echo $rows->term_name; ?></option>
                              <?php      } ?>
                                </select>
                              </div>
                              </div>
                              </fieldset>
                           <fieldset>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">Select class</label>
                                 <div class="col-sm-3">
                                    <select   name="class_id" id="class_id"  data-title="Select Class" class="selectpicker" onchange="getSubject(this.value)"   data-style="btn-block"  data-menu-style="dropdown-blue">
                                       <?php foreach ($getall_class as $rows) {  ?>
                                       <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                                       <?php      } ?>
                                    </select>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                        <div class="content table-responsive table-full-width">
                           <table class="table table-hover table-striped">
                              <thead>
                                 <tr>
                                    <th>Days</th>
                                    <th>I</th>
                                    <th>II</th>
                                    <th>III</th>
                                    <th>IV</th>
                                    <th>V</th>
                                    <th>VI</th>
                                    <th>VII</th>
                                    <th>VIII</th>
                                 </tr>
                              </thead>
                              <?php
                                 $period = 8;
                                  $arr1=array('Mon','Tues','Wednes','Thurs','Fri','Sat');
                                 $arr2=array('1','2','3','4','5','6');
                                 ?>
                              <tr>
                                 <?php
                                    for($i=1;$i <= $period; $i++){ }
                                    ?>
                              </tr>
                              <?php
                                 foreach($arr2 as $day){
                                  ?>
                              <tr>
                                 <th><?php echo $day; ?></th>
                                 <?php
                                    for($i=1;$i<=$period; $i++){
                                        ?>
                                 <td>
                                    <!-- <select   name="subject_id[]" class="" required>
                                       <option value="">No Subject</option>
                                             <?php foreach ($subres as $rows) {  ?>
                                             <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                       <?php      } ?>

                                       </select> -->
                                    <select   name="subject_id[]" class="subject_id" id="subject_id"   required>
                                       <option value="">No subject</option>
                                    </select>
                                    <br><br>
                                    <select   name="teacher_id[]" class="teacher_id"  id="teacher_id" required>
                                       <option value="">No Teacher</option>
                                       <!-- <?php foreach ($teacheres as $rows) {  ?>
                                          <option value="<?php echo $rows->teacher_id; ?>"><?php echo $rows->name; ?></option>
                                          <?php      } ?> -->
                                    </select>
                                    <input type="hidden" name="period_id[]" value="<?php echo $i; ?>">
                                    <input type="hidden"name="day_id[]" value="<?php echo $day; ?>">
                                 </td>
                                 <?php
                                    }
                                    ?>
                              </tr>
                              <?php
                                 }
                                 ?>
                           </table>
                        </div>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-10">
                                 <center>   <button type="submit" class="btn btn-info btn-fill col-md-2" style="padding:10px;">Save</button></center>
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
   // function getComboA(sel){
   //    var value = sel.value;
   //    alert(value);
   // }

   function getSubject(){
    var class_id=$('#class_id').val();
	//alert(class_id);
    $.ajax({
       url:'<?php echo base_url(); ?>timetable/getsubject',
       method:"POST",
       data:{class_id:class_id},
       dataType: "JSON",
       cache: false,
       success:function(data)
       {
         var stat=data.status;
		 //alert(stat);
           $(".subject_id").empty();
         if(stat=="success"){

           var res=data.res;
             var len=res.length;
               $('<option>').val(" ").text("Select Subject").appendTo('.subject_id');
               for (i = 0; i < len; i++) {
                 $('<option>').val(res[i].subject_id).text(res[i].subject_name).appendTo('.subject_id');
               }

              getTeacher();
         }else{
       $(".subject_id").empty();
         }
       }
      });
   }

   function getTeacher(){
     var class_id=$('#class_id').val();
	 //alert(class_id);
     $.ajax({
        url:'<?php echo base_url(); ?>timetable/getTeacher',
        method:"POST",
        data:{class_id:class_id},
        dataType: "JSON",
        cache: false,
        success:function(data)
        {
          var stat=data.status;
           //alert(stat);
           $(".teacher_id").empty();
         if(stat=="success"){

           var res=data.res;
           //alert(res.length);
           var len=res.length;
             $('<option>').val(" ").text("Select Teacher").appendTo('.teacher_id');

           for (i = 0; i < len; i++) {

           $('<option>').val(res[i].teacher_id).text(res[i].name).appendTo('.teacher_id');

           }

         }else{
             $("#teacher_id").empty();
         }


        }
       });
   }

   $(document).ready(function () {
   $('#timetablemenu').addClass('collapse in');
   $('#time').addClass('active');
   $('#time1').addClass('active');
    $('#timetableform').validate({ // initialize the plugin
        rules: {

            period_id:{required:true },
            class_id:{required:true },
              term_id:{required:true },
            year_id:{required:true },

            "subject_id[]":{required:true },
            "teacher_id[]":{required:true }
        },
        messages: {

              period_id: "Select Period",
              class_id: "Select Class",
              year_id: "Select Year",
              term_id: "Select Term"
             //  subject_id: "Select Subject",
             //   teacher_id: "Select Teacher"

            }
    });
   });

</script>
