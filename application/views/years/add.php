<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Add Exam Details</h4>

                       </div>

                       <div class="content">
                           <form method="post" action="<?php echo base_url(); ?>years/create" class="form-horizontal" enctype="multipart/form-data" id="myformsection">

                                 <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">FROM MONTH</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="from_month" class="form-control" value="">

                                          </div>
                                          <label class="col-sm-2 control-label">END MONTH</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="end_month" class="form-control"  />
                                          </div>

                                      </div>
                                  </fieldset>
                                        <div class="form-group">


											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Save Years</button>
                                            </div>

                                            </div>
                                    </fieldset>

                             </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
</div>

<?php endif; ?>
       <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">

                                <div class="fresh-datatables">



                          <table id="bootstrap-table" class="table">
                              <thead>

                                <th>S.no</th>
                                <th>FROM MONTH</th>
								<th>END MONTH</th>
                                <th class="disabled-sorting text-right">Actions</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows) {
                                ?>
                                  <tr>
                                    <td><?php  echo $i; ?></td>
                                    <td><?php  echo $rows->from_month	; ?></td>
									 <td><?php echo $rows->to_month; ?></td>
                                    <td class="text-right">
								<!--	<a href="<?php echo base_url(); ?>examination/add_exam_subject/<?php //echo $rows->exam_id; ?>" rel="tooltip" title="Added Exam Details" class="btn btn-simple btn-info btn-icon table-action view" >
									<i class="fa fa-id-card-o" aria-hidden="true"></i></a> -->

                                      <a href="<?php echo base_url();  ?>examination/edit_exam/<?php //echo $rows->exam_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>


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

<script type="text/javascript">

$(document).ready(function () {
jQuery('#yearsmenu').addClass('collapse in');
 $('#myformsection').validate({ // initialize the plugin
     rules: {


         yexam:{required:true },


     },
     messages: {


           yexam: "Please Enter Section Name"


         }
 });
});

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
