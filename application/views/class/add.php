<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Add Class</h4>
                           <p class="pull-right btn btn-wd" style="margin-top:-30px;"><a href="<?php echo base_url(); ?>sectionadd/addsection">Add / View Section</a></p>
                       </div>

                       <div class="content">
                           <form action="<?php echo base_url(); ?>classadd/createclass" method="post" enctype="multipart/form-data" id="myformclass">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label class="col-sm-2 control-label">Class</label>
                                           <input type="text" class="form-control"  placeholder="" id="classname" name="classname" value="">
                                      </div></div>
									  <div class="col-md-5">
                                       <div class="form-group">
									  <label class="col-sm-2 control-label">Status</label>
										   <select name="status"  class="selectpicker form-control">
												  <option value="Active">Active</option>
												  <option value="Deactive">DeActive</option>
											</select>
                                       </div>
                                   </div>
                               </div>
                           <button type="submit" class="btn btn-info btn-fill pull-left">Add</button>
                               <div class="clearfix"></div>
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

                                 <th>ID</th>
                                <th>Class</th>
								<th>Status</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach($result as $rows){$sta=$rows->status;
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->class_name; ?></td>
									<td>
										<?php 
										if($sta=='Active'){?>
										<button class="btn btn-success btn-fill btn-wd">Active</button>
										<?php  }else{?>
										<button class="btn btn-danger btn-fill btn-wd">De Active</button>
										<?php } ?>
								   </td>

                                    <td>
                                      <a href="<?php echo base_url();  ?>classadd/updateclass/<?php echo $rows->class_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                      <!-- <a href="<?php echo base_url();  ?>classadd/delete_class/<?php echo $rows->class_id; ?>" class="btn btn-simple btn-danger btn-icon "><i class="fa fa-times"></i></a> -->


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

  $('#mastersmenu').addClass('collapse in');
  $('#master').addClass('active');
  $('#masters3').addClass('active');



 $('#myformclass').validate({ // initialize the plugin
     rules: {


         classname:{required:true
           },


     },
     messages: {


           classname: "Please Enter Class Name"


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
