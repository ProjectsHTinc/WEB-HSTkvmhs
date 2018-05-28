<style>
ul#menu li {
    display:inline;
}
</style>
<div class="main-panel">
<div class="content">
<div class="col-md-12" style="padding-left:0px;">
  <div class="card">





<?php
$date = '2017-05-01';
$end = '2017-05-' . date('t', strtotime($date)); //get end date of month
?>
<table id="bootstrap-table" class="table">
 <thead>
    <tr>
    <?php
      $mon = date('M', strtotime($date));
          echo "<center><b>$mon</b></center>";
            echo "<th style='padding-left:10px;'>S.No </th>";
            echo "<th style='padding-left:10px;'>Name </th>";
     while(strtotime($date) <= strtotime($end)) {
        $day_num = date('d', strtotime($date));
        $day_name = date('l', strtotime($date));

        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));

        echo "<th style='padding-left:10px;'>$day_num </th>";
    }
    ?>
    </tr>
  </thead>
     <tbody>
       <?php  $i=1; foreach($res as $rows){  ?>


       <tr>
         <td> <?php echo $i; ?></td>
          <td><?php  echo $rows->name; $i++;  }  ?></td>
       </tr>
     </tbody>

</table>
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
         $('#admissionmenu').addClass('collapse in');
         $('#admission').addClass('active');
         $('#admission3').addClass('active');
  </script>
