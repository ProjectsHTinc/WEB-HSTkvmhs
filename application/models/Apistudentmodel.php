<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apistudentmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Mail Function ####################//

	public function sendMail($to,$subject,$htmlContent)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
		mail($to,$subject,$htmlContent,$headers);
	}


//#################### Mail Function End ####################//


//#################### Current Year ####################//

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

//#################### Current Year End ####################//


//#################### Current Term ####################//

	public function getTerm()
	{
	    $year_id = $this->getYear();
		$sqlTerm = "SELECT * FROM edu_terms WHERE NOW() >= from_date AND NOW() <= to_date AND year_id = '$year_id' AND status = 'Active'";
		$term_result = $this->db->query($sqlTerm);
		$ress_term = $term_result->result();
		
		if($term_result->num_rows()==1)
		{
			foreach ($term_result->result() as $rows)
			{
			    $term_id = $rows->term_id;
			}
			return $term_id;
		}
	}

//#################### Current Term End ####################//

//#################### Student Profile ####################//

	public function showStudentProfile($stud_admission_id)
	{
			$student_query = "SELECT * from edu_admission WHERE admission_id='$stud_admission_id' AND status = 'Active'";
		    $student_res = $this->db->query($student_query);
			$student_profile= $student_res->result();
			
			 if($student_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "student Not Found");
			}else{
				$response = array("status" => "success", "msg" => "Student Profile", "studentProfile"=>$student_profile);
			} 
			
			return $response;	
	}

//#################### Student Profile End ####################//


//#################### Time table for Students and Parents ####################//
	public function dispTimetable($class_id)
	{
			$year_id = $this->getYear();
			$term_id = $this->getTerm();
			
			$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,COALESCE(s.subject_name, '') as subject_name,tt.teacher_id,te.name,tt.day,tt.period,ss.sec_name,c.class_name
			FROM edu_timetable AS tt LEFT JOIN edu_teachers AS te ON tt.teacher_id = te.teacher_id LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.class_id = '$class_id' AND tt.year_id='$year_id' AND tt.term_id='$term_id' ORDER BY tt.table_id";
			$timetable_res = $this->db->query($timetable_query);
			$timetable_result= $timetable_res->result();
			
			 if($timetable_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Timetable Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Timetable", "timeTable"=>$timetable_result);
			} 
			
			return $response;		
	}
//#################### Time table End ####################//


//#################### Exams for Students and Parents ####################//
	public function dispExams($class_id)
	{
			$year_id = $this->getYear();
			
			$exam_query = "SELECT ex.exam_id,ed.classmaster_id,ex.exam_name,ex.exam_flag AS is_internal_external,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate, COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id='$class_id'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ed.classmaster_id='$class_id'
			GROUP by ex.exam_name
			
			UNION ALL
			
			SELECT ex.exam_id,ed.classmaster_id,ex.exam_name,ex.exam_flag AS is_internal_external,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
			COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id='$class_id'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where
			classmaster_id = '$class_id')
			GROUP by ex.exam_name";

			$exam_res = $this->db->query($exam_query);
			$exam_result= $exam_res->result();
			$exam_count = $exam_res->num_rows();
			
			 if($exam_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Exams Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Exams", "Exams"=>$exam_result);
			} 
			
			return $response;		
	}
//#################### Exams End ####################//


//#################### Exam Details for Students and Parents ####################//
	public function dispExamdetails($class_id,$exam_id)
	{
			 $year_id = $this->getYear();
		
			$exam_query = "SELECT A.exam_id,A.exam_name,C.subject_name,B.exam_date, B.times FROM `edu_examination` A, `edu_exam_details` B, `edu_subject` C WHERE A.`exam_id` = B. exam_id AND B.subject_id = C.subject_id AND B.classmaster_id ='$class_id' AND B.exam_id='$exam_id'";
			$exam_res = $this->db->query($exam_query);
			$exam_result= $exam_res->result();
			$exam_result_count = $exam_res->num_rows();

			if($exam_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Exams Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Exam Details", "count"=>$exam_result_count,"examDetails"=>$exam_result);
			} 
			
			return $response;		
	}
//#################### Exam Details End ####################//


//#################### Mark Details for Students and Parents ####################//
	public function dispMarkdetails($stud_id,$exam_id,$is_internal_external)
	{
			$year_id = $this->getYear();
	
			//if ($is_internal_external =='0') {
				//$mark_query = "SELECT C.exam_name,B.subject_name,A.total_marks, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination`C WHERE A.`exam_id` ='$exam_id' AND A.`stu_id` = '$stud_id' AND A.subject_id=B.subject_id AND A.exam_id = C.exam_id";
			//	$mark_query = "SELECT C.exam_name,B.subject_name, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination`C WHERE A.`exam_id` ='$exam_id' AND A.`stu_id` = '$stud_id' AND A.subject_id=B.subject_id AND A.exam_id = C.exam_id";
		//	} else {
				//$mark_query = "SELECT C.exam_name,B.subject_name,A.internal_mark, A.internal_grade, A.external_mark, A.external_grade, A.total_marks, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination`C WHERE A.`exam_id` ='$exam_id' AND A.`stu_id` = '$stud_id' AND A.subject_id=B.subject_id AND A.exam_id = C.exam_id";
				$mark_query = "SELECT C.exam_name,B.subject_name, A.internal_grade, A.external_grade, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination`C WHERE A.`exam_id` ='$exam_id' AND A.`stu_id` = '$stud_id' AND A.subject_id=B.subject_id AND A.exam_id = C.exam_id";
		//	}
			
			$mark_res = $this->db->query($mark_query);
			$mark_result= $mark_res->result();
			
	//		$total_marks = 0;
	//		foreach($mark_result as $rows){ 
	//			$exam_marks = $rows->total_marks;
	//			$total_marks = 	$total_marks + $exam_marks;
	//		}
			
			 if($mark_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Marks Not Found");
			}else{
			    $response = array("status" => "success", "msg" => "View Marks Details", "marksDetails"=>$mark_result);
				//$response = array("status" => "success", "msg" => "View Marks Details", "marksDetails"=>$mark_result, "totalMarks"=>$total_marks);
			} 

			return $response;		
	}
//#################### Mark Details End ####################//

//#################### Homework for Students and Parents ####################//
	public function dispHomework($class_id,$hw_type)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT A.hw_id,A.hw_type,A.title, A.test_date,A.due_date, A.hw_details, A.mark_status, B.subject_name FROM `edu_homework` A, `edu_subject` B WHERE A.subject_id = B.subject_id AND A.class_id ='$class_id' AND A.year_id='$year_id' AND A.status = 'Active' AND A.hw_type = '$hw_type'";
			$hw_res = $this->db->query($hw_query);
			$hw_result= $hw_res->result();
			$hw_count = $hw_res->num_rows();
			
			 if($hw_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Homework Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Homework Details", "count"=>$hw_count, "homeworkDetails"=>$hw_result);
			} 

			return $response;		
	}
//#################### Homework Details End ####################//


//#################### Homework test marks for Students and Parents ####################//
	public function dispCtestmarks($hw_id,$entroll_id)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT * FROM `edu_class_marks` WHERE hw_mas_id = '$hw_id' AND enroll_mas_id ='$entroll_id'";
			$hw_res = $this->db->query($hw_query);
			$hw_result= $hw_res->result();
			
			 if($hw_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Homework Test Marks Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Class Test", "ctestmarkDetails"=>$hw_result);
			} 

			return $response;		
	}
//#################### Homework test marks  End ####################//


//#################### Attendence for Students and Parents ####################//
	public function dispAttendence ($class_id,$stud_id)
	{
			$year_id = $this->getYear();
			
			$total_days_query = "SELECT * FROM `edu_attendence` WHERE ac_year='$year_id' AND class_id='$class_id'";
			$total_days_res = $this->db->query($total_days_query);
			$total_days_result= $total_days_res->result();
			$total_days_count = $total_days_res->num_rows();
			
			if($total_days_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "No Attendance days Found");
			}else{
			   // $total_days = $total_days_count/2;
			    $total_days = $total_days_count;
			    
			    foreach($total_days_result as $rows){ 
    				$at_id = $rows->at_id;
			    }

    			$absent_query = "SELECT * FROM `edu_attendance_history` WHERE class_id='$class_id' AND student_id='$stud_id' AND a_status = 'A' ";
    			$absent_res = $this->db->query($absent_query);
    			$absent_result= $absent_res->result();
    			$absent_count = $absent_res->num_rows();
    			
    			if($absent_res->num_rows()>0){
    				//$absent_days = $absent_count/2;
    				$absent_days = $absent_count;
    			} else {
    			    $absent_days = 0;
    			}
    			
    			$leave_query = "SELECT * FROM `edu_attendance_history` WHERE class_id='$class_id' AND student_id='$stud_id' AND a_status = 'L' ";
    			$leave_res = $this->db->query($leave_query);
    			$leave_result= $leave_res->result();
    			$leave_count = $leave_res->num_rows();
    			
    			if($leave_res->num_rows()>0){
    				 //$leave_days = $leave_count/2;
    				 $leave_days = $leave_count;
    			} else {
    			    $leave_days = 0;
    			}
    			
    			$od_query = "SELECT * FROM `edu_attendance_history` WHERE class_id='$class_id' AND student_id='$stud_id' AND a_status = 'OD' ";
    			$od_res = $this->db->query($od_query);
    			$od_result= $od_res->result();
    			$od_count = $od_res->num_rows();
    			
    			if($od_res->num_rows()>0){
    				 //$od_days = $od_count/2;
    				 $od_days = $od_count;
    			} else {
    			    $od_days = 0;
    			}
			    $total_leave = $absent_days+$leave_days+$od_days;
			    $present_days = $total_days-$total_leave;
			   
			   	$attendence_history = array("total_working_days"=>$total_days, "absent_days"=>$absent_days, "leave_days"=>$leave_days, "od_days"=>$od_days, "present_days"=>$present_days);
			   	
    			$attend_query = "SELECT
                                COUNT(B.abs_date) AS abs_count,
                                A.at_id,
                                B.student_id,
                                B.abs_date,
                                B.a_status
                            FROM
                                edu_attendence A,
                                edu_attendance_history B
                            WHERE
                                A.ac_year = '$year_id' AND B.class_id = '$class_id' AND B.student_id = '$stud_id' AND B.attend_id = A.at_id
                            GROUP BY
                                B.abs_date";
    			$attend_res = $this->db->query($attend_query);
    			$attend_result= $attend_res->result();
    			$attend_count = $attend_res->num_rows();
    			
    			 if($attend_res->num_rows()==0){
    				 $response = array("status" => "success", "msg" => "View Attendence","attendenceHistory"=>$attendence_history, "attendenceDetails"=>$attend_result);
    			}else{
    				$response = array("status" => "success", "msg" => "View Attendence","attendenceHistory"=>$attendence_history, "attendenceDetails"=>$attend_result);
    			} 
			} 
			return $response;		
	}
	
//#################### Attendence End ####################//


//#################### Fees Status for Students and Parents ####################//
	public function dispFees ($stud_id)
	{
			$year_id = $this->getYear();
			
		     $fees_query = "SELECT C.term_name,B.due_date_from,B.due_date_to,A.status FROM `edu_term_fees_status` A, `edu_fees_master` B,`edu_terms` C WHERE A.year_id='$year_id' AND A.student_id='$stud_id' AND A.fees_id=B.id AND B.term_id = C.term_id";
			$fees_res = $this->db->query($fees_query);
			$fees_result= $fees_res->result();
			
			 if($fees_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Fees Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Fees", "feesDetails"=>$fees_result);
			} 

			return $response;		
	}
//#################### Communication End ####################//

}

?>