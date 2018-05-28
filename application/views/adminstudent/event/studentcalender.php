<style>
.fc-month-button{
	display: none;
	}
.fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
	</style>

	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="content">
								<div class="header">
										<legend>Event Calendar </legend>

								</div>
								<div class="container-fluid">
									<div class="row">
									<div class="col-md-8">
										<center>
											<div class="card card-calendar">
													<div class="content">

															<div id="fullCalendar"></div>

													</div>
											</div>
										</center>
									</div>


									<div class="col-md-4">

										<div class="card">
                            <div class="header">Add to Reminder</div>
                            <div class="content">
                                <form method="post" action="#" id="to_do_form">
                                    <div class="form-group">
                                        <label>Pick Date</label>
                                        <input type="text" name="to_do_date" placeholder="" class="form-control datepicker">
                                    </div>
                                    <div class="form-group">
                                        <label>To Do List</label>
                                        <input type="text" name="to_do_list" placeholder="To Do List" class="form-control">
                                    </div>
																		<div class="form-group">
                                        <label>Notes</label>
                                        <textarea id="comments" name="to_do_notes" name="comments" class="form-control"></textarea>
                                    </div>


                                    <button type="submit" class="btn btn-fill btn-info">Save</button>
                                </form>
                            </div>
                        </div>
								</div> <!-- end card -->
									</div>
							</div>
					</div>
			</div>
		  		  </div>
    		</div>
				</div>
				<script>

	$(document).ready(function() {
		$('#events').addClass('collapse in');
$('#events').addClass('active');
$('#events').addClass('active');
		$('#fullCalendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: new Date(),
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			// events:"<?php echo base_url() ?>event/getall_act_event",
			eventSources: [
	 {
		 url: '<?php echo base_url() ?>event/getall_act_event',
		 color: 'yellow',
		 textColor: 'black'
	 },
	 {
		 url: '<?php echo base_url() ?>event/get_all_regularleave',
		 color: 'blue',
		 textColor: 'white'
	 },
	 {
		url: '<?php echo base_url() ?>teacherevent/view_all_reminder',
		color: 'red',
		textColor: 'white'
	}
 ],
			eventMouseover: function(calEvent, jsEvent) {
    var tooltip = '<div class="tooltipevent" style="width:auto;height:auto;background-color:#000;color:#fff;position:absolute;z-index:10001;padding:20px;">' + calEvent.description + '</div>';
    var $tooltip = $(tooltip).appendTo('body');

    $(this).mouseover(function(e) {
        $(this).css('z-index', 10000);
        $tooltip.fadeIn('500');
        $tooltip.fadeTo('10', 1.9);
    }).mousemove(function(e) {
        $tooltip.css('top', e.pageY + 10);
        $tooltip.css('left', e.pageX + 20);
    });
},

eventMouseout: function(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.tooltipevent').remove();
},

		});




	});

	$('#to_do_form').validate({ // initialize the plugin
	    rules: {
	        to_do_date:{required:true },
	        to_do_list:{required:true },
					to_do_notes:{required:true },
	    },
	    messages: {
	          to_do_date: "Select date",
	          to_do_list:"Enter To Do List",
						to_do_notes:"Enter Some Notes"

	        },
	      submitHandler: function(form) {
	        //alert("hi");
	        swal({
	                      title: "Are you sure?",
	                      text: "You Want Confrim this form",
	                      type: "success",
	                      showCancelButton: true,
	                      confirmButtonColor: '#DD6B55',
	                      confirmButtonText: 'Yes, I am sure!',
	                      cancelButtonText: "No, cancel it!",
	                      closeOnConfirm: false,
	                      closeOnCancel: false
	                  },
	                  function(isConfirm) {
	                      if (isConfirm) {
	       $.ajax({
	           url: "<?php echo base_url(); ?>teacherevent/todolist",
	            type:'POST',
	           data: $('#to_do_form').serialize(),
	           success: function(response) {
	               if(response=="success"){
	                //  swal("Success!", "Thanks for Your Note!", "success");
	                  $('#to_do_form')[0].reset();
	                  swal({
	           title: "Wow!",
	           text: "Message!",
	           type: "success"
	       }, function() {
	           window.location = "<?php echo base_url(); ?>teacherevent/calender";
	       });
	               }else{
	                 sweetAlert("Oops...", "Something went wrong!", "error");
	               }
	           }
	       });
	     }else{
	         swal("Cancelled", "Process Cancel :)", "error");
	     }
	   });
	}
	});



		    </script>
