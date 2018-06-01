<style>
.fc-month-button{
	display: none;
	}
.fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
.red{    background-color: red;
    color: red;
    padding-left: 10px;}
		.Words{
			padding-left: 10px;
    font-size: 20px;
		}
.fc-event{
	background-color: red;
	}	</style>

	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="content">
								<div class="header">
									<?php  //echo json_encode($res); ?>
										<legend>Attendance Calender </legend>

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

									<div class="col-md-4 text-center">
										<div class="row" style="padding-top: 150px;">
											<h5>Total Working days</h5>
											<p> <?php if(empty($total)){

											} else{
												echo count($total);
											}?> </p>
										</div>
										<div class="Words">
									Absent & Leave -
																				<?php if(empty($ableavedays)){

									} else{
										echo count($ableavedays);
									}?>
																				</div>
										<div class="noote" style="    display: inline-flex;   ">
										<div class="notice">
											<p class="red">1</p>
										</div>
										<div class="Words">
											Absent
										</div>
									</div>
										</div>

							</div>
					</div>
			</div>
		  		  </div>
    		</div>
				</div>
				<script>

	$(document).ready(function() {
$('#attendence').addClass('collapse in');
 $('#attendence').addClass('active');
 $('#attendence').addClass('active');
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
			events: 	<?php  echo json_encode($res); ?>,

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

		    </script>
