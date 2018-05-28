<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <?php
          if(empty($cls_tutor)){

          } else{ ?>
                    <div class="card">
                        <div class="header">Class Teacher</div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php foreach($cls_tutor as $class_tut){} ?>
                                        <a href="<?php echo  base_url(); ?>teacherattendence/send_attendance/<?php echo $class_tut->class_sec_id;  ?>" class="btn btn-wd"><?php echo $class_tut->class_name; echo "-";echo $class_tut->sec_name; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>

                        <div class="card">
                            <div class="header">View the Attendance By Class wise</div>
                            <div class="content">

                                <div class="row">
                                    <?php

                              if(empty($res)){   ?>
                                        <div class="col-md-2">
                                            <p>NO Records Found</p>
                                        </div>
                                        <?php  }  else{  foreach($res as $rows) { ?>
                                            <?php
                                 ?>
                                                <div class="col-md-2">
                                                    <a href="<?php echo  base_url(); ?>teacherattendence/viewattendence/<?php echo $rows->class_master_id; ?>" class="btn btn-wd"><?php echo $rows->class_name."-".$rows->sec_name; ?></a></div>

                                                <?php  } }  ?>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#attendmenu').addClass('collapse in');
    $('#atten').addClass('active');
    $('#atten2').addClass('active');
</script>
