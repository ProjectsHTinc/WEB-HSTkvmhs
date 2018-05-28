<style>
   .txt{
   font-weight: 200;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="card">
               <div class="">
                  <legend>
                    <h4 style="padding-top:20px;">Take Attendance For Class on Selected Date</h4>
                    </legend>
                  <div class="content">
                     <form action="<?php echo base_url(); ?>adminattendance/attendance_on_class" method="post" class="form-horizontal" id="select_month">
                       <fieldset>
                          <div class="form-group">
                             <label class="col-sm-2 control-label">Select Date</label>
                             <div class="col-sm-4">
                               <input type="text" class="form-control datepicker " name="attendance_date" id="attendance_date">
                             </div>
                             <label class="col-sm-2 control-label">Select Session</label>
                             <div class="col-sm-4">
                               <select class="form-control" name="session_id">

                                 <option value="0">AM</option>
                                 <option value="1">PM</option>

                               </select>

                             </div>
                          </div>
                       </fieldset>
                       <fieldset>

                       </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Select Class</label>
                              <div class="col-sm-4">
                                <select class="form-control" name="class_id">
                                  <?php foreach($res as $rows){ ?>
                                  <option value="<?php echo $rows->class_id; ?>"><?php echo $rows->class_name;echo "-"; echo $rows->sec_name;  ?></option>
                                <?php } ?>
                                </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-10">
                                 <button type="submit" class="btn btn-info btn-fill center">Get Students </button>
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
</div>
</div>
<script type="text/javascript">

   $('#select_month').validate({ // initialize the plugin
       rules: {
           attendance_date:{required:true },
           month_id:{required:true }

       },
       messages: {
             attendance_date: "Select Date",
             month_id: "Select Month"

           }
   });

          $('#attend').addClass('collapse in');
          $('#attendance').addClass('active');
          $('#attend1').addClass('active');
</script>
