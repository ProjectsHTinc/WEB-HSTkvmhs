<!doctype html>
<html lang="en">
   <head>
      <!-- <meta charset="utf-8" /> -->
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>ENSYFI</title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta name="viewport" content="width=device-width" />
      <!-- Bootstrap core CSS     -->
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
      <!--  Light Bootstrap Dashboard core CSS    -->
      <link href="<?php echo base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
      <!--  CSS for Demo Purpose, don't include it in your project     -->
      <link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
      <!--     Fonts and icons     -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stroke/css/pe-icon-7-stroke.css">
	    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
      <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
      <!--  Forms Validations Plugin -->
      <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>
      <!-- PDF -->
      <script src="<?php echo base_url(); ?>assets/js/jspdf.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/jspdf.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/FileSaver.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/js/jspdf.plugin.table.js" type="text/javascript"></script>
	  
	  <!-- Excel -->
	  <script src="<?php echo base_url(); ?>assets/js/jquery.table2excel.js" type="text/javascript"></script>
	  
     
      <style>
         .navbar{
         margin-bottom:0px;}
         .caret{
         position: relative;
         top: -20px;
         float: right;
         }
         .alert button.close {
         position: relative;top:10px;
         }
         .error{
         color: red;
         font-weight: 500;
         }
         .title_ensyfi{
         color:#fff!important; margin-left: 10px!important; padding-left: 175px !important;
         }
         .abox{border: 1px solid grey;}
         .topbar{background-color:#642160 ;height:99px;}
         .imgclass{margin:0px;float:left;}
         .imgstyle1{width:40px;height:40px;}
         body{position: absolute;
         height: 100%;
         width: 100%;
         background-color: whitesmoke;}
         .sidemenubcolor{background-color: #1e202c;}
		 .menuimg{
           float: left;
           margin-right: 10px;
         }
      </style>
   </head>
   <body>
      <div class="wrapper">
      <nav class="navbar navbar-default topbar">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>

               <a class="navbar-brand title_ensyfi" href="#" style="color:white; margin-left:10px; margin-top:25px;
    font-size:25px;">
			   <?php $sql="SELECT name,user_id,user_type FROM edu_users WHERE user_id='1' AND user_type='1'";
                              $res=$this->db->query($sql);
                              $rows=$res->result();
                              foreach ($rows as $rows3){} $uname=$rows3->name;
							  echo $uname; ?></a>
            </div>
            <div class="collapse navbar-collapse"  style="float:right;padding-top: 18px;">
               <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown" style="padding:08px 10px;">
                     <a href="#" class="dropdown-toggle abox" data-toggle="dropdown" style="padding:03px 15px;font-size: 12px; color: white;border-color: white;text-transform: uppercase;">
                     Quick Links</a>
                     <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>teacheronduty/home">On Duty Form</a></li>
						 <li><a href="<?php echo base_url(); ?>teachercommunication/home">Apply Leaves </a></li>
                        <li><a href="<?php echo base_url(); ?>teacheronduty/special_class_details">Special Class </a></li>
                        <li><a href="<?php echo base_url(); ?>teacheronduty/view_substitution">Substitution </a></li>
						
                          <!--  <li><a href="<?php echo base_url(); ?>extracurricular/home">Extra curricular  </a></li>
                           <li><a href="<?php echo base_url(); ?>specialclass/home">Special Class</a></li> -->
                     </ul>
                  </li>
                  <li class="dropdown dropdown-with-icons">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin:3px;">
                        <div class="photo">
                           <?php
                              $user_id=$this->session->userdata('user_id');
                              $user_type=$this->session->userdata('user_type');
                              $query="SELECT user_pic FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
                              $objRs=$this->db->query($query);
                              $row=$objRs->result();
                              foreach ($row as $rows1)
                              {
                               $pic=$rows1->user_pic;
                               if($pic!='')
                               {?>
                           <img src="<?php echo base_url(); ?>assets/teachers/profile/<?php echo $pic; ?>" class="img-circle img-responsive imgstyle1"/>
                           <?php }else{
                              ?> <img src="<?php echo base_url(); ?>assets/noimg.png" class="img-circle img-responsive imgstyle1" />
                           <?php }} ?>
                        </div>
                        <b class="caret" style="margin-left:55px;color:white;"></b>
                     </a>
                     <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                           <a href="<?php echo base_url(); ?>teacherprofile/profilepic">
                           <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/profile.png"/> Profile
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>teacherprofile/profile">
                           <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/setting.png"/>  Setting
                           </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                           <a href="<?php echo base_url(); ?>adminlogin/logout" class="text-danger">
                           <i class="pe-7s-close-circle"></i>
                           Log out
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="sidebar sidemenu">
         <!-- <div class="logo sidemenubcolor"  style="padding:0px 70px;height:115px">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/ensyfi.png" style="height:115px;"  />
         </div> -->
         <div class="sidebar-wrapper" style="background-color:#323546;">
            <div class="user" style="margin-top:10px;padding-bottom:22px;">
               <div class="imgclass photo" style="margin-left:20px;">
                  <?php
                     $user_id=$this->session->userdata('user_id');
                     $user_type=$this->session->userdata('user_type');
                     $query="SELECT user_pic FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
                     $objRs=$this->db->query($query);
                     $row=$objRs->result();
                     foreach ($row as $rows1)
                     {
                      $pic=$rows1->user_pic;
                      if($pic!='')
                      {?>
                  <img class="img-responsive" style="width:80px;height:80px;" src="<?php echo base_url(); ?>assets/teachers/profile/<?php echo $pic; ?>" >
                  <?php }else{
                     ?> <img class="img-responsive" src="<?php echo base_url(); ?>assets/noimg.png"  />
                  <?php }} ?>
               </div>
               <div class="info">
                  <a  href="" style="padding-top:25px;">
                  <?php
                     $user_id=$this->session->userdata('user_id');
                     $user_type=$this->session->userdata('user_type');
                     $query="SELECT name FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
                     $objRs=$this->db->query($query);
                     $rows=$objRs->result();
                     foreach ($rows as $rows2)
                     { }echo '<p>'; echo"Welcome, "; echo $rows2->name; echo '</p>';?>
                  </a>
               </div>
            </div>
            <ul class="nav">
               <li class="" id="dash">
                  <a href="<?php echo base_url(); ?>">
                     <i class="pe-7s-home"></i>
                     <p>Dashboard</p>
                  </a>
               </li>
               <li id="classhandling">
                  <a href="<?php echo base_url(); ?>teachertimetable/classhandling_subject">
                      <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/classhandling.png"/>
                     <p>Class Handling 	</p>
                  </a>

               </li>

               <li id="grouping">
                  <a href="<?php echo base_url(); ?>teacherprofile/grouping">
                      <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/classhandling.png"/>
                     <p>Group Message 	</p>
                  </a>

               </li>
               <li id="atten">
                  <a data-toggle="collapse" href="#attendmenu">
				   <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/Attendance.png"/>
                    <!-- <i class="pe-7s-note2"></i>-->
                     <p>Attendance	</p>
                     <b class="caret"></b>
                  </a>
                  <div class="collapse" id="attendmenu">
                     <ul class="nav">
                        <li id="atten1"><a href="<?php echo base_url();  ?>teacherattendence/home">Update Attendance</a></li>
                        <li id="atten2"><a href="<?php echo base_url();  ?>teacherattendence/view">View Attendance</a></li>
                        <li id="atten3"><a href="<?php echo base_url();  ?>teacherattendence/monthview">Month view</a></li>
                     </ul>
                  </div>
               </li>
               <li id="home">
                  <a href="<?php echo base_url(); ?>homework/home">
                   <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/homework&classtest.png"/>
                     <p>Home Work / Class Test	</p>
                  </a>
               </li>
               <li id="exam">
                  <a data-toggle="collapse" href="#examinationmenu">
                     <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/Results.png"/>
                     <p>Examination Result</p>
                     <b class="caret"></b>
                  </a>
                  <div class="collapse" id="examinationmenu">
                     <ul class="nav">
                        <li id="exam3"><a href="<?php echo base_url(); ?>examinationresult/exam_namefor_duty"> Exam Duty</a></li>
						<li id="exam4"><a href="<?php echo base_url(); ?>examinationresult/exname"> Add & View Exam Marks</a></li>
                        <!-- <li id="exam1"><a href="<?php echo base_url(); ?>examinationresult/home">Add Exam Marks</a></li> -->
                        <li id="exam2"><a href="<?php echo base_url(); ?>examinationresult/view_exam_name_marks">Edit Exam Marks</a></li>
                     </ul>
                  </div>
               </li>
			   <li id="stuonduty">
                  <a href="<?php echo base_url(); ?>teacheronduty/view_class">
                     <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/on duty.png"/>
                     <p>Student Onduty </p>
                  </a>
				  </li>
               <li id="calendar">
                  <a data-toggle="collapse" href="#calendermenu">
                     <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/calender.png"/>
                     <p>Calendar	</p>
                     <b class="caret"></b>
                  </a>
                  <div class="collapse" id="calendermenu">
                     <ul class="nav">
                        <li id="calendar1"><a href="<?php echo base_url(); ?>teacherevent/calender">Calendar</a></li>
                        <li id="calendar2"><a href="<?php echo base_url(); ?>teacherevent/home">List of Event</a></li>
                     </ul>
                  </div>
               </li>
               <li id="comm">
                  <a data-toggle="collapse" href="#commmenu">
                    <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/circular.png"/>
                     <p>Circular</p>
                     <b class="caret"></b>
                  </a>
                  <div class="collapse" id="commmenu">
                     <ul class="nav">
                      
                        <li id="comm2"><a href="<?php echo base_url(); ?>teachercommunication/view_circular">View Circulars</a></li>
                     </ul>
                  </div>
               </li>
               <li id="timetable">
                  <a data-toggle="collapse" href="#timetablemenu">
                   <img class="menuimg" src="<?php echo base_url(); ?>assets/img/icons/timetable.png"/>
                     <p>Time Table	</p>
                     <b class="caret"></b>
                  </a>
                  <div class="collapse" id="timetablemenu">
                     <ul class="nav">
                        <li id="timetable1"><a href="<?php echo base_url(); ?>teachertimetable/teachertimetable">Teacher Time Table</a></li>
                        <li id="timetable2"><a href="<?php echo base_url(); ?>teachertimetable/home">Time Table</a></li>
                        <li id="timetable2"><a href="<?php echo base_url(); ?>teachertimetable/reviewview">Reviews</a></li>
                     </ul>
                  </div>
               </li>
            </ul>
         </div>
      </div>
