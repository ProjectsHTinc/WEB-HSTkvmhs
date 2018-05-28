<div class="main-panel">
<div class="content">

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
                              <h4 class="title">List of Parents</h4>
                                <div class="fresh-datatables">

                               <div class="toolbar">
	                            <!-- Here you can write extra buttons/actions for the toolbar-->
								</div>
						   
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">  
						   
						   <thead>
                                  <th data-field="id">S.No</th>
                                  <th data-field="year"  data-sortable="true"> Name</th>
                                  <th data-field="no"  data-sortable="true">Username</th>
                                   <th data-field="email"  data-sortable="true">Email</th>
                                  <th data-field="name"  data-sortable="true">Created Date</th>
                                  <th data-field="status"  data-sortable="true">Status</th>
                                  <th data-field="Section" data-sortable="true">Action</th>


                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                               // print_r($parents);
                                foreach ($parents as $rows) {

                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->user_name; ?></td>
                                     <td><?php echo $rows->email; ?></td>

                                    <td><?php echo  $new_date = date('d-m-Y - h:i', strtotime($rows->created_date)); ?></td>


                                      <td>
                                        <?php if($rows->status=='Active'){ ?>
                                          <button class="btn btn-success btn-fill btn-wd">Active</button>
                                      <?php  }else{ ?>
                                        <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                                      <?php } ?></td>
                                    <td>



                                      <a href="<?php echo base_url(); ?>userrolemanage/get_user_parents/<?php echo $rows->user_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
$(document).ready(function() {
         $('#usermanagement').addClass('collapse in');
         $('#user').addClass('active');
         $('#user2').addClass('active');

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
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		    responsive: true,
		    language: {
		    search: "_INPUT_",
		    searchPlaceholder: "Search records",
		    }

		});

	});
        
      
         
</script>
