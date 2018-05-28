

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-8">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Add Terms</h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>years/add_terms" class="form-horizontal" enctype="multipart/form-data" id="myformsection">
                      
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"> YEAR</label>
                              <div class="col-sm-4">
                                 <select name="year_id"  required class="selectpicker" data-title="Select From & To Year " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php foreach($result as $rows)
                                       {
                                         $fyear=$rows->from_month;
                                       $month= strtotime($fyear);
                                       
                                       $eyear=$rows->to_month;
                                       $month1= strtotime($eyear);
                                       
                                         ?>
                                    <option value="<?php  echo $rows->year_id; ?>"><?php  echo  date('Y',$month); ?> (To) <?php  echo  date('Y',$month1); ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">TERMS</label>
                              <div class="col-sm-4">
                                 <input type="text" name="terms" required class="form-control" value="">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">FROM DATE</label>
                              <div class="col-sm-4">
                                 <input type="text" name="from_month" required class="form-control datepicker" value="">
                              </div>
                              <label class="col-sm-2 control-label">To DATE</label>
                              <div class="col-sm-4">
                                 <input type="text" name="end_month" required class="form-control datepicker"  />
                              </div>
                           </div>
                        </fieldset>
                        <div class="form-group">
                           <label class="col-sm-2 control-label">Status</label>
                           <div class="col-sm-4">
                              <select name="status"  class="selectpicker form-control">
                                 <option value="Active">Active</option>
                                 <option value="Deactive">De-Active</option>
                              </select>
                           </div>
                           <label class="col-sm-2 control-label">&nbsp;</label>
                           <div class="col-sm-4">
                              <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                           </div>
                        </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
                     <div class="content">
                        <div class="fresh-datatables">
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th>S.no</th>
                                 <th>Year</th>
                                 <th>FROM DATE</th>
                                 <th>To DATE</th>
                                 <th>TERMS</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($terms as $rows) { 
                                    $sta=$rows->status;
                                    $yrdata=$rows->from_date;
                                          $month4= strtotime($yrdata);
                                    
                                    $endmonth=$rows->to_date;
                                    $month5= strtotime($endmonth);
                                     ?>
                                 <tr>
                                    <td><?php  echo $i; ?></td>
                                    <?php
                                       $tea_name=$rows->year_id;
                                       
                                       $sQuery = "SELECT * FROM edu_academic_year ";
                                       $objRs=$this->db->query($sQuery);
                                       $row=$objRs->result();
                                       foreach ($row as $rows1)
                                       {
                                       $s= $rows1->year_id;
                                       $fyear=$rows1->from_month;
                                       $month= strtotime($fyear);
                                       $sec=date('Y',$month);
                                       
                                       $eyear=$rows1->to_month;
                                       $month1= strtotime($eyear);
                                       $sec1=date('Y',$month1);
                                       
                                       $arryPlatform = explode(",",$tea_name);
                                       $sPlatform_id  = trim($s);
                                       $sPlatform_name  = trim($sec);
                                       $sPlatform_name1  = trim($sec1);
                                       if (in_array($sPlatform_id, $arryPlatform ))
                                       {   ?>
                                    <td> <?php echo $sec;?>-<?php echo $sec1 ;?></td>
                                    <?php
                                       }
                                       }
                                       ?>
                                    <td><?php  echo date('M-Y',$month4); ?></td>
                                    <td><?php  echo date('M-Y',$month5) ; ?></td>
                                    <td><?php  echo $rows->term_name; ?></td>
                                    <td>
                                       <?php 
                                          if($sta=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <!-- <a href="<?php // echo base_url(); ?>examination/add_exam_subject/<?php //echo $rows->exam_id; ?>" rel="tooltip" title="Added Exam Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                          <i class="fa fa-id-card-o" aria-hidden="true"></i></a> -->
                                       <a href="<?php echo base_url();  ?>years/edit_terms/<?php echo $rows->term_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  }  ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
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
   $(document).ready(function () {
   $('#mastersmenu').addClass('collapse in');
   $('#master').addClass('active');
   $('#masters2').addClass('active');
    $('#myformsection').validate({ // initialize the plugin
        rules: {
   
   
            yexam:{required:true },
   
   
        },
        messages: {
   
   
              yexam: "Please Enter Section Name"
   
   
            }
    });
   });
   
   var $table = $('#bootstrap-table');
         $().ready(function(){
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: true,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize: 8,
                 clickToSelect: false,
                 pageList: [8,10,25,50,100],
   
                 formatShowingRows: function(pageFrom, pageTo, totalRows){
                     //do nothing here, we don't want to show the text "showing x of y from..."
                 },
                 formatRecordsPerPage: function(pageNumber){
                     return pageNumber + " rows visible";
                 },
                 icons: {
                     refresh: 'fa fa-refresh',
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
</script>
<script type="text/javascript">
   $().ready(function(){
   
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
   });
</script>

