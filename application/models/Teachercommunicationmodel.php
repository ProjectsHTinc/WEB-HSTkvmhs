<?php
Class Teachercommunicationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

    function getall_details($user_id)
	 {
		
		  $query="SELECT l.*,lm.id,lm.leave_title,lm.leave_type FROM edu_user_leave AS l,edu_user_leave_master AS lm WHERE l.user_id='$user_id' AND l.leave_master_id=lm.id ORDER BY l.leave_id desc";
		 $resultset1=$this->db->query($query);
		 $res1=$resultset1->result();
		 return $res1;
		 
	 }
	 
	 function getall_leaves()
	 {
		 $query="SELECT * FROM edu_user_leave_master WHERE status='Active'"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
	 }
	 
	 function create_leave($user_type,$user_id,$leave_master_id,$leave_type,$formatted_date,$to_ldate,$frm_time,$to_time,$leave_description)
	 {     
		  $check_leave_date="SELECT * FROM edu_user_leave WHERE from_leave_date='$formatted_date' AND to_leave_date='$to_ldate' AND user_id='$user_id'";
          $result=$this->db->query($check_leave_date);
          if($result->num_rows()==0)
		  { 
			
			  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
			  $result1=$this->db->query($get_year);
			  $all_year= $result1->result();
			  foreach($all_year as $cyear){}
			  $current_year=$cyear->year_id;
			 
			 $sql="INSERT INTO edu_user_leave(year_id,user_type,user_id,leave_master_id,type_leave,from_leave_date,to_leave_date,frm_time,to_time,leave_description,status,created_at)VALUES('$current_year','$user_type','$user_id','$leave_master_id','$leave_type','$formatted_date','$to_ldate','$frm_time','$to_time','$leave_description','Pending',NOW())";
			 $resultset=$this->db->query($sql);
			
			 $data= array("status"=>"success");
			 return $data;
		 }else{
			  $data= array("status" => "Leave Date Already Exist");
              return $data;
		  } 
	 }
	 function edit_leave($user_id,$leave_id)
	 {
		
		  $que="SELECT * FROM edu_user_leave WHERE user_id='$user_id' AND leave_id='$leave_id'";
		 $resultset1=$this->db->query($que);
		 $row=$resultset1->result();
		 return $row;
		 
	 }
	 
	 function update_leave($leave_id,$user_type,$user_id,$leave_type,$formatted_date,$frm_time,$to_time,$leave_description)
	 {
		 

        $query1="UPDATE edu_user_leave SET type_leave='$leave_type',from_leave_date='$formatted_date',frm_time='$frm_time',to_time='$to_time',leave_description='$leave_description',updated_at=NOW() WHERE leave_id='$leave_id' AND user_id='$user_id'";
        $resultset=$this->db->query($query1);
		//$row=$resultset->result();
		$data= array("status"=>"success");
		return $data;		
		 
	 }
	 
	 function getall_circular_details($user_id)
	 {
		 $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
		 $resultset=$this->db->query($query);
		 $row=$resultset->result();
		 foreach($row as $rows){}
		 $teacher_id=$rows->teacher_id;
		 
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  $all_year= $result1->result();
		  foreach($all_year as $cyear){}
		  $current_year=$cyear->year_id;
		  

		 $com="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.id,cm.academic_year_id,cm.circular_title,cm.circular_description,cm.status FROM edu_circular AS c,edu_circular_master AS cm WHERE c.user_id='$user_id' AND c.user_type=2 AND cm.academic_year_id='$current_year' AND c.circular_master_id=cm.id AND cm.status='Active' ORDER BY c.id DESC";
		 //$sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$teacher_id',teacher_id) ";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
	 } 
	 
	 
	 
	 
	 
	 
}
?>