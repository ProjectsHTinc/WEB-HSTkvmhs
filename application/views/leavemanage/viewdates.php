<div class="main-panel">
  <div class="content">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
    ×</button> <?php echo $this->session->flashdata('msg'); ?>
    </div>

<?php endif; ?>

<div class="col-md-12">
  <div class="card">
    <div class="content">
      <p>Regular Holiday     <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right">Go Back</button></p>
      <table id="bootstrap-table" class="table">
          <thead>
                <th data-field="id">S.No</th>

                <th data-field="no">Leave Date</th>


                <th data-field="Section">Action</th>
          </thead>
          <tbody>
            <?php
            $i=1;
            //print_r($res);exit;
            foreach ($res as $rows) {

            ?>
              <tr>
                <td><?php echo $i; ?></td>

                  <td><?php $date=date_create($rows->leave_list_date);
                  echo date_format($date,"d-m-Y");  ?> </td>


                <td>

<!-- <a href="<?php echo base_url(); ?>leavemanage/specialedit/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a> -->
<a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)" data-original-title="Remove" onclick="deleteLeave(<?php echo $rows->id; ?>)"><i class="fa fa-remove"></i></a>
                    </td>
              </tr>
              <?php $i++;  }  ?>
          </tbody>
      </table>
    </div>
  </div>
</div>


</div>
</div>

<script type="text/javascript">
$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#leave1').addClass('active');
var $table = $('#bootstrap-table');
      $().ready(function(){
        //  jQuery('#enrollmentmenu').addClass('collapse in');
        //  $('#enroll').addClass('active');
        //  $('#enroll2').addClass('active');
          $table.bootstrapTable({
              toolbar: ".toolbar",
              clickToSelect: true,
              showRefresh: true,
              search: true,
              showToggle: true,
              showColumns: true,
              pagination: true,
              searchAlign: 'left',
              pageSize: 12,
              clickToSelect: false,
              pageList: [25,50,100],

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

function deleteLeave(id){

  swal({
              title: "Are you sure?",
              text: "You Want to Delete the this Date",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes, I am sure!',
              cancelButtonText: "No, cancel it!",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                $.ajax({
                         type: "POST",
                         url: "<?php echo base_url(); ?>leavemanage/deletedate",
                         data : {  id : id },
                         success: function(data){
                           //alert(data)
                         if(data=="success"){
                           swal({title: "Good job", text: "Deleted Successfully!", type: "success"},
                              function(){
                                  location.reload();
                              }
                           );
                         }else{
                           sweetAlert("Oops...", "Something went wrong!", "error");
                         }
                         }
                     });

              } else {
                  swal("Cancelled", "Process Cancel :)", "error");
              }
          });


}
</script>
