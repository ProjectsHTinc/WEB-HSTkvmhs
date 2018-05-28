<?php

Class Adminattendancemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

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


      //GET ALL CLASS
       function get_all_class(){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT ee.class_id,COUNT(CASE WHEN ee.class_id = ee.class_id THEN ee.class_id END) AS total_count,c.class_name,ss.sec_name FROM edu_enrollment AS ee INNER JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id WHERE ee.admit_year='$year_id' GROUP BY ee.class_id";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


       //Class list for month view
       function get_class_list($class_id){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
         $query="SELECT ea.*,eu.name FROM edu_attendence  AS ea JOIN edu_users  AS eu ON eu.user_id=ea.created_by WHERE class_id='$class_id' AND ac_year='$year_id' ORDER BY created_at DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();

       }

       //LIST of record for class
       function get_list_record($at_id,$class_id){
         $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
          $query="SELECT  c.enroll_id, c.name,c.admission_id, o.a_status,a.sex FROM  edu_enrollment c LEFT JOIN edu_attendance_history o ON c.enroll_id = o.student_id AND o.attend_id ='$at_id' LEFT JOIN edu_admission a ON c.admission_id=a.admission_id WHERE c.class_id='$class_id' AND c.admit_year='$year_id'  ORDER BY a.sex DESC,c.name ASC";
         $res=$this->db->query($query);
         return $res->result();
       }

       //Get month for class view attendance
       function get_month_class($class_id)
	   {
         $acd_year=$this->get_cur_year();
         $year_id= $acd_year['cur_year'];
         $query="SELECT DATE_FORMAT(`created_at`,'%M') AS showmonth,DATE_FORMAT(`created_at`,'%m') AS month_id FROM edu_attendence WHERE class_id='$class_id' AND ac_year='$year_id' GROUP BY showmonth";
         $res=$this->db->query($query);
         return $res->result();
       }

       //Get year for class view attendance
       function get_year_class($class_id)
	   {
         $acd_year=$this->get_cur_year();
         $year_id= $acd_year['cur_year'];
         $query="SELECT DATE_FORMAT(`created_at`,'%Y') AS showyear FROM edu_attendence WHERE class_id='$class_id' AND ac_year='$year_id' GROUP BY showyear";
         $res=$this->db->query($query);
         return $res->result();
       }

      //GET Month View for Class
      function get_monthview_class($first,$last,$class_master_id){
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
         $query="SELECT COUNT(ah.student_id) as leaves,en.enroll_id, en.class_id, en.name, a.sex, c.class_name, s.sec_name, ah.abs_date, ah.a_status, ah.attend_period, at.at_id FROM edu_enrollment en
        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id
		INNER JOIN edu_admission AS a ON en.admission_id=a.admission_id WHERE en.class_id='$class_master_id' AND en.admit_year = '$year_id' AND ah.abs_date >= '$first' AND ah.abs_date <= '$last' GROUP BY ah.student_id,en.name ASC,a.sex DESC
        UNION ALL
        SELECT '0' as leaves,en.enroll_id, en.class_id, en.name,a.sex, c.class_name, s.sec_name, '' as abs_date, 'P' as a_status, '' as attend_period,'' as at_id FROM edu_enrollment en
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id
		INNER JOIN edu_admission AS a ON en.admission_id=a.admission_id
		WHERE en.class_id='$class_master_id' AND en.admit_year = '$year_id' AND en.enroll_id
        NOT IN (SELECT en.enroll_id FROM edu_enrollment en
        INNER JOIN edu_attendance_history AS ah ON en.enroll_id = ah.student_id
        INNER JOIN edu_attendence AS at ON ah.attend_id = at.at_id
        INNER JOIN edu_classmaster AS cm ON en.class_id = cm.class_sec_id
        INNER JOIN edu_class AS c ON cm.class=c.class_id
        INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE en.class_id='$class_master_id' AND ah.abs_date >= '$first' AND ah.abs_date <= '$last')
        GROUP BY en.enroll_id,en.name ";
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
           // $response = array("status" => "error", "msg" => "No Attendance days Found");
            $data= array("status" => "nodata");
            return $data;
       }else{
           //$total_days = $total_days_count/2;
		   $total_days = $total_days_count;
           $data= array("status" => "success","result" => $total_days);
            return $data;
       }

      }

      // Get Student Leave Days
      function get_leave_dates($student_id,$month_id,$year_id){
         $query="SELECT DATE_FORMAT(abs_date,'%d-%m-%Y')AS abs_date,a_status FROM edu_attendance_history WHERE MONTH(abs_date) = '$month_id' AND YEAR(abs_date) = '$year_id' AND student_id='$student_id'";
        $res=$this->db->query($query);
        if($res->num_rows()==0){
          $data= array("status" => "nodata");
          return $data;
          }else{
          $result= $res->result();
            $data= array("status" => "success","res" => $result);
            return $data;
          }
      }


      // Update Attendance for class
      function update_attendance_class($attend_id,$enroll_id,$attendence_val,$class_id,$user_id){
        $get_exist_data="SELECT * FROM edu_attendence WHERE at_id='$attend_id'";
        $res=$this->db->query($get_exist_data);
        foreach($res->result() as $rows){}
        $attend_period=$rows->attendence_period;
        $attend_date=$rows->created_at;
        $delete_atten_id="DELETE FROM edu_attendance_history WHERE attend_id='$attend_id'";
        $res=$this->db->query($delete_atten_id);
         $att_count=count($attendence_val);
          for($i=0;$i <$att_count;$i++){
           $present_val=$attendence_val[$i];
           $student_id=$enroll_id[$i];
              if($present_val!='P'){
              $add_att="INSERT INTO edu_attendance_history(attend_id,class_id,student_id,abs_date,a_status,attend_period,a_val,status,updated_by,updated_at) VALUES('$attend_id','$class_id','$student_id','$attend_date','$present_val','$attend_period','1','Active','$user_id',NOW())";
              $resultset=$this->db->query($add_att);
              }
        }

        $att_co="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$attend_id' AND a_status='L'";
        $res_att=$this->db->query($att_co);
        foreach($res_att->result() as $rwos){}
        $leav_count= $rwos->absentcount;
         $att_co1="SELECT count(attend_id) as absentcount FROM edu_attendance_history WHERE attend_id='$attend_id' AND a_status='A'";
        $res_att1=$this->db->query($att_co1);
        foreach($res_att1->result() as $rwos){}
        $abs_cnt= $rwos->absentcount;
        $abs_count=$leav_count+$abs_cnt;
        $no_prese=$att_count-$abs_count;
        $update_class_present="UPDATE edu_attendence SET class_total='$att_count',no_of_present='$no_prese',no_of_absent='$abs_count',updated_by='$user_id',updated_at=NOW() WHERE at_id='$attend_id'";
        $res_update=$this->db->query($update_class_present);
        if($res_update){
          $delte="DELETE FROM edu_attendance_history WHERE a_status='P'";
          $resultdelete=$this->db->query($delte);

          $data= array("status" =>"success");
          return $data;
        }else{
          $data= array("status" =>"failure");
          return $data;
        }

      }



      //Check Attendance view
      function check_attendance_by_admin($class_id,$session_id,$attendance_date){
          $cur_d= date("Y-m-d", strtotime($attendance_date));
          $a_period=$session_id;
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
            //   $data= array("status" =>"success");
            //  return $data;
           }
           else{
             $data= array("status" =>"regular");
             //print_r($data);exit;
             return $data;

           }
          //  $data= array("status" =>"success");
          //  return $data;
         }else{
           $data= array("status" =>"special");
           return $data;

         }
      }


      function take_attendance_admin($a_period,$abs_date,$enroll_id,$attendence_val,$class_id,$user_id){
        $len=count($enroll_id);
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
        if($a_period==0){
             $cur_d= date("Y-m-d 10:10:10", strtotime($abs_date));
        }else{
             $cur_d= date("Y-m-d 14:14:14", strtotime($abs_date));
        }

        $add_att_cal="INSERT INTO edu_attendance_calendar(Date,class_master_id) VALUES('$cur_d',$class_id)";
        $att_add=$this->db->query($add_att_cal);
        $query="INSERT INTO edu_attendence (ac_year,class_id,class_total,attendence_period,created_by,created_at,status) VALUES('$year_id','$class_id','$len','$a_period','$user_id','$cur_d','Active')";
        $resultset=$this->db->query($query);
        $atten_id = $this->db->insert_id();
        for($i=0;$i <$len;$i++){
         $present_val=$attendence_val[$i];
         $student_id=$enroll_id[$i];
            if($present_val!='P'){
            $add_att="INSERT INTO edu_attendance_history(attend_id,class_id,student_id,abs_date,a_status,attend_period,a_val,status,updated_by,updated_at) VALUES('$atten_id','$class_id','$student_id','$cur_d','$present_val','$a_period','1','Active','$user_id',NOW())";
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
        $no_prese=$len-$abs_count;
        $update_class_present="UPDATE edu_attendence SET no_of_present='$no_prese',no_of_absent='$abs_count',updated_by='$user_id',updated_at=NOW() WHERE at_id='$atten_id'";
        $res_update=$this->db->query($update_class_present);
        if($res_update){
          $delte="DELETE FROM edu_attendance_history WHERE a_status='P'";
          $resultdelete=$this->db->query($delte);

          $data= array("status" =>"success");
          return $data;
        }else{
          $data= array("status" =>"failure");
          return $data;
        }




      }



}
?>
