<div class="main-panel">
<div class="content">
  <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="content">
 <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                         <div class="fresh-datatables">
                   <table id="bootstrap-table" class="table">
                       <thead>
                         <th data-field="id" class="text-center">S.no</th>
                         <th data-field="name" class="text-center" data-sortable="true">Class/Section</th>
                         <th data-field="Subject" class="text-center" data-sortable="true">Subject</th>
                         <th data-field="comments" class="text-center" data-sortable="true">Comments</th>
                         <th data-field="DateTime" class="text-center" data-sortable="true">DateTime</th>
                         <th data-field="Remarks" class="text-center" data-sortable="true">Remarks</th>
                       </thead>
                       <tbody>
                         <?php
                         $i=1;
                         foreach ($res as $rows) {
                         ?>
                           <tr>
                             <td><?php echo $i; ?></td>
                             <td><?php echo $rows->class_name; echo "-"; echo $rows ->sec_name; ?> </td>

                           <td><?php echo $rows->subject_name; ?></td>
                            <td><?php echo $rows->comments; ?></td>
                              <td><?php $cls_date = new DateTime($rows->time_date);
echo $cls_date->format('d-m-Y H:i A');  ?></td>
                             <td><?php echo $rows->remarks; ?></td>

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
$('#timetable').addClass('collapse in');
$('#timetable').addClass('active');
$('#timetable').addClass('active');

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
