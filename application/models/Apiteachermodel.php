<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apiteachermodel extends CI_Model {

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

//#################### Grade System Start ####################//
    public function calculate_grade($Marks)
    {
            if(is_numeric($Marks))
            {
                if ($Marks >= 91 && $Marks <= 100) {
                    $grade = 'A1';
                    return $grade;
                }
                if ($Marks >= 81 && $Marks <= 90) {
                    $grade = 'A2';
                    return $grade;
                }
                if ($Marks >= 71 && $Marks <= 80) {
                    $grade = 'B1';
                    return $grade;
                }
                if ($Marks >= 61 && $Marks <= 70) {
                    $grade = 'B2';
                    return $grade;
                }
                if ($Marks >= 51 && $Marks <= 60) {
                    $grade = 'C1';
                    return $grade;
                }
                if ($Marks >= 41 && $Marks <= 50) {
                    $grade = 'C2';
                    return $grade;
                }
                if ($Marks >= 31 && $Marks <= 40) {
                    $grade = 'D';
                    return $grade;
                }
                if ($Marks >= 21 && $Marks <= 30) {
                    $grade = 'E1';
                    return $grade;
                }
                if ($Marks <= 20) {
                    $grade = 'E2';
                    return $grade;
                }
            }else{
                $grade = '';
               return $grade;
            }
    }
//#################### Grade System End ####################//
    
    
//#################### Attendence for class ####################//
	public function dispAttendence ($class_id,$disp_type,$disp_date,$month_year)
	{
			$year_id = $this->getYear();

			if ($disp_type=='day')
			{
    			$att_query = "SELECT * from edu_attendence WHERE date(created_at) ='$disp_date' AND class_id ='$class_id' AND ac_year = '$year_id'  AND status = 'Active'";
    		    $att_res = $this->db->query($att_query);

    			 if($att_res->num_rows()==0) {
    				 $response = array("status" => "error", "msg" => "No Records Found");
    			}else{
    				$attend_query = "SELECT count(ah.student_id) as count, en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, ah.abs_date, ah.a_status, ah.attend_period, at.at_id
                        FROM edu_enrollment en
                        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
                        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
                        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                        INNER JOIN edu_class AS c ON cm.class=c.class_id 
                        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND en.admit_year = '$year_id' AND ah.abs_date = '$disp_date' GROUP by ah.student_id
                        
                        UNION ALL
                        
                        SELECT count(en.enroll_id) as count, en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, '' as abs_date, 'P' as a_status, '' as attend_period,'' as at_id
                        FROM edu_enrollment en
                        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                        INNER JOIN edu_class AS c ON cm.class=c.class_id 
                        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id'  AND en.admit_year = '$year_id' AND en.enroll_id 
                        NOT IN (SELECT en.enroll_id FROM edu_enrollment en
                        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
                        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
                        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                        INNER JOIN edu_class AS c ON cm.class=c.class_id 
                        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND ah.abs_date = '$disp_date' GROUP by ah.student_id)  GROUP by en.enroll_id";
    				
        				$attend_res = $this->db->query($attend_query);
            			$attend_result= $attend_res->result();
            			$attend_count = $attend_res->num_rows();
        			
        			    $response = array("status" => "success", "msg" => "View Attendence", "count"=>$attend_count, "attendenceDetails"=>$attend_result);
    			} 
			    
			} 
			
			if ($disp_type=='month') {
			    
    			$sdateDisp = explode('-', $month_year);
    		    $from_month = $sdateDisp[0];
    		    $from_year = $sdateDisp[1];
    		
    			$first_date = date('Y-m-d',mktime(0, 0, 0, $from_month , 1, $from_year));
    			$last_day   = date('t',strtotime($first_date));
    			$last_date = date('Y-m-d',mktime(0, 0, 0, $from_month ,$last_day, $from_year));
			
			    $att_query = "SELECT * from edu_attendence WHERE date(created_at) >= '$first_date' AND date(created_at) <= '$last_date'  AND class_id ='$class_id' AND ac_year = '$year_id'  AND status = 'Active'";
    		    $att_res = $this->db->query($att_query);

    			 if($att_res->num_rows()==0) {
    				 $response = array("status" => "error", "msg" => "No Records Found");
    			}else{

			        $attend_query = "SELECT COUNT(ah.student_id) as leaves,en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, ah.abs_date, ah.a_status, ah.attend_period, at.at_id FROM edu_enrollment en
                    INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
                    INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
                    INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                    INNER JOIN edu_class AS c ON cm.class=c.class_id 
                    INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND en.admit_year = '$year_id' AND ah.abs_date >= '$first_date' AND ah.abs_date <= '$last_date' 
                    GROUP BY ah.student_id

                    UNION ALL

                    SELECT count(en.enroll_id) as leaves,en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, '' as abs_date, 'P' as a_status, '' as attend_period,'' as at_id FROM edu_enrollment en 
                    INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                    INNER JOIN edu_class AS c ON cm.class=c.class_id 
                    INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND en.admit_year = '$year_id' AND en.enroll_id 
                    NOT IN (SELECT en.enroll_id FROM edu_enrollment en
                    INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
                    INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
                    INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
                    INNER JOIN edu_class AS c ON cm.class=c.class_id 
                    INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND ah.abs_date >= '$first_date' AND ah.abs_date <= '$last_date')
                    GROUP BY en.enroll_id";
                    
                    $attend_res = $this->db->query($attend_query);
        			$attend_result= $attend_res->result();
        			$attend_count = $attend_res->num_rows();

    				$response = array("status" => "success", "msg" => "View Attendence", "count"=>$attend_count, "attendenceDetails"=>$attend_result);
        		} 
			}

			return $response;		
	}
	
//#################### Attendence End ####################//


//#################### Attendence month view class ####################//
	public function dispMonthview ($class_id,$student_id,$month_year)
	{
	        $year_id = $this->getYear();
			$sdateDisp = explode('-', $month_year);
		    $from_month = $sdateDisp[0];
		    $from_year = $sdateDisp[1];
		
			$first_date = date('Y-m-d',mktime(0, 0, 0, $from_month , 1, $from_year));
			$last_day   = date('t',strtotime($first_date));
			$last_date = date('Y-m-d',mktime(0, 0, 0, $from_month ,$last_day, $from_year));

			$attend_query = "SELECT COUNT(ah.student_id)as leaves,en.enroll_id, en.class_id, en.name, c.class_name, s.sec_name, ah.abs_date, ah.a_status, ah.attend_period, at.at_id FROM edu_enrollment en
				INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
				INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
				INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
				INNER JOIN edu_class AS c ON cm.class=c.class_id 
				INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_id' AND en.admit_year = '$year_id' AND ah.abs_date >= '$first_date' AND ah.abs_date <= '$last_date' AND ah.student_id = '$student_id' GROUP BY ah.abs_date";

			$attend_res = $this->db->query($attend_query);
			$attend_result= $attend_res->result();
			$attend_count = $attend_res->num_rows();
			
			 if($attend_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "No Records Found");
			}else{
				$response = array("status" => "success", "msg" => "View Attendence", "count"=>$attend_count, "attendenceDetails"=>$attend_result);
			} 

			return $response;		
	}
	
//#################### Attendence month view ####################//


//#################### Homework for Teachers ####################//
	public function dispHomework($class_id,$teacher_id,$hw_type)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT A.hw_id,A.hw_type,A.title, A.test_date, A.due_date, A.hw_details, A.mark_status, B.subject_name FROM `edu_homework` A, `edu_subject` B WHERE A.subject_id = B.subject_id AND A.class_id ='$class_id' AND A.year_id='$year_id' AND  A.hw_type = '$hw_type' AND  A.teacher_id = '$teacher_id' AND A.status = 'Active'";
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
	
	
		public function reloadHomework($teacher_id)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT A.hw_id, A.hw_type, A.title, A.test_date, A.due_date,A.teacher_id ,A.class_id, A.hw_details, A.mark_status, A.subject_id,B.subject_name, D.class_name, E.sec_name FROM 
                            `edu_homework` A, `edu_subject` B, `edu_classmaster` C, `edu_class` D, `edu_sections` E WHERE 
                            A.subject_id = B.subject_id AND A.year_id ='$year_id' AND 
                            A.subject_id IN (SELECT DISTINCT subject_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id') AND A.class_id IN (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id') AND 
                            A.class_id = C. class_sec_id AND C.class = D.class_id AND
                            C.section = E.sec_id AND A.status = 'Active' AND A.teacher_id='$teacher_id'";
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


//#################### Homework test marks for Teachers ####################//
	public function dispCtestmarks($hw_id)
	{
			$year_id = $this->getYear();
			
			$hw_query = "SELECT B.name, A.marks  FROM `edu_class_marks`A, edu_enrollment B WHERE A.enroll_mas_id = B.enroll_id AND A.hw_mas_id = '$hw_id'";
		
			$hw_res = $this->db->query($hw_query);
			$hw_result= $hw_res->result();
			
			 if($hw_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Homework Test Marks Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Class Test", "ctestmarkDetails"=>$hw_result);
			} 

			return $response;		
	}
//#################### Homework test marks End ####################//


//#################### Exams for Teachers ####################//
	public function dispExams($class_ids)
	{
			$year_id = $this->getYear();
			
	        $exam_query = "SELECT ex.exam_id,ex.exam_name,ex.exam_flag AS is_internal_external,ed.classmaster_id, ss.sec_name,c.class_name,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
				COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
				CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
				FROM edu_examination ex
				RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id in ($class_ids)
				LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
				INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
				INNER JOIN edu_class AS c ON cm.class=c.class_id 
				INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
				WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ed.classmaster_id in ($class_ids)
				GROUP by ed.classmaster_id
				
				UNION ALL
			
				SELECT ex.exam_id,ex.exam_name,ex.exam_flag AS is_internal_external,ed.classmaster_id, ss.sec_name,c.class_name, COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
				COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
				CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
				FROM edu_examination ex
				LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id in ($class_ids)
				LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id 
				INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
				INNER JOIN edu_class AS c ON cm.class=c.class_id 
				INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
				WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where classmaster_id in ($class_ids)) GROUP by ed.classmaster_id";
			
			$exam_res = $this->db->query($exam_query);
			$exam_result= $exam_res->result();

        	if($exam_res->num_rows()==0){
        				 $response = array("status" => "error", "msg" => "Exams Not Found");
        		}else{
        				$response = array("status" => "success", "msg" => "View Exams", "examDetails"=>$exam_result);
        	} 

			return $response;		
	}
	
//#################### Reload Exams for Teachers ####################//	
	public function reloadExam($teacher_id)
	{
			$year_id = $this->getYear();
			
			$exam_query = "SELECT ex.exam_id,ex.exam_name,ex.exam_flag AS is_internal_external,ed.classmaster_id, ss.sec_name,c.class_name,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
						COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
						CASE WHEN ems.status='Publish' OR ems.status='Approved' THEN 1 ELSE 0 END AS MarkStatus
						FROM edu_examination ex
						RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
						INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
						INNER JOIN edu_class AS c ON cm.class=c.class_id 
						INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
						WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						GROUP by ed.classmaster_id, ed.exam_id
						
						UNION ALL
						
						SELECT ex.exam_id,ex.exam_name,ex.exam_flag AS is_internal_external,ed.classmaster_id, ss.sec_name,c.class_name, COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
						COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
						CASE WHEN ems.status='Publish' OR ems.status='Approved' THEN 1 ELSE 0 END AS MarkStatus
						FROM edu_examination ex
						LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')
						LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id 
						INNER JOIN edu_classmaster AS cm ON ed.classmaster_id = cm.class_sec_id
						INNER JOIN edu_class AS c ON cm.class=c.class_id 
						INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
						WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')) GROUP by ed.classmaster_id,ed.exam_id";
					
						$exam_res = $this->db->query($exam_query);
	
						 if($exam_res->num_rows()==0){
							 $exam_result = array("status" => "error", "msg" => "Exams not found");
						
						}else{
							$exam_result= $exam_res->result();
						} 
						
						$examdetail_query = "SELECT A.exam_id,A.exam_name,C.subject_name,B.exam_date, B.times,B.classmaster_id, E.class_name, F.sec_name FROM 
							`edu_examination` A, `edu_exam_details` B, `edu_subject` C, `edu_classmaster` D, `edu_class` E, `edu_sections` F WHERE 
							A.`exam_id` = B. exam_id AND B.subject_id = C.subject_id AND 
							B.classmaster_id=D.class_sec_id AND D.class = E.class_id AND 
							D.section = F.sec_id AND B.classmaster_id in (SELECT DISTINCT class_master_id from edu_teacher_handling_subject WHERE teacher_id ='$teacher_id')";
							$examdetail_res = $this->db->query($examdetail_query);
	
						 if($examdetail_res->num_rows()==0){
							 $examdetail_result = array("status" => "error", "msg" => "Exams not found");
						
						}else{
							$examdetail_result= $examdetail_res->result();
							$response = array("status" => "success","msg" => "Examsfound","Exams"=>$exam_result,"examDetails"=>$examdetail_result);
						
						}  
			return $response;		
	}	
	
//#################### Reload Exams for Teachers End ####################//


//#################### Exam Details for Teachers ####################//
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


//#################### Mark Details for Teachers ####################//
	public function dispMarkdetails($class_id,$exam_id,$subject_id,$is_internal_external)
	{
			$year_id = $this->getYear();
			
			if ($is_internal_external =='0') {
			  	$mark_query = "SELECT C.exam_name, B.subject_name, D.name, A.internal_mark, A.internal_grade, A.external_mark,A.external_grade, A.total_marks, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination` C, `edu_enrollment` D WHERE A.`exam_id` = '$exam_id' AND A.`classmaster_id` = '$class_id' AND A.subject_id = '$subject_id' AND A.subject_id = B.subject_id AND A.exam_id = C.exam_id AND A.stu_id = D.enroll_id";
		  
			} else {
				$mark_query = "SELECT C.exam_name, B.subject_name, D.name, A.internal_mark, A.internal_grade, A.external_mark,A.external_grade, A.total_marks, A.total_grade FROM `edu_exam_marks` A, `edu_subject` B, `edu_examination` C, `edu_enrollment` D WHERE A.`exam_id` = '$exam_id' AND A.`classmaster_id` = '$class_id' AND A.subject_id = '$subject_id' AND A.subject_id = B.subject_id AND A.exam_id = C.exam_id AND A.stu_id = D.enroll_id";
			}
			
			$mark_res = $this->db->query($mark_query);
			$mark_result= $mark_res->result();
			
			 if($mark_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Marks Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Marks Details", "marksDetails"=>$mark_result);
			} 

			return $response;		
	}
//#################### Mark Details End ####################//

//#################### Timetable  for Teachers ####################//
	public function dispTimetable($teacher_id)
	{
			$year_id = $this->getYear();
			$term_id = $this->getTerm();
			
	    	$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period,ss.sec_name,c.class_name FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.teacher_id ='$teacher_id' AND tt.year_id='$year_id' AND tt.term_id='$term_id' ORDER BY tt.day, tt.period";
			$timetable_res = $this->db->query($timetable_query);
			$timetable_result= $timetable_res->result();

			
			 if($timetable_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Timetable Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Timetable", "timetableDetails"=>$timetable_result);
			} 

			return $response;		
	}
//#################### Timetable End ####################//

//#################### Reminder  for Teachers ####################//
	public function dispReminder($user_id)
	{
			$year_id = $this->getYear();
			
	    	$reminder_query = "SELECT * from edu_reminder WHERE to_do_user_id ='$user_id'";
			$reminder_res = $this->db->query($reminder_query);
			$reminder_result= $reminder_res->result();

			
			 if($reminder_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Reminders Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Reminder", "dispReminder"=>$reminder_res);
			} 

			return $response;		
	}
//#################### Reminder End ####################//

//#################### Communication for Teachers ####################//
	public function dispCommunication ($teacher_id)
	{
			$year_id = $this->getYear();
			
			$comm_query = "SELECT commu_title,commu_details,commu_date FROM `edu_communication` WHERE find_in_set('$teacher_id', `teacher_id`)";
			$comm_res = $this->db->query($comm_query);
			$comm_result= $comm_res->result();
			$comm_count = $comm_res->num_rows();
			
			 if($comm_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Communication Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Communication", "count"=>$comm_count, "communicationDetails"=>$comm_result);
			} 

			return $response;		
	}
//#################### Communication End ####################//

//#################### Communication for Teachers ####################//
	public function dispLeavetype ($user_id)
	{
			$year_id = $this->getYear();
			
			$leave_type_query = "SELECT id,leave_title,leave_type from edu_user_leave_master WHERE status = 'Active' ";
			$leave_type_res = $this->db->query($leave_type_query);
			$leave_type_result= $leave_type_res->result();
			$leave_type_count = $leave_type_res->num_rows();
			
			 if($leave_type_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Leaves Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Leave Types", "leaveDetails"=>$leave_type_result);
			} 

			return $response;		
	}
//#################### Communication End ####################//

//#################### Display Leaves for Teachers ####################//
	public function dispUserleaves ($user_id)
	{
			$year_id = $this->getYear();
		
			$leave_query = "SELECT
                            B.leave_title,
                            A.from_leave_date,
                            A.to_leave_date,
                            A.frm_time,
                            A.to_time,
                            A.type_leave AS leave_type,
                            A.status,
                            C.teacher_id,
                            D.name
                        FROM
                            edu_user_leave A,
                            edu_user_leave_master B,
                            edu_users C,
                            edu_teachers D
                        WHERE
                            A.leave_master_id = B.id AND A.user_id = C.user_id AND C.teacher_id = D.teacher_id AND A.user_id = '$user_id' AND A.year_id = '$year_id'";

			$leave_res = $this->db->query($leave_query);
			$leave_result= $leave_res->result();
			$leave_count = $leave_res->num_rows();
			
			 if($leave_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Leaves Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Leaves", "leaveDetails"=>$leave_result);
			} 

			return $response;		
	}
//#################### Display Leaves End ####################//


//#################### Display Timetablereview for Teachers ####################//
	public function dispTimetablereview ($teacher_id)
	{
		$year_id = $this->getYear();
			
    		$sql = "SELECT * FROM edu_users WHERE teacher_id ='$teacher_id'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		
    		if($user_result->num_rows()>0)
    		{
    			foreach ($user_result->result() as $rows)
    			{
    			    $user_id = $rows->user_id;
    			}
    		}
		
			 $review_query = "SELECT
                        A.time_date,
                        DAYNAME(A.time_date) AS day,
                        A.class_id,
                        D.class_name,
                        E.sec_name,
                        C.subject_name,
                        A.comments,
                        A.remarks,
                        A.status
                    FROM
                        edu_timetable_review A,
                        edu_classmaster B,
                        edu_subject C,
                        edu_class D,
                        edu_sections E
                    WHERE
                        A.class_id = B.class_sec_id AND B.class = D.class_id AND B.section = E.sec_id AND A.subject_id = C.subject_id AND A.user_id = '$user_id' AND A.year_id = '$year_id'
                    ORDER BY
                        A.time_date DESC";
                        
			$review_res = $this->db->query($review_query);
			$review_result= $review_res->result();
			$review_count = $review_res->num_rows();
			
			 if($review_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Reviews Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Reviews", "reviewDetails"=>$review_result);
			} 

			return $response;		
	}
//#################### Display Timetablereview End ####################//


//#################### Add Leave for Teachers ####################//
	public function addUserleaves ($user_type,$user_id,$leave_master_id,$leave_type,$date_from,$date_to,$fromTime,$toTime,$description)
	{
			$year_id = $this->getYear();

		    $leave_query = "INSERT INTO `edu_user_leave` (`year_id`, `user_type`, `user_id`, `leave_master_id`, `type_leave`, `from_leave_date`, `to_leave_date`, `frm_time`, `to_time`, `leave_description`, `status`,`created_at`) VALUES ('$year_id', '$user_type', '$user_id', '$leave_master_id', '$leave_type', '$date_from', '$date_to', '$fromTime', '$toTime', '$description', 'Pending',NOW())";
			$leave_res = $this->db->query($leave_query);
		
			if($leave_res) {
			    $response = array("status" => "success", "msg" => "Leave Added");
			} else {
			    $response = array("status" => "error");
			}
			return $response;	
	}
//#################### Add Leave End ####################//


//#################### Add Homework for Teachers ####################//
	public function addHomework ($class_id,$teacher_id,$homeWork_type,$subject_id,$title,$test_date,$due_date,$homework_details,$created_by,$created_at)
	{
			$year_id = $this->getYear();
			
		    $hw_query = "INSERT INTO `edu_homework`(`year_id`, `class_id`, `teacher_id`, `hw_type`, `subject_id`, `title`, `test_date`, `due_date`, `hw_details`, `status`, `created_by`, `created_at`) VALUES ('$year_id','$class_id','$teacher_id','$homeWork_type','$subject_id','$title','$test_date','$due_date','$homework_details','Active','$created_by','$created_at')";
			$hw_res = $this->db->query($hw_query);
			$last_hwid = $this->db->insert_id();
				
			if($hw_res) {
			    $response = array("status" => "success", "msg" => "Homework Added", "last_id"=>$last_hwid);
			} else {
			    $response = array("status" => "error");
			}
			return $response;		
	}
//#################### Add Leave End ####################//

//#################### Add Homework Marks for Teachers ####################//
	public function addHWmarks ($hw_masterid,$student_id,$marks,$remarks,$created_by,$created_at)
	{
		$year_id = $this->getYear();
			
		$sqlMarks = "SELECT * FROM edu_class_marks WHERE hw_mas_id  = '$hw_masterid' AND enroll_mas_id ='$student_id'";
		$Marks_result = $this->db->query($sqlMarks);

		if($Marks_result->num_rows()>0)
		{
		    	foreach ($Marks_result->result() as $rows)
		        {
		            $marks_id = $rows->mark_id;
		        }
			$response = array("status" => "AlreadyAdded", "msg" => "Already Added", "mark_id"=>$marks_id);
		} else {
			
			
		    $HWmarks_query = "INSERT INTO `edu_class_marks`(`enroll_mas_id`, `hw_mas_id`, `marks`, `remarks`, `status`, `created_by`, `created_at`) 
			VALUES ('$student_id','$hw_masterid','$marks','$remarks','Active','$created_by','$created_at')";
			$HWmarks_res = $this->db->query($HWmarks_query);
			$last_HWmarksid = $this->db->insert_id();

			$HW_update_query = "UPDATE edu_homework SET mark_status ='1' WHERE  hw_id ='$hw_masterid'";
			$HW_update_res = $this->db->query($HW_update_query);

			if($HWmarks_res) {
			    $response = array("status" => "success", "msg" => "Homework Marks Added", "last_id"=>$last_HWmarksid);
			} else {
			    $response = array("status" => "error");
			}
		}
			return $response;		
	}
//#################### Add Leave End ####################//

//#################### Add Exam Marks for Teachers ####################//
	public function addExammarks ($exam_id,$teacher_id,$subject_id,$stu_id,$classmaster_id,$internal_mark,$external_mark,$marks,$created_by,$is_internal_external)
	{
		$year_id = $this->getYear();
		
		$totalMarks = "SELECT * FROM edu_exam_details WHERE exam_id = '$exam_id' AND subject_id ='$subject_id' AND classmaster_id ='$classmaster_id'";
		$totalMarks_result = $this->db->query($totalMarks);

		if($totalMarks_result->num_rows()>0)
		{
		    	foreach ($totalMarks_result->result() as $rows)
		        {
		            $subject_total  = $rows->subject_total;
		            $internal_mark_total  = $rows->internal_mark;
		            $external_mark_total  = $rows->external_mark;
		        }
		} 

        $sqlMarks = "SELECT * FROM edu_exam_marks WHERE exam_id = '$exam_id' AND subject_id ='$subject_id' AND stu_id ='$stu_id'  AND classmaster_id ='$classmaster_id'";
		$Marks_result = $this->db->query($sqlMarks);

		if($Marks_result->num_rows()>0)
		{
		    	foreach ($Marks_result->result() as $rows)
		        {
		            $exam_marks_id = $rows->exam_marks_id;
		        }
			$response = array("status" => "AlreadyAdded", "msg" => "Already Added", "exam_mark_id"=>$exam_marks_id);
		} else {
    		    
			if ($is_internal_external=="0") 
			{

			    if(is_numeric($marks))
                {
    			    $total = ($marks/$subject_total)*100;
                    $total_grade = $this->calculate_grade($total);
                } else {
					$total_grade = $marks;
                }
			    
			    /*
				if ($marks >= 91 && $marks <= 100) { 
					$total_grade = 'A1';
                }
                if ($marks >= 81 && $marks <= 90) {
					$total_grade = 'A2';
                }
                if ($marks >= 71 && $marks <= 80) {
					$total_grade = 'B1';
                }
                if ($marks >= 61 && $marks <= 70) {
					$total_grade = 'B2';
                }
                if ($marks >= 51 && $marks <= 60) {
					$total_grade = 'C1';
                }
                if ($marks >= 41 && $marks <= 50) {
					$total_grade = 'C2';
                }
                if ($marks >= 31 && $marks <= 40) {
					$total_grade = 'D';
                }
                if ($marks >= 21 && $marks <= 30) {
					$total_grade = 'E1';
                }
                if ($marks <= 20) {
					$total_grade = 'E2';
                }
				if ($marks == 'AB') {
					$total_grade = '';
                }
				*/
				   $marks_query = "INSERT INTO `edu_exam_marks`(`exam_id`, `teacher_id`, `subject_id`, `stu_id`, `classmaster_id`, `total_marks`, `total_grade`, `created_by`, `created_at`) VALUES ('$exam_id','$teacher_id','$subject_id','$stu_id','$classmaster_id','$marks','$total_grade','$created_by',NOW())";
		
			} 	
			else 	{
				
				
			    if(is_numeric($internal_mark))
                {
    			    $total = ($internal_mark/$internal_mark_total)*100;
                    $internal_grade = $this->calculate_grade($total);
                } else {
					$internal_grade = $internal_mark;
                }
                
                 if(is_numeric($external_mark))
                {
    			    $total = ($external_mark/$external_mark_total)*100;
                    $external_grade = $this->calculate_grade($total);
                } else {
					$external_grade = $external_mark;
                }
                
                 if(is_numeric($internal_mark) || is_numeric($external_mark))
                {
                    $total_marks = $internal_mark + $external_mark;
                    $total = ($total_marks/$subject_total)*100;
                    $total_grade = $this->calculate_grade($total);
                }else{
                    $total_marks = $internal_mark;
                    $total_grade = $internal_mark;
                }
            
            /*
            
                $total_marks = $internal_mark + $external_mark;
                
                if(is_numeric($total_marks))
                {
    			    $total = ($total_marks/$subject_total)*100;
                    $total_grade = $this->calculate_grade($total);
                } else {
					$total_grade = '';
                }
			    
				
				//Internal Marks Grade
                if ($internal_mark >= 37 && $internal_mark <= 40) {
                	$internal_grade = 'A1';
                }
                if ($internal_mark >= 33 && $internal_mark <= 36) {
                	$internal_grade = 'A2';
                }
                if ($internal_mark >= 29 && $internal_mark <= 32) {
               	 $internal_grade = 'B1';
                }
                if ($internal_mark >= 25 && $internal_mark <= 28) {
                	$internal_grade = 'B2';
                }
                if ($internal_mark >= 21 && $internal_mark <= 24) {
                	$internal_grade = 'C1';
                }
                if ($internal_mark >= 17 && $internal_mark <= 20) {
                	$internal_grade = 'C2';
                }
                if ($internal_mark >= 13 && $internal_mark <= 16) {
                	$internal_grade = 'D';
                }
                if ($internal_mark >= 9 && $internal_mark <= 12) {
                	$internal_grade = 'E1';
                }
                if ($internal_mark <= 8) {
               		$internal_grade = 'E2';
                }
                if ($internal_mark == 'AB') {
               		$internal_grade = '';
                }
                
                //External Mark Grade
                if ($external_mark >= 55 && $external_mark <= 60) {
                	$external_grade = 'A1';
                }
                if ($external_mark >= 49 && $external_mark <= 54) {
                	$external_grade = 'A2';
                }
                if ($external_mark >= 43 && $external_mark <= 48) {
                	$external_grade = 'B1';
                }
                if ($external_mark >= 37 && $external_mark <= 42) {
                	$external_grade = 'B2';
                }
                if ($external_mark >= 31 && $external_mark <= 36) {
                	$external_grade = 'C1';
                }
                if ($external_mark >= 25 && $external_mark <= 30) {
                	$external_grade = 'C2';
                }
                if ($external_mark >= 20 && $external_mark <= 24) {
                	$external_grade = 'D';
                }
                if ($external_mark >= 13 && $external_mark <= 19) {
                	$external_grade = 'E1';
                }
                if ($external_mark <= 12) {
                	$external_grade = 'E2';
                }
                if ($external_mark == 'AB') {
               		$external_grade = '';
                }
                
                //Total Mark Grade
                $total_marks = $internal_mark + $external_mark;
                
                if ($total_marks >= 91 && $total_marks <= 100) { 
					$total_grade = 'A1';
                }
                if ($total_marks >= 81 && $total_marks <= 90) {
					$total_grade = 'A2';
                }
                if ($total_marks >= 71 && $total_marks <= 80) {
					$total_grade = 'B1';
                }
                if ($total_marks >= 61 && $total_marks <= 70) {
					$total_grade = 'B2';
                }
                if ($total_marks >= 51 && $total_marks <= 60) {
					$total_grade = 'C1';
                }
                if ($total_marks >= 41 && $total_marks <= 50) {
					$total_grade = 'C2';
                }
                if ($total_marks >= 31 && $total_marks <= 40) {
					$total_grade = 'D';
                }
                if ($total_marks >= 21 && $total_marks <= 30) {
					$total_grade = 'E1';
                }
                if ($total_marks <= 20) {
					$total_grade = 'E2';
                }
                if ($internal_mark == 'AB' && $external_mark == 'AB') { 
					$total_grade = '';
                }
                */
		      $marks_query = "INSERT INTO `edu_exam_marks`(`exam_id`, `teacher_id`, `subject_id`, `stu_id`, `classmaster_id`, `internal_mark`, `internal_grade`, `external_mark`, `external_grade`, `total_marks`, `total_grade`, `created_by`, `created_at`) VALUES ('$exam_id','$teacher_id','$subject_id','$stu_id','$classmaster_id','$internal_mark','$internal_grade','$external_mark','$external_grade','$total_marks','$total_grade','$created_by',NOW())";
		}
		
			$marks_res = $this->db->query($marks_query);
			$last_marksid = $this->db->insert_id();

			if($marks_res) {
			    $response = array("status" => "success", "msg" => "Marks Added", "last_id"=>$last_marksid);
			} else {
			    $response = array("status" => "error");
			}
		}
			return $response;		
	}
//#################### Exam marks End ####################//

//#################### Add Reminder for Teachers ####################//
	public function addReminder ($user_id,$title,$description,$date)
	{
			$year_id = $this->getYear();
			
		    $reminder_query = "	INSERT INTO `edu_reminder`(`user_id`, `to_do_date`, `to_do_title`, `to_do_description`, `status`, `created_by`, `created_at`)
			VALUES ('$user_id','$date','$title','$description','Active','$user_id',NOW())";
			$reminder_res = $this->db->query($reminder_query);
			$last_reminderid = $this->db->insert_id();

			if($reminder_res) {
			    $response = array("status" => "success", "msg" => "Reminder Added", "last_id"=>$last_reminderid);
			} else {
			    $response = array("status" => "error");
			}
			return $response;		
	}
//#################### Add Reminder End ####################//


//#################### Add Timetablereview for Teachers ####################//
	public function addTimetablereview ($time_date,$class_id,$subject_id,$period_id,$user_type,$user_id,$comments,$created_at)
	{
			$year_id = $this->getYear();
			
		    $review_query = "	INSERT INTO `edu_timetable_review`(`time_date`,`year_id` , `class_id`, `subject_id`, `period_id`, `user_type`, `user_id`, `comments`, `status`, `created_at`)
			VALUES ('$time_date','$year_id','$class_id','$subject_id','$period_id','$user_type','$user_id','$comments','Active','$created_at')";
			$review_res = $this->db->query($review_query);
			$last_reviewid = $this->db->insert_id();

			if($review_res) {
			    $response = array("status" => "success", "msg" => "Timetablereview Added", "last_id"=>$last_reviewid);
			} else {
			    $response = array("status" => "error");
			}
			return $response;		
	}
//#################### Add Timetablereview End ####################//

//#################### Sync Attendance for Teachers ####################//
	public function syncAttendance ($ac_year,$class_id,$class_total,$no_of_present,$no_of_absent,$attendence_period,$created_by,$created_at,$status)
	{
			$year_id = $this->getYear();
            $createDate = new DateTime($created_at);
            $createDateonly = $createDate->format('Y-m-d');
            
			$sqlAttendance = "SELECT * FROM edu_attendence WHERE ac_year ='$ac_year' AND class_id ='$class_id' AND attendence_period ='$attendence_period' AND date(created_at) = '$createDateonly'";
    		$Attendance_result = $this->db->query($sqlAttendance);

    		if($Attendance_result->num_rows()>0)
    		{
    		    	foreach ($Attendance_result->result() as $rows)
			        {
			            $at_id = $rows->at_id;
			        }
    			$response = array("status" => "AlreadyAdded", "msg" => "Already Added", "attendance_id"=>$at_id);
    		} else {

				$attend_query = "INSERT INTO `edu_attendence`(`ac_year`, `class_id`, `class_total`, `no_of_present`, `no_of_absent`, `attendence_period`, `created_by`,`created_at`,`status`) VALUES ('$ac_year','$class_id','$class_total','$no_of_present','$no_of_absent','$attendence_period','$created_by','$created_at','$status')";
				$attend_res = $this->db->query($attend_query);
				$last_attendid = $this->db->insert_id();
	
				if($attend_res) {
					$response = array("status" => "success", "msg" => "Attendance Added", "last_attendance_id"=>$last_attendid);
				} else {
					$response = array("status" => "error");
				}
			}
			return $response;		
	}
//#################### Sync Attendance End ####################//

//#################### Sync Attendance History for Teachers ####################//
	public function syncAttendancehistory ($attend_id,$class_id,$student_id,$abs_date,$a_status,$attend_period,$a_val,$a_taken_by,$created_at,$status)
	{
  			$sqlAttendance = "SELECT * FROM edu_attendance_history WHERE class_id ='$class_id' AND attend_period ='$attend_period' AND abs_date ='$abs_date' AND student_id = '$student_id'";
    		$Attendance_result = $this->db->query($sqlAttendance);
    		
    		if($Attendance_result->num_rows()>0)
    		{
    		    	foreach ($Attendance_result->result() as $rows)
			        {
			            $absent_id = $rows->absent_id;
			        }
    			$response = array("status" => "AlreadyAdded", "msg" => "Alredy Added", "attendance_history_id"=>$absent_id);
    		} else {
			
				$attend_his_query = "INSERT INTO `edu_attendance_history`(`attend_id`, `class_id`, `student_id`, `abs_date`, `a_status`, `attend_period`, `a_val`,`a_taken_by`,`created_at`,`status`) VALUES ('$attend_id','$class_id','$student_id','$abs_date','$a_status','$attend_period','$a_val','$a_taken_by','$created_at','$status')";
				$attend_his_res = $this->db->query($attend_his_query);
				$last_historyid = $this->db->insert_id();
	
				if($attend_his_res) {
					$response = array("status" => "success", "msg" => "Attendance History Added", "last_attendance_history_id"=>$last_historyid);
				} else {
					$response = array("status" => "error");
				}
				return $response;
			}
	}
//#################### Sync Attendance End ####################//
}

?>