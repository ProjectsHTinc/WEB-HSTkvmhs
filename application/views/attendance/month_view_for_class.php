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
                              <th data-field="month" class="text-center" data-sortable="true">Month</th>
                              <th data-field="year" class="text-center" data-sortable="true">No.of.Leaves- in Days </th>
                              <th data-field="pp" class="text-center" data-sortable="true">No.of.Present- in Days </th>
                              <th data-field="check" class="text-center" data-sortable="true">Check Leave dates </th>
                           </thead>
                           <p>Total Working Days 
                           <?php if($res_total['status']=="success"){echo $wrk= $res_total['result']; }else{echo "No data"; } ?> 
                           </p>
                           <tbody>
                              <?php
                               
                              
                                 $i=1;
                                 foreach ($res as $rows) {

                                 ?>
                              <tr>
                                 <td class="text-center"><?php echo $i;  ?></td>
                                 <td class="text-center  txt" ><?php echo $rows->name; ?></td>
                                  <td class="text-center  txt" ><?php  echo date("F", strtotime('00-'.$month.'-01')); ?></td>
                                 <td class="text-center"><?php echo $ab=$rows->leaves; ?></td>
                                 <td class="text-center"><?php echo $pp=$wrk-$ab; ?></td>
                                 
                                  <td class="text-center">
                                    <input type="hidden" name="month_id" id="month_id" value="<?php echo $month;  ?>">
                                    <input type="hidden" name="year_id" id="year_id" value="<?php echo $year;  ?>">

                                    <button onclick="list_dates(<?php echo $rows->enroll_id;   ?>)" value="">View</button> </td>
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
                 <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Leave Dates</h4>
              </div>
              <div class="modal-body">
              <table id="bootstrap-table" class="table">
                 <thead>
                <tr>
                  <th>Leavedates</th><th>Status</th>
                </tr>
              </thead>
              <tbody id="leavesdates12">

              </tbody>
              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
function list_dates(student_id){
  //alert("hi");
  var month_id=$("#month_id").val();
  var year_id=$("#year_id").val();
  var student_id=student_id;
//  alert(student_id);
  $.ajax({
    type: 'POST',
    url: '<?php  echo base_url(); ?>adminattendance/view_dates_id',
    data: {month_id: month_id, year_id: year_id,student_id:student_id},
    dataType: "JSON",
    cache: false,
    success: function(response) {
//alert(response)
     $("#leavesdates12").empty();
      $('#myModal').modal('show');
       var res=response.res;
       var stat=response.status;
       var len=res.length;

        if(stat=="success"){
          for (i = 0; i < len; i++) {
          var markup = "<tr><td>" + res[i].abs_date + "</td><td>" + res[i].a_status + "</td></tr>";
          $("#leavesdates12").append(markup);
          }
        }else if(stat=="nodata"){
          $("#leavesdates12").empty();
          var markup = "<tr><td>No Record</td><td>No Record</td></tr>";
          $("#leavesdates12").append(markup);
        }
        else{
          var markup = "no data";
          $("#leavesdates12").append(markup);
        }
    }
});
}


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
