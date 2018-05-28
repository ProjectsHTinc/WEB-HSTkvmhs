<div class="main-panel">
<div class="content">
  <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <div class="card">
                   <?php if($this->session->flashdata('msg')): ?>
                     <div class="alert alert-success">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                   ×</button> <?php echo $this->session->flashdata('msg'); ?>
                 </div>
                 <?php endif; ?>
                     <div class="content">
 <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                         <div class="fresh-datatables">



                   <table id="bootstrap-table" class="table">
                       <thead>

                           <th data-field="id">S.no</th>
                         <th data-field="name" data-sortable="true">Class/Section</th>
                          <th data-field="username" data-sortable="true">Name</th>
                         <th data-field="Subject"  data-sortable="true">Subject</th>
                         <th data-field="Period"  data-sortable="true">Period</th>
                         <th data-field="comments"  data-sortable="true">Comments</th>
                          <th data-field="DateTime"  data-sortable="true">DateTime</th>
                          <th data-field="Remarks"  data-sortable="true">Remarks</th>
                            <th data-field="Action"  data-sortable="true">Action</th>


                       </thead>
                       <tbody>
                         <?php
                         $i=1;
                         foreach ($res as $rows) {
                         ?>
                           <tr>
                             <td><?php echo $i; ?></td>
                             <td><?php echo $rows->class_name; echo "-"; echo $rows ->sec_name; ?> </td>
                               <td><?php echo $rows->name; ?></td>
                           <td><?php echo $rows->subject_name; ?></td>
                            <td><?php echo $rows->period_id; ?></td>
                            <td><?php echo $rows->comments; ?></td>
                              <td><?php $cls_date = new DateTime($rows->time_date);
echo $cls_date->format('d-m-Y H:i A');  ?></td>
                             <td><?php echo $rows->remarks; ?></td>
                              <td>  <a href="<?php echo base_url(); ?>timetable/edit_review/<?php echo $rows->timetable_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
              </td>
                           </tr>
                           <?php $i++;  }  ?>
                       </tbody>
                   </table>

                 </div>
                     </div><!-- end content-->
                 </div><!--  end card  -->
             </div> <!-- end col-md-12 -->
         </div> <!-- end row -->

     </div>
 </div>
</div>
</div>

<script>

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
<script>
jQuery('#timetablemenu').addClass('collapse in');
$('#time').addClass('active');
$('#time2').addClass('active');
</script>
