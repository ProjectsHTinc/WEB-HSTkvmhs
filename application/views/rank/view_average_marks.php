<style>
.exam_name{
  display: inline-flex;
}
.exam_name p{
  border: 1px solid #cdcdd2;
  padding-left: 10px;
  padding-right: 10px;
}
</style>
<div class="main-panel">
   <div class="content">
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <div class="fresh-datatables">
                           <h4 class="title" style="padding-bottom:10px;">List of Rank based on <?php echo $marktype; ?> <br>
                             <div class="exam_name"><?php foreach($exam_id as $row_exam){  ?>

                              <p class=""><?php  echo $row_exam->exam_name;  ?></p>
                            <?php  }  ?></div>
                            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-bottom:10px;">Go Back</button> </h4>
                           <div class="toolbar">
                           </div>
                       <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                          <thead>
                             <th>S.no</th>
                             <th>Student-Name</th>
                             <th>Rank</th>
                             <th>Total</th>
                          </thead>
                          <tbody>
                          <?php
                            $s=1;
                            foreach($res_student as $rows){
                               ?>
                              <tr>
                                <td><?php echo $s; ?></td>
                                <td><?php echo $rows->name; ?></td>
                                <td><?php echo $s; ?> </td>
                                <td><?php echo round($rows->total,2); ?></td>

                             </tr>
                             <?php  $s++;  }  ?>
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
   $(document).ready(function() {
   $('#rank').addClass('collapse in');
   $('#rank').addClass('active');
   $('#rank').addClass('active');
   $('#example').DataTable({
      dom: 'lBfrtip',
      buttons: [
           {
               extend: 'excelHtml5',
               exportOptions: {
               columns: ':visible'
               }
           },
           {
               extend: 'pdfHtml5',
               exportOptions: {
               columns: ':visible'
               }
           },
           'colvis'
       ],
       "pagingType": "full_numbers",
       "lengthMenu": [[50, -1], [10, 25, 50, "All"]],
       responsive: true,
       language: {
       search: "_INPUT_",
       searchPlaceholder: "Search records",
       }
         });
      });


</script>
