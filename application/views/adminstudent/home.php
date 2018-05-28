<style>
   .fc-scroller{
   overflow-x: hidden;
   overflow-y: hidden;
   }
   
   .fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
   .fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
   .fc-month-button{display: none;}

   .textborder{height:130px;
   padding-left: 0px;
   margin-left: -25px;
   border-left:2px solid #323546;
   float: left;}
   .imgstyle{padding-bottom: 10px;}
   ul li a img:active {
       background-color: yellow;
   }
   .test{padding-top: 15px;text-align: center;padding-left:0px}
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
               <?php  foreach ($user_details as $rows) {} ?>
               <div class="tab-content">
                  <div class="tab-pane active" id="description-logo">
                     <div class="" style="border:none;box-shadow: none;">
                           <div class="col-md-3" >
                              <?php $pic= $rows->user_pic; if(empty($pic)){?>
								         <img src="<?php echo base_url(); ?>assets/noimg.png" class="img-circle img-responsive imgstyle1" /> 
                               <?php  }else{  ?>
                              <img src="<?php echo base_url(); ?>assets/students/profile/<?php echo $rows->user_pic; ?>" class="img-responsive img-circle" style="width:125px;">
							          <p class="name"> <?php echo $rows->name; }?> </p>
                           </div>
                           <div class="col-md-3" style="padding-top:05px;">
                              <div class="">
							   <?php
                                 $dateTime=new DateTime($rows->dob); $fdate=date_format($dateTime,'d-m-Y' );
         								 $dob1=$rows->dob;
         								 $from = new DateTime($dob1);
         								 $to   = new DateTime('today');
         								 $currentage=$from->diff($to)->y;?>
                              <p> Name :<?php echo $rows->name; ?></p>
                              <p> Gender :<?php echo $rows->sex; ?></p>
                              <p>Date Of Birth :<?php echo $fdate; ?></p>
                              <p> AGE :<?php echo $currentage; ?></p>
                              </div>
							  
                           </div>
                        <div  class="textborder"></div>
						   
						   <div class="col-md-6 test">
		            <ul class="nav nav-icons" role="tablist">
                  <li class="active">
                     <a href="#description-logo" role="tab" data-toggle="tab">
                    <i class="fa fa-user" aria-hidden="true"></i><br>
                     Profile
                     </a>
                  </li>
                  <li>
                     <a href="#map-logo" role="tab" data-toggle="tab">
                       <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                     Contact
                     </a>
                  </li>
                  <li>
                     <a href="#help-logo" role="tab" data-toggle="tab">
                    <i class="fa fa-file-text" aria-hidden="true"></i> <br>
                     Details
                     </a>
                  </li>
                </ul>
						   </div>
                     
                     </div>
                  </div>
                  <div class="tab-pane" id="map-logo">
                    
                        <div class="col-md-3" >
                        <div class="header" style="padding-top:05px;">
                           <h4 class="title">Primary Email</h4>
                           <p class="category"><?php echo $rows->email; ?></p>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="header" style="padding-top:05px;">
                           <h4 class="title">Phone Number</h4>
                           <p class="category"><?php echo $rows->mobile; ?></p>
                        </div>
                     </div>
						 <div  class="textborder" style="height:55px;"></div>
						 <div class="col-md-6" style="text-align:center;padding-left:0px;">
		           <ul class="nav nav-icons" role="tablist" style="padding-top:5px;">
                     <li>
                        <a href="#description-logo" role="tab" data-toggle="tab">
                     <i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li class="active">
                        <a href="#map-logo" role="tab" data-toggle="tab">
                       <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                        Contact
                        </a>
                     </li>
                     <li>
                        <a href="#help-logo" role="tab" data-toggle="tab">
                      <i class="fa fa-file-text" aria-hidden="true"></i> <br>
                     Details
                     </a>
                     </li>
                  </ul>
						   </div>
                    
                  </div>
       
                  <div class="tab-pane" id="help-logo">
                        <div class="col-md-3">
                           <div class="header" style="padding-top:05px;">
                              <h4 class="title">Class</h4>
                              <p class="category"><a> <?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a></p>
                           </div>
						   </div>
						    <div class="col-md-3" >
						    <div class="header" style="padding-top:05px;">
                              <h4 class="title">Mother Tongue</h4>
                              <p class="category"><?php echo $rows->mother_tongue; ?></p>
                           </div>
                        </div>
                        <div  class="textborder" style="height:55px;"></div>
						 <div class="col-md-6" style="text-align: center;padding-left:0px;">
		             <ul class="nav nav-icons" role="tablist" style="padding-top:5px;">
                     <li>
                        <a href="#description-logo" role="tab" data-toggle="tab">
                     <i class="fa fa-user" aria-hidden="true"></i><br>
                        Profile
                        </a>
                     </li>
                     <li>
                        <a href="#map-logo" role="tab" data-toggle="tab">
                       <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                        Contact
                        </a>
                     </li>
                     <li  class="active">
                        <a href="#help-logo" role="tab" data-toggle="tab">
                      <i class="fa fa-file-text" aria-hidden="true"></i> <br>
                     Details
                     </a>
                     </li>
                  </ul>
						   </div>
                    
                  </div>
               </div>
               <!-- end tab content -->
            </div>
      </div>
   </div>
  
   
         <div class="col-md-12">
		 <div class="col-md-6">
            <div class="card">
               <div id="fullCalendar"></div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card ">
               <div class="header" style="background-color:#1e202c;padding: 10px;">
                     <h4 class="title" style="color: white;">Circular 
					 <a href="<?php echo base_url();?>student/view_all_circular" >
						<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/view1.png"/></a></h4>
                  </div>
                  <div class="content content-full-width">
                     <div class="panel-group" id="accordion">
                        <?php //echo count($stud_details);
                           if(empty($stud_circular)){
                           	echo "<p> No Circular Found </p>";
                           }else{
                           	foreach($stud_circular as $circular){ ?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-target="#collapseOneHover<?php echo $circular->id; ?>" href="" data-toggle="collapse-hover">
                                 <?php echo $circular->circular_title;?>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOneHover<?php echo $circular->id; ?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php echo $circular->circular_description;?>
                              </div>
                           </div>
                        </div>
                        <?php }}?>
                     </div>
                     <!-- <a href="<?php echo base_url();?>student/view_all_circular" class="btn btn-social btn-simple btn-twitter">View All</a> -->
                  </div>
            </div>
         </div>
      </div>
	 
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
    $('#dashboard').addClass('collapse in');
   $('#dashboard').addClass('active');
   $('#dashboard').addClass('active');
   
   
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
    url: '<?php echo base_url() ?>student/get_all_regularleave',
    color: 'blue',
    textColor: 'white'
   },
   
   {
   url: '<?php echo base_url() ?>student/get_all_special_leave',
   color: 'pink',
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

