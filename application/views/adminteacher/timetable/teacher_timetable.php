<style>
   .tablwidth{
   margin-right: 16px;
   border:1px solid grey;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
      </div>
      <div class="">
         <div class="content">
            <div class="container card" style="padding-bottom:20px;">
               <div class="header">
                  <legend>Time Table<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> <a href="<?php echo base_url(); ?>teachertimetable/reviewview" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go To Review</a></legend>
               </div>
               <div class="card">
                  <div class="">
                     <div class="col-md-12">
                        <div class="">
                           <div class="">
                              <div class="col-md-3 tablwidth">
                                 <center>Monday</center>
                                 <table id="" class="table">
                                    <thead>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                    </thead>
                                    <tbody>
                                       <?php
                                          foreach($restime as $rows){
                                            $day=$rows->day;
                                            //echo $day;
                                            if($day=="1"){ ?>
                                       <tr>
                                          <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                          <td>  <?php echo $rows->period;  ?></td>
                                          <td>  <?php echo $rows->subject_name;  ?></td>
                                       </tr>
                                       <?php   }else{
                                          }

                                          }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-3 tablwidth">
                                 <center>Tuesday</center>
                                 <table id="" class="table">
                                    <thead>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                    </thead>
                                    <tbody>
                                       <?php
                                          foreach($restime as $rows){
                                            $day=$rows->day;
                                            //echo $day;
                                            if($day=="2"){ ?>
                                       <tr>
                                          <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                          <td>  <?php echo $rows->period;  ?></td>
                                          <td>  <?php echo $rows->subject_name;  ?></td>
                                       </tr>
                                       <?php   }else{
                                          }

                                          }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-3 tablwidth">
                                 <center>Wednesday</center>
                                 <table id="" class="table">
                                    <thead>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                       <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                    </thead>
                                    <tbody>
                                       <?php
                                          foreach($restime as $rows){
                                            $day=$rows->day;
                                            //echo $day;
                                            if($day=="3"){ ?>
                                       <tr>
                                          <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                          <td>  <?php echo $rows->period;  ?></td>
                                          <td>  <?php echo $rows->subject_name;  ?></td>
                                       </tr>
                                       <?php   }else{
                                          }

                                          }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-3 tablwidth">
                              <center>Thursday</center>
                              <table id="" class="table">
                                 <thead>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                 </thead>
                                 <tbody>
                                    <?php
                                       foreach($restime as $rows){
                                         $day=$rows->day;
                                         //echo $day;
                                         if($day=="4"){ ?>
                                    <tr>
                                       <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                       <td>  <?php echo $rows->period;  ?></td>
                                       <td>  <?php echo $rows->subject_name;  ?></td>
                                    </tr>
                                    <?php   }else{
                                       }

                                       }
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                           <div class="col-md-3 tablwidth">
                              <center>Friday</center>
                              <table id="" class="table">
                                 <thead>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                 </thead>
                                 <tbody>
                                    <?php
                                       foreach($restime as $rows){
                                         $day=$rows->day;
                                         //echo $day;
                                         if($day=="5"){ ?>
                                    <tr>
                                       <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                       <td>  <?php echo $rows->period;  ?></td>
                                       <td>  <?php echo $rows->subject_name;  ?></td>
                                    </tr>
                                    <?php   }else{
                                       }

                                       }
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                           <div class="col-md-3 tablwidth tablwidth">
                              <center>Saturday</center>
                              <table id="" class="table">
                                 <thead>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                                    <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                                 </thead>
                                 <tbody>
                                    <?php
                                       foreach($restime as $rows){
                                         $day=$rows->day;
                                         //echo $day;
                                         if($day=="6"){ ?>
                                    <tr>
                                       <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                                       <td>  <?php echo $rows->period;  ?></td>
                                       <td>  <?php echo $rows->subject_name;  ?></td>
                                    </tr>
                                    <?php   }else{
                                       }

                                       }
                                       ?>
                                 </tbody>
                              </table>
                           </div>
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
   $('#timetablemenu').addClass('collapse in');
   $('#timetable').addClass('active');
   $('#timetable1').addClass('active');

</script>
