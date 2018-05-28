<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Teacher Class & Section</h4>
                       </div>

                       <div class="content">

						   <div class="row">
                              <?php

                                if(empty($class_id)){   ?>
                                <div class="col-md-2"><p>No Records Found</p></div>
                                  <?php  }  else{   ?>
                                  <?php   $cnt= count($class_id);
                                   for($i=0;$i<$cnt;$i++){
                                   ?>
                              <div class="col-md-2">
            <a rel="tooltip" href="#myModal" data-toggle="modal" data-target="#addmodel" data-id="<?php echo $class_id[$i]; ?>"  class=" open-AddBookDialog  btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a></div>
                              <?php  } }  ?>
                              </div>

                       </div>
                   </div>
               </div>
           </div><!-- row -->

<script type="text/javascript">
  $(document).on("click", ".open-AddBookDialog", function () {
     var eventId = $(this).data('id');
     $(".modal-body #event_id").val( eventId );
});
</script>
	<!--<div id="test" style="display: none" >  </div>-->

	<div class="modal fade" id="addmodel" role="dialog" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:10px;">
		 <button type="button" class="close" style="margin:25px;" data-dismiss="modal">&times;</button>
		 <h4 class="title">Teacher Class & Section</h4>
		 </div>
		 <div class="modal-body">
                        <p id="msg" style="text-align:center;"></p>
		   <div class="row">

              <div class="col-md-12">

                  <div class="card">

                   <div class="content">
                    <form method="post" action="<?php echo base_url(); ?>homework/create" class="form-horizontal" enctype="multipart/form-data" id="classsection">
					           <fieldset>
                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Type of Test</label>
                                           <div class="col-sm-10">
                                     <label class="radio radio-inline">
                                       <input type="radio" data-toggle="radio" name="test_type" value="Class-Test">Class Test
                                     </label>

									<label class="radio ">
										<input type="radio" data-toggle="radio" name="test_type" value="Home-Test">Home Test
									</label>
									 <input type="text" id="event_id" name="class_id"  class="form-control" value="<?php ?>"/>
                                           </div>
                                        </div>
                               </fieldset>

                             <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Title" name="title" class="form-control">
                                            </div>
											</div>
                            </fieldset>

                              <fieldset>
								 <div class="form-group">
                                            <label class="col-sm-2 control-label">Date</label>
                                            <div class="col-sm-6">
                                              <input type="text" placeholder="Select Date" name="tet_date" class="form-control datepicker" >
                                            </div>
                                 </div>
                             </fieldset>
							 <fieldset>
								 <div class="form-group">
                                            <label class="col-sm-2 control-label">Details</label>
                                            <div class="col-sm-6">
								 <textarea name="details" class="form-control" rows="4" cols="80"></textarea>

                                            </div>

                                 </div>
                             </fieldset>

							  <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                            </div>

                                        </div>
                                    </fieldset>

                           </form>
                       </div>


                  </div><!--  end card  -->
              </div> <!-- end col-md-12 -->
          </div><!-- end row -->

		  </div>
		  </div>
		  </div>
		  </div>






       </div>


   </div>


</div>

<script type="text/javascript">
$('#homeworkmenu').addClass('collapse in');
$('#home').addClass('active');
$('#home1').addClass('active');

/* $(document).ready(function () {

 $('#myformsection').validate({ // initialize the plugin
     rules: {


         sectionname:{required:true },


     },
     messages: {


           sectionname: "Please Enter Section Name"


         }
 });
});

 */


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
