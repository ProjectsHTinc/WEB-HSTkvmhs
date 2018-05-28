<style>
   td{
   text-align: center;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content">
                     <div class="header">
                        Message History
                        <a href="<?php echo base_url(); ?>teacherprofile/grouping" class="btn btn pull-right">Send Message</a>
                     </div>
                  </div>
                  <table id="bootstrap-table" class="table">
                     <thead>
                        <th data-field="id" class="text-center">S.No</th>
                        <th data-field="name" class="text-center" data-sortable="true">Group Name</th>
                        <th data-field="Section" class="text-center" data-sortable="true">Type</th>
                        <th data-field="actions" class="td-actions text-left" data-events="operateEvents">Notes</th>
                     </thead>
                     <tbody>
                        <?php $i=1; foreach ($list_of_message as $rowsclass) {  ?>
                        <tr>
                           <td><?php echo $i;  ?></td>
                           <td><?php echo $rowsclass->group_title;  ?><?php echo "<br>"; echo $new_date = date('d-m-Y H:i A', strtotime($rowsclass->created_at));  ?></td>
                           <td><?php echo $rowsclass->notification_type;  ?></td>
                           <td><?php echo $rowsclass->notes;  ?>
                           </td>
                        </tr>
                        <?php $i++;  }  ?>
                     </tbody>
                  </table>
               </div>
               <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#grouping').addClass('active');

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
                 pageSize: 10,
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
         $(document).on("click", ".open-AddBookDialog", function () {
              var eventId = $(this).data('id');
              $(".modal-body #group_id").val( eventId );
         });

</script>
