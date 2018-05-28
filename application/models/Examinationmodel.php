<?php

Class Examinationmodel extends CI_Model
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

function get_exam_details()
{   
	$year_id=$this->getYear();

	$query="SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_examination AS e,edu_academic_year AS y WHERE e.exam_year=y.year_id AND e.exam_year='$year_id' ORDER BY exam_id DESC";
	$resultset=$this->db->query($query);
	return $resultset->result();
}

function get_years_details()
{
	$query= "SELECT * FROM edu_academic_year WHERE status='Active'";
	$year=$this->db->query($query);
	$row=$year->result();
	return $row;
}

function view_exam_details($exam_id,$classmaster_id)
{
	$year_id=$this->getYear();

	 $query="select ed.exam_name,ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.times,ex.classmaster_id,ex.exam_id,cm.class_sec_id,ex.teacher_id,ex.status,ex.subject_total,ex.is_internal_external,ex.internal_mark,ex.external_mark,s.subject_name,s.subject_id,c.class_name,se.sec_name FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se,edu_examination AS ed WHERE ex.exam_id IN('$exam_id') AND ed.exam_id=ex.exam_id AND ed.exam_year='$year_id'  AND ex.subject_id=s.subject_id AND ex.classmaster_id IN('$classmaster_id') AND ex.classmaster_id=cm.class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section";
	$resultset=$this->db->query($query);
   return $resultset->result();

}

function get_details_view()
{ 
	$year_id=$this->getYear();
	$query="select y.year_id,y.from_month,y.to_month,ed.exam_name,ed.exam_year,ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.times,ex.classmaster_id,ex.exam_id,cm.class_sec_id,ex.teacher_id,ex.status,s.subject_name,s.subject_id,c.class_name,se.sec_name FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se,edu_examination AS ed,edu_academic_year AS y WHERE ed.exam_id=ex.exam_id AND ed.exam_year='$year_id' AND ed.exam_year=y.year_id AND ex.subject_id=s.subject_id AND ex.classmaster_id=cm.class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section GROUP BY ex.exam_id ASC, ex.classmaster_id ASC";
	$resultset=$this->db->query($query);
   return $resultset->result();

}

function search_details_view($class_name)
{  
	 $year_id=$this->getYear();
	$query="select ed.exam_name,ex.*,s.subject_name,s.subject_id,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,se.sec_id,se.sec_name FROM edu_exam_details AS ex,edu_examination AS ed, edu_subject AS s,edu_classmaster AS cm, edu_class AS c,edu_sections AS se  WHERE ex.classmaster_id='$class_name' AND ex.subject_id=s.subject_id AND ex.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id AND ex.exam_id=ed.exam_id AND ed.exam_year='$year_id'";
	$resultset=$this->db->query($query);
	return $resultset->result();  
}

function get_details_view1()
{
	$query="select ex.exam_detail_id,ex.subject_id,ex.exam_date,ex.status,ex.times,ex.classmaster_id,cm.class_sec_id,ex.teacher_id,s.subject_name,c.class_name,se.sec_name  FROM edu_exam_details AS ex,edu_classmaster AS cm,edu_subject AS s,edu_class AS c,edu_sections AS se WHERE  ex.subject_id=s.subject_id AND ex.classmaster_id=cm.class_sec_id AND c.class_id =cm.class AND se.sec_id=cm.section GROUP BY c.class_name,se.sec_name";

	// select ex.classmaster_id,c.class_name,s.sec_name FROM  edu_exam_details AS ex,edu_classmaster AS cm, edu_class AS c,edu_sections AS s WHERE c.class_id =cm.class AND s.sec_id=cm.section


	$resultset=$this->db->query($query);
	return $resultset->result();
}

function getall_exam_details($exam_id)
{
	$sql = "SELECT ed.exam_id,ex.exam_id,ex.exam_flag,ex.status FROM edu_exam_details AS ed,edu_examination AS ex WHERE ed.exam_id='$exam_id' AND ex.exam_id='$exam_id' AND ed.exam_id=ex.exam_id GROUP By ed.exam_id";
	$resultset1 = $this->db->query($sql);
	$res        = $resultset1->result();
	return $res;
}

function getall_exam_inter_exter_details($exam_id,$cls_masid)
{
	$sql="SELECT ed.exam_detail_id,ed.exam_id,ed.subject_id,ed.exam_date,ed.classmaster_id,ed.subject_total,ed.is_internal_external,ed.internal_mark,ed.external_mark,ex.exam_id,ex.exam_year,ex.exam_name,ex.status,ex.exam_flag FROM edu_exam_details AS ed,edu_examination AS ex WHERE ed.exam_id='$exam_id' AND ed.classmaster_id='$cls_masid' AND ed.exam_id=ex.exam_id ";
	$resultset1 = $this->db->query($sql);
	$res        = $resultset1->result();
	return $res;
}

function exam_details($exam_year,$exam_name,$exam_flag,$status)
{
	$check_exam_name="SELECT * FROM edu_examination WHERE exam_name='$exam_name' AND exam_year='$exam_year'";
	$result=$this->db->query($check_exam_name);
	if($result->num_rows()==0)
	{
		$query="INSERT INTO edu_examination(exam_year,exam_name,exam_flag,status,created_at,updated_at)VALUES('$exam_year','$exam_name','$exam_flag','$status',NOW(),NOW())";
		$resultset=$this->db->query($query);
		$data= array("status"=>"success");
		return $data;
	}else{
		$data= array("status"=>"Exam Name Already Exist");
		return $data;
	}
}

function add_exam_details($exam_year,$class_name,$subject_name,$exdate,$time,$teacher_id,$status,$sub_total,$inter_mark,$exter_mark,$inter_exter_mark,$user_id)
{
	$count_name = count($subject_name);
	//echo $count_name; 
	for($i=0;$i<$count_name;$i++)
	{
		//print_r($exam_year);exit;
		$exam_years=$exam_year;
		$class_id=$class_name;
		$subject_id=$subject_name[$i];

		$exam_dates=$exdate[$i];
		$times=$time[$i];
		$tea_id=$teacher_id[$i];

		$subtlt=$sub_total[$i];
		$inter_exter=$inter_exter_mark[$i];

		if($inter_exter=='0'){
			$inter='0';
			$exter='0';
		}else{
			$inter=$inter_mark[$i];
			$exter=$exter_mark[$i];
		}
     //echo $inter;  echo $exter; exit;
	$check_exam_name="SELECT * FROM edu_exam_details WHERE exam_id='$exam_years' AND subject_id='$subject_id' AND classmaster_id='$class_id' AND exam_date='$exam_dates' AND times='$times'";
	$result=$this->db->query($check_exam_name);
	if($result->num_rows()==0)
	{  
		$query="INSERT INTO edu_exam_details(exam_id,subject_id,exam_date,times,classmaster_id,teacher_id,subject_total,is_internal_external,internal_mark,external_mark,status,created_by,created_at) VALUES ('$exam_years','$subject_id','$exam_dates','$times','$class_id','$tea_id','$subtlt','$inter_exter','$inter','$exter','$status','$user_id',NOW())";
		$resultset=$this->db->query($query);
	}else{
		$data= array("status"=>"Exam Already Exist");
		return $data;
	}  
}
	$data= array("status" => "success");
	return $data;
}
function edit_exam($exam_id)
{
	$query1="SELECT * FROM  edu_examination WHERE exam_id='$exam_id'";
	$res=$this->db->query($query1);
	return $res->result();
}
function update_exam($exam_id,$exam_year,$exam_name,$exam_flag,$status)
{
	$query="UPDATE edu_examination SET exam_year='$exam_year',exam_name='$exam_name',exam_flag='$exam_flag',status='$status' WHERE exam_id='$exam_id'";
	$res=$this->db->query($query);
	$query1="UPDATE edu_exam_details SET status='$status' WHERE exam_id='$exam_id'";
	$res=$this->db->query($query1);
	//return $res->result();
	if($res){
		$data= array("status" => "success");
		return $data;
	}else{
		$data= array("status" => "Failed to Update");
		return $data;
	}
}

function edit_exam_details($exam_detail_id) 
{
	$query1="SELECT ed.*,ex.exam_year,ex.exam_name,ex.exam_id,y.year_id,y.from_month,y.to_month FROM  edu_exam_details AS ed, edu_examination AS ex,edu_academic_year AS y WHERE exam_detail_id='$exam_detail_id' AND ed.exam_id=ex.exam_id AND ex.exam_year=y.year_id GROUP BY ed.exam_id";
	$res=$this->db->query($query1);
	return $res->result();
}

function update_exam_detail($id,$exam_year,$class_name,$subject_name,$formatted_date,$time,$teacher_id,$status,$sub_total,$inter_mark,$exter_mark,$inter_exter_mark,$user_id)
{
	//$check_exam_name="SELECT * FROM edu_exam_details WHERE exam_id='$exam_year' AND subject_id='$subject_name' AND classmaster_id='$class_name' AND exam_date='$formatted_date' AND times='$time' AND teacher_id='$teacher_id' AND status='$status' AND internal_mark='$inter_mark' AND external_mark='$exter_mark' AND is_internal_external='$inter_exter_mark'";
	// $result=$this->db->query($check_exam_name);
	//if($result->num_rows()==0)
	// {  
	$query="UPDATE edu_exam_details SET exam_id='$exam_year',subject_id='$subject_name',exam_date='$formatted_date',times='$time',classmaster_id='$class_name',teacher_id='$teacher_id',subject_total='$sub_total',is_internal_external='$inter_exter_mark',internal_mark='$inter_mark',external_mark='$exter_mark',status='$status',updated_by='$user_id',updated_at=NOW() WHERE exam_detail_id='$id' ";
	$res=$this->db->query($query);
	$data= array("status" => "success");
	return $data;
	//}else{
	//$data= array("status" => "Exam Already Exist");
	//return $data;
	//}
}

function check_add_exam($classid,$examid)
{
	$sql="SELECT * FROM edu_exam_details WHERE classmaster_id='$examid' AND exam_id='$classid'";
	$res1=$this->db->query($sql);
	return count($res1->result());
}
//-------------------Exam Class Result------------------------------

function exam_name_status()
{
	//$sql="SELECT * FROM edu_exam_marks_status ";
	$sql="SELECT ms.*,ex.exam_id,ex.exam_year,ex.exam_name FROM edu_exam_marks_status AS ms,edu_examination AS ex WHERE ms.exam_id=ex.exam_id GROUP BY ms.exam_id";
	$res=$this->db->query($sql);
	$result=$res->result();
	return $result;
}

function marks_statuss($exam_id)
{  
	//$sql="SELECT * FROM edu_exam_marks_status ";
	$sql="SELECT ms.*,cm.class_sec_id,cm.class,cm.section,c.*,s.* FROM edu_exam_marks_status AS ms,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ms.exam_id='$exam_id' AND ms.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id";
	$res=$this->db->query($sql);
	$result=$res->result();
	return $result;
}

function clsname_examname($exam_id,$cls_masid)
{  
	$get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
	$result1=$this->db->query($get_year);
	$all_year= $result1->result();
	foreach($all_year as $cyear){}
	$current_year=$cyear->year_id; 

	$sql="SELECT ex.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_examination AS ex,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE ex.exam_id='$exam_id' AND exam_year='$current_year' AND cm.class_sec_id='$cls_masid' AND cm.class=c.class_id AND cm.section=s.sec_id";
	$res=$this->db->query($sql);
	$result=$res->result();
 return $result;

}
function marks_status_details($clsmasid,$exam_id)
{
	//echo $clsmasid;
$query="SELECT * FROM edu_exam_marks_status WHERE status='Publish' AND exam_id='$exam_id' AND classmaster_id='$clsmasid'";
	$resultset=$this->db->query($query);
	$row=$resultset->result();
	return $row;
}

function getall_stuname($user_id,$cls_masid,$exam_id)
{
			 $sql="SELECT
			en.enroll_id,
			en.name,
			en.admission_id,
			en.admisn_no,
			en.class_id,
			m.subject_id,
			m.classmaster_id,
			m.internal_mark,
			m.internal_grade,
			m.external_mark,
			m.external_grade,
			m.total_marks,
			m.total_grade,
			a.admission_id,
			a.admisn_no,
			a.name,
			a.sex,
			a.language,
			s.subject_name,
			s.is_preferred_lang,
			if(s.is_preferred_lang='1',s.subject_name,'') AS pref_language 
		FROM
			edu_enrollment AS en,
			edu_exam_marks AS m,
			edu_admission AS a,
			edu_subject AS s
		WHERE
			en.class_id = '$cls_masid' AND en.enroll_id = m.stu_id AND m.exam_id = '$exam_id' AND en.admission_id = a.admission_id AND s.subject_id = a.language ORDER BY a.sex DESC,en.name ASC";
	
	//$sql="SELECT en.enroll_id,en.name,en.admission_id,en.admisn_no,en.class_id,m.subject_id,m.classmaster_id,m.internal_mark,m.internal_grade,m.external_mark,m.external_grade,m.total_marks,m.total_grade,a.admission_id,a.admisn_no,a.name,a.sex,a.language,s.subject_name FROM edu_enrollment AS en,edu_exam_marks AS m,edu_admission AS a LEFT JOIN edu_subject AS s ON s.subject_id=a.language WHERE en.class_id='$cls_masid' AND en.enroll_id=m.stu_id AND m.exam_id='$exam_id' AND en.admission_id=a.admission_id ORDER BY a.sex DESC,en.name ASC";
	//$sql="SELECT en.enroll_id,en.name,en.admisn_no,en.class_id,m.exam_id,m.subject_id,m.classmaster_id,m.marks FROM edu_enrollment AS en,edu_exam_marks AS m WHERE m.exam_id='$exam_id' AND m.classmaster_id='$cls_masid' AND en.class_id='$cls_masid' AND en.enroll_id=m.stu_id ";
	$res=$this->db->query($sql); 
	$rows=$res->result();
	return $rows;
}


//----------------

function getall_subname($user_id,$cls_masid,$exam_id)
{
	$sql1="SELECT estc.id,estc.class_master_id,estc.subject_id,estc.exam_flag,estc.status,su.subject_id,su.subject_name FROM edu_subject_to_class AS estc,edu_subject AS su WHERE estc.class_master_id='$cls_masid' AND estc.subject_id=su.subject_id AND estc.exam_flag='0' AND  estc.status='Active' ";
	$resultset3=$this->db->query($sql1);
	$res1=$resultset3->result();
	//return $res1;
	/* if(empty($res1)){
	$data=array("status" =>"Record Not Found");
	return $data;
	}else{ */
	foreach($res1 as $rows1){
	$sub_id[]=$rows1->subject_id;$sub_name[]=$rows1->subject_name;}
	$data=array("status" =>"Success","subject_id" =>$sub_id,"subject_name" =>$sub_name);
	//return $data;
	//echo "<pre>"; print_r($data);			
	return $data; 
	//}

}  

//-------------
/* function getall_subname($user_id,$cls_masid,$exam_id)
{

$query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$cls_masid'";
$resultset=$this->db->query($query);
$row=$resultset->result();
//print_r($row);exit;
if(empty($row))
{
$data= array("status" =>"Subject Not Found");
return $data;
}
foreach($row as $rows)
{ }
$id=$rows->subject;
//echo $id;
// $id=$rows->subject;
$sql="SELECT * FROM edu_subject";
$res1=$this->db->query($sql);
$rows=$res1->result();
// echo'<pre>';  print_r($rows);exit;
foreach ($rows as $rows1) 
{
$s= $rows1->subject_id;
$sec=$rows1->subject_name;

$subid = explode(",",$id);
$subjid  = trim($s);
$subname  = trim($sec);
if(in_array($subjid,$subid))
{
$sub_name[]=$sec;
$sub_id[]=$s;
}
//return $a;
}
$datas= array("status" =>"Success","subject_id"=>$sub_id,"subject_name"=>$sub_name);
return $datas;

}
*/
function update_exam_status($exid,$cmid,$user_id)
{
	$sql1="SELECT * FROM edu_exam_marks_status WHERE exam_id='$exid' AND classmaster_id='$cmid' AND status='Publish'";
	$res1=$this->db->query($sql1);
	$res2=$res1->result();
	foreach($res2 as $ans){
		$a=$ans->exam_id;
		$b=$ans->classmaster_id;
		}
	if($res1->num_rows()==0)
	{
		$sql="UPDATE edu_exam_marks_status SET status='Publish',updated_by='$user_id',updated_at=NOW() WHERE exam_id='$exid' AND classmaster_id='$cmid'";
		$res=$this->db->query($sql);

		$sql1="SELECT * FROM edu_exam_marks_status WHERE exam_id='$exid' AND classmaster_id='$cmid'";
		$res1=$this->db->query($sql1);
		$res2=$res1->result();
		foreach($res2 as $ans){
		$a=$ans->exam_id;
		$b=$ans->classmaster_id;
	}
	if($res)
	{
		$data= array("status" => "success","var1"=>$a,"var2"=>$b);
		return $data;
	}else{
		$data= array("status" => "Failed to Update","var1"=>$a,"var2"=>$b);
		return $data;
	}
	}else{
		$data= array("status" => "Already Approved Exam Marks","var1"=>$a,"var2"=>$b);
		return $data;
	}
}

function get_subject($classid)
{
	$sql1="SELECT estc.id,estc.class_master_id,estc.subject_id,estc.exam_flag,estc.status,su.subject_id,su.subject_name FROM edu_subject_to_class AS estc,edu_subject AS su WHERE estc.class_master_id='$classid' AND estc.subject_id=su.subject_id AND estc.exam_flag='0' AND  estc.status='Active' ";
	$resultset3=$this->db->query($sql1);
	$res1=$resultset3->result();
	if(empty($res1))
	{
		$data=array("status" =>"Subject Not Found");
		return $data;
	}else{
		foreach($res1 as $rows1){
		$sub_id[]=$rows1->subject_id;$sub_name[]=$rows1->subject_name;}
		$data=array("status" =>"Success","subject_id" =>$sub_id,"subject_name" =>$sub_name);
		//return $data;
		//echo "<pre>"; print_r($data);			
		return $data; 
	}
}

}
?>
