
		<style>
   .box{
   padding: 12px 0px 66px 0px;
   border: 2px solid #9a8585;
   }
   .head-count{  text-align: center; border-bottom: 2px solid #9a8585;
   }
   .cnt{font-size: 20px;}
   .alinks{color: #888282;
   font-size: 17px;}
   .fc-month-button{
   display: none;
   }
   .fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
   .fc-scroller{
   overflow-y: hidden;
   overflow-x: hidden;
   height: 265px !important;
   width:300px;
   }
   .fc-toolbar h2{font-size: 20px;}
   .fc-view-container{margin-top: -25px;}
   .img
   {
	   background: url(<?php echo base_url(); ?>assets/img/circular1.png);
	   width: 55px;
       height: 50px;

   }
   .img1
   {
	   background: url(<?php echo base_url(); ?>assets/img/events1.png);
	   width: 55px;
       height: 50px;

   }
   .imgs
   {
	   background: url(<?php echo base_url(); ?>assets/img/leave.png);
	   width: 55px;
       height: 50px;

   }
	 .img4{

		 background: url(<?php echo base_url(); ?>assets/img/attendance1.png);
		width: 55px;
        height: 50px;
	 }
   .plusicon
   {
	  display:inline-block;float: right;
   }
   .design{
	 color:#663366;
    font-size:16px;
	font-weight: bold;

   }
   .setcolor{
    background-color: #323546;
   }
   .textborder{
	    height:58px;
        padding-left:0px;
		border-left:2px solid #c6c6c7;
		float: left;
   }
   .rem{color:white;font-size:18px;text-transform: capitalize;}
	 input[type='radio']:after {
			width: 15px;
			height: 15px;
			border-radius: 15px;
			top: 0px;
			left: -1px;
			position: relative;
			background-color:#a2a09d;
			content: '';
			display: inline-block;
			visibility: visible;
			border: 0px solid white;
	}

	input[type='radio']:checked:after {
			width: 15px;
			height: 15px;
			border-radius: 15px;
			top: 0px;
			left: -1px;
			position: relative;
			background-color:#642160;
			content: '';
			display: inline-block;
			visibility: visible;
			border: 0px solid white;
	}
	.imgdesign{border:1px solid #F5F5F5;height:52px;background-color: #F5F5F5;}
</style>
<div class="main-panel">
<div class="content">
   <div class="card">
      <div class="container-fluid">
         <p style="font-size:25px;padding-left:16px;padding-top: 15px;">Admin Dashboard</p>
         <div class="">
            <div class="row">
               <div class="col-md-12">
                  <div class="col-md-9">
                     <div class="card">
                        <form id="" action="#" method="" novalidate="" style="padding-bottom:30px;">

                           <fieldset id="group2" style="padding-top:20px;">
                              <div class="form-group">
                                 <div class="col-sm-12">

									<input type='radio' name="user_type" value="students" checked style="margin-left:40px;"/><span style="padding-left:10px; padding-right:10px; ">Students</span>
									<input type='radio' name="user_type" value="teachers" /><span style="padding-left:10px;">Teachers</span>

                                    <div class="col-sm-4" style="float:right;margin-right:110px;padding-top:10px;">
                                       <select name="cls_sex" class="form-control" id="class_sec" style="padding:05px;height:30px;">
                                          <option value="">Select Class</option>
										  <?php foreach($class as $rows){?>
                                          <option value="<?php echo $rows->class_sec_id;?>"><?php echo $rows->class_name;?> - <?php echo $rows->sec_name;?></option>
										  <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                           <div class="content">
                              <div class="form-group">
                                 <div class="col-md-10">
                                    <input class="form-control searchbox" name="text" type="text"   id="search_txt" onkeypress="search_load()" autocomplete="off" aria-required="true" placeholder="Search Students,Teacher">
                                 </div>
                                 <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="search_load()">Search </button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <div class="card">
                           <div id="result">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" >
                           <table class="table table-striped">
                              <thead>
                                 <tr style="background-color:#e57b05;">
                                    <th style="color: white;font-size: 15px;">DATE & TIME</th>
									 <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="text-center"><p style="font-size:18px;padding-top:08px;color: #84858d;"><?php  echo date("d M Y"); echo '<br>';?> <span style="font-size:15px;"><?php echo date("l");?></span></p></td>

									 <td>
									 <span class="textborder"></span>
									 <div id="txt" style="font-size:20px;font-weight:bold;color:#84858d;padding-left:13px;
    padding-top:13px;"></div></td>
                                 </tr>

                              </tbody>
                           </table>
                     </div>
                  </div>
               <!---                      -->
			     <div class="col-md-12" style="padding-left:0px; padding-top:15px;padding-bottom:15px;">
				 <div class="col-md-3">
                     <div class="card" style="box-shadow:none;">
					 <div class="imgdesign">
					 <div class="img">
					  <ul style="padding-left:70px;">
					  <li style="padding-top:13px;list-style-type:none;">
					 <a href="<?php echo base_url(); ?>circular/view_circular" class="design">Circular</a>
					 </li>
					 </ul>
					 </div>
					 </div>
					</div>
					 </div>
					 <div class="col-md-3">
                     <div class="card" style="box-shadow:none;">
					  <div class="imgdesign">
					 <div class="img1">
					 <ul style="padding-left:70px;">
					  <li style="padding-top:13px;list-style-type:none;">
					   <a href="<?php echo base_url(); ?>event/create" class="design">Events</a>
					 </li>
					 </ul>
					 </div>
					 </div>
					 </div>
					 </div>
					 <div class="col-md-3" >
                     <div class="card" style="box-shadow:none;">
					  <div class="imgdesign">
					 <div class="imgs">
					  <ul style="padding-left:70px;">
					  <li style="padding-top:13px;list-style-type:none;">
					 <a href="<?php echo base_url(); ?>communication/view_user_leaves" class="design">Teachers<span style="padding-left:7px;">Leave</span></a>
					 </li>
					 </ul>
					 </div>
					 </div>
					 </div>
					 </div>
					 <div class="col-md-3" >
			    <div class="card" style="box-shadow:none;">
				 <div class="imgdesign">
					 <div class="img4">
						<ul style="padding-left:70px;">
						<li style="padding-top:13px;list-style-type:none;">
					 <a href="<?php echo base_url(); ?>adminattendance/monthclass" class="design">Month<span style="padding-left:7px;">Attendance</span></a>
					 </li>
					 </ul>
					 </div>
					 </div>
					 </div>
					 </div>

					 </div>



				</div>
               <hr>
               <div class="col-md-12">
                  <div class="col-md-4">
                     <!-- <div class="card ">
                        <div id="fullCalendar"></div>
                     </div>-->
					  <div class="card">
                        <!-- <div class="header">
                           <h4 class="title" style="float:left;">Reminder</h4>
                        </div>-->
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem">Circular <a href="<?php echo base_url(); ?>circular/add_circular" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span>
									</th>
								</thead>
                                 <tbody>
                                    <?php  if(empty($dash_comm)){} else {$i=1;
                                       	foreach ($dash_comm as $rows) { ?>
                                    <tr>
                                       <td>
                                          <label class="checkbox">
                                          <?php echo $i; ?>
                                          </label>
                                       </td>
                                       <td><?php echo $rows->circular_title;  ?></td>
                                    </tr>
                                    <?php  $i++; } 	}?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card">
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem"> Reminder <a href="<?php echo base_url(); ?>event/home" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span></th>
								</thead>
                                 <tbody>
                                    <?php  if(empty($dash_reminder)){
                                       } else {
                                       	 $i=1;
                                       	foreach ($dash_reminder as $rows1) { ?>
                                    <tr>
                                       <td>
                                          <label class="checkbox">
                                          <?php echo $i; ?>
                                          </label>
                                       </td>
                                       <td><?php echo $rows1->to_do_title;  ?> </td>
                                    </tr>
                                    <?php  $i++; } 	}?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card">
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem">Task & Events <a href="<?php echo base_url(); ?>event/create" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span></th>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
window.onload
{
	startTime();
}



   function search_load(){

   var ser= $("#search_txt").val();
   var user_type=$('input[name=user_type]:checked').val();
   var cls_sec= $("#class_sec").val();
   //alert(cls_sec);

   if(!ser && !user_type && !cls_sec){
   // alert("enter Text");
   $('#result').html('<center style="color:red;">Enter The Text in Search Box</center>');
   }else{
    $.ajax({
       url:'<?php echo base_url(); ?>adminlogin/search',
       method:"POST",
       data:{ser:ser,user_type:user_type,cls_sec:cls_sec},
      //  dataType: "JSON",
      //  cache: false,
       success:function(data)
       {
        //alert(data);
         $('#result').html(data);
         //alert(data['status']);

       }
      });


   }
   }

   function startTime()
{
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i)
{
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

$('input[type="radio"]').on('click change', function(e) {
     $('#result').html(' ');
});

</script>
