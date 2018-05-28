<div class="main-panel">

<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header"> 
                           <h4 class="title">Add House Groups  </h4>
                       </div>
                       <div class="content">
                           <form method="post" action="<?php echo base_url(); ?>groups/create_groups" class="form-horizontal" enctype="multipart/form-data" id="groupsformsection" name="groupsformsection">
                                 <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">House Groups</label>
                                          <div class="col-sm-4"> 
										                         <input type="text" name="groups_name" class="form-control"  value="">
                                          </div>
                                          <label class="col-sm-2 control-label">Status</label>
                                          <div class="col-sm-4">
                      										   <select name="status"  class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        											  <option value="Active">Active</option>
                        											  <option value="Deactive">DeActive</option>
                      											</select>
                                          </div>
                                      </div>
                                  </fieldset>
								                   <fieldset>
                                        <div class="form-group">
										                      	<label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
											                         <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Save">
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
                                <th>House Groups</th>
								                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                              </thead>
                              <tbody>
                                <?php
                                  $i=1;
                                  foreach($result as $rows){$stu=$rows->status;
                                ?>
                                  <tr>
                                    <td><?php  echo $i; ?></td>
                                    <td><?php  echo $rows->group_name; ?></td>
									
									 <td><?php 
										  if($stu=='Active'){?>
											<button class="btn btn-success btn-fill btn-wd">Active</button>
										 <?php  }else{?>
										  <button class="btn btn-danger btn-fill btn-wd">DeActive</button>
										  <?php } ?></td>
                                    <td class="text-right">
                                      <a href="<?php echo base_url(); ?>groups/edit_group/<?php echo $rows->id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                  </tr>
							                  <?php $i++;   } ?>
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

$('#curricular').addClass('collapse in');
$('#activities').addClass('active');
$('#curricular2').addClass('active'); 

   $('#groupsformsection').validate({ // initialize the plugin
       rules: {
           groups_name:{required:true },
  		     status:{required:true }
       },
       messages: {
             groups_name:"Please Enter Group Name",
  		       status:"select Status"
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
