<style>
.formdesign
{
	padding-bottom: 48px;
    padding-top: 10px;
    background-color: rgba(209, 209, 211, 0.11);
    border-radius: 12px;
}
</style>

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
                        <h4 class="title" style="padding-bottom: 20px;">List of Student Registration</h4>
                        <div class="fresh-datatables">
				
                           <div class="toolbar">
	                            <!-- Here you can write extra buttons/actions for the toolbar-->
	                       </div>
						   
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                              <thead>
                                 <th>S.No</th>
                                 <th>Name</th>
                                 <th>Admission No</th>
                                 <th>Blood Group</th>
                                 <th>Class-Section</th>
                                 <th>Registration Date</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                          foreach ($result as $rows) {
                          $stu=$rows->status;
                          ?>
                       <tr>
                          <td><?php echo $i; ?></td>
                          <?php  foreach ($year as $row)
                             {
                                 $fyear=$row->from_month;
                                 $month= strtotime($fyear);
                                 $eyear=$row->to_month;
                                 $month1= strtotime($eyear);
                             }
                             ?>
                         
                          <td><?php echo $rows->name; ?></td>
                          <td><?php echo $rows->admisn_no; ?></td>
                          <td><?php echo $rows->blood_group_name; ?></td>
                          <td><?php echo $rows->class_name; echo "--"; echo $rows->sec_name; ?></td>
                          <td><?php $date=date_create($rows->admit_date);
                             echo date_format($date,"d-m-Y"); ?></td>
                          <td><?php 
                             if($stu=='Active'){?>
                             <button class="btn btn-success btn-fill btn-wd">Active</button>
                             <?php  }else{?>
                             <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                ?>
                          </td>
                          <td>
                             <a href="<?php echo base_url(); ?>admission/get_ad_id1/<?php echo $rows->admission_id; ?>" rel="tooltip" title="View Admission Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                             <i class="fa fa-address-card-o" aria-hidden="true"></i>
                             </a> 
                             <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                          </td>
                       </tr>
									<?php $i++;  }  ?>
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
   jQuery('#enrollmentmenu').addClass('collapse in');
            $('#enroll').addClass('active');
            $('#enroll2').addClass('active');

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

