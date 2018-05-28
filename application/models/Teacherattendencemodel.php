<?php

Class Teacherattendencemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


      function get_cur_year(){
        $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
        $get_year=$this->db->query($check_year);
        foreach($get_year->result() as $current_year){}
        //
        if($get_year->num_rows()==1){
          $acd_year= $current_year->year_id;
          $data= array("status" =>"success","cur_year"=>$acd_year);
          //print_r($data);exit;
           return $data;
        }else{
          $data= array("status" =>"noYearfound");
          return $data;
        }
      }


      function get_teacher_id($user_id){
        $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
         foreach($row as $rows){}
        $teacher_id=$rows->teacher_id;
        $get_classes="SELECT eths.teacher_id,eths.class_master_id,eths.subject_id,et.name,c.class_name,s.sec_name,esu.subject_name FROM edu_teacher_handling_subject AS eths
        LEFT JOIN edu_teachers AS et ON et.teacher_id=eths.teacher_id LEFT JOIN edu_classmaster AS cm ON eths.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
        LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON eths.subject_id=esu.subject_id WHERE eths.teacher_id='$teacher_id' AND eths.status='Active'  GROUP BY eths.class_master_id";
        $resultset1=$this->db->query($get_classes);
        $res=$resultset1->result();
        return $res;
		}


       function get_studentin_class($class_id){
         $acd_year=$this->get_cur_year();
        $ye= $acd_year['cur_year'];
        $query="SELECT en.*,a.name,a.sex FROM edu_enrollment AS en,edu_admission AS a  WHERE en.class_id='$class_id' AND en.admit_year='$ye' AND en.status='Active' AND en.admission_id=a.admission_id ORDER BY a.sex DESC,en.name ASC";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


       function get_attendence_class($class_id,$student_id,$attendence_val,$a_taken,$student_count,$get_academic){
            $len=count($student_id);
           if(empty($attendence_val)){
             $at_val=0;
           }else{
                $at_val=count($attendence_val);
           }
           $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
          $cur_d=$dateTime->format("Y-m-d H:i:s");
            $cur_da=$dateTime->format("Y-m-d");
          $a_pe=$dateTime->format("A");

          if($a_pe=="AM"){
            $a_period="0";
          }else{
            $a_period="1";
          }
		  
          //$check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_da' AND attendence_period='$a_period'";
		  $check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_da'";
          $get_att=$this->db->query($check_attendence);

          if($get_att->num_rows()==0){
            $add_att_cal="INSERT INTO edu_attendance_calendar(Date,class_master_id) VALUES('$cur_d',$class_id)";
            $att_add=$this->db->query($add_att_cal);
            $total_present=$student_count-$at_val;
              $query="INSERT INTO edu_attendence (ac_year,class_id,class_total,attendence_period,created_by,created_at,status) VALUES('$get_academic','$class_id','$student_count','$a_period','$a_taken','$cur_d','Active')";
             $resultset=$this->db->query($query);
             $atten_id = $this->db->insert_id();
             if(empty($attendence_val)){
               $data= array("status" =>"success");
               return $data;
             }else{
               $last_id=$this->db->insert_id();
               $myArray1 = implode(',', $attendence_val);
               $myArray = explode(',', $myArray1);
               $sp=array_chunk($myArray,3);
               $at_len=count($attendence_val);
               for ($i=0; $i <$at_len; $i++) {
                  $a_status= $sp[$i][0];
                 $stu_id= $sp[$i][1];
                 $a_day= $sp[$i][2];
             if($a_status!="P"){
               $add_att="INSERT INTO edu_attendance_history(attend_id,class_id,student_id,abs_date,a_status,attend_period,a_val,a_taken_by,created_at,status) VALUES('$last_id','$class_id','$stu_id','$cur_d','$a_status','$a_period','1','$a_taken',NOW(),'Active')";
                $resultset=$this->db->query($add_att);
             }
          }
          $att_co="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$atten_id' AND a_status='L'";
          $res_att=$this->db->query($att_co);
          foreach($res_att->result() as $rwos){}
          $leav_count= $rwos->absentcount;
           $att_co1="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$atten_id' AND a_status='A'";
          $res_att1=$this->db->query($att_co1);
          foreach($res_att1->result() as $rwos){}
          $abs_cnt= $rwos->absentcount;
           $abs_count=$leav_count+$abs_cnt;
           $no_prese=$at_val-$abs_count;
            $update_class_present="UPDATE edu_attendence SET no_of_present='$no_prese',no_of_absent='$abs_count' WHERE at_id='$atten_id'";
          $res_update=$this->db->query($update_class_present);

             if($resultset){
               $delte="DELETE FROM edu_attendance_history WHERE a_status='P'";
               $resultdelete=$this->db->query($delte);

               $data= array("status" =>"success");
               return $data;
             }else{
               $data= array("status" =>"failure");
               return $data;
             }
             }
          }else{
            $data= array("status" =>"taken");
            return $data;

          }


       }

       function check_attendence($class_id){
         $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
         $cur_d=$dateTime->format("Y-m-d");
         $a_day=$dateTime->format("A");
         if($a_day=="AM"){
           $a_period="0";
         }else{
            $a_period="1";
         }

           $check_leave="SELECT * FROM edu_leavemaster AS elm LEFT JOIN edu_leaves AS el ON el.leave_mas_id=elm.leave_id WHERE el.leave_date='$cur_d' AND FIND_IN_SET('$class_id',elm.leave_classes)";
          $get_le=$this->db->query($check_leave);

          if($get_le->num_rows()==0){
             $check_reg_leave="SELECT * FROM edu_leavemaster AS elm LEFT JOIN edu_holidays_list_history AS ehlh ON ehlh.leave_masid=elm.leave_id WHERE ehlh.leave_list_date='$cur_d' AND FIND_IN_SET('$class_id',elm.leave_classes)";

            $get_re=$this->db->query($check_reg_leave);
            if($get_re->num_rows()==0){
               //$check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_d' AND attendence_period='$a_period'";
			   $check_attendence="SELECT * FROM edu_attendence WHERE class_id='$class_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$cur_d'";
               $get_att=$this->db->query($check_attendence);
               if($get_att->num_rows()==0){

                 $data= array("status" =>"success");
                 return $data;

               }else{
                 $data= array("status" =>"taken");
                 return $data;

               }
               $data= array("status" =>"success");
              return $data;
            }
            else{
              $data= array("status" =>"regular");
              return $data;

            }
            $data= array("status" =>"success");
            return $data;
          }else{
            $data= array("status" =>"special");
            return $data;

          }

       }


       function get_atten_val($class_id){
          $acd_year=$this->get_cur_year();
          $ye= $acd_year['cur_year'];
          $query="SELECT ea.*,eu.name FROM edu_attendence  AS ea JOIN edu_users  AS eu ON eu.user_id=ea.created_by WHERE class_id='$class_id' AND ac_year='$ye' ORDER BY created_at DESC";
          $res=$this->db->query($query);
          return $res->result();
       }

       function get_list_record($at_id,$class_id){
         $acd_year=$this->get_cur_year();
         $ye= $acd_year['cur_year'];
         $query="SELECT  c.enroll_id, c.name,c.admission_id, o.a_status,a.sex FROM  edu_enrollment c LEFT JOIN edu_attendance_history o ON c.enroll_id = o.student_id AND o.attend_id ='$at_id' LEFT JOIN edu_admission a ON a.admission_id=c.admission_id WHERE c.class_id='$class_id' AND c.admit_year='$ye' AND c.status='Active' ORDER BY a.sex DESC,c.name ASC";
         $res=$this->db->query($query);
         return $res->result();
       }

      //Get Total Working Days For class
      function get_total_working_days($first,$last,$class_master_id){
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];

       $total_days_query = "SELECT * FROM edu_attendence WHERE date(created_at) >= '$first' AND date(created_at) <= '$last' AND  ac_year='$year_id' AND class_id='$class_master_id'";
       $total_days_res = $this->db->query($total_days_query);
       $total_days_result= $total_days_res->result();
       $total_days_count = $total_days_res->num_rows();

       if($total_days_res->num_rows()==0){
            $data= array("status" => "nodata");
            return $data;
       }else{
           $total_days = $total_days_count/2;
           $data= array("status" => "success","result" => $total_days);
            return $data;
       }

      }


      function send_attendance_status($attend_id){
        $query="UPDATE edu_attendence SET sent_status='1' WHERE at_id='$attend_id'";
        $res=$this->db->query($query);
        if($res){
          $data= array("status" => "success");
          return $data;
        }else{
          $data= array("status" => "failed");
          return $data;
        }
      }



}
?>
