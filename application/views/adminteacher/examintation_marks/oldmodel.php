<?php

Class Examinationresultmodel extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    
    function get_teacher_id($user_id,$user_type)
    {
        $query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
		
        $sql        = "SELECT * FROM edu_examination WHERE status='Active'";
        $resultset1 = $this->db->query($sql);
        $res        = $resultset1->result();
        return $res;
        // print_r($sec_n);exit
        //print_r($data);exit;
    }
    //------------------------New--------------------------------
	 function view_all_subject_details($exam_id,$user_id,$user_type)
	{
		$query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
		
		$sql="SELECT ts.*,su.subject_id,su.subject_name FROM edu_teacher_handling_subject AS ts,edu_subject AS su WHERE ts.teacher_id='$teacher_id' AND ts.subject_id=su.subject_id GROUP BY ts.subject_id";
        $resultset1=$this->db->query($sql);
        $res=$resultset1->result();
        return $res;
		
	} 
	
	function view_all_cls_details($exam_id,$sub_id,$user_id,$user_type)
	{
		$query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
		
		//$sql="SELECT ts.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_teacher_handling_subject AS ts,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ts.teacher_id='$teacher_id' AND cm.class_sec_id='' AND cm.class=c.class_id AND cm.section=s.sec_id GROUP BY ts.subject_id";
		 $sql="SELECT ts.id,ts.subject_id,ts.teacher_id,ts.class_master_id,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_teacher_handling_subject AS ts,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ts.teacher_id='$teacher_id' AND ts.subject_id='$sub_id' AND ts.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id";
        $resultset1=$this->db->query($sql);
        $res=$resultset1->result();
        return $res;
		
	}
	//-----------------------------------------------------------

    function getall_cls_sec($user_id)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id  = $rows->teacher_id;
		
        $get_classes = "SELECT class_name,class_teacher FROM edu_teachers WHERE teacher_id='$teacher_id'";
        $resultset1  = $this->db->query($get_classes);
        $teacher_row = $resultset1->result();
        foreach ($teacher_row as $teacher_rows) {}
        $teach_id = $teacher_rows->class_name;
        $cls_te   = $teacher_rows->class_teacher;
		
        $sQuery   = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class,cm.subject FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id  ORDER BY c.class_name";
        $objRs    = $this->db->query($sQuery);
        $row      = $objRs->result();
        foreach ($row as $rows1) {
            $s              = $rows1->class_sec_id;
            $sec            = $rows1->class;
            $clas           = $rows1->class_name;
            $sec_name       = $rows1->sec_name;
            $sub            = $rows1->subject;
            $arryPlatform   = explode(",", $teach_id);
            $sPlatform_id   = trim($s);
            $sPlatform_name = trim($sec);
            if (in_array($sPlatform_id, $arryPlatform)) {
                $class_id[]   = $s;
                $class_name[] = $clas;
                $sec_n[]      = $sec_name;
                $sub_id[]     = $sub;
            }
        }
        // print_r($sec_n);exit
        if (empty($class_id)) {
            $data = array(
                "status" => "No Record Found"
            );
            return $data;
        } else {
            $data = array(
                "class_id" => $class_id,
                "class_name" => $class_name,
                "sec_name" => $sec_n,
                "sub_id" => $sub_id,
                "cls_id" => $cls_te,
                "status" => "Record Found"
            );
            return $data;
        }
        //print_r($data);exit;
    }
    
	
    function get_cls_teacher_id($user_id,$user_type)
    {
        $query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
		//echo $teacher_id;exit;
        $get_classes = "SELECT class_teacher FROM edu_teachers WHERE teacher_id='$teacher_id' AND status='Active'";
        $resultset1  = $this->db->query($get_classes);
        $res         = $resultset1->result();
        return $res;
        /*foreach($teacher_row as $teacher_rows){}
        $teach_id=$teacher_rows->class_name;
        $cls_te=$teacher_rows->class_teacher; */
    }
    
    function getall_exam_details($exam_id)
    {
        $sql        = "SELECT * FROM edu_exam_details WHERE exam_id='$exam_id' GROUP By classmaster_id";
        $resultset1 = $this->db->query($sql);
        $res        = $resultset1->result();
        return $res;
    }
    function exam_date_check($user_id,$cls_masid,$exam_id,$user_type)
	{
		$query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
        //echo $teacher_id;exit; 
		
		 $edate="SELECT t.teacher_id,t.name,t.subject,ex.exam_detail_id,ex.exam_id,ex.subject_id,ex.exam_date,ex.classmaster_id,ex.status FROM edu_teachers AS t,edu_enrollment AS en,edu_exam_details AS ex WHERE t.teacher_id='$teacher_id' AND ex.subject_id=t.subject AND ex.classmaster_id='$cls_masid' AND ex.exam_id='$exam_id' AND ex.exam_date<NOW() AND ex.status='Active' GROUP BY ex.subject_id";
		$resultset3= $this->db->query($edate);
        $res2        = $resultset3->result();
        return $res2;
	}
    function getall_cls_sec_stu($user_id,$sub_id,$cls_masid,$exam_id,$user_type)
    {
        $query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
        //echo $teacher_id;exit;
         $sql        = "SELECT t.teacher_id,t.subject_id,t.class_master_id,su.subject_id,su.subject_name,en.enroll_id,en.admission_id,en.name,en.class_id,en.status FROM edu_subject AS su,edu_teacher_handling_subject AS t,edu_enrollment AS en WHERE t.subject_id='$sub_id' AND t.subject_id=su.subject_id AND en.class_id='$cls_masid' AND t.class_master_id=en.class_id AND t.teacher_id='$teacher_id' AND en.status='Active'";
        $res        = $this->db->query($sql);
        $result     = $res->result();
        return $result;
        
    }
    
    function getall_subname($user_id, $cls_masid, $exam_id)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {
        }
        $teacher_id = $rows->teacher_id;
        
        $query     = "SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$cls_masid'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        //print_r($row);exit;
        if (empty($row)) {
            $data = array(
                "status" => "Subject Not Found"
            );
            return $data;
        }
        foreach ($row as $rows) {
        }
        $id   = $rows->subject;
        //echo $id;
        // $id=$rows->subject;
        $sql  = "SELECT * FROM edu_subject";
        $res1 = $this->db->query($sql);
        $rows = $res1->result();
        // echo'<pre>';  print_r($rows);exit;
        foreach ($rows as $rows1) {
            $s   = $rows1->subject_id;
            $sec = $rows1->subject_name;
            
            $subid   = explode(",", $id);
            $subjid  = trim($s);
            $subname = trim($sec);
            if (in_array($subjid, $subid)) {
                $sub_name[] = $sec;
                $sub_id[]   = $s;
            }
            //return $a;
        }
        $datas = array(
            "status" => "Success",
            "subject_id" => $sub_id,
            "subject_name" => $sub_name
        );
        return $datas;
        
    }
    //-----------------------Get Class Marks------------------------------------
    
    function getall_stuname($user_id, $cls_masid, $exam_id)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->teacher_id;
        //echo $teacher_id;exit;
        //$sql="SELECT t.teacher_id,t.class_teacher,t.name,t.subject,en.enroll_id,en.name,en.admisn_no,en.class_id FROM edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND en.class_id='$cls_masid'";
        
        $sql  = "SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.subject_id,m.classmaster_id,m.internal_mark,m.internal_grade,m.external_mark,m.external_grade,m.total_marks,m.total_grade FROM edu_enrollment AS en,edu_exam_marks AS m WHERE en.class_id='$cls_masid' AND en.enroll_id=m.stu_id AND m.exam_id='$exam_id'";
        $res  = $this->db->query($sql);
        $rows = $res->result();
        return $rows;
    }
    
    function exam_marks_details($exam_id, $subid, $sutid, $clsmastid, $teaid, $internal_marks, $external_marks, $user_id)
    {
        $check="SELECT * FROM edu_exam_marks WHERE exam_id='$exam_id' AND subject_id='$subid' AND classmaster_id='$clsmastid'";
		$result1=$this->db->query($check);
		if($result1->num_rows()==0)
		{ 
        $count_name = count($external_marks);
        //echo $count_name; exit;
        for ($i = 0; $i < $count_name; $i++) {
            $user_id1   = $user_id;
            $sutid1     = $sutid[$i];
            //print_r($enroll);
            $subid1     = $subid;
            $clsmastid1 = $clsmastid;
            $teaid1     = $teaid;
            $examid1    = $exam_id;
            if (!empty($internal_marks[$i])) {
                $marks1 = $internal_marks[$i];
            } else {
                $marks1 = 0;
                $grade  = 'null';
            }
            //Internal Marks Grade
            if ($marks1 >= 37 && $marks1 <= 40) {
                $grade = 'A1';
            }
            if ($marks1 >= 33 && $marks1 <= 36) {
                $grade = 'A2';
            }
            if ($marks1 >= 29 && $marks1 <= 32) {
                $grade = 'B1';
            }
            if ($marks1 >= 25 && $marks1 <= 28) {
                $grade = 'B2';
            }
            if ($marks1 >= 21 && $marks1 <= 24) {
                $grade = 'C1';
            }
            if ($marks1 >= 17 && $marks1 <= 20) {
                $grade = 'C2';
            }
            if ($marks1 >= 13 && $marks1 <= 16) {
                $grade = 'D';
            }
            if ($marks1 >= 9 && $marks1 <= 12) {
                $grade = 'E1';
            }
            if ($marks1 <= 8) {
                $grade = 'E2';
            }
            
            //External Mark Grade
            $marks2 = $external_marks[$i];
            
            if ($marks2 >= 55 && $marks2 <= 60) {
                $grade1 = 'A1';
            }
            if ($marks2 >= 49 && $marks2 <= 54) {
                $grade1 = 'A2';
            }
            if ($marks2 >= 43 && $marks2 <= 48) {
                $grade1 = 'B1';
            }
            if ($marks2 >= 37 && $marks2 <= 42) {
                $grade1 = 'B2';
            }
            if ($marks2 >= 31 && $marks2 <= 36) {
                $grade1 = 'C1';
            }
            if ($marks2 >= 25 && $marks2 <= 30) {
                $grade1 = 'C2';
            }
            if ($marks2 >= 20 && $marks2 <= 24) {
                $grade1 = 'D';
            }
            if ($marks2 >= 13 && $marks2 <= 19) {
                $grade1 = 'E1';
            }
            if ($marks2 <= 12) {
                $grade1 = 'E2';
            }
            
            //Total Mark Grade
            $total = $marks1 + $marks2;
            
            if ($total >= 91 && $total <= 100) {
                $grade2 = 'A1';
            }
            if ($total >= 81 && $total <= 90) {
                $grade2 = 'A2';
            }
            if ($total >= 71 && $total <= 80) {
                $grade2 = 'B1';
            }
            if ($total >= 61 && $total <= 70) {
                $grade2 = 'B2';
            }
            if ($total >= 51 && $total <= 60) {
                $grade2 = 'C1';
            }
            if ($total >= 41 && $total <= 50) {
                $grade2 = 'C2';
            }
            if ($total >= 31 && $total <= 40) {
                $grade2 = 'D';
            }
            if ($total >= 21 && $total <= 30) {
                $grade2 = 'E1';
            }
            if ($total <= 20) {
                $grade2 = 'E2';
            }
            
            $query      = "INSERT INTO edu_exam_marks(exam_id,teacher_id,subject_id,stu_id,classmaster_id,internal_mark,internal_grade,external_mark,external_grade,total_marks,total_grade,created_by,created_at)VALUES('$examid1','$teaid1','$subid1','$sutid1','$clsmastid1','$marks1','$grade','$marks2','$grade1','$total','$grade2','$user_id1',NOW())";
            $resultset1 = $this->db->query($query);
        }
		  }else{
            $data= array("status"=>"Already Added");
            return $data;
            } 
        if ($resultset1) {
            $data = array("status" => "success");return $data;
        }else{
            $data = array("status" => "failure");return $data;
        }
                 
        
    }
    
    
    function add_marks_detail_ajax($exam_id, $subid, $sutid, $clsmastid, $teaid, $marks)
    {
        $query1    = "INSERT INTO edu_exam_marks(exam_id,teacher_id,subject_id,stu_id,classmaster_id,marks,created_at)VALUES('$exam_id','$teaid','$subid','$sutid','$clsmastid','$marks',NOW())";
        $resultset = $this->db->query($query1);
        if ($resultset) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "failure"
            );
            return $data;
        }
        
    }
	
    function getall_marks_details($user_id,$exam_id,$user_type)
    {
        $query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;
        
         $sql="SELECT em.*,t.name,t.teacher_id,su.subject_id,su.subject_name FROM edu_exam_marks AS em,edu_subject AS su,edu_teachers AS t WHERE em.exam_id='$exam_id' AND em.teacher_id='$teacher_id' AND t.teacher_id=em.teacher_id  AND em.subject_id=su.subject_id GROUP BY em.classmaster_id,em.subject_id ";
        $resultset = $this->db->query($sql);
        return $resultset->result();
    }
	
    function getall_marks_details1($user_id, $cls_masid)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        //foreach($row as $rows){}
        //$teacher_id=$rows->teacher_id;
        
        //$sql="SELECT subject_id,classmaster_id,marks FROM edu_exam_marks WHERE classmaster_id='$cls_masid'  ";
        //$resultset=$this->db->query($sql);
        //$res=$resultset->result();
        //$datas=array("status"=>"success","marks"=>$res);
        return $row;
    }
    
    function getall_marks($user_id,$cls_masid,$exam_id,$sub_id,$user_type)
    {
        $query     = "SELECT teacher_id,user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {}
        $teacher_id = $rows->user_master_id;

		$sql1 = "SELECT * FROM edu_exam_marks WHERE teacher_id='$teacher_id' AND subject_id='$sub_id' AND classmaster_id='$cls_masid' AND exam_id='$exam_id'";
        $result1 = $this->db->query($sql1);
        $row1    = $result1->result();
        return $row1;
        
    }
    
    function edit_marks_details($user_id, $subid, $clsmasid, $exam_id)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {
        }
        $teacher_id = $rows->teacher_id;
        
        $sql       = "SELECT m.*,en.enroll_id,en.admit_year,en.name,en.class_id,en.admisn_no FROM edu_exam_marks AS m,edu_enrollment AS en WHERE m.exam_id='$exam_id' AND m.subject_id='$subid' AND m.classmaster_id='$clsmasid' AND m.teacher_id='$teacher_id' AND en.class_id='$clsmasid' AND en.enroll_id=m.stu_id ";
        $resultset = $this->db->query($sql);
        $res       = $resultset->result();
        return $res;
        
    }
    
    function marks_status_details($clsmasid, $exam_id)
    {
        //echo $clsmasid;
        $query     = "SELECT * FROM edu_exam_marks_status WHERE status='Approved' OR status='Publish' AND exam_id='$exam_id' AND classmaster_id='$clsmasid'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        return $row;
    }
    
    function update_marks_details($teaid,$clsmastid,$exam_id,$subid,$internal_marks,$external_marks,$sutid,$user_id)
    {
       
        $count_name = count($external_marks);
        
        for ($i = 0; $i < $count_name; $i++) {
            $user_id1   = $user_id;
            $sutid1     = $sutid[$i];
            $subid1     = $subid;
            $clsmastid1 = $clsmastid;
            $teaid1     = $teaid;
            $examid1    = $exam_id;
            
            //Internal Marks Grade
            $marks1=$internal_marks[$i];
            
            if ($marks1 >= 37 && $marks1 <= 40) {
                $grade = 'A1';
            }
            if ($marks1 >= 33 && $marks1 <= 36) {
                $grade = 'A2';
            }
            if ($marks1 >= 29 && $marks1 <= 32) {
                $grade = 'B1';
            }
            if ($marks1 >= 25 && $marks1 <= 28) {
                $grade = 'B2';
            }
            if ($marks1 >= 21 && $marks1 <= 24) {
                $grade = 'C1';
            }
            if ($marks1 >= 17 && $marks1 <= 20) {
                $grade = 'C2';
            }
            if ($marks1 >= 13 && $marks1 <= 16) {
                $grade = 'D';
            }
            if ($marks1 >= 9 && $marks1 <= 12) {
                $grade = 'E1';
            }
            if ($marks1 <= 8) {
                $grade = 'E2';
            }
            
            
            //External Mark Grade
            $marks2 = $external_marks[$i];
            if ($marks2 >= 55 && $marks2 <= 60) {
                $grade1 = 'A1';
            }
            if ($marks2 >= 49 && $marks2 <= 54) {
                $grade1 = 'A2';
            }
            if ($marks2 >= 43 && $marks2 <= 48) {
                $grade1 = 'B1';
            }
            if ($marks2 >= 37 && $marks2 <= 42) {
                $grade1 = 'B2';
            }
            if ($marks2 >= 31 && $marks2 <= 36) {
                $grade1 = 'C1';
            }
            if ($marks2 >= 25 && $marks2 <= 30) {
                $grade1 = 'C2';
            }
            if ($marks2 >= 20 && $marks2 <= 24) {
                $grade1 = 'D';
            }
            if ($marks2 >= 13 && $marks2 <= 19) {
                $grade1 = 'E1';
            }
            if ($marks2 <= 12) {
                $grade1 = 'E2';
            }
            
            //Total Mark Grade
            $total = $marks1 + $marks2;
            if ($total >= 91 && $total <= 100) {
                $grade2 = 'A1';
            }
            if ($total >= 81 && $total <= 90) {
                $grade2 = 'A2';
            }
            if ($total >= 71 && $total <= 80) {
                $grade2 = 'B1';
            }
            if ($total >= 61 && $total <= 70) {
                $grade2 = 'B2';
            }
            if ($total >= 51 && $total <= 60) {
                $grade2 = 'C1';
            }
            if ($total >= 41 && $total <= 50) {
                $grade2 = 'C2';
            }
            if ($total >= 31 && $total <= 40) {
                $grade2 = 'D';
            }
            if ($total >= 21 && $total <= 30) {
                $grade2 = 'E1';
            }
            if ($total <= 20) {
                $grade2 = 'E2';
            }
          $update_marks="UPDATE edu_exam_marks SET internal_mark='$marks1',internal_grade='$grade',external_mark='$marks2',external_grade='$grade1',total_marks='$total',total_grade='$grade2',updated_by='$user_id1',updated_at=NOW() WHERE exam_id='$examid1' AND  classmaster_id='$clsmastid1' AND subject_id='$subid1' AND stu_id='$sutid1'";
          $resultset=$this->db->query($update_marks);
        }
        if($resultset) {
            $data=array("status" => "success");
        return $data;
        }else{
             $data=array("status" => "failure");
            return $data;
         }
    }
    
    function marks_status_update($exam_id, $clsmastid, $user_id)
    {
        $query      = "SELECT * FROM edu_exam_marks_status WHERE exam_id='$exam_id' AND classmaster_id='$clsmastid'";
        $resultset1 = $this->db->query($query);
        
        $sql1 = "SELECT * FROM edu_exam_marks_status WHERE exam_id='$exam_id' AND classmaster_id='$clsmastid'";
        $res1 = $this->db->query($sql1);
        $res  = $res1->result();
        foreach ($res as $ans) {
            $a = $ans->exam_id;
            $b = $ans->classmaster_id;
        }
        if ($resultset1->num_rows() == 0) {
            $sql    = "INSERT INTO edu_exam_marks_status(exam_id,classmaster_id,status,created_by,created_at) VALUES('$exam_id','$clsmastid','Approved','$user_id',NOW())";
            $result = $this->db->query($sql);
            
            $sql1 = "SELECT * FROM edu_exam_marks_status WHERE exam_id='$exam_id' AND classmaster_id='$clsmastid'";
            $res1 = $this->db->query($sql1);
            $res  = $res1->result();
            foreach ($res as $ans) {
                $a = $ans->exam_id;
                $b = $ans->classmaster_id;
            }
            
            if ($result) {
                $data = array(
                    "status" => "success",
                    "var1" => $a,
                    "var2" => $b
                );
                return $data;
            } else {
                $data = array(
                    "status" => "failure",
                    "var1" => $a,
                    "var2" => $b
                );
                return $data;
            }
        } else {
            $data = array(
                "status" => "Already Added Exam Marks",
                "var1" => $a,
                "var2" => $b
            );
            return $data;
        }
    }
    
    function exam_duty_details($user_id,$exam_id)
    {
        $query     = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset = $this->db->query($query);
        $row       = $resultset->result();
        foreach ($row as $rows) {
        }
        $teacher_id = $rows->teacher_id;
        //ORDER By ed.exam_detail_id DESC
        $sql        = "SELECT ed.*,ex.exam_id,ex.exam_year,ex.exam_name,t.teacher_id,t.name,s.subject_id,s.	subject_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_exam_details AS ed,edu_examination As ex,edu_subject AS s,edu_teachers AS t,edu_classmaster AS cm, edu_class AS c,edu_sections AS se WHERE ed.teacher_id='$teacher_id' AND ex.exam_id='$exam_id' AND ex.exam_id=ed.exam_id AND t.teacher_id=ed.teacher_id AND ed.subject_id=s.subject_id AND cm.class_sec_id=ed.classmaster_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER By ed.exam_date DESC ";
        $result     = $this->db->query($sql);
        $res        = $result->result();
        return $res;
    }
    
}
