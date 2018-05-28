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

                                <div class="fresh-datatables">
                                  <h4 class="title">Fees Status1</h4>
                                  <table id="example" class="table table-fixed">
                              <thead>
                                 <th data-field="id" class="text-left">S.No</th>
                                <th data-field="year" class="text-left" data-sortable="true">Year</th>
                                <th data-field="term" class="text-left" data-sortable="true">Term Name</th>
                                <th data-field="class" class="text-left" data-sortable="true">Class</th>
                                 <th data-field="quota" class="text-left" data-sortable="true">Quota</th>
								                 <th data-field="fees" class="text-left" data-sortable="true">Fees Amount</th>
                                <th data-field="date_from" class="text-left" data-sortable="true">From Date </th>
                                <th data-field="date_to" class="text-left" data-sortable="true">To Date </th>
                                <!-- <th data-field="notes" class="text-left" data-sortable="true">Notes</th> -->
                                <th data-field="status" class="text-left" data-sortable="true">Status</th>
								<th data-field="Section" class="text-left" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($view as $rows) {
								   $stu=$rows->status;

                                ?>
                                  <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
                                    <td class="text-left"><?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?></td>
                                    <td class="text-left"><?php echo $rows->term_name; ?></td>
                                    <td class="text-left"><?php echo $rows->class_name; ?> - <?php echo $rows->	sec_name; ?></td>
                  									<td class="text-left"><?php echo $rows->quota_name;?></td>
                  									<td class="text-left"><?php echo $rows->fees_amount;?></td>
                  									<td class="text-left"><?php $date=date_create($rows->due_date_from);
                                                         echo date_format($date,"d-m-Y");?></td>
                  									<td class="text-left"><?php $date=date_create($rows->due_date_to);
                                                         echo date_format($date,"d-m-Y");?></td>
                  									<!-- <td class="text-left"><?php //echo $rows->notes;?></td>-->
                  									 <td><?php
                  									  if($stu=='Active'){?>
                  									   <button class="btn btn-success btn-fill btn-wd">Active</button>
                  									 <?php  }else{?>
                  									  <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                  									  <?php } ?></td>

                                    <td class="text-left">
                                        <a href="<?php echo base_url(); ?>feesstructure/view_term_fees/<?php echo $rows->id; ?>" rel="tooltip" title="Fees Status For Students" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
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
$('#feesmenu').addClass('collapse in');
$('#payment').addClass('active');
$('#fees1').addClass('active');


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
  },
  "fixedHeader" : {
                  header : true,
                  footer : true
              }
});



</script>
