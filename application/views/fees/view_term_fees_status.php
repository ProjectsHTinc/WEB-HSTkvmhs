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
                                  <h4 class="title">Fees Status</h4>
                          <table id="bootstrap-table" class="table">
                              <thead>
                                 <th data-field="id" class="text-left">S.No</th>
								  <th data-field="notes" class="text-left" data-sortable="true">Student Name</th>
                                <th data-field="year" class="text-left" data-sortable="true">Year</th>
                                <th data-field="term" class="text-left" data-sortable="true">Term Name</th>
                                <th data-field="class" class="text-left" data-sortable="true">Class</th>
                                <th data-field="quota" class="text-left" data-sortable="true">Quota</th>
								<th data-field="fees" class="text-left" data-sortable="true">Fees Amount</th>
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
									<td class="text-left"><?php echo $rows->name;?></td>
                                    <td class="text-left"><?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?></td>
                                    <td class="text-left"><?php echo $rows->term_name; ?></td>
                                    <td class="text-left"><?php echo $rows->class_name; ?> - <?php echo $rows->	sec_name; ?></td>
                  									<td class="text-left"><?php echo $rows->quota_name;?></td>
                  									<td class="text-left"><?php echo $rows->fees_amt;?></td>

                  									 <td><?php
                  									  if($stu=='Unpaid'){?>
                  									  <button class="btn btn-danger btn-fill btn-wd">UnPaid</button>
                  									 <?php  }else{?>
                  									   <button class="btn btn-success btn-fill btn-wd">Paid</button>

                  									  <?php } ?></td>

                                    <td class="text-left">
                                        <a href="<?php echo base_url(); ?>feesstructure/edit_term_fees_status/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
 var $table = $('#bootstrap-table');

       $().ready(function(){
		   $('#feesmenu').addClass('collapse in');
        $('#payment').addClass('active');
        $('#fees1').addClass('active');
         //jQuery('#teachermenu').addClass('collapse in');
           $table.bootstrapTable({
               toolbar: ".toolbar",
               clickToSelect: true,
               showRefresh: true,
               search: true,
               showToggle: true,
               showColumns: true,
               pagination: true,
               searchAlign: 'left',
               pageSize:10,
               clickToSelect: false,
               pageList: [10,15,25,50,100],

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
