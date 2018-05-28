<?php

Class Dashboard extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  function getYear()
  {
      $sqlYear     = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year   = $year_result->result();

      if ($year_result->num_rows() == 1) {
          foreach ($year_result->result() as $rows) {
              $year_id = $rows->year_id;
          }
          return $year_id;
      }
  }

    function get_user_count_student(){
        $query="SELECT COUNT(enroll_id) AS user_count FROM  edu_enrollment WHERE admit_year=1";
        $result=$this->db->query($query);
        return  $result->result();

    }

    function get_user_count_parents(){
        $query="SELECT COUNT(id) AS user_count FROM  edu_parents WHERE STATUS='Active'";
        $result=$this->db->query($query);
        return  $result->result();

    }
    function dash_teacher_users(){
      $query="SELECT COUNT(teacher_id) AS user_count FROM  edu_teachers WHERE STATUS='Active'";
      $result=$this->db->query($query);
      return  $result->result();
    }


    function dash_events(){
      $query="SELECT * FROM edu_events WHERE STATUS='Active' AND  event_date>=CURDATE() ORDER BY event_id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();

    }


    function dash_users(){
      $query="SELECT * FROM edu_users WHERE STATUS='Active' ORDER BY user_id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();
    }

    function dash_comm()
	{
		 $get_year="SELECT * FROM edu_academic_year WHERE CURDATE()>=from_month AND CURDATE()<=to_month";
		  $result1=$this->db->query($get_year);
		   $all_year= $result1->result();
		  if($result1->num_rows()==0){
           }else{
          foreach($all_year as $cyear){}
	      $current_year=$cyear->year_id;
           $query="SELECT c.id,c.circular_master_id,c.circular_date,cm.id,cm.circular_title,cm.status,cm.academic_year_id FROM edu_circular AS c,edu_circular_master AS cm WHERE cm.status='Active' AND c.circular_master_id=cm.id AND cm.academic_year_id='$current_year' ORDER BY c.id DESC LIMIT 5";
          $result=$this->db->query($query);
          return  $result->result();
          }
    }

	function dash_reminder($user_id){
      $query="SELECT * FROM edu_reminder WHERE user_id='$user_id' AND STATUS='Active' ORDER BY id DESC LIMIT 5";
      $result=$this->db->query($query);
      return  $result->result();
    }

     function save_profile_id($user_profile_id,$status){
       $query="UPDATE edu_users SET status='$status' WHERE user_id='$user_profile_id'";
       $result=$this->db->query($query);
       $data= array("status"=>"success");
       return $data;
     }

	 // Get All Class And Section

	 function get_all_class_sec()
	 {
		 $sql="SELECT c.class_name,c.class_id,s.sec_name,s.sec_id,cm.class_sec_id,cm.class,cm.section,cm.status FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id AND cm.status='Active' ORDER BY c.class_name";
		 $result1=$this->db->query($sql);
         return  $result1->result();
	 }

    //  forgotpassword


    function forgotpassword($username)
	{
      $query="SELECT user_type,teacher_id,parent_id,student_id FROM edu_users WHERE user_name='$username'";
      $result=$this->db->query($query);
       if($result->num_rows()==0){
         echo "Username Not found";
       }else{
          foreach($result->result() as $row){}
           $type_name= $row->user_type;
        switch ($type_name) {

          case '2':
               $type_id= $row->teacher_id;
               $digits = 6;
               $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
               $reset_pwd=md5($OTP);
               $reset="UPDATE edu_users SET user_password='$reset_pwd' WHERE teacher_id='$type_id'";
               $result_pwd=$this->db->query($reset);
               $query="SELECT email FROM edu_teachers WHERE teacher_id='$type_id'";
               $result=$this->db->query($query);
               foreach($result->result() as $row){}
               $to_mail= $row->email;
               $to = $to_mail;
               $subject = '"Password Reset"';
               $htmlContent = '
                 <html>
                 <head>  <title></title>
                 </head>
                 <body>
                 <center><p>Hi Your Account Password is Reset.Please Use Below Password to login</p></center>
                   <table cellspacing="0">

                         <tr>
                             <th>Password:</th><td>'.$OTP.'</td>
                         </tr>
                         <tr>
                             <th></th><td><a href="'.base_url() .'">Click here  to Login</a></td>
                         </tr>
                     </table>
                 </body>
                 </html>';

             // Set content-type header for sending HTML email
             $headers = "MIME-Version: 1.0" . "\r\n";
             $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
             // Additional headers
             $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
             $sent= mail($to,$subject,$htmlContent,$headers);
             if($sent){
                 echo "Password  Reset and send to your Mail Please check it";
             }else{
               echo "Somthing Went Wrong";
             }


              exit;
            break;
          case '3':
              $type_id= $row->student_id;
              $digits = 6;
              $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
              $reset_pwd=md5($OTP);
              $reset="UPDATE edu_users SET user_password='$reset_pwd' WHERE student_id='$type_id'";
              $result_pwd=$this->db->query($reset);
              $query="SELECT email,mobile FROM edu_admission WHERE admission_id='$type_id'";
              $result=$this->db->query($query);
              foreach($result->result() as $row){}
              $to_mail= $row->email;
			  $cell= $row->mobile;

			  if(!empty($to_mail)){
              $to = $to_mail;
              $subject = '"Password Reset"';
              $htmlContent = '
                <html>
                <head>  <title></title>
                </head>
                <body>
                <center><p>Hi Your Account Password is Reset.Please Use Below Password to login</p></center>
                  <table cellspacing="0">


                        <tr>
                            <th>Password:</th><td>'.$OTP.'</td>
                        </tr>
                        <tr>
                            <th></th><td><a href="'.base_url() .'">Click here to Login</a></td>
                        </tr>
                    </table>
                </body>
                </html>';

            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // Additional headers
            $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
            $sent= mail($to,$subject,$htmlContent,$headers);
		  }
			if(!empty($cell))
		   {
			$userdetails="Password : ".$OTP.", ";
			 //echo $userdetails;
			$textmsg =urlencode($userdetails);
			$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
			$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
			$api_params = $api_element.'&numbers='.$cell.'&message='.$textmsg;
			$smsgatewaydata = $smsGatewayUrl.$api_params;
			$url = $smsgatewaydata;
			 //echo $url;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			curl_close($ch);
		  }

            if($sent  || !empty($cell)){
                echo "Password  Reset and send to your Mail Please check it";
            }else{
              echo "Somthing Went Wrong";
            }

            break;
          case '4':
            $type_id= $row->parent_id;
            $digits = 6;
            $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $reset_pwd=md5($OTP);
            $reset="UPDATE edu_users SET user_password='$reset_pwd' WHERE parent_id='$type_id'";
            $result_pwd=$this->db->query($reset);
            $query="SELECT email,mobile FROM edu_parents WHERE id='$type_id'";
            $result=$this->db->query($query);
            foreach($result->result() as $row){}
            $to_mail= $row->email;
			$cell= $row->mobile;
			//$name= $row->name;

			//echo $to_mail; echo $cell; exit;

			if(!empty($to_mail)){
            $to = $to_mail;
            $subject = '"Password Reset"';
            $htmlContent = '
              <html>
              <head>  <title></title>
              </head>
              <body>
              <center><p>Hi Your Account Password is Reset.Please Use Below Password to login</p></center>
                <table cellspacing="0">

                      <tr>
                          <th>Password:</th><td>'.$OTP.'</td>
                      </tr>
                      <tr>
                          <th></th><td><a href="'.base_url() .'">Click here  to Login</a></td>
                      </tr>
                  </table>
              </body>
              </html>';

          // Set content-type header for sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          // Additional headers
          $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
          $sent= mail($to,$subject,$htmlContent,$headers);
			}

		if(!empty($cell))
		  {
			$userdetails="Password : ".$OTP.", ";
			 //echo $userdetails;
			$textmsg =urlencode($userdetails);
			$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
			$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
			$api_params = $api_element.'&numbers='.$cell.'&message='.$textmsg;
			$smsgatewaydata = $smsGatewayUrl.$api_params;
			$url = $smsgatewaydata;
			 //echo $url;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			curl_close($ch);
		 }
          if($sent || !empty($cell)){
              echo "Password  Reset and send to your Mail Please check it";
          }else{
            echo "Somthing Went Wrong";
          }

            break;
          default:
            echo "No result found";
            break;
        }



       }

    }

      // Search function in Admin Panel

     function search_data($ser_txt,$user_type,$class_sec){
         $year_id = $this->getYear();
       if($user_type=="students"){
		   if(empty($class_sec)){
        //  $query="SELECT * FROM edu_enrollment AS ee WHERE ee.name LIKE '$ser_txt%'";
        // $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c WHERE e.class_id=cm.class_sec_id AND e.status='Active' and       cm.class=c.class_id and cm.section=s.sec_id  and e.name LIKE '$ser_txt%'";
        $query="SELECT a.name,a.sex,c.class_name,a.admission_id,s.sec_name,
       (SELECT GROUP_CONCAT(p.name,'- (',p.mobile,')' SEPARATOR ',') FROM edu_parents AS p
       WHERE FIND_IN_SET (p.id,a.parnt_guardn_id)) AS parentsname FROM edu_admission AS a
       INNER JOIN edu_enrollment AS e ON a.admission_id= e.admission_id INNER JOIN edu_classmaster AS cm ON e.class_id = cm.class_sec_id
       INNER JOIN edu_class AS c ON  cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE e.admit_year='$year_id' AND e.name LIKE '$ser_txt%'";

         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
    <th>S.no</th>
    <th>Students</th>
    <th>Gender</th>
    <th>Class</th>
    <th style="width:300px;">Parents Name</th>
    <th>Edit</th>
    </tr>
  ';
   $i=1;
     foreach($result->result() as $row){

    $output .= '
     <tr>
     <td>'.$i.'</td>
    <td>'.$row->name.'</td>
    <td>'.$row->sex.'</td>
    <td>'.$row->class_name.'-'.$row->sec_name.'</td>
    <td>'.$row->parentsname.'</td>
	 <td><a href="'. base_url().'admission/get_ad_id/'.$row->admission_id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
     </tr>
    ';
     $i++;
         }
         echo $output;}
	   }else{
		 // $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c WHERE cm.class_sec_id='$class_sec' AND e.status='Active' AND
     //  e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id and e.name LIKE '$ser_txt%'";
     $query="SELECT a.name,a.sex,c.class_name,a.admission_id,s.sec_name,
    (SELECT GROUP_CONCAT(p.name,'- (',p.mobile,')' SEPARATOR ',') FROM edu_parents AS p
    WHERE FIND_IN_SET (p.id,a.parnt_guardn_id)) AS parentsname FROM edu_admission AS a
    INNER JOIN edu_enrollment AS e ON a.admission_id= e.admission_id INNER JOIN edu_classmaster AS cm ON e.class_id = cm.class_sec_id
    INNER JOIN edu_class AS c ON  cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE e.class_id='$class_sec' AND e.admit_year='$year_id' AND   e.name LIKE '$ser_txt%'";

         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>S.no</th>
     <th>Students</th>
     <th>Gender</th>
     <th>Class</th>
     <th style="width:300px;">Parents Name</th>
	   <th>Edit</th>
    </tr>
  ';
  $i=1;
     foreach($result->result() as $row){
    $output .= '
     <tr>
       <td>'.$i.'</td>
      <td>'.$row->name.'</td>
      <td>'.$row->sex.'</td>
      <td>'.$row->class_name.'-'.$row->sec_name.'</td>
      <td>'.$row->parentsname.'</td>
	 <td><a href="'. base_url().'admission/get_ad_id/'.$row->admission_id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
     </tr>
    ';
    $i++;
         } echo $output;}

	   }
       }else if($user_type=="parents"){
        $query="SELECT et.teacher_id,et.name,et.phone,et.email,c.class_name,s.sec_name,et.status FROM edu_teachers AS et JOIN edu_classmaster AS cm, edu_sections AS s,edu_class AS c WHERE et.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND et.name LIKE '$ser_txt%'";

       }else if($user_type=="teachers"){
		   if(empty($class_sec))
		   {
        $query="SELECT et.name,et.phone,et.email,et.teacher_id,c.class_name,s.sec_name,et.status FROM edu_teachers AS et
        LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id WHERE et.name LIKE '$ser_txt%'";
         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>S.no </th>
     <th>Name </th>
     <th>phone No</th>
     <th>Class Teacher</th>
     <th>Email </th>
	   <th>Edit</th>
    </tr>
  ';
  $i=1;
     foreach($result->result() as $row){
    $output .= '
     <tr>
       <td>'.$i.'</td>
      <td>'.$row->name.'</td>
      <td>'.$row->phone.'</td>
      <td>'.$row->class_name.'-'.$row->sec_name.'</td>
      <td>'.$row->email.'</td>
	  <td><a href="'. base_url().'teacher/get_teacher_id/'.$row->teacher_id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
     </tr>
    ';
    $i++;
         }echo $output;}
		   }else{
	     $query="SELECT et.name,et.phone,et.email,et.teacher_id,et.class_teacher,estc.teacher_id,estc.class_master_id,estc.status,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_teacher_handling_subject AS estc LEFT JOIN edu_teachers AS et ON et.teacher_id=estc.teacher_id LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id
       LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS se ON cm.section=se.sec_id  WHERE  estc.class_master_id='$class_sec' GROUP BY estc.teacher_id";
         $result=$this->db->query($query);
         if($result->num_rows()==0){
          echo "No Data Found";
         }else{
          $output='
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Name </th>
     <th>phone No</th>
     <th>Class Teacher</th>
     <th>Email </th>

	 <th>Edit</th>
    </tr>
  ';
     foreach($result->result() as $row){
    $output .= '
     <tr>
      <td>'.$row->name.'</td>
      <td>'.$row->phone.'</td>
      <td>'.$row->class_name.'-'.$row->sec_name.'</td>
      <td>'.$row->email.'</td>

	  <td><a href="'. base_url().'teacher/get_teacher_id/'.$row->teacher_id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
     </tr>
    ';
         }echo $output;}
		   }
     }else{
          echo "No Data Found";
       }

   }

   //Notifications

 function pending_leave(){
        $query="SELECT l.leave_id,l.user_id,et.name FROM edu_user_leave AS l LEFT JOIN edu_teachers  AS et ON et.teacher_id=l.user_id WHERE l.status='P' LIMIT 5";
        $result12=$this->db->query($query);
        return  $result12->result();
      }
//Admin  Teacher

    function dash_teacher($user_id){
   $query="SELECT ed.teacher_id,ed.*,et.*,c.class_name,s.sec_name,esu.subject_name FROM edu_users  AS ed LEFT JOIN edu_teachers AS et ON  et.teacher_id=ed.teacher_id LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE ed.user_id='$user_id'";

  $result12=$this->db->query($query);
  return  $result12->result();

    }



    // Admin students

    function dash_students($user_id){
 $query="SELECT ed.name,ed.user_pic,ed.student_id,ea.admisn_year,ea.admisn_no,ea.admission_id,ee.name,ee.class_id,ea.sex,ea.age,ea.dob,ea.mother_tongue,ea.mobile,ea.email,ea.student_pic,c.class_name,s.sec_name FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE ed.user_id='$user_id'";
$result12=$this->db->query($query);
return  $result12->result();
    }



    function get_special(){
      $query="SELECT c.leave_date AS START,c.leaves_name AS title FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday'";
      $res=$this->db->query($query);
      return $res->result();
    }
// Admin Parents

  function dash_parents($user_id){
    $query="SELECT eu.user_id,eu.user_pic,eu.parent_id,ep.name,ep.* FROM edu_users AS eu INNER JOIN edu_parents AS ep ON eu.parent_id=ep.id WHERE eu.user_id='$user_id'";
    $res=$this->db->query($query);
    $rows=$res->result();
	//return $rows;
	foreach($rows as $rows1){} $aid=$rows1->admission_id;
	//echo $aid;exit;
	 $query1="SELECT * FROM edu_parents WHERE admission_id IN($aid)";
    $res1=$this->db->query($query1);
    return $res1->result();
  }
  function get_students($user_id)
  {
    $query="SELECT eu.user_id,eu.parent_id,ep.name,ep.admission_id FROM edu_users AS eu LEFT JOIN edu_parents AS ep ON eu.parent_id=ep.id WHERE eu.user_id='$user_id'";
    $res=$this->db->query($query);
    foreach($res->result() as $rows){ }
    $pare_id= $rows->parent_id;

    $get_stude="SELECT ee.name,ee.class_id,c.class_name,s.sec_name,ee.enroll_id,ed.* FROM edu_admission AS ed LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ed.admission_id INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id
INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE FIND_IN_SET('$pare_id',ed.parnt_guardn_id)";
    $res1=$this->db->query($get_stude);
    return $res1->result();
  }

  function stud_details($user_id){
    $query="SELECT eu.user_id,eu.parent_id,ep.name,ep.admission_id FROM edu_users AS eu LEFT JOIN edu_parents AS ep ON eu.parent_id=ep.id WHERE eu.user_id='$user_id'";
    $res=$this->db->query($query);
    foreach($res->result() as $rows){ }
    $pare_id= $rows->parent_id;

    $get_stude="SELECT ee.name,ee.class_id,c.class_name,s.sec_name,ee.enroll_id,ed.* FROM edu_admission AS ed LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ed.admission_id INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id
INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE FIND_IN_SET('$pare_id',ed.parnt_guardn_id)";
    $res1=$this->db->query($get_stude);
    return $res1->result();
  }
  function get_students_cls_id($user_id){
	    $user_id=$this->session->userdata('user_id');
        $get_enroll_id="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ee.enroll_id,ee.class_id FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id
        LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE ed.user_id='$user_id'";

        $results=$this->db->query($get_enroll_id);
		$ress=$results->result();
        //foreach($results->result() as $rows){}
        //return $class_id=$rows->class_id;
		return $ress;

  }


    function total_working_days(){
      $query="SELECT created_at FROM edu_attendence WHERE ac_year=1  GROUP BY CAST(created_at AS DATE) ";
      $results=$this->db->query($query);
      return $results->result();

    }

function get_students_circular($user_id)
  {
	   $get_year="SELECT * FROM edu_academic_year WHERE CURDATE()>=from_month AND CURDATE()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  if($result1->num_rows()==0){ }else{
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;

		  $com="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.id,cm.academic_year_id,cm.circular_title,cm.circular_description,cm.status FROM edu_circular AS c,edu_circular_master AS cm WHERE c.user_id='$user_id' AND c.user_type=3 AND cm.academic_year_id='$current_year' AND c.circular_master_id=cm.id AND cm.status='Active' ORDER BY c.id DESC LIMIT 5 ";
		 //$sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$teacher_id',teacher_id) ";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
		  }
  }


  function get_parents_circular($user_id)
  {
	      $get_year="SELECT * FROM edu_academic_year WHERE CURDATE()>=from_month AND CURDATE()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  if($result1->num_rows()==0){ }else{
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;

		  $com="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.id,cm.academic_year_id,cm.circular_title,cm.circular_description,cm.status FROM edu_circular AS c,edu_circular_master AS cm WHERE c.user_id='$user_id' AND c.user_type=4 AND cm.academic_year_id='$current_year' AND c.circular_master_id=cm.id AND cm.status='Active' ORDER BY c.id DESC  LIMIT 5 ";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
		  }
  }

}
?>
