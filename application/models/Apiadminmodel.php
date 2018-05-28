<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apiadminmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Current Year ####################//

	public function sendMail($to,$subject,$htmlContent)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
		mail($to,$subject,$htmlContent,$headers);
	}


//#################### Login ####################//


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

//#################### GET ALL ClASS ####################//

  function get_classes($user_id){
    $sql="SELECT ec.class_name,ec.class_id FROM edu_classmaster AS ecm LEFT JOIN edu_class AS ec ON ec.class_id=ecm.class GROUP BY ec.class_name";
    $res=$this->db->query($sql);
    if($res->num_rows()==0){
        $data=array("status"=>"error","msg"=>"nodata");
        return $data;
    }else{
      $result=$res->result();
      $data=array("status"=>"success","msg"=>"success","data"=>$result);
      return $data;
    }
  }


  //#################### GET ALL SECTIONS ####################//

    function get_all_sections($class_id){
     $sql="SELECT es.sec_name,es.sec_id FROM edu_classmaster AS ecm LEFT JOIN edu_sections AS es ON ecm.section=es.sec_id WHERE ecm.class='$class_id'";
      $res=$this->db->query($sql);
      if($res->num_rows()==0){
          $data=array("status"=>"error","msg"=>"nodata");
          return $data;
      }else{
        $result=$res->result();
        $data=array("status"=>"success","msg"=>"success","data"=>$result);
        return $data;
      }
    }


        //#################### GET ALL Students in class ####################//

          function get_all_students_in_classes($class_id,$section_id){
            $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
            $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_sec_id;
              $year_id=$this->getYear();
            $stu_list="SELECT eer.name,eer.enroll_id,eer.admisn_no,ea.sex,ea.admisn_year,eer.class_id FROM edu_enrollment AS eer LEFT JOIN edu_admission AS ea ON ea.admission_id=eer.admission_id WHERE eer.class_id='$classid' AND eer.admit_year='$year_id' AND eer.status='Active' order by eer.enroll_id asc";
            $res_stu=$this->db->query($stu_list);
              $result_stud=$res_stu->result();
            if($res->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$res->result();
              $data=array("status"=>"success","msg"=>"success","data"=>$result_stud);
              return $data;
            }
          }



        //#################### GET STUDENT & PARENTS DETAILS ####################//

          function get_student_details($student_id){
               $year_id=$this->getYear();
              $sql="SELECT er.admission_id,ea.* FROM edu_enrollment AS er LEFT JOIN edu_admission AS ea ON er.admission_id=ea.admission_id WHERE er.enroll_id='$student_id'";
            $res_stu=$this->db->query($sql);
            	$admis= $res_stu->result();
            	foreach($admis as $admis_id){}
            	$ad_id=$admis_id->admission_id;
            $student_query = "SELECT * from edu_admission WHERE admission_id='$ad_id' AND status = 'Active'";
						$student_res = $this->db->query($student_query);
						$student_profile= $student_res->result();

							foreach($student_profile as $rows){
								$admit_id = $rows->admission_id;
								  $parent_id = $rows->parnt_guardn_id;
							}
   
                	 	 $father_query = "SELECT * from edu_parents WHERE id IN ($parent_id) AND relationship = 'Father' AND status = 'Active'";
						$father_res = $this->db->query($father_query);
						$father_profile = $father_res->result();

						foreach($father_profile as $rows){ 
								$admisson_id = $rows->admission_id;
								$relationship = $rows->relationship;
						}
                        
					    $fatherProfile  = array(
                            "id" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->id,
                            "name" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->name,
                            "occupation" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->occupation,
                            "income" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->income,
                            "home_address" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->home_address ,
                            "email" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->email,
                            "mobile" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->mobile,
                            "home_phone" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->home_phone,
                            "office_phone" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->office_phone,
                            "relationship" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->relationship,
                            "user_pic" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->user_pic
                          );
                						
						$mother_query = "SELECT * from edu_parents WHERE id IN ($parent_id) AND relationship = 'Mother' AND status = 'Active'";
						$mother_res = $this->db->query($mother_query);
						$mother_profile = $mother_res->result();

						foreach($mother_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

				      $motherProfile  = array(
                             "id" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->id,
                            "name" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->name,
                            "occupation" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->occupation,
                            "income" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->income,
                            "home_address" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->home_address ,
                            "email" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->email,
                            "mobile" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->mobile,
                            "home_phone" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->home_phone,
                            "office_phone" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->office_phone,
                            "relationship" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->relationship,
                            "user_pic" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->user_pic
                          );
						
						$guardian_query = "SELECT * from edu_parents WHERE id IN ($parent_id) AND relationship = 'Guardian' AND status = 'Active'";
						$guardian_res = $this->db->query($guardian_query);
						$guardian_profile = $guardian_res->result();

						foreach($guardian_profile as $rows){ 
								$admisson_id = $rows->admission_id;
						}

					 $guardianProfile  = array(
                         "id" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->id,
                        "name" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->name,
                        "occupation" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->occupation,
                        "income" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->income,
                        "home_address" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->home_address ,
                        "email" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->email,
                        "mobile" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->mobile,
                        "home_phone" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->home_phone,
                        "office_phone" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->office_phone,
                        "relationship" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->relationship,
                        "user_pic" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->user_pic
                      );
            						
						$enroll_query = "SELECT A.enroll_id AS registered_id,A.admission_id,A.admisn_no AS admission_no,A.class_id,A.name,C.class_name,D.sec_name 
						from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND 
						B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admission_id = '$admit_id'";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
						
						$parentProfile = array("fatherProfile" =>$fatherProfile,"motherProfile" =>$motherProfile,"guardianProfile" =>$guardianProfile);
						
				  		$response = array("status" => "success", "msg" => "userdetailfound", "studentData" =>$student_profile,"parentProfile" =>$parentProfile,"registeredDetails"=>$stu_enroll_res, "year_id" => $year_id);
						return $response;
          }


      //#################### GET STUDENT & ALL HOMEWORK DETAILS ####################//

        function get_all_howework_details($student_id){
          $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
          $res=$this->db->query($sql);
          $result=$res->result();
          foreach($result as $rows){   }
          $classid=$rows->class_id;
          $year_id=$this->getYear();
          $get_all_hw="SELECT eh.hw_type,eh.hw_id,eh.subject_id,eh.title,es.subject_name,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.class_id='$classid' AND eh.year_id='$year_id' AND eh.status='Active' AND hw_type='HW' ORDER BY eh.test_date DESC";
          $result_hw=$this->db->query($get_all_hw);
          if($result_hw->num_rows()==0){
              $data=array("status"=>"error","msg"=>"nodata");
              return $data;
          }else{
            $result_home=$result_hw->result();
            $data=array("status"=>"success","msg"=>"success","data"=>$result_home);
            return $data;
          }

        }

      //#################### GET STUDENT &  HOMEWORK DETAILS ####################//

        function get_howework_details($hw_id){
          $get_all_hw="SELECT eh.title,eh.hw_type,eh.subject_id,es.subject_name,eh.hw_details,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.hw_id='$hw_id'";
          $result_hw=$this->db->query($get_all_hw);
          if($result_hw->num_rows()==0){
              $data=array("status"=>"error","msg"=>"nodata");
              return $data;
          }else{
            $result_home=$result_hw->result();
            $data=array("status"=>"success","msg"=>"success","data"=>$result_home);
            return $data;
          }

        }


        //#################### GET STUDENT & ALL CLASSTEST DETAILS ####################//

          function get_all_classtest_details($student_id){
            $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
            $res=$this->db->query($sql);
            $result=$res->result();
            foreach($result as $rows){   }
            $classid=$rows->class_id;
            $year_id=$this->getYear();
            $get_all_hw="SELECT eh.hw_type,eh.hw_id,eh.subject_id,eh.title,es.subject_name,eh.test_date FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.class_id='$classid' AND eh.year_id='$year_id' AND eh.status='Active' AND hw_type='HT' ORDER BY eh.test_date DESC";
            $result_hw=$this->db->query($get_all_hw);
            if($result_hw->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result_home=$result_hw->result();
              $data=array("status"=>"success","msg"=>"success","data"=>$result_home);
              return $data;
            }

          }

          //#################### GET STUDENT &  CLASSTEST DETAILS ####################//

            function get_classtest_details($hw_id){
              echo $get_all_hw="SELECT eh.title,eh.hw_type,eh.subject_id,es.subject_name,eh.hw_details,eh.test_date,eh.mark_status FROM edu_homework AS eh LEFT JOIN edu_subject AS es ON es.subject_id=eh.subject_id WHERE eh.hw_id='$hw_id'";
              $result_hw=$this->db->query($get_all_hw);
              if($result_hw->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $result_home=$result_hw->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$result_home);
                return $data;
              }

            }


            //#################### GET ALL EXAM DETAILS ####################//

            function get_all_exam_details(){
              $year_id=$this->getYear();
              $sql="SELECT exam_id,exam_name FROM edu_examination WHERE exam_year='$year_id' AND STATUS='Active'";
              $result=$this->db->query($sql);
              if($result->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $exam_result=$result->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$exam_result);
                return $data;
              }


            }


              //#################### GET  EXAM DETAILS ####################//
            function get_exam_details($student_id,$exam_id){
              $sql="SELECT class_id FROM edu_enrollment WHERE enroll_id='$student_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_id;
               $exam_sql="SELECT eed.subject_id,es.subject_name,DATE_FORMAT(eed.exam_date,'%d-%m-%Y')AS exam_date,eed.times FROM edu_exam_details AS eed LEFT JOIN edu_subject AS es ON es.subject_id=eed.subject_id WHERE eed.classmaster_id='$classid' AND eed.exam_id='$exam_id' AND eed.status='Active' ORDER BY exam_date ASC";
              $ex_result=$this->db->query($exam_sql);
              if($ex_result->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $exam_result=$ex_result->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$exam_result);
                return $data;
              }

            }


                //#################### GET  ALL TEACHERS ####################//

            function get_all_teachers(){
              $sql="SELECT et.name,et.sex,et.age,et.class_teacher,c.class_name,s.sec_name,et.subject,esu.subject_name,et.teacher_id FROM edu_teachers
              AS et LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON  cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE et.status='Active' order by et.teacher_id asc";
              $res=$this->db->query($sql);
              if($res->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $result=$res->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$result);
                return $data;
              }

            }


            //#################### GET   TEACHER DETAILS  ####################//
            function get_teacher($teacher_id){
              $sql="SELECT et.name,et.sex,et.age,et.class_teacher,c.class_name,s.sec_name,et.subject,esu.subject_name,et.teacher_id,et.profile_pic FROM edu_teachers  AS et INNER JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
              INNER JOIN edu_sections AS s ON cm.section=s.sec_id INNER JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE et.status='Active' AND et.teacher_id='$teacher_id'";
              $res_detail=$this->db->query($sql);




            }


            //#################### GET   TEACHER CLASS DETAILS  ####################//
            function get_teacher_class_details($teacher_id){
                $year_id = $this->getYear();
                
                $teacher_query = "SELECT t.teacher_id,t.name,t.sex,t.age,t.nationality,t.religion,t.community_class, t.community,t.address,t.email,t.phone,t.sec_email,t.sec_phone,t.profile_pic,t.update_at,t.subject,t.class_name AS class_taken,t.class_teacher FROM edu_teachers AS t WHERE t.teacher_id = '$teacher_id'";
				$teacher_res = $this->db->query($teacher_query);
				$teacher_profile = $teacher_res->result();
/*
                $get_teacher_details="SELECT et.name,et.sex,et.age,et.class_teacher,et.religion,et.community_class,et.address,et.email,et.sec_email,et.phone,et.sec_phone,et.qualification,c.class_name,s.sec_name,et.subject,esu.subject_name,et.teacher_id,et.profile_pic,et.class_name as class_taken,et.update_at,et.teacher_id
                FROM edu_teachers  AS et LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
                LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON et.subject=esu.subject_id
                WHERE et.status='Active' AND et.teacher_id='$teacher_id'";
                $res_detail=$this->db->query($get_teacher_details);
                $teacherProfile=$res_detail->result();
*/
                $class_sub_query = "SELECT
    								class_master_id,
    								teacher_id,
    								class_name,
    								sec_name,
    								subject_name
    							FROM
    								edu_teacher_handling_subject A,
    								edu_classmaster B,
    								edu_subject C,
    								edu_class D,
    								edu_sections E
    							WHERE
    								A.class_master_id = B.class_sec_id AND B.class = D.class_id AND B.section = E.sec_id AND A.subject_id = C.subject_id AND A.teacher_id = '$teacher_id' ORDER by class_master_id";
						$class_sub_res = $this->db->query($class_sub_query);

					    if($class_sub_res->num_rows()==0){
							 $class_sub_result = array("status" => "Class_section", "msg" => "Class and Section not found");

						}else{
							$class_sub_result = $class_sub_res->result();
						}


						$timetable_query = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period,ss.sec_name,c.class_name FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE tt.teacher_id ='$teacher_id' AND tt.year_id='$year_id' ORDER BY tt.day, tt.period";
						$timetable_res = $this->db->query($timetable_query);

						 if($timetable_res->num_rows()==0){
							 $timetable_result = array("status" => "timetable", "msg" => "TimeTable not found");

						}else{
							$timetable_result= $timetable_res->result();
						}


						$data = array("status" => "success", "msg" => "Class and Sections",'teacherProfile'=>$teacher_profile,"class_name"=>$class_sub_result,"timeTable"=>$timetable_result);
						return $data;
                }





                    //#################### GET   LIST OF PARENTS   ####################//
              function get_list_of_parents($class_id,$section_id){
                $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
                $res=$this->db->query($sql);
                $result=$res->result();
                foreach($result as $rows){   }
                 $classid=$rows->class_sec_id;
                $year_id=$this->getYear();
               //echo  $stu_list="SELECT eer.enroll_id AS student_id,eer.name,eer.admisn_no,ea.sex,ea.admisn_year,ep.name,ep.id,ea.parnt_guardn_id FROM edu_enrollment AS eer LEFT JOIN edu_admission AS ea ON ea.admisn_no=eer.admisn_no LEFT JOIN edu_parents AS ep ON  ea.parnt_guardn_id=ep.parent_id  WHERE eer.class_id='$classid' AND eer.admit_year='$year_id' AND eer.status='Active'";
               $stu_list="select ee.enroll_id as student_id,ee.admission_id as admisn_no,ea.name,ea.admisn_year,ea.sex,ea.parnt_guardn_id,ee.class_id,IFNULL(ep.name,'') as father_name,IFNULL(ep.name,'') as mother_name,IFNULL(ep.name,'') as guardn_name,IFNULL(ep.id,'') as parent_id from edu_enrollment as ee left join edu_admission as ea on ee.admission_id=ea.admission_id left join edu_parents as ep on ea.parnt_guardn_id=ep.id WHERE ee.class_id='$classid' AND ee.admit_year='$year_id' AND ee.status='Active'";
            
               $res_stu=$this->db->query($stu_list);
                if($res_stu->num_rows()==0){
                    $data=array("status"=>"error","msg"=>"nodata");
                    return $data;
                }else{
                  $result_stud=$res_stu->result();
                  $data=array("status"=>"success","msg"=>"success","data"=>$result_stud);
                  return $data;
                }
              }


              //#################### GET   PARENT DETAILS  ####################//
              function get_parent_details($admission_id){
                 $year_id=$this->getYear();
                 
                         $student_query = "SELECT * from edu_admission WHERE admission_id='$admission_id' AND status = 'Active'";
						$student_res = $this->db->query($student_query);
						$student_profile= $student_res->result();

							foreach($student_profile as $rows){ 
								$admit_id = $rows->admission_id;
								$parent_id = $rows->parnt_guardn_id;
							}
							
						$father_query = "SELECT * from edu_parents WHERE find_in_set ($admission_id,admission_id) AND relationship = 'Father' AND status = 'Active'";
						$father_res = $this->db->query($father_query);
						$father_profile = $father_res->result();

						foreach($father_profile as $rows){ 
								$admisson_id = $rows->admission_id;
								$relationship = $rows->relationship;
						}
                        
					    $fatherProfile  = array(
            "id" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->id,
            "name" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->name,
            "occupation" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->occupation,
            "income" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->income,
            "home_address" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->home_address ,
            "email" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->email,
            "mobile" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->mobile,
            "home_phone" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->home_phone,
            "office_phone" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->office_phone,
            "relationship" =>(!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->relationship,
            "user_pic" => (!isset($father_profile[0]) || is_null($father_profile[0])) ? '' : $father_profile[0]->user_pic
          );

       $mother_query = "SELECT * from edu_parents WHERE find_in_set ($admission_id,admission_id) AND relationship = 'Mother' AND status = 'Active'";
         $mother_res = $this->db->query($mother_query);
          $mother_profile = $mother_res->result();

          foreach($mother_profile as $rows){
              $admisson_id = $rows->admission_id;
          }

          $motherProfile  = array(
              "id" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->id,
            "name" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->name,
            "occupation" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->occupation,
            "income" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->income,
            "home_address" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->home_address,
            "email" => (!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->email,
            "mobile" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->mobile,
            "home_phone" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->home_phone,
            "office_phone" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->office_phone,
            "relationship" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->relationship,
            "user_pic" =>(!isset($mother_profile[0]) || is_null($mother_profile[0])) ? '' : $mother_profile[0]->user_pic
          );

          $guardian_query = "SELECT * from edu_parents WHERE find_in_set ($admission_id,admission_id) AND relationship = 'Guardian' AND status = 'Active'";
          $guardian_res = $this->db->query($guardian_query);
          $guardian_profile = $guardian_res->result();

          foreach($guardian_profile as $rows){
              $admisson_id = $rows->admission_id;
          }

          $guardianProfile  = array(
             "id" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->id,
            "name" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->name,
            "occupation" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->occupation,
            "income" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->income,
            "home_address" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->home_address ,
            "email" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->email,
            "mobile" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->mobile,
            "home_phone" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->home_phone,
            "office_phone" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->office_phone,
            "relationship" => (!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->relationship,
            "user_pic" =>(!isset($guardian_profile[0]) || is_null($guardian_profile[0])) ? '' : $guardian_profile[0]->user_pic 
          );
						
						$enroll_query = "SELECT A.enroll_id AS registered_id,A.admission_id,A.admisn_no AS admission_no,A.class_id,A.name,C.class_name,D.sec_name 
						from edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D WHERE A.class_id = B.class_sec_id AND 
						B.class = C.class_id AND B.section = D.sec_id AND A.admit_year ='$year_id' AND A.admission_id = '$admit_id'";
						$enroll_res = $this->db->query($enroll_query);
						$stu_enroll_res= $enroll_res->result();
						
						$parentProfile = array("fatherProfile" =>$fatherProfile,"motherProfile" =>$motherProfile,"guardianProfile" =>$guardianProfile);
					
				  		$response = array("status" => "success", "msg" => "userdetailfound", "studentProfile" =>$student_profile,"parentProfile" =>$parentProfile,"registeredDetails"=>$stu_enroll_res, "year_id" => $year_id);
						return $response;
                 
                 
          

              }

                              //#################### GET   PARENT SUDENT LIST  ####################//
              function get_parent_student_list($parent_id){
                  $year_id=$this->getYear();
                  $father_query = "SELECT * from edu_parents WHERE id='$parent_id' AND status = 'Active'";
                  $father_res = $this->db->query($father_query);
                  $father_profile = $father_res->result();

                  foreach($father_profile as $rows){
                      $admisson_id = $rows->admission_id;
                  }

                   $enroll_query = "SELECT A.enroll_id,A.admission_id,A.admisn_no,A.class_id,A.name,C.class_name,D.sec_name,EA.sex,A.admit_year FROM edu_enrollment A, edu_classmaster B, edu_class C, edu_sections D ,edu_admission EA WHERE A.class_id = B.class_sec_id AND B.class = C.class_id AND B.section = D.sec_id AND EA.admission_id=A.admission_id AND A.admit_year ='$year_id' AND A.admission_id IN ($admisson_id)";
                  $enroll_res = $this->db->query($enroll_query);
                  $stu_enroll_res= $enroll_res->result();


                $response = array("status" => "success", "msg" => "studentdetailsfound","data"=>$stu_enroll_res);
                    return $response;

              }



                //#################### GET LIST OF TEACHER FOR A CLASS  ####################//
              function list_of_teachers_for_class($class_id,$section_id){
                $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
                $res=$this->db->query($sql);
                $result=$res->result();
                foreach($result as $rows){   }
                $class_master_id=$rows->class_sec_id;
                $year_id=$this->getYear();
              //  $query="SELECT eths.teacher_id,et.name,et.sex,c.class_name,s.sec_name,esu.subject_name,et.class_teacher,et.subject FROM edu_teacher_handling_subject AS eths  LEFT JOIN edu_teachers AS et ON eths.teacher_id=et.teacher_id LEFT JOIN edu_classmaster AS cm ON et.class_teacher=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id  LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON et.subject=esu.subject_id WHERE eths.class_master_id='$class_master_id' AND eths.status='Active' GROUP BY eths.teacher_id";
                  $query="SELECT eths.subject_id,eths.teacher_id,et.name,esu.subject_name FROM edu_teacher_handling_subject AS eths LEFT JOIN edu_teachers AS et ON eths.teacher_id=et.teacher_id LEFT JOIN edu_subject AS esu ON eths.subject_id=esu.subject_id
WHERE eths.class_master_id='$class_master_id' AND eths.status='Active' order by eths.teacher_id asc";
                $result_query=$this->db->query($query);
                if($result_query->num_rows()==0){
                    $data=array("status"=>"error","msg"=>"nodata");
                    return $data;
                }else{
                  $result=$result_query->result();
                  $data=array("status"=>"success","msg"=>"success","data"=>$result);
                  return $data;
                }
              }




                //#################### GET LIST OF EXAM FOR CLASS  ####################//
              function list_of_exams_class($class_id,$section_id){
                $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
                $res=$this->db->query($sql);
                $result=$res->result();
                foreach($result as $rows){   }
                $classid=$rows->class_sec_id;
                $year_id=$this->getYear();
                  $query="SELECT ex.exam_id,ed.classmaster_id,ex.exam_name,ex.exam_flag AS is_internal_external,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate, COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			RIGHT JOIN edu_exam_details ed on ex.exam_id = ed.exam_id and ed.classmaster_id='$classid'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ed.classmaster_id='$classid'
			GROUP by ex.exam_name
			
			UNION ALL
			
			SELECT ex.exam_id,ed.classmaster_id,ex.exam_name,ex.exam_flag AS is_internal_external,COALESCE(DATE_FORMAT(MIN(ed.exam_date), '%d/%b/%y'),'') AS Fromdate,
			COALESCE(DATE_FORMAT(MAX(ed.exam_date), '%d/%b/%y'),'') AS Todate,
			CASE WHEN ems.status='Publish' THEN 1 ELSE 0 END AS MarkStatus
			FROM edu_examination ex
			LEFT JOIN edu_exam_details ed on ed.exam_id = ex.exam_id and ed.classmaster_id='$classid'
			LEFT JOIN edu_exam_marks_status ems ON ems.exam_id = ex.exam_id and ems.classmaster_id = ed.classmaster_id
			WHERE ex.exam_year ='$year_id' and ex.status = 'Active' and ex.exam_id NOT IN (SELECT DISTINCT exam_id FROM edu_exam_details where
			classmaster_id = '$classid')
			GROUP by ex.exam_name";
                $result_query=$this->db->query($query);
                if($result_query->num_rows()==0){
                    $data=array("status"=>"error","msg"=>"nodata");
                    return $data;
                }else{
                  $result=$result_query->result();
                  $data=array("status"=>"success","msg"=>"success","Exams"=>$result);
                  return $data;
                }
              }

              //#################### GET TimeTable FOR CLASS  ####################//
            function get_timetable_for_class($class_id,$section_id){
              $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_sec_id;
              $year_id=$this->getYear();
              $term_id = $this->getTerm();
              $query="SELECT tt.table_id,tt.class_id,tt.subject_id,COALESCE(s.subject_name,' ') AS subject_name,tt.teacher_id,COALESCE(t.name,' ') AS teacher_name,tt.day,COALESCE(ed.list_day,' ') AS w_days,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id LEFT JOIN edu_days AS ed  ON tt.day=ed.d_id WHERE tt.class_id='$classid' AND tt.year_id='$year_id' AND tt.term_id='$term_id' ORDER BY tt.table_id ASC";
              $result_query=$this->db->query($query);
              if($result_query->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $result=$result_query->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$result);
                return $data;
              }
            }



              //#################### GET FEES MASTER FOR CLASS  ####################//
            function get_fees_master_class($class_id,$section_id){
              $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
              $res=$this->db->query($sql);
              $result=$res->result();
              foreach($result as $rows){   }
              $classid=$rows->class_sec_id;
              $year_id=$this->getYear();
            //   $query="SELECT efm.id,efm.term_id,DATE_FORMAT(efm.due_date_from,'%d-%m-%Y')AS due_date,DATE_FORMAT(efm.due_date_to,'%d-%m-%Y')AS to_date,
            //   DATE_FORMAT(eac.from_month,'%Y')AS from_year,DATE_FORMAT(eac.to_month,'%Y')AS to_year FROM edu_fees_master AS efm LEFT JOIN edu_academic_year AS eac ON efm.year_id=eac.year_id WHERE efm.class_master_id='$classid' AND efm.year_id='$year_id' AND efm.status='Active'";
              $query="SELECT efm.id AS fees_id,DATE_FORMAT(efm.due_date_from,'%d-%m-%Y')AS due_date_from,et.term_name,DATE_FORMAT(efm.due_date_to,'%d-%m-%Y')AS due_date_to,
DATE_FORMAT(eac.from_month,'%Y')AS from_year,DATE_FORMAT(eac.to_month,'%Y')AS to_year FROM edu_fees_master AS efm LEFT JOIN edu_academic_year AS eac ON efm.year_id=eac.year_id
LEFT JOIN edu_terms AS et ON  efm.term_id=et.term_id WHERE efm.class_master_id='$classid' AND efm.year_id='$year_id' AND efm.status='Active'";
              $result_query=$this->db->query($query);
              if($result_query->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $result=$result_query->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$result);
                return $data;
              }
            }


              //#################### GET FEES DETAILS  ####################//
            function get_fees_details($fees_id){
              $query="SELECT efm.id,efm.term_id,DATE_FORMAT(efm.due_date_from,'%d-%m-%Y')AS due_date,DATE_FORMAT(efm.due_date_to,'%d-%m-%Y')AS to_date,eq.quota_name,ss.sec_name,c.class_name,efm.notes,eu.name AS created_by,DATE_FORMAT(eac.from_month,'%Y')AS from_year,DATE_FORMAT(eac.to_month,'%Y')AS to_year FROM edu_fees_master AS efm LEFT JOIN edu_academic_year AS eac ON efm.year_id=eac.year_id
              LEFT JOIN edu_quota AS eq ON eq.id=efm.quota_id INNER JOIN edu_classmaster AS cm ON efm.class_master_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id INNER JOIN edu_users AS eu ON eu.user_id=efm.created_by WHERE efm.class_master_id=6 AND efm.id='$fees_id'";
              $result_query=$this->db->query($query);
              if($result_query->num_rows()==0){
                  $data=array("status"=>"error","msg"=>"nodata");
                  return $data;
              }else{
                $result=$result_query->result();
                $data=array("status"=>"success","msg"=>"success","data"=>$result);
                return $data;
              }
            }


            //#################### GET FEES DETAILS  ####################//
          function get_fees_status($class_id,$section_id,$fees_id){
            $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
            $res=$this->db->query($sql);
            $result=$res->result();
            foreach($result as $rows){   }
            $classid=$rows->class_sec_id;
            $year_id=$this->getYear();
             $query="SELECT etfs.id,eer.name,etfs.student_id,etfs.status,etfs.paid_by,etfs.updated_at,eer.quota_id,eq.quota_name
            FROM edu_term_fees_status AS etfs LEFT JOIN edu_enrollment AS eer ON eer.enroll_id=etfs.student_id LEFT JOIN edu_quota AS eq ON eer.quota_id=eq.id  WHERE etfs.fees_id='$fees_id' AND etfs.class_master_id='$classid'";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"success","data"=>$result);
              return $data;
            }
          }

            //#################### GET LIST EXAM FOR CLASS  ####################//
          function get_list_exam_class($class_id,$section_id){
            $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
            $res=$this->db->query($sql);
            $result=$res->result();
            foreach($result as $rows){   }
            $classid=$rows->class_sec_id;
            $year_id=$this->getYear();
            $query="SELECT eed.exam_id,ee.exam_name,ee.exam_year,eac.from_month as Fromdate,eac.to_month as Todate,eed.classmaster_id,CASE WHEN ems.status='Publish' THEN 0 ELSE 0 END AS MarkStatus FROM edu_exam_details AS eed LEFT JOIN edu_examination AS ee ON ee.exam_id=eed.exam_id LEFT JOIN edu_exam_marks_status AS ems ON ems.exam_id=eed.exam_id LEFT JOIN edu_academic_year AS eac ON ee.exam_year=eac.year_id WHERE eed.classmaster_id='$classid' GROUP BY ee.exam_id";
                $result_query=$this->db->query($query);
                if($result_query->num_rows()==0){
                    $data=array("status"=>"error","msg"=>"nodata");
                    return $data;
                }else{
                  $result=$result_query->result();
                  $data=array("status"=>"success","msg"=>"success","Exams"=>$result);
                  return $data;
                }
          }


          //#################### GET  EXAM FOR CLASS  ####################//
          function get_exam_details_class($exam_id,$class_id){
            $query="SELECT eed.exam_id,eed.subject_id,es.subject_name,DATE_FORMAT(eed.exam_date,'%d-%m-%Y')AS exam_date,eed.times,eed.teacher_id,et.name
            FROM edu_exam_details AS eed LEFT JOIN edu_teachers AS et ON et.teacher_id=eed.teacher_id LEFT JOIN edu_subject AS es ON es.subject_id=eed.subject_id WHERE eed.classmaster_id='$class_id' AND eed.exam_id='$exam_id' AND eed.status='Active'";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"success","data"=>$result);
              return $data;
            }
          }


  //#################### GET  EXAM MARKS FOR CLASS  ####################//
          function get_exam_marks_class($exam_id,$class_id,$section_id){
            $sql="SELECT class_sec_id FROM edu_classmaster WHERE class='$class_id' AND section='$section_id'";
            $res=$this->db->query($sql);
            $result=$res->result();
            foreach($result as $rows){   }
            $class_mas_id=$rows->class_sec_id;
            $year_id=$this->getYear();
       $query="SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.subject_id,m.classmaster_id,m.internal_mark,m.internal_grade,m.external_mark,m.external_grade,m.total_marks,m.total_grade FROM edu_enrollment AS en,edu_exam_marks AS m WHERE en.class_id='$class_mas_id' AND en.enroll_id=m.stu_id AND m.exam_id='$exam_id'";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"success","data"=>$result);
              return $data;
            }
          }


          // Teachers OD form view
          function get_teachers_od_view($user_id){
            $year_id=$this->getYear();
            $query="SELECT eod.id,eod.od_for,eu.user_master_id,et.name,eod.from_date,eod.to_date,eod.notes,eod.status FROM edu_on_duty AS eod
            LEFT JOIN edu_users AS eu ON eu.user_id=eod.user_id LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id WHERE eod.user_type='2' AND eod.year_id='$year_id' ORDER BY eod.id DESC";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"odviewfound","ondutyDetails"=>$result);
              return $data;
            }
          }


          // Students OD FORM view
          function get_students_od_view($user_id){
            $year_id=$this->getYear();
            $query="SELECT du.id,du.od_for,du.notes,du.from_date,du.to_date,du.status,u.user_id,u.name,u.user_master_id,c.class_name,s.sec_name FROM edu_on_duty AS du,edu_enrollment AS en,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_users AS u WHERE du.user_type=3 AND du.user_id=u.user_id AND u.user_master_id=en.admission_id AND u.name=en.name AND cm.class_sec_id=en.class_id AND cm.class=c.class_id AND cm.section=s.sec_id AND du.year_id='$year_id' ORDER BY du.id DESC";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"odviewfound","ondutyDetails"=>$result);
              return $data;
            }
          }

            // GET Teacher Leaves
          function get_teachers_leaves($user_id){
            $year_id=$this->getYear();
            $query="SELECT eul.leave_id,eu.user_id,et.name,eulm.leave_title,eulm.leave_type,DATE_FORMAT(eul.from_leave_date,'%d-%m-%Y') AS from_leave_date,DATE_FORMAT(eul.to_leave_date,'%d-%m-%Y')AS to_leave_date,eul.leave_description,eul.status,eul.frm_time,eul.to_time FROM edu_user_leave  AS eul LEFT JOIN edu_users AS eu ON eu.user_id=eul.user_id LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id LEFT JOIN edu_user_leave_master AS eulm ON eulm.id=eul.leave_master_id WHERE eul.user_type='2' AND eul.year_id='$year_id' ORDER BY eul.leave_id DESC";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"leavesfound","leaveDetails"=>$result);
              return $data;
            }
          }



          function get_all_circular_view($user_id){
          $query="SELECT ecm.id,ecm.circular_title,ecm.circular_description,ec.circular_type,ecm.status,ecm.created_at as circular_date FROM edu_circular_master AS ecm,edu_circular as ec GROUP by id ORDER BY ecm.id DESC";
            $result_query=$this->db->query($query);
            if($result_query->num_rows()==0){
                $data=array("status"=>"error","msg"=>"nodata");
                return $data;
            }else{
              $result=$result_query->result();
              $data=array("status"=>"success","msg"=>"circularfound","circularDetails"=>$result);
              return $data;
            }
          }
}

?>
