<style>
   .txt{
   font-weight: 200;
   }
   th{text-align: center;}
   td{text-align: center;}
</style>
<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <h4 class="title">Attendance for Class in Month </h4>
         <div class="card">
            <div class="content">
               <div class="row">
                  <div class="col-md-12">
                     <div class="">
                        <div class="">
                           <div class="fresh-datatables">
                              <table id="bootstrap-table" class="table">
                                 <thead>
                                    <th data-field="id">S.No</th>
                                    <th data-field="year"  data-sortable="true">Class Name</th>
                                    <th data-field="status"  data-sortable="true">Class Strength</th>
                                    <th data-field="Section" data-sortable="true">View</th>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $i=1;
                                       foreach ($res as $rows) {
                                       ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $rows->class_name.'&nbsp;'.$rows->sec_name; ?></td>
                                       <td><?php echo $rows->total_count;  ?></td>
                                       <td><a href="<?php echo base_url(); ?>adminattendance/month_view_class/<?php echo $rows->class_id;  ?>" class="btn btn-default">Check it</a></td>
                                    </tr>
                                    <?php $i++; } ?>
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
         $('#attend2').addClass('active');
</script>
