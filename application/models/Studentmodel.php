<?php

Class Studentmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  public function getYear()
    {
      $sqlYear = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
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

    function getTerm()
    {
        $sqlYear     = "SELECT * FROM edu_terms WHERE CURDATE() >= from_date AND CURDATE() <= to_date AND status = 'Active'";
        $term_result = $this->db->query($sqlYear);
        $ress_year   = $term_result->result();

        if ($term_result->num_rows() == 1) {
            foreach ($term_result->result() as $rows) {
                $term_id = $rows->term_id;
            }
            return $term_id;
        }
    }

//GET ALL
		function get_stu_homework_details($user_id,$user_type)
		{
			$query="SELECT student_id,user_type,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			//foreach($row as $rows){}
			$student_id=$row[0]->user_master_id;
			//echo $student_id;exit;

			$query1="SELECT admission_id,admisn_no,name,parnt_guardn_id FROM edu_admission WHERE admission_id='$student_id' AND status='Active'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->admission_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
			$parnt_guardn_id=$row2->parnt_guardn_id;}

			$year_id=$this->getYear();

			$query2="SELECT * FROM edu_enrollment WHERE admit_year='$year_id' AND admission_id='$admission_id' AND admisn_no='$admisn_no' AND name='$name' AND status='Active'";
			$result1=$this->db->query($query2);
			$row3=$result1->result();
			foreach($row3 as $row4){
			$admisn_no=$row4->admisn_no;
			$name=$row4->name;
			$class_id=$row4->class_id;
			}
			$query3="SELECT h.*,cm.class_sec_id,cm.class,cm.section,c.*,se.* FROM edu_homework AS h,edu_classmaster AS cm,edu_class AS c,edu_sections AS se WHERE h.year_id='$year_id' AND h.class_id='$class_id' AND h.status='Active' AND h.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY h.hw_id DESC" ;
			$result2=$this->db->query($query3);
			$row4=$result2->result();
			return $row4;

		}

			function view_homework_marks($user_id,$hw_id)
		   {
			$year_id=$this->getYear();

			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
             //echo $student_id;
			$query1="SELECT enroll_id,admission_id,name,admisn_no FROM edu_enrollment WHERE admit_year='$year_id' AND admission_id='$student_id' AND status='Active'";
			$result=$this->db->query($query1);
			$row1=$result->result();
			foreach($row1 as $row2){
			$admission_id=$row2->enroll_id;
			$admisn_no=$row2->admisn_no;
			$name=$row2->name;
		}

			$query="SELECT * FROM edu_class_marks WHERE hw_mas_id='$hw_id' AND enroll_mas_id='$admission_id'";
		    $result=$this->db->query($query);
            $marks=$result->result();
			return $marks;


		}
		/// Examination Result Models

		function get_all_exam($user_id)
		{
			$year_id=$this->getYear();

			$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;

			$sql="SELECT * FROM edu_enrollment WHERE admit_year='$year_id' AND admission_id='$student_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
            //echo $cls_id;exit;

			 $sql="SELECT m.*,ed.exam_id,ed.exam_year,ed.exam_name,ed.exam_year FROM edu_exam_marks_status AS m,edu_examination AS ed WHERE m.classmaster_id='$cls_id' AND m.status='Publish' AND m.exam_id=ed.exam_id AND ed.exam_year='$year_id'";
			 $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
		}

		function get_all_exam_views($user_id)
		{
			/* $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id; */

			 $year_id=$this->getYear();
			 $sql1="SELECT * FROM edu_examination WHERE exam_year='$year_id' AND status='Active'";
			 $resultset=$this->db->query($sql1);
			 $res1=$resultset->result();
             return $res1;
		}

		function exam_marks($user_id,$exam_id,$user_type)
		{
		    $year_id=$this->getYear();

			$query="SELECT student_id,user_type,user_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->user_master_id;
			//echo $student_id;

			$sql="SELECT * FROM edu_enrollment WHERE admit_year='$year_id' AND admission_id='$student_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			$adm_id=$rows->admission_id;
			//echo $enr_id;exit;

			 $sql1="SELECT ms.*,em.*,su.subject_name,a.language FROM edu_exam_marks AS em,edu_exam_marks_status AS ms,edu_subject AS su,edu_admission AS a WHERE ms.status='Publish' AND em.exam_id='$exam_id' AND ms.exam_id=em.exam_id  AND em.classmaster_id='$cls_id' AND em.classmaster_id=ms.classmaster_id AND em.stu_id='$enr_id' AND em.subject_id=su.subject_id AND a.admission_id='$adm_id' ";
			 $resultset1=$this->db->query($sql1);
			 $res1=$resultset1->result();
             return $res1;
		}


		function exam_calender_details($user_id,$exams_id,$user_type)
		{
			$query="SELECT student_id,user_type,user_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->user_master_id;
			//echo $student_id;exit;
             $year_id=$this->getYear();

			$sql="SELECT * FROM edu_enrollment WHERE admit_year='$year_id' AND admission_id='$student_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			//echo $cls_id; exit;

			$sql1="SELECT ed.*,en.exam_id,en.exam_year,en.exam_name,su.* FROM edu_exam_details AS ed,edu_examination AS en,edu_subject AS su WHERE ed.exam_id='$exams_id' AND ed.classmaster_id='$cls_id' AND ed.exam_id=en.exam_id AND ed.subject_id=su.subject_id AND en.exam_year='$year_id' AND ed.status='Active' ";
			$resultset1=$this->db->query($sql1);
			$row1=$resultset1->result();
			return $row1;
		}


	   function get_student_user($user_id)
	   {
		$year_id=$this->getYear();
         $get_enroll_id="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ee.enroll_id FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id
LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE ed.user_id=$user_id";
        $results=$this->db->query($get_enroll_id);
        foreach($results->result() as $rows){}   $enroll_id=$rows->enroll_id;
      $query="SELECT abs_date AS start,a_status AS description,CASE WHEN attend_period = 0 THEN 'FULLDAY' ELSE 'FULLDAY' END AS title FROM edu_attendance_history WHERE student_id='$enroll_id' AND  a_status IN ('A', 'L')";
       $resultset1=$this->db->query($query);
	 return $resultset1->result();
     }

     function get_class_id_user(){
		 $year_id=$this->getYear();
        $user_id=$this->session->userdata('user_id');
         $get_enroll_id="SELECT ed.name,ed.student_id,ea.admisn_year,ea.admisn_no,ee.enroll_id,ee.class_id,ee.admit_year FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id
       LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE ed.user_id='$user_id'";

        $results=$this->db->query($get_enroll_id);
        foreach($results->result() as $rows){}
        return  $class_id=$rows->class_id;
     }

     function get_timetable(){
         $term_id = $this->getTerm();
         $year_id = $this->getYear();
        $class_id=$this->get_class_id_user();
       $query="SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_id' AND tt.term_id='$term_id'
       AND tt.year_id='$year_id' ORDER BY tt.table_id ASC";
      $result=$this->db->query($query);
      $time=$result->result();
     if($result->num_rows()==0){
       $data= array("st" => "no data Found");
       return $data;
     }else{
       $data= array("st" => "success","time"=>$time);
       return $data;
   // return $result->result();
     }

     }
  //--------------------------Circular----------------------//

	 function get_circular($user_id){
		  //$cid=$this->get_class_id_user();
          //echo $user_id;exit;
		  // $get_year="SELECT * FROM edu_academic_year WHERE CURDATE()>=from_month AND CURDATE<=to_month";
		  // $result1=$this->db->query($get_year);
		  // $all_year= $result1->result();
		  // if($result1->num_rows()==0){ }else{
		  // foreach($all_year as $cyear){}
		  // $current_year=$cyear->year_id;

           $current_year=$this->getYear();

		$com="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,cm.id,cm.academic_year_id,cm.circular_title,cm.circular_description,cm.status FROM edu_circular AS c,edu_circular_master AS cm WHERE c.user_id='$user_id' AND c.user_type=3 AND cm.academic_year_id='$current_year' AND c.circular_master_id=cm.id AND cm.status='Active' ORDER BY c.id DESC";
		 //$sql="SELECT * FROM edu_communication WHERE status='A' AND FIND_IN_SET('$teacher_id',teacher_id) ";
		 $resultset=$this->db->query($com);
		 $row=$resultset->result();
		 return $row;
		   }
	 

	 //--------------------Fees Status---------------

	 function get_fees_status_details($user_id)
	 {
		      $year_id=$this->getYear();

		    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			//echo $student_id;

			$sql="SELECT enroll_id,class_id,admission_id,quota_id,admit_year FROM edu_enrollment WHERE admission_id='$student_id' AND admit_year='$year_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
		    $quotaid=$rows->quota_id;

			$sql1="SELECT fs.*,fm.term_id,fm.due_date_from,fm.due_date_to,fm.notes,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name FROM edu_term_fees_status AS fs,edu_fees_master AS fm,edu_academic_year AS y,edu_terms AS t,edu_quota AS q WHERE fs.student_id='$enr_id' AND fs.class_master_id='$cls_id' AND fs.quota_id='$quotaid' AND fs.fees_id=fm.id AND fm.status='Active' AND fm.term_id=t.term_id AND fs.year_id='$year_id' AND fs.year_id=y.year_id AND fs.quota_id=q.id";
			$result1=$this->db->query($sql1);
			$row1=$result1->result();
			return $row1;
	 }

	 //--------------------leaves-------------------
	 function get_all_regularleave($user_id)
			 {
				 $year_id=$this->getYear();

		    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			//echo $student_id;

			$sql="SELECT * FROM edu_enrollment WHERE admission_id='$student_id' AND admit_year='$year_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;
			//echo $cls_id;exit;

		 $query="SELECT eh.leave_list_date AS start,lm.leave_type AS title,lm.leave_type AS description,lm.leave_classes,lm.status FROM edu_holidays_list_history AS eh LEFT OUTER JOIN edu_leavemaster AS lm ON lm.leave_id=eh.leave_masid WHERE lm.status='Active' AND  FIND_IN_SET('$cls_id',lm.leave_classes)";
		$result=$this->db->query($query);
		return $result->result();
               }

	function get_special_leave_all($user_id)
	   {
		   $year_id=$this->getYear();

		    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			$student_id=$row[0]->student_id;
			//echo $student_id;

			$sql="SELECT * FROM edu_enrollment WHERE admission_id='$student_id' AND admit_year='$year_id'";
			$resultset=$this->db->query($sql);
			$row=$resultset->result();
			foreach($row as $rows){}
			$enr_id=$rows->enroll_id;
			$cls_id=$rows->class_id;

			//$query="SELECT leave_date AS start,leaves_name as title,leave_type AS description FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday' AND lm.status='A'";

			$sql1="SELECT lm.leave_id,lm.leave_type AS description,lm.leave_classes,lm.status,el.leaves_name AS title,el.leave_mas_id,el.leave_date AS start,el.days,el.week FROM edu_leavemaster AS lm,edu_leaves AS el WHERE lm.leave_id=el.leave_mas_id AND lm.leave_type='Special Holiday' AND FIND_IN_SET('$cls_id',lm.leave_classes) AND lm.status='Active'";
			$res=$this->db->query($sql1);
			return $res->result();

		  }

		  //------------------------On Duty-----------------------------

		   function getall_details($user_id,$user_type)
	         {
				$query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
				$resultset=$this->db->query($query);
				$row=$resultset->result();
				$student_id=$row[0]->student_id;

				  $get_year="SELECT * FROM edu_academic_year WHERE CURDATE>=from_month AND CURDATE<=to_month";
				  $result1=$this->db->query($get_year);
				  $all_year= $result1->result();
				  foreach($all_year as $cyear){}
				  $current_year=$cyear->year_id;

				 $query="SELECT * FROM edu_on_duty WHERE user_id='$user_id' AND user_type='$user_type' AND year_id='$current_year'";
				 $resultset1=$this->db->query($query);
				 return $resultset1->result();
	       }

		   function apply_onduty($user_type,$user_id,$reason,$fdate,$tdate,$notes)
		   {
                if($fdate < $tdate || $fdate==$tdate){
			    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
				$resultset=$this->db->query($query);
				$row=$resultset->result();
				$student_id=$row[0]->student_id;

				 $get_year="SELECT * FROM edu_academic_year WHERE CURDATE()>=from_month AND CURDATE()<=to_month";
				  $result1=$this->db->query($get_year);
				  $all_year= $result1->result();
				  foreach($all_year as $cyear){}
				  $current_year=$cyear->year_id;

				 $sql="INSERT INTO edu_on_duty(user_type,user_id,year_id,od_for,from_date,to_date,notes,status,created_by,created_at)VALUES('$user_type','$user_id','$current_year','$reason','$fdate','$tdate','$notes','Pending','$user_id',NOW())";
				 $result1=$this->db->query($sql);
				 //$res=$result1->result();
				 if($resultset)
				  {
					 $data= array("status" => "success");
					 return $data;
				 }
				}else{$data= array("status" => "Date");
					 return $data;}

		   }

		   function edit_onduty_form($id,$user_type)
		   {
			   $query="SELECT * FROM edu_on_duty WHERE id='$id' AND user_type='$user_type'";
			   $resultset=$this->db->query($query);
			   return $resultset->result();
		   }

		   function update($duty_id,$user_type,$user_id,$reason,$fdate,$tdate,$notes)
		   {    if($fdate < $tdate || $fdate==$tdate){
			   $sql="UPDATE edu_on_duty SET od_for='$reason',from_date='$fdate',to_date='$tdate',notes='$notes',updated_by='$user_id',updated_at=NOW() WHERE id='$duty_id' AND user_type='$user_type'";
			   $resultset=$this->db->query($sql);
			   if($resultset)
				{
				 $data= array("status" => "success");
				 return $data;
				}
		   }else{$data= array("status" => "Date");
					 return $data;}

		   }

		   //-------------Special Class--------------------------------\

		   function special_class_details($user_id,$user_type)
		   {
			   $year_id=$this->getYear();

			    $query="SELECT student_id FROM edu_users WHERE user_id='$user_id'";
				$resultset=$this->db->query($query);
				$row=$resultset->result();
				$student_id=$row[0]->student_id;

				$sql="SELECT * FROM edu_enrollment WHERE admission_id='$student_id' AND admit_year='$year_id' ";
				$resultset=$this->db->query($sql);
				$row=$resultset->result();
				foreach($row as $rows){}
				$enr_id=$rows->enroll_id;
				$cls_id=$rows->class_id;

				$sql1="SELECT sc.*,t.teacher_id,t.name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.	class_name,s.sec_id,s.sec_name,su.subject_id,su.subject_name FROM edu_special_class AS sc,edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_subject AS su WHERE sc.year_id='$year_id' AND sc.teacher_id=t.teacher_id AND sc.class_master_id='$cls_id' AND sc.class_master_id=cm.class_sec_id  AND cm.class=c.class_id AND cm.section=s.sec_id AND sc.subject_id=su.subject_id AND sc.status='Active' ";
				$result1=$this->db->query($sql1);
			    $res=$result1->result();
				return $res;
		   }

}
?>
