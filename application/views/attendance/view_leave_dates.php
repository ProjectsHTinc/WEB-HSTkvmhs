<style>
   .txt{
   font-weight: 200;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="col-md-12">
            <div class="col-md-10">
               <div class="card">
                  <div class="content">
                     <legend>  <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:10px;">Go Back</button>  </legend>
                     <h4 class="title"> List of Record in <?php foreach($get_name_class as $rows){} echo $rows->class_name; echo "-";echo $rows->sec_name;  ?></h4>
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th data-field="id" class="text-center"  data-sortable="true">S.No</th>
                              <th data-field="date" class="text-center" data-sortable="true">Name</th>
                              <th data-field="year" class="text-center" data-sortable="true">No.of.Leaves- in Days </th>
                              <th data-field="check" class="text-center" data-sortable="true">Check Leave dates </th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($res as $rows) {

                                 ?>
                              <tr>
                                 <td class="text-center"><?php echo $i;  ?></td>
                                 <td class="text-center  txt" ><?php echo $rows->name; ?></td>
                                 <td class="text-center"><?php echo $rows->leaves/2; ?></td>
                                  <td class="text-center"><a  href="<?php echo base_url(); ?>adminattendance/view_dates_id/<?php echo $rows->enroll_id; ?>">View</a></td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end content-->
               </div>
               <!--  end card  -->
               </tbody>
               </table>
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
         $('#attend1').addClass('active');
</script>
