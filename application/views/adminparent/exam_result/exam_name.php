

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Examination Name <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php 
                           if(empty($exam)){echo "<p style=text-align:center;color:red;>Admin doesn't Approve The Reportcard </p>";}else{
                             foreach($stu_id as $sid){}
                                $stu_id=$sid->enroll_id;
                           $cls_id=$sid->class_id;
                           //echo $stu_id;
                           foreach($exam as $row)
                           {
                           $ex_name=$row->exam_name;
                           $exam_id=$row->exam_id;
                           //  echo $ex_name;
                           // echo $exam_year;
                           ?>
                        <div class="col-md-2">
                           <a rel="tooltip" href="<?php echo base_url(); ?>adminparent/exam_results/<?php echo $exam_id; ?>/<?php echo $stu_id;?>/<?php echo $cls_id;?>"  class="btn btn-wd"><?php echo $ex_name; ?></a>
                        </div>
                        <?php } }?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
         <!-- end row -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
    $('#examinationmenu').addClass('collapse in');
    $('#exam').addClass('active');
    $('#exam2').addClass('active');
   
    });
    
</script>
<script type="text/javascript">
   $().ready(function(){
   
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
   });
</script>
<script type="text/javascript">
   function changeText(id) 
   {
    $('#myModal').modal('show');
    //alert(id);
       $.ajax({
             type: 'post',
             url: '<?php echo base_url(); ?>homework/checker',
             data: {
                 id:id
             },
           dataType: 'json',
   
            success: function(test1)
      {
   	    
   		
                 if (test1.status=='Success') {
                  
                     var sub = test1.subject_name;
   			//alert(sub.length);
                     var sub_id = test1.subject_id;
                     var len=sub.length;
   			//alert(len);
                     var i;
                     var name = '';
                   
                     for (i = 0; i < len; i++) {
                         name += '<option value='+ sub_id[i] +'>'+ sub[i] + '</option> ';
                         $("#ajaxres").html(name);
                         $('#msg').html('');
                     }
                 } else {
   			
   			$('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   			  $("#ajaxres").html('');
   
                 }  
             }
    
    
   });
   }
   
   $(document).on("click", ".open-AddBookDialog", function () {
      var eventId = $(this).data('id');
      $(".modal-body #event_id").val( eventId );
   });
   
</script>

