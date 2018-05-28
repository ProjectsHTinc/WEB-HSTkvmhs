<div class="main-panel">
<div class="content">
<div class="col-md-12">
<div class="content">
    <form method="post" action="<?php echo base_url(); ?>timetable/save_user_review" id="timetablereviewform">
<div class="row">
  <div class="col-md-6">

                  <div class="card">
                      <div class="header">ReView form</div>
                      <div class="content">
                        <?php foreach ($res as $rows) {
                          # code...
                        } ?>

                            <div class="form-group">
                                <label>Teacher Name</label>
                               <input type="text" class="form-control"  placeholder="" id="classname" name="classname" value="<?php echo $rows->name; ?>" readonly="">

                               <input type="hidden" class="form-control"  placeholder="" id="timetable_id" name="timetable_id" value="<?php echo $rows->timetable_id; ?>" readonly="">


                            </div>
                              <div class="form-group">
                                  <label>Class Name</label>
                                 <input type="text" class="form-control" readonly  placeholder="" id="classname" name="classname" value="<?php echo $rows->class_name; ?><?php echo $rows->sec_name; ?>">


                              </div>

                              <div class="form-group">
                                  <label>Subject Name</label>
                                 <input type="text" class="form-control" readonly placeholder="" id="classname" name="classname" value="<?php echo $rows->subject_name; ?>">


                              </div>
                              <div class="form-group">
                                  <label>Period</label>
                                 <input type="text" class="form-control" readonly placeholder="" id="classname" name="classname" value="<?php echo $rows->period_id; ?>">


                              </div>
                              <div class="form-group">
                                  <label>Date Time</label>
                                   <input type="text" class="form-control"  placeholder="" id="classname" name="classname" readonly value=" <?php echo $rows->time_date;  ?>">
                           </select>
                              </div>
                              <div class="form-group">
                                  <label>Comments</label>
                                  <textarea id="comments" name="comments" class="form-control" readonly=""><?php echo $rows->comments;  ?></textarea>
                              </div>





                      </div>
                  </div> <!-- end card -->

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                      <label>Admin Remarks</label>
                      <textarea id="comments" name="remarks" class="form-control" ><?php echo $rows->remarks;  ?></textarea>
                  </div>

                </div>
                  <button type="submit" class="btn btn-fill btn-info">Save</button>


              </div>
</div>
  </form>
</div>
</div>
</div>
</div>
<script>
jQuery('#timetablemenu').addClass('collapse in');
$('#time').addClass('active');
$('#time2').addClass('active');
</script>
