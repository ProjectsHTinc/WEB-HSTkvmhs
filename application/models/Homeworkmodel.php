<?php

Class Homeworkmodel extends CI_Model
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
//GET ALL SECTION get_subject($classid,$user_id,$user_type)

//---------------New--------------------------------
	function get_teacher_class_sec($user_id,$user_type)
	{
		$query="SELECT user_id,user_type,user_master_id,teacher_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
		$resultset=$this->db->query($query);
		$row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->user_master_id;
		 //echo  $teacher_id;exit;
		 
		 $sql="SELECT ts.id,ts.subject_id,ts.teacher_id,ts.class_master_id,ts.status,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_teacher_handling_subject AS ts,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ts.teacher_id='$teacher_id'  AND ts.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id  AND ts.status='Active' GROUP BY ts.class_master_id ";
		 $resultset=$this->db->query($sql);
         $res1=$resultset->result();
         return $res1;
	}
	
	function get_cls_tutor($user_id,$user_type)
	{
		$query="SELECT user_id,user_type,user_master_id,teacher_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
		$resultset=$this->db->query($query);
		$row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->user_master_id;
		 
		 $cls_tutor="SELECT t.teacher_id,t.class_teacher,t.status,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE t.teacher_id='$teacher_id' AND t.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id";
		 $resultset1=$this->db->query($cls_tutor);
         $res2=$resultset1->result();
         return $res2;
	}
	
	function get_subject($classid,$user_id,$user_type)
	{
		$query="SELECT user_id,user_type,user_master_id,teacher_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
		$resultset=$this->db->query($query);
		$row=$resultset->result();
		foreach($row as $rows){}
		$teacher_id=$rows->user_master_id;
		
		$sql="SELECT ts.id,ts.subject_id,ts.teacher_id,ts.class_master_id,ts.status,su.subject_id,su.subject_name FROM edu_teacher_handling_subject AS ts,edu_subject AS su WHERE ts.teacher_id='$teacher_id' AND ts.class_master_id='$classid' AND ts.subject_id=su.subject_id AND ts.status='Active' ";
        $resultset1=$this->db->query($sql);
        //$res=$resultset1->result();
        //return $res;
		if($resultset1->num_rows()==0){
           $data= array("status" => "nodata");
           return $data;
         }else{
             $res1=$resultset1->result();
             $data=array("status"=>"success","res2"=>$res1);
             return $data;
		 }

	}
//--------------------------------------------------
		 function get_teacher_id($user_id)
		 {
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $get_classes="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
			 $resultset1=$this->db->query($get_classes);
			 $teacher_row=$resultset1->result();
			  foreach($teacher_row as $teacher_rows){}
			$teach_id=$teacher_rows->class_name;
			
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
			$row=$objRs->result();
			foreach ($row as $rows1)
			{
			$s= $rows1->class_sec_id;
			$sec=$rows1->class;
			$clas=$rows1->class_name;
			$sec_name=$rows1->sec_name;
			$arryPlatform = explode(",", $teach_id);
		   $sPlatform_id  = trim($s);
		   $sPlatform_name  = trim($sec);
				 if(in_array($sPlatform_id, $arryPlatform )) {
					 $class_id[]=$s;
			 $class_name[]=$clas;
			 $sec_n[]=$sec_name;
 			 }
 			 }
      // print_r($sec_n);exit
      if(empty($class_id)){
        $data= array("status" =>"No Record Found");
        return $data;
      }else{

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"Record Found");
        return $data;
      }
        //print_r($data);exit;
       }
	   
	    function create_test($year_id,$class_id,$user_id,$user_type,$test_type,$title,$subject_name,$formatted_date,$format_date,$details)
	   {      
		     /*  $check_test_date="SELECT * FROM edu_homework WHERE class_id='$class_id' AND test_date='$formatted_date' AND subject_id='$subject_name'";
			  $result=$this->db->query($check_test_date);
			  if($result->num_rows()==0)
			  { */
			  $query="SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type' ";
			  $resultset=$this->db->query($query);
			  $row=$resultset->result();
			  //foreach($row as $rows){}
			  $teacher_id=$row[0]->user_master_id;
			  
			  $query="INSERT INTO edu_homework(year_id,class_id,teacher_id,hw_type,subject_id,title,test_date,due_date,hw_details,status,	created_by,created_at)VALUES('$year_id','$class_id','$teacher_id','$test_type','$subject_name','$title','$formatted_date','$format_date','$details','Active','$user_id',NOW())";
			  $resultset=$this->db->query($query);
			  $data= array("status"=>"success");
			  return $data;
			  /* }else{
					$data= array("status"=>"Already Exist");
					return $data;
				  } */
				   
	   }
	   
	   function getall_details($user_id,$user_type)
	   {
		    $query="SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type' ";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			$id=$row[0]->user_master_id;
			 
		  //$query="SELECT * FROM edu_homework ";
		    $query="SELECT eh.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,su.subject_id,su.subject_name FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s WHERE eh.teacher_id='$id' AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id ORDER BY eh.hw_id DESC";
          $result=$this->db->query($query);
          return $result->result();
	   }
	  function get_stu_details($hw_id,$user_id,$user_type)
	  { 
		    $query="SELECT eh.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,su.subject_id,su.subject_name,ed.enroll_id,ed.admission_id,ed.admit_year,ed.admisn_no,ed.name,ed.class_id,ed.status,a.admission_id,a.admisn_no,a.name,a.sex FROM edu_homework as eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s,edu_enrollment AS ed,edu_admission AS a WHERE ed.class_id=eh.class_id AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND eh.subject_id=su.subject_id And eh.hw_id='$hw_id' AND ed.status='Active' AND ed.admission_id=a.admission_id AND ed.name=a.name ORDER BY a.sex DESC,ed.name ASC ";
		  $result=$this->db->query($query);
          return $result->result();
		  

	  }
	  
	  function enter_marks($enroll,$hwid,$marks,$remarks,$user_id,$user_type)
	  {
		   $count_name = count($marks);
		  //echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$enroll1=$enroll[$i];
			//print_r($enroll);
			$hwid1=$hwid;
			$marks1=$marks[$i];
			$remarks1=$remarks[$i];
		  $query="INSERT INTO edu_class_marks(enroll_mas_id,hw_mas_id,marks,remarks,status,created_by,created_at) VALUES ('$enroll1','$hwid1','$marks1','$remarks1','Active','$user_id',NOW())";
		  $result=$this->db->query($query);
		  
		  $sql="UPDATE edu_homework SET mark_status='1' WHERE hw_id='$hwid1'";
		  $result1=$this->db->query($sql);
		  
          //return $result->result();
		  }
		  $data= array("status"=>"success");
		  return $data;
		   
	  }
	  
	  function edit_details($hw_id,$user_id,$user_type)
	  {
		  $query="SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type' ";
		  $resultset=$this->db->query($query);
		  $row=$resultset->result();
		  //foreach($row as $rows){}
		  $teacher_id=$row[0]->user_master_id;
			
		    $query="SELECT eh.hw_id,eh.year_id,eh.class_id,eh.teacher_id,eh.	hw_type,eh.subject_id,su.subject_id,su.subject_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,em.mark_id,em.enroll_mas_id,em.hw_mas_id,em.marks,em.remarks,ed.enroll_id,ed.admission_id,ed.admit_year,ed.admisn_no,ed.name,ed.class_id,ed.status,a.admission_id,a.admisn_no,a.name,a.sex FROM edu_homework AS eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s,edu_class_marks AS em,edu_enrollment AS ed,edu_admission AS a WHERE eh.hw_id='$hw_id' AND em.hw_mas_id='$hw_id' AND eh.teacher_id='$teacher_id' AND eh.subject_id=su.subject_id AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND ed.enroll_id=em.enroll_mas_id AND ed.admission_id=a.admission_id AND ed.name=a.name ORDER BY a.sex DESC,ed.name ASC ";
		 $result=$this->db->query($query); 
         return $result->result();		 
	  }
	 
	  function update_marks($enroll,$hwid,$marks,$remarks,$user_id,$user_type)
	  {
		  
		  $count_name = count($marks);
				//echo $count_name; exit;
           for($i=0;$i<$count_name;$i++)
		   {
			$enroll1=$enroll[$i];
			//print_r($enroll);
			$hwid1=$hwid;
			$marks1=$marks[$i];
			$remarks1=$remarks[$i];
		  $query="UPDATE edu_class_marks SET enroll_mas_id='$enroll1',hw_mas_id='$hwid1',marks='$marks1',remarks='$remarks1',updated_by='$user_id',updated_at=NOW() WHERE hw_mas_id='$hwid1' AND enroll_mas_id='$enroll1'";
		  $result=$this->db->query($query);

          //return $result->result();
		  }
		  $data= array("status"=>"success");
		  return $data;
		  

	  }
	  function edit_test_details($hw_id,$user_id,$user_type)
	  {
		  $query="SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type' ";
		  $resultset=$this->db->query($query);
		  $row=$resultset->result();
		  //foreach($row as $rows){}
		  $teacher_id=$row[0]->user_master_id;
		  
		   $query="SELECT eh.*,su.subject_id,su.subject_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_homework AS eh,edu_classmaster AS cm,edu_subject AS su,edu_class AS c,edu_sections AS s WHERE eh.hw_id='$hw_id' AND eh.teacher_id='$teacher_id' AND eh.subject_id=su.subject_id AND eh.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id";
		 $result=$this->db->query($query); 
         return $result->result();	
	  }
	
	   function update_test_details($id,$hw_type,$title,$formatted_date,$format_date,$test_details,$status,$user_id,$user_type)
	   {
		   $query1="UPDATE edu_homework SET hw_type='$hw_type',title='$title',test_date='$formatted_date',due_date='$format_date',hw_details='$test_details',status='$status',updated_by='$user_id',updated_at=NOW() WHERE hw_id='$id'";
		   $result1=$this->db->query($query1); 
           $data= array("status"=>"success");
		   return $data;
	   }


	  
	  function get_acdaemicyear()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  return $all_year;
		}
		
		///SMS
		
		function get_all_ctutor_homework($user_id,$cls_tutor_id)
		{
			$year_id=$this->getYear();
			
		  $hmw="SELECT h.*,s.subject_id,s.subject_name FROM edu_homework AS h,edu_subject AS s WHERE class_id='$cls_tutor_id' AND h.year_id='$year_id' AND h.subject_id=s.subject_id GROUP BY DATE_FORMAT(h.created_at, '%Y-%m-%d')  DESC";
		  $hmw1=$this->db->query($hmw);
		  $hmw2= $hmw1->result();
		  return $hmw2;
		}
		
		function send_homework_status($user_id,$createdate,$clssid)
		{
			$send="UPDATE edu_homework SET send_option_status='1',updated_by='$user_id',updated_at=NOW() WHERE class_id='$clssid' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$createdate'";
			$send1=$this->db->query($send); 
            $data= array("status"=>"success");
		    return $data;
		}
		
		function view_send_homework_all($user_id,$tdate,$cid)
		{
		  $year_id=$this->getYear();
		   $ahmw="SELECT h.hw_id,h.hw_type,h.title,h.created_at,h.test_date,h.due_date,h.hw_details,h.send_option_status,s.subject_id,s.subject_name,t.name FROM edu_homework AS h,edu_subject AS s,edu_teachers AS t WHERE class_id='$cid' AND h.year_id='$year_id' AND h.subject_id=s.subject_id AND DATE_FORMAT(h.created_at,'%Y-%m-%d')='$tdate'  AND h.teacher_id=t.teacher_id";
		  $ahmw1=$this->db->query($ahmw);
		  $ahmw2= $ahmw1->result();
		  return $ahmw2;
		}
		

}
?>
