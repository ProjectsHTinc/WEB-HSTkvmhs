<?php

Class Rankmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }


  function getYear()
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

  function get_exam_details_view()
  {
  	 $year_id=$this->getYear();

  	$query= "SELECT ex.*,ed.exam_detail_id,ed.exam_id FROM edu_examination AS ex,edu_exam_details AS ed WHERE ex.status='Active' AND ex.exam_year='$year_id' AND ex.exam_id=ed.exam_id  GROUP By ed.exam_id";
	$cls=$this->db->query($query);
	$row=$cls->result();
	return $row;
  }

  function get_cls_details_view()
  {
  	$query= "SELECT cm.class_sec_id,em.classmaster_id,c.class_name,s.sec_name FROM  edu_exam_marks AS em,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE em.classmaster_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id GROUP By em.classmaster_id";
	$cls=$this->db->query($query);
	$row=$cls->result();
	return $row;
  }

  function get_rank_details_view($year_id,$examid,$cls_id,$sub_id,$pass_mark)
  {

        //$query= "SELECT cm.class_sec_id FROM edu_classmaster AS cm WHERE cm.class IN ($cls_id)";
	     //$cls=$this->db->query($query);
	    //$row=$cls->result();
	   //foreach($row as $rows){
    //$cm_id[]=$rows->class_sec_id; }
   //$cid=implode(',', $cm_id);

    //SELECT em.classmaster_id,s.subject_name,em.internal_mark,em.external_mark,em.total_marks,en.name FROM edu_exam_marks AS em,edu_enrollment AS en,edu_subject AS s WHERE em.exam_id='1' AND em.classmaster_id IN(14,17,18,19) AND em.stu_id=en.enroll_id AND em.total_marks >= 30 AND em.subject_id=s.subject_id ORDER BY em.total_marks DESC

   //SELECT sum(total_marks) as total,em.total_marks,em.subject_id,em.classmaster_id,em.stu_id,st.name,c.class_name,s.sec_name FROM edu_exam_marks AS em,edu_enrollment AS st, edu_class AS c,edu_sections AS s,edu_classmaster AS cm WHERE em.classmaster_id IN($cid) AND em.exam_id IN($examid) AND em.stu_id=st.enroll_id   AND FIND_IN_SET(em.classmaster_id,cm.class_sec_id) AND cm.class_sec_id IN($cid) AND FIND_IN_SET(cm.class,c.class_id) AND FIND_IN_SET(cm.section,s.sec_id)  GROUP BY em.classmaster_id,em.stu_id;

   $query= "SELECT sum(total_marks) as total,GROUP_CONCAT(if(em.total_marks>=$pass_mark,'Pass','Fail')) AS Subject_marks,st.name,ad.sex,c.class_name,s.sec_name,GROUP_CONCAT(em.internal_mark) AS inm,GROUP_CONCAT(em.external_mark) AS exm FROM edu_exam_marks AS em LEFT JOIN edu_enrollment AS st ON  em.stu_id=st.enroll_id LEFT JOIN edu_classmaster AS cm ON em.classmaster_id=cm.class_sec_id LEFT JOIN  edu_class AS c
   ON  cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_examination AS ed ON ed.exam_id=em.exam_id LEFT JOIN edu_subject AS su ON su.subject_id=em.subject_id LEFT JOIN edu_admission As ad ON ad.admission_id=st.admission_id WHERE ed.exam_id='$examid' AND em.classmaster_id='$cls_id' AND em.exam_id IN($examid)
    AND  em.subject_id IN($sub_id) GROUP BY em.classmaster_id,em.stu_id ORDER BY ad.sex DESC,st.name ASC";
	  $marks=$this->db->query($query);
	  $row1=$marks->result();
	  return $row1;
  }

  function get_all_subject_details($clss_id)
  {
     $query1= "SELECT s.subject_name,em.subject_id,em.classmaster_id FROM edu_exam_marks AS em,edu_subject AS s WHERE em.classmaster_id='$clss_id' AND em.subject_id=s.subject_id GROUP By em.subject_id";
     $sub=$this->db->query($query1);
     //return $row=$sub->result();
      if($sub->num_rows()==0){
        $data= array("status" =>"nodata");
        return $data;
      }else{
        $res=$sub->result();
        $data=array("status"=>"success","result"=>$res);
        return $data;
     }
  }

}
?>
