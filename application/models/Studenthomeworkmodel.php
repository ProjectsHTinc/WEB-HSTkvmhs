<?php

Class Studenthomeworkmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL 
		function get_stu_homework_details($user_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			$student_id=$row[0]->student_id;
			//echo $student_id;exit;
			$query1="SELECT admission_id,admisn_no,name,parnt_guardn_id FROM edu_admission WHERE admission_id='$student_id' AND status='A'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->admission_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
			$parnt_guardn_id=$row2->parnt_guardn_id;}
			
			$query2="SELECT * FROM edu_enrollment WHERE admission_id='$admission_id' AND admisn_no='$admisn_no' AND name='$name' AND status='A'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}
			
			$query3="SELECT h.*,cm.class_sec_id,cm.class,cm.section,c.*,se.* FROM edu_homework AS h,edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE h.class_id='$class_id' AND h.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY h.hw_id DESC" ;
			$result2=$this->db->query($query3);
			$row4=$result2->result();
			return $row4;
			
		}
		
		function view_homework_marks($user_id,$hw_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			
			$query1="SELECT admission_id,admisn_no,name,parnt_guardn_id FROM edu_admission WHERE admission_id='$student_id' AND status='A'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->admission_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
			$parnt_guardn_id=$row2->parnt_guardn_id;}
			
			$query="SELECT * FROM edu_class_marks WHERE hw_mas_id='$hw_id' AND enroll_mas_id='$student_id'";
		    $result=$this->db->query($query); 
            $marks=$result->result();
			return $marks;
		 
			
		}
		
		/// Examination Result Models 
		
		function get_all_exam($user_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			
			 $sql="SELECT * FROM edu_examination";
			 $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
		}
		
		function exam_marks($user_id,$exam_id)
		{
			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			 
			 $sql1="SELECT * FROM edu_exam_marks WHERE exam_id='$exam_id' AND stu_id='$student_id'";
			 $resultset1=$this->db->query($sql1);
			 $res1=$resultset1->result();
             return $res1;
		}
		
	   
	  
	   
	 
	

}
?>
