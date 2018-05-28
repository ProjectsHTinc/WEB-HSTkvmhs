

<style>
   .fc-scroller{
   overflow-x: hidden;
   overflow-y: hidden;
   }
   .fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
   .fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
   .fc-month-button{display: none;}
   .textborder{height:120px;
padding-left: 0px;
margin-left: -25px;
border-left: 2px solid #323546;
float: left;}
.imgstyle{padding-bottom: 10px;}
ul li a img:active {
    background-color: yellow;
}
.test{padding-top:05px;text-align: center;padding-left:0px}
.name{padding-left:20px;
font-size: 30px;
font-weight: bold;}
 .plusicon
   {
	  display:inline-block;float:right;
   }
   .design{
	 color: white;
    font-size:30px;

   }
   .setcolor{
    background-color: #323546;
   }
   .rem{color:white;font-size:18px;text-transform: capitalize;}
</style>
<div class="main-panel">
<div class="content">
   <div class="container-fluid">
      <div class="card">
         <div class="row">
            <div class="col-md-12">
               <?php  foreach ($user_details as $rows) {
                  # code...
                  } ?>
               <div class="tab-content">
                  <div class="tab-pane active" id="description-logo">
                     <div class="" style="border:none;box-shadow: none;">

                           <div class="col-md-3" >
                              <?php $pic= $rows->user_pic; if(empty($pic)){
                                 } else{  ?>
                              <img src="<?php echo base_url(); ?>assets/teachers/profile/<?php echo $rows->user_pic; ?>" class="img-responsive img-circle" style="width:125px;">
							  <p class="name"> <?php echo $rows->name; }?> </p>
                           </div>
                           <div class="col-md-3" style="padding-top:20px;">
                              <div class="">
                                <?php
										$dateTime=new DateTime($rows->dob); $dobdate=date_format($dateTime,'d-m-Y' );
										$dob1=$rows->dob;
      								    $from = new DateTime($dob1);
										$to   = new DateTime('today');
									     $currentage=$from->diff($to)->y;?>
                                 <p> Gender :<?php echo $rows->sex; ?></p>
                                 <p>Date Of Birth :<?php echo $dobdate; ?></p>
                                 <p> AGE :<?php echo $currentage; ?></p>
                              </div>

                           </div>
                        <div  class="textborder" style="height:162px;"></div>

						   <div class="col-md-6 test">
		    <ul class="nav nav-icons" style="padding-top: 35px;" role="tablist">
                     <li class="active">
                        <a href="#description-logo" role="tab" data-toggle="tab">
						<i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li>
                        <a href="#map-logo" role="tab" data-toggle="tab">
                        <i class="fa fa-map-marker"></i><br>
                        Location
                        </a>
                     </li>
                     <li class="">
                        <a href="#legal-logo" role="tab" data-toggle="tab">
						<i class="fa fa-phone-square" aria-hidden="true"></i><br>
                        Contact
                        </a>
                     </li>
                     <li class="">
                        <a href="#help-logo" role="tab" data-toggle="tab">
						<i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                        Details
                        </a>
                     </li>
                  </ul>
						   </div>

                     </div>
                  </div>
                  <div class="tab-pane" id="map-logo">

                        <div class="col-md-6" >
                           <div class="header" style="padding-top:0px;">
                              <h4 class="title">Address</h4>
                              <p class="category"><?php echo $rows->address; ?></p>
                           </div>
                        </div>
						 <div  class="textborder" style="height:63px;"></div>
						 <div class="col-md-6" style="padding-top:5px;text-align: center;padding-left:0px;">

		     <ul class="nav nav-icons" role="tablist">
                     <li>
                        <a href="#description-logo" role="tab" data-toggle="tab">
                     <i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li class="active">
                        <a href="#map-logo" role="tab" data-toggle="tab">
                        <i class="fa fa-map-marker"></i><br>
                        Location
                        </a>
                     </li>
                     <li>
                        <a href="#legal-logo" role="tab" data-toggle="tab">
						<i class="fa fa-phone-square" aria-hidden="true"></i><br>

                        Contact
                        </a>
                     </li>
                     <li>
                        <a href="#help-logo" role="tab" data-toggle="tab">
						 <i class="fa fa-file-text-o" aria-hidden="true"></i><br>

                        Details
                        </a>
                     </li>
                  </ul>
						   </div>

                  </div>
                  <div class="tab-pane" id="legal-logo">
                        <div class="col-md-3" style="padding-bottom:25px;" >
                           <div class="header">
                              <h4 class="title">Primary Email</h4>
                              <p class="category"><?php echo $rows->email; ?></p>
                           </div>
                           <div class="header">
                              <h4 class="title">Secondary Email</h4>
                              <p class="category"><?php echo $rows->sec_email; ?></p>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="header">
                              <h4 class="title">Phone Number</h4>
                              <p class="category"><?php echo $rows->phone; ?></p>
                           </div>
                           <div class="header">
                              <h4 class="title">Secondary Phone</h4>
                              <p class="category"><?php echo $rows->sec_phone; ?></p>
                           </div>
                        </div>
						 <div  class="textborder" style="height:140px;"></div>
						 <div class="col-md-5 test">
		      <ul class="nav nav-icons" style="padding-top:30px;" role="tablist">
                     <li>
                        <a href="#description-logo" role="tab" data-toggle="tab">
                      <i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li>
                        <a href="#map-logo" role="tab" data-toggle="tab">
                        <i class="fa fa-map-marker"></i><br>
                        Location
                        </a>
                     </li>
                     <li class="active">
                        <a href="#legal-logo" role="tab" data-toggle="tab">
						<i class="fa fa-phone-square" aria-hidden="true"></i><br>
                        Contact
                        </a>
                     </li>
                     <li>
                        <a href="#help-logo" role="tab" data-toggle="tab">
						<i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                        Details
                        </a>
                     </li>
                  </ul>
						   </div>

                  </div>
                  <div class="tab-pane" id="help-logo">

                        <div class="col-md-3" style="padding-bottom:25px; ">
                           <div class="header">
                              <h6 class="title">Class Teacher </h6>
                              <p class="category"><a> <?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a></p>
                           </div>
						             </div>
  						            <div class="col-md-3" style="padding-bottom:25px; ">
  						              <div class="header">
                                <h6 class="title">Core Subject </h4>
                                <p class="category"><?php echo $rows->subject_name; ?></p>
                             </div>
                          </div>


                        <div  class="textborder" style="height:77px;"></div>
						<div class="col-md-5 test">
		            <ul class="nav nav-icons" role="tablist">
                     <li>
                        <a href="#description-logo" role="tab" data-toggle="tab">
                      <i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li>
                        <a href="#map-logo" role="tab" data-toggle="tab">
                        <i class="fa fa-map-marker"></i><br>
                        Location
                        </a>
                     </li>
                     <li class="">
                        <a href="#legal-logo" role="tab" data-toggle="tab">
					<i class="fa fa-phone-square" aria-hidden="true"></i><br>
                        Contact
                        </a>
                     </li>
                     <li class="active">
                        <a href="#help-logo" role="tab" data-toggle="tab">
						<i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                        Details
                        </a>
                     </li>
                  </ul>
						   </div>

                  </div>
               </div>
               <!-- end tab content -->
            </div>
            <!-- end col-md-8 -->
         </div>
      </div>
      <div class="col-md-12">
         <div class="col-md-6">
            <div class="card ">

               <div class="content" style="padding-top:0px;">
                  <div class="table-full-width">
                     <table class="table">
					 <thead class="setcolor">
						<th colspan="2" style="padding-bottom: 8px;"><span class="rem"> UpComing Events <a href="<?php echo base_url(); ?>teacherevent/home" >
						<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/view1.png"/></a></span></th>
								</thead>
                        <tbody>
                           <?php  if(empty($das_events)){
                              } else {
                              	 $i=1;
                              	foreach ($das_events as $rows) { ?>
                           <tr>
                              <td>
                                 <label class="checkbox">
                                 <?php echo $i; ?>
                                 </label>
                              </td>
                              <td><?php echo $new_date = date('d-m-Y', strtotime($rows->event_date));  ?> &nbsp; <?php echo $rows->event_name; ?></td>
                           </tr>
                           <?php  $i++; } 	}?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card">
               <div id="fullCalendar"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {

   	$('#dash').addClass('active');


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
   }
   ,

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

</script>
