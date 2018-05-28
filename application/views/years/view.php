<div class="main-panel">
<div class="content">
       <div class="container-fluid">
                    <div class="row">
              <div class="col-md-12">

                  <div class="card">
                    <div class="header">
                        <h4 class="title">Years</h4>

                    </div>

                      <table id="bootstrap-table" class="table">
                          <thead>

                            <th data-field="id" class="text-center">ID</th>
                            <th data-field="name" class="text-center" data-sortable="true">From month</th>
                            <th data-field="Section" class="text-center" data-sortable="true">End Month</th>


                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($years as $rowsclass) { ?>
                              <tr>
                                <td><?php echo $i;  ?></td>
                                <td><?php echo $rowsclass->from_month;  ?></td>
                                <td><?php echo $rowsclass->to_month;  ?></td>
                              </tr>
                              <?php $i++;  }  ?>
                          </tbody>
                      </table>
                  </div>


                  <div class="card">
                    <div class="header">
                        <h4 class="title">Terms</h4>

                    </div>

                      <table id="bootstrap-table1" class="table">
                          <thead>

                              <th data-field="id" class="text-center">ID</th>
                            <th data-field="name" class="text-center" data-sortable="true">From month</th>
                            <th data-field="Section" class="text-center" data-sortable="true">End Month</th>
                            <th data-field="term" class="text-center" data-sortable="true">Terms Name</th>


                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($terms as $rowsclass) { ?>
                              <tr>
                                <td><?php echo $i;  ?></td>
                                <td><?php echo $rowsclass->from_date;  ?></td>
                                <td><?php echo $rowsclass->to_date;  ?></td>
                                  <td><?php echo $rowsclass->term_name;  ?></td>
                              </tr>
                              <?php $i++;  }  ?>
                          </tbody>
                      </table>
                  </div>


                  <!--  end card  -->
              </div> <!-- end col-md-12 -->
          </div> <!-- end row -->
       </div>
   </div>
</div>
<style>
th{text-align: center;}
td{text-align: center;}
</style>
<script type="text/javascript">
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
       var $table = $('#bootstrap-table1');
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

jQuery('#yearsmenu').addClass('collapse in');
             });

</script>
