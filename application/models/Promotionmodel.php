<?php

Class Promotionmodel extends CI_Model
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


      //Current Year
      function getall_years(){
        $get_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
        $result1=$this->db->query($get_year);
        if($result1->num_rows()==0){
          $data= array("status" => "no data Found");
          return $data;
        }else{
          $all_year= $result1->result();
          $data= array("status" => "success","all_years"=>$all_year);
          return $data;
        }

      }

     //Get Academic Year

     function get_all_academic_year(){
       $query="SELECT * FROM edu_academic_year WHERE status='Active'";
       $year_result = $this->db->query($query);
       return $year_result->result();
     }


    //  GET ALL Class
     function get_all_classes_for_year(){
       $query="SELECT c.class_name,s.sec_name,cm.class_sec_id  AS class_id FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm
        WHERE cm.class = c.class_id AND cm.section = s.sec_id AND cm.status='Active' ORDER BY c.class_name";
        $year_result = $this->db->query($query);
        return $year_result->result();
     }


    //  Create Promotion
    function create_promotion($current_year_id,$next_year_id,$class_master_id_for_last,$promotion_class_master_id,$student_id,$result_status,$user_id){
      $student_id_cnt=count($student_id);
      for($i=0;$i<$student_id_cnt;$i++){
        $student_id_list=$student_id[$i];
        $check ="SELECT * FROM edu_promotion_history WHERE current_academic_year_id='$current_year_id' AND student_reg_id_for_last_academic_year='$student_id_list' AND promotion_academic_year_id='$next_year_id'";
        $result_check=$this->db->query($check);
         if($result_check->num_rows()==0){
        $check ="SELECT admission_id,admisn_no,name,house_id,extra_curicullar_id,quota_id FROM edu_enrollment WHERE enroll_id='$student_id_list'";
        $result=$this->db->query($check);
        foreach($result->result() as $rows){
           $name=$rows->name;
           $admission_id=$rows->admission_id;
           $admisn_no=$rows->admisn_no;
           $house_id=$rows->house_id;
           $extra_curicullar_id=$rows->extra_curicullar_id;
           $quota_id=$rows->quota_id;

           $pro_query="INSERT INTO  edu_promotion_history (current_academic_year_id,promotion_academic_year_id,student_admission_id,student_reg_id_for_last_academic_year,student_name,class_master_id_for_last_academic_year,result_status,promotion_class_master_id,promoted_by,promoted_at) VALUES('$current_year_id','$next_year_id','$admission_id','$student_id_list','$name','$class_master_id_for_last','$result_status','$promotion_class_master_id','$user_id',NOW())";
           $res=$this->db->query($pro_query);

           $reg_query="INSERT INTO edu_enrollment (admission_id,admit_year,admit_date,admisn_no,name,class_id,house_id,extra_curicullar_id,quota_id,created_at,created_by,status) VALUES('$admission_id','$next_year_id',NOW(),'$admisn_no','$name','$promotion_class_master_id','$house_id','$extra_curicullar_id','$quota_id',NOW(),'$user_id','Active')";
            $req_q=$this->db->query($reg_query);

        }
      }else{
        $data= array("status" => "Already");
        return $data;
      }
     }
     if($req_q){
       $data= array("status" => "success");
       return $data;
     }else{
       $data= array("status" => "failure");
       return $data;
     }

    }


    function promotion_history(){
      $query="SELECT eph.id,eph.current_academic_year_id,eay.from_month AS last_year,eay.to_month AS to_year,
      promotion_academic_year_id,eac.from_month,eac.to_month,
      student_name,
      class_master_id_for_last_academic_year,c.class_name AS last_class,s.sec_name AS last_sec,result_status,promotion_class_master_id,cp.class_name,sp.sec_name
      FROM  edu_promotion_history AS eph
      LEFT JOIN edu_academic_year AS eay ON eay.year_id=eph.current_academic_year_id
      LEFT JOIN edu_academic_year AS eac ON eac.year_id=eph.promotion_academic_year_id
      LEFT JOIN edu_classmaster AS cm ON eph.class_master_id_for_last_academic_year=cm.class_sec_id
      LEFT JOIN edu_class AS c ON cm.class=c.class_id
      LEFT JOIN edu_sections AS s ON cm.section=s.sec_id
      LEFT JOIN edu_classmaster AS cmp ON eph.promotion_class_master_id=cmp.class_sec_id
      LEFT JOIN edu_class AS cp ON cmp.class=cp.class_id
      LEFT JOIN edu_sections AS sp ON cmp.section=sp.sec_id ORDER BY id DESC
      ";
      $resultset=$this->db->query($query);
      return  $res=$resultset->result();
    }



    function edit_promotion_history($id){
       $year_id=$this->getYear();
      $query="SELECT eph.id,eph.student_admission_id,ee.class_id,c.class_name AS last_class,s.sec_name AS last_sec,ee.name,eph.promotion_class_master_id,cp.class_name,sp.sec_name,
      eph.current_academic_year_id,eay.from_month AS last_year,eay.to_month AS to_year,eph.promotion_academic_year_id,eac.from_month,eac.to_month,eph.result_status
      FROM edu_promotion_history AS eph
      LEFT JOIN edu_academic_year AS eay ON eay.year_id=eph.current_academic_year_id
      LEFT JOIN edu_academic_year AS eac ON eac.year_id=eph.promotion_academic_year_id
      LEFT JOIN edu_enrollment AS ee ON ee.admission_id=eph.student_admission_id
      LEFT JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id
      LEFT JOIN edu_class AS c ON cm.class=c.class_id
      LEFT JOIN edu_sections AS s ON cm.section=s.sec_id
      LEFT JOIN edu_classmaster AS cmp ON eph.promotion_class_master_id=cmp.class_sec_id
      LEFT JOIN edu_class AS cp ON cmp.class=cp.class_id
      LEFT JOIN edu_sections AS sp ON cmp.section=sp.sec_id
      WHERE eph.id='$id' AND ee.admit_year='$year_id'";
      $resultset=$this->db->query($query);
      return  $res=$resultset->result();
    }


    function save_promotion($current_year_id,$student_admission_id,$next_year_id,$promotion_class_master_id,$result_status,$id,$user_id){
      $update_prom="UPDATE edu_promotion_history SET promotion_academic_year_id='$next_year_id',promotion_class_master_id='$promotion_class_master_id',result_status='$result_status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
      $resultset=$this->db->query($update_prom);

      // Update in Registeration
      $update_enrol="UPDATE edu_enrollment SET class_id='$promotion_class_master_id',admit_year='$next_year_id' WHERE admit_year='$next_year_id' AND admission_id='$student_admission_id'";
      $resultset_reg=$this->db->query($update_enrol);

      if($resultset_reg){
        $data= array("status" => "success");
        return $data;
       }else{
        $data= array("status" => "failure");
        return $data;
      }

    }


    function view_list_for_year($year_id){
    $query="SELECT e.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,a.admission_id,a.admisn_no,a.sex,a.name
    FROM edu_enrollment AS e,edu_classmaster AS cm, edu_sections AS s,edu_class AS c,edu_admission AS a WHERE e.class_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND e.admission_id=a.admission_id
    AND e.name=a.name AND e.admisn_no=a.admisn_no AND e.admit_year='$year_id' ORDER BY enroll_id DESC";
    $resultset=$this->db->query($query);
    return  $res=$resultset->result();
    }


    function get_year_name($year_id){
      $query="SELECT * FROM edu_academic_year WHERE year_id='$year_id'";
      $resultset=$this->db->query($query);
      return  $res=$resultset->result();
    }






}
	?>
