

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
                           <h4 class="title">Fees Status(<?php  if(empty($fees)){ echo " Fees Status Not Found";}else{  foreach ($fees as $rows){ } echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month)); } ?> ) </h4>
                           <div class="dtypo-line" style="padding:30px;">
                              <div class="row">
                                 <?php
                                    if(empty($fees)){ echo "Fees Status Not Found";}else{
                                                        $i=1;
                                                        foreach ($fees as $rows){$paid=$rows->status;
                                    
                                                        ?>
                                 <div class="col-md-10">
                                    <h5><?php echo $i; ?>. <?php echo $rows->term_name;  ?> ( <button class="btn btn-social btn-simple btn-linkedin"> Due Date : <?php $date=date_create($rows->due_date_to);
                                       echo date_format($date,"d-m-Y");  ?> </button>  ) </h5>
                                    <blockquote>
                                       <p><?php echo $rows->notes; ?><span style="float: right;"> <?php 
                                          if($paid=='Paid'){?>
                                          <button class="btn btn-success btn-fill btn-wd">Paid</button>
                                          <?php  }else{?>
                                          <button class="btn btn-danger btn-fill btn-wd">Unpaid</button>
                                          <?php } ?> </span>
                                       </p>
                                       <small>
                                       <cite title="Source Title">
                                       <?php $date=date_create($rows->due_date_from);
                                          echo date_format($date,"d-m-Y");?></cite>
                                       </small>
                                    </blockquote>
                                 </div>
                                 <?php $i++;  }  }?>
                              </div>
                           </div>
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
   var $table = $('#bootstrap-table');
    $('#fees').addClass('collapse in');
     $('#fees').addClass('active');
     $('#fees').addClass('active');
         $().ready(function(){
           jQuery('#teachermenu').addClass('collapse in');
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

