<?php

Class Enrollmentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  public function getYear()
    {
      $sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year = $year_result->result();

      if($year_result->num_rows()==1)
      {
        foreach ($year_result->result() as $rows)
        {
            $year_id = $rows->year_id;
        }
        return $year_id;
      }
    }

//CREATE ADMISSION   ad_enrollment

        function ad_enrollment($admisnid,$admit_year,$formatted_date,$admisn_no,$name,$class,$quota_id,$groups_id,$activity_id,$status){
        	//echo $admisn_no; echo'<br>'; echo $admisnid;
			$year_id=$this->getYear();
          $check_email="SELECT * FROM edu_enrollment WHERE admit_year='$admit_year' AND admit_year='$year_id' AND admisn_no='$admisn_no'";
          $result=$this->db->query($check_email);
          if($result->num_rows()==0){

			  $digits = 6;
		      $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
			  //echo $OTP;
              $md5pwd=md5($OTP);

			  $admisn="select name,admission_id,admisn_no from edu_admission WHERE admisn_no='".$admisn_no."'"; 
     	      $resultset = $this->db->query($admisn);
		      foreach ($resultset->result() as $rows)
		      {}
			    if(!empty($admisnid)){
		        $admisnid=$rows->admission_id; 
				}else{
					$admisnid=$admisnid;
				}
				//echo  $admisn_no;exit;
             $query="INSERT INTO edu_enrollment (admission_id,admit_year,admit_date,admisn_no,name,class_id,house_id,extra_curicullar_id,quota_id,created_at,status) VALUES ('$admisnid','$admit_year','$formatted_date','$admisn_no','$name','$class','$groups_id','$activity_id','$quota_id',NOW(),'$status')";
             $resultset=$this->db->query($query);
             
            //Student User Creation
             $sql="SELECT COUNT(admission_id) AS student FROM edu_admission " ;
             $resultsql=$this->db->query($sql);
             $result1= $resultsql->result();
             $cont=$result1[0]->student;
			//echo $cont;
             $user_id=$admisnid+400000;
              //echo $user_id;
             $getmail="select email,mobile,name from edu_admission WHERE admission_id='".$admisnid."'";
     	      $resultset12 = $this->db->query($getmail);
			  $reu=$resultset12->result();

             foreach($reu as $rows){}
             $email=$rows->email;
			 $cell=$rows->mobile;
			 $sname=$rows->name;

			 if(!empty($email))
			 {
              $to =$email;
              $subject ='"Welcome Message"';
              $htmlContent = '
			   <html>
			   <head>  <title></title>
			   </head>
			   <body style="background-color:beige;">
				 <table cellspacing="0" style=" width: 300px; height: 200px;">
					   <tr>
						   <th>Email:</th><td>'.$email.'</td>
					   </tr>
					   <tr>
						   <th>Username :</th><td>'.$user_id.'</td>
					   </tr>
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
			   mail($to,$subject,$htmlContent,$headers);
			 }
			 if(!empty($cell))
			 {
				$userdetails="Name : " .$sname. ",Username".$user_id.",Password :".$OTP.",";
				//echo $userdetails;
				$textmsg =urlencode($userdetails."To Known more details login into http://bit.ly/2wLwdRQ");
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

              $stude_insert="INSERT INTO edu_users (name,user_name,user_password,user_type,user_master_id,student_id,created_date,updated_date,status) VALUES ('$name','$user_id','$md5pwd','3','$admisnid','$admisnid',NOW(),NOW(),'$status')";
              $resultset=$this->db->query($stude_insert);

      		 $query2="UPDATE edu_admission SET enrollment='1' WHERE admission_id='$admisnid'";
      		 $resultset=$this->db->query($query2);

            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "Admission Already Exist");
            return $data;
          }

       }

	   function add_enrollment($admission_id)
	   {

		    $query="SELECT admission_id,admisn_year,name,admisn_no FROM edu_admission WHERE admission_id='$admission_id'";
		    $res=$this->db->query($query);
            return $res->result();
	   }

	    function get_current_years()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  if($result1->num_rows()==0){
			$data= array("status" => "no data Found");
			return $data;
		  }else{
			$all_year= $result1->result();
			$data= array("status" => "success","all_years"=>$all_year);
			return $data;
			//print_r($all_year);
		  }

		}

       //GET ALL Admission Form get_enrollmentid

      function get_all_enrollment()
	   {
		  $year_id=$this->getYear();

        $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,a.admission_id,a.admisn_no,a.sex,a.name,(Select b.blood_group_name FROM edu_blood_group as b WHERE  b.id IN(a.blood_group)) AS blood_group_name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c,edu_admission AS a WHERE  
          e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id AND e.admission_id=a.admission_id  AND  e.admit_year='$year_id' ORDER BY enroll_id DESC";
         
         $res=$this->db->query($query);
         return $res->result();
       }

     // Sorting

	 function get_all_enrollment_sorting_details()
	 {
		 $year_id=$this->getYear();

         $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_id,s.sec_name,a.admission_id,a.admisn_no,a.sex,a.name FROM edu_enrollment as e,edu_admission AS a,edu_classmaster as cm, edu_sections as s,edu_class as c WHERE
          e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id AND  e.admission_id=a.admission_id AND   e.admit_year='$year_id' Group BY sex ";
         $res=$this->db->query($query);
         return $res->result();
       }

	   function get_all_enrollment_sorting_class()
	   {
		 $year_id=$this->getYear();

         $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_id,s.sec_name,b.blood_group_name FROM edu_enrollment as e,edu_classmaster as cm,edu_sections as s,edu_class as c,edu_blood_group as b,edu_admission AS a WHERE a.blood_group=b.id AND  e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id AND e.admit_year='$year_id' GROUP BY e.class_id";
         $res=$this->db->query($query);
         return $res->result();
       }

	   function get_sorting_details($gender,$cls_mst_id)
	   {
		   $year_id=$this->getYear();

		   $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_name,s.sec_id,s.sec_name,a.admission_id,a.admisn_no,a.sex,a.name FROM edu_enrollment as e,edu_classmaster as cm, edu_sections as s,edu_class as c,edu_admission AS a WHERE
        e.class_id='$cls_mst_id' AND e.class_id=cm.class_sec_id and cm.class=c.class_id and cm.section=s.sec_id AND e.admission_id=a.admission_id   AND a.sex='$gender' AND e.admit_year='$year_id'  ORDER BY enroll_id DESC";
           $res=$this->db->query($query);
           return $res->result();
	   }
	   //-------------------

       function get_enrollmentid($admission_id){
		   $year_id=$this->getYear();

         $query="SELECT * FROM edu_enrollment WHERE admission_id='$admission_id' AND admit_year='$year_id'";
         $res=$this->db->query($query);
         return $res->result();
       }

//Update enrollment

        function save_enrollment($admit_year,$formatted_date,$name,$class,$status,$enroll_id,$admisn_no,$quota_id,$groups_id,$activity_id,$admission_id){
           $query="UPDATE edu_enrollment SET admit_year='$admit_year',admit_date='$formatted_date',name='$name',class_id='$class',house_id='$groups_id',extra_curicullar_id='$activity_id',quota_id='$quota_id',status='$status' WHERE enroll_id='$enroll_id' AND admission_id='$admission_id'";
           $res=$this->db->query($query);

		   $query1="UPDATE edu_admission SET name='$name' WHERE admission_id='$admission_id'";
           $res1=$this->db->query($query1);

		   $query2="UPDATE edu_users SET name='$name' WHERE student_id='$admission_id'";
           $res1=$this->db->query($query2);

           if($res){
             $data= array("status" => "success");
             return $data;
           }else{
             $data= array("status" => "Failed To update");
             return $data;
           }
        }
       function de_enroll($enroll_id)
	   {
		   $year_id=$this->getYear();

         $query="UPDATE edu_enrollment SET status='Deactive' WHERE enroll_id='$enroll_id' AND admit_year='$year_id' ";
         $res=$this->db->query($query);
         $data= array("status" => "De Active Successfully");
         return $data;
       }

	    function getData($admisno)
		{

		  $query = "select name,admission_id,admisn_no from edu_admission WHERE admisn_no='".$admisno."'";
     	  $resultset = $this->db->query($query);
		  foreach ($resultset->result() as $rows)
		  {
		   echo $rows->name;
		   //echo $rows->admission_id;  
		   exit;
		  }

		}

		function getData1($admisno)
		{
	      $year_id=$this->getYear();
		  $query = "select name,admission_id from edu_enrollment WHERE admission_id='".$admisno."' AND admit_year='$year_id'";
     	  $resultset = $this->db->query($query);
		  return  count($resultset->result());
		}


		 function search(Request $request)
           {
              $keywords = $request->get('keywords');
              $suggestions = Search::where('keywords', 'LIKE', '%'.$keywords.'%')->get();
              return $suggestions;
           }

		   //get all quota deatis

		   function get_all_quota_details()
		   {
			   $query="SELECT * FROM edu_quota WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			   return $res;
		   }

		   //get all groups deatis

		   function get_all_groups_details()
		   {
			   $query="SELECT * FROM edu_groups WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			     return $res;
		   }

		   //get all activities deatis

		   function get_all_activities_details()
		   {
			   $query="SELECT * FROM edu_extra_curricular WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			     return $res;
		   }

}
?>
