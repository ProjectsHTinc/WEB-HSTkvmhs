<?php

Class Ondutymodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function get_teacher_onduty_details()
     {
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
    	 $query="SELECT du.*,u.user_id,u.name FROM edu_on_duty AS du,edu_users AS u WHERE du.user_type=2 AND du.user_id=u.user_id AND du.year_id='$current_year' ORDER BY du.id DESC" ; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     

    function edit_teacher($id)
    {
       $query="SELECT du.*,u.user_id,u.name FROM edu_on_duty AS du,edu_users AS u WHERE du.user_type=2 AND du.id='$id' AND du.user_id=u.user_id"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

   function update_teacher_onduty($status,$user_id,$id)
    {

       $sql="UPDATE edu_on_duty SET status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    }

//------------------------Student---------------------------------

	function get_student_onduty_details()
	{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  
		  //echo $current_year;exit;
		  
		  $query="SELECT du.*,u.user_id,u.name,u.user_master_id,en.enroll_id,en.admission_id,en.name,en.class_id,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_on_duty AS du,edu_enrollment AS en,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_users AS u WHERE du.user_type=3 AND du.user_id=u.user_id AND u.user_master_id=en.admission_id AND u.name=en.name AND cm.class_sec_id=en.class_id AND cm.class=c.class_id AND cm.section=s.sec_id AND du.year_id='$current_year'  ORDER BY du.id DESC "; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	}	
	
	function edit_student($id)
	{
		$query="SELECT du.*,u.user_id,u.name,u.user_master_id,en.enroll_id,en.admission_id,en.name,en.class_id,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_on_duty AS du,edu_enrollment AS en,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_users AS u WHERE du.user_type=3 AND du.user_id=u.user_id AND du.id='$id' AND u.user_master_id=en.admission_id AND u.name=en.name AND cm.class_sec_id=en.class_id AND cm.class=c.class_id AND cm.section=s.sec_id"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	}
	
	function update_student_onduty($status,$user_id,$id)
	{
	   $sql="UPDATE edu_on_duty SET status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
	}
}
	?>