<style>
    select {
        width: 100px;
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="col-md-12">

            <div class="card">
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                    <?php endif; ?>
            </div>
        </div>

        <div class="content">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <legend>Edit Time Table
                            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                        </legend>
                    </div>

                    <?php
      ?>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <form method="post" action="<?php echo base_url(); ?>timetable/update_timetable" class="form-horizontal" enctype="multipart/form-data" id="timetableform" name="timetableform">
                                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                            <input type="hidden" name="term_id" value="<?php echo $term_id; ?>">
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover table-striped" style="width:900px;">
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
                                                    <?php $prd= count($restime)/6; //echo  $restime[5]->subject_name;
                                                      $period = $prd;
                                                      //$arr2=array('Mon','Tue','Wednes','Thurs','Friday','Saturday');
                                                      $arr2=array('1','2','3','4','5','6');
                                                      $k=0;
                                                      foreach($arr2 as $day){
                                                      for($i=1;$i <= 6; $i++){ ?>
                                                                <tr>
                                                                    <th>
                                                                        <?php echo $day; ?>
                                                                    </th>
                                                                    <?php
                                                                    for($i=1;$i <= $period; $i++){
                                                                      ?>
                                                                        <td>
                                                                            <select name="subject_id[]" class="subject_id" id="subject_id">
                                                                                <option value=""> </option>
                                                                                <?php foreach($res_sub['res'] as $row_subject){ ?>
                                                                                    <option value="<?php echo   $row_subject->subject_id;  ?>" <?php if($restime[$k]->subject_id==$row_subject->subject_id) {echo 'selected="selected"';} ?>>
                                                                                        <?php echo   $row_subject->subject_name;  ?>
                                                                                    </option>
                                                                                    <?php } ?>

                                                                            </select>
                                                                            <script language="JavaScript">
                                                                                document.timetableform.subject_id.value = "<?php echo $restime[$k]->subject_id; ?>";
                                                                            </script>
                                                                            <br>
                                                                            <select name="teacher_id[]" class="teacher_id" id="teacher_id">
                                                                                <option value=""> </option>
                                                                                <?php foreach($res_teacher['res'] as $row_teacher){ ?>
                                                                                    <option value="<?php echo  $row_teacher->teacher_id;  ?>" <?php if($restime[$k]->teacher_id == $row_teacher->teacher_id) echo 'selected="selected"'; ?>>
                                                                                        <?php
                   echo  $row_teacher->name;  ?>
                                                                                    </option>
                                                                                    <?php } ?>

                                                                            </select>
                <script language="JavaScript">
                    document.timetableform.teacher_id.value = "<?php echo $restime[$k]->teacher_id; ?>";
                </script>
                <input type="hidden" name="period_id[]" value="<?php echo $i; ?>">
                <input type="hidden" name="day_id[]" value="<?php echo $day; ?>">
              </td>
                <?php
                $k++;
              }
            }
          }
        ?>
      </tr>
</table>

                                            </div>
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">&nbsp;</label>
                                                    <div class="col-sm-10">
                                                        <center>
                                                            <button type="submit" class="btn btn-info btn-fill col-md-2" style="padding:10px;">Update Timetable</button>
                                                        </center>
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
        <script>
            jQuery('#timetablemenu').addClass('collapse in');
            $('#time').addClass('active');
            $('#time2').addClass('active');
        </script>
