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
                                  <h4 class="title">View All Circular </h4>
                                <div class="dtypo-line" style="padding:30px;">
                                    <div class="row">
                                       <?php
									   if(empty($circular)){ echo "No Circular Found";}else{
                                $i=1;
                                foreach ($circular as $rows) {

                                ?>
                                        <div class="col-md-10">
                                            <h5><?php echo $i; ?>. <?php echo $rows->circular_title; ?> </h5>
                                            <blockquote>
                                               <p><?php echo $rows->circular_description; ?></p>
                                               <small>

                                                  <cite title="Source Title">
	           <?php $dateTime=new DateTime($rows->circular_date); $fdate=date_format($dateTime,'d-m-Y' ); echo $fdate; ?></cite>
                                               </small>
                                            </blockquote>
                                        </div>
									   <?php $i++;  }  }?>
                                    </div>
                                </div>
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
   $('#commmenu').addClass('collapse in');
     $('#comm').addClass('active');
     $('#comm2').addClass('active');
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
