<?php

Class Leavemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



      ///SAVE Leave

              function create_leave($leave_type,$years,$days,$weeks,$leave_date,$leave_name,$class_name,$leave_status){
                if($leave_type=='Regular Holiday'){
                 $check_leave="SELECT * FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='$leave_type' AND c.week='$weeks' AND c.days='$days'";
                 $res12=$this->db->query($check_leave);
                 if($res12->num_rows()==1){
                   $data= array("status" => "regular already");
                   return $data;
                 }

            }
            if($leave_type=='Special Holiday'){
            $check_special="SELECT * FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='$leave_type' AND leave_date='$leave_date'";
            $res_sp=$this->db->query($check_special);
            if($res_sp->num_rows()==1){
              $data= array("status" => "special already");
              return $data;
            }


        }

                 $query="INSERT INTO edu_leavemaster (leave_year,leave_type,leave_classes,status,created_at,updated_at) VALUES ('$years','$leave_type','$class_name','$leave_status',NOW(),NOW())";

                $resultset1 = $this->db->query($query);

                $leave_mas_id=$this->db->insert_id();

                $query1="INSERT INTO edu_leaves(leaves_name,leave_date,days,week,leave_mas_id,status,created_at,updated_at) VALUES('$leave_name','$leave_date','$days','$weeks','$leave_mas_id','$leave_status',NOW(),NOW())";
                $resultset2 = $this->db->query($query1);
                  $leave_id=$this->db->insert_id();
                  if($leave_type=="Regular Holiday"){
                           for($i=1;$i<=12;$i++)
                         {

                             $mth_name = date("F", mktime(0, 0, 0, $i, 10)); // Get month name from number
                              $date = date('j', strtotime($mth_name. $years. $weeks. $days));
                               $temp_his1['mth_year'] = $years.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-'.$date;
                               $temp_his['day'] = $days;
                               $temp_his['on_week'] = $weeks;
                               //print_r($temp_his1);
                               $query3="INSERT INTO edu_holidays_list_history (leave_list_date,day,on_week,sno,leave_masid,leave_id) VALUES ('$temp_his1[mth_year]','$days','$weeks','$i','$leave_mas_id','$leave_id')";
                                $resultset3 = $this->db->query($query3);


                         }
                         if($query3){
                           $data= array("status" => "success");
                           return $data;
                         }

               }else{
                 $data= array("status" => "success");
                 return $data;
               }
               $data= array("status" => "failure");
               return $data;
              }


              //Regular Holiday

              function get_regular(){
                $query="SELECT lm.leave_type,lm.leave_year,el.week,lm.status,lm.leave_id,el.id ,el.days FROM edu_leavemaster AS lm LEFT JOIN edu_leaves AS el ON lm.leave_id=el.leave_mas_id WHERE lm.leave_type='Regular Holiday' ORDER BY lm.leave_id DESC";
                $res=$this->db->query($query);
                //print_r($res->result());exit;
                return $res->result();
              }


              //Special Holiday

              function get_special(){
                $query="SELECT * FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday'";
                $res=$this->db->query($query);
                return $res->result();
              }

              function get_leave_id($id){
                $query="SELECT elm.*,el.* FROM edu_leavemaster  AS elm LEFT JOIN edu_leaves AS el ON el.leave_mas_id=elm.leave_id WHERE elm.leave_id='$id'";
              //echo   $query="SELECT * FROM edu_holidays_list_history AS lm INNER JOIN edu_leavemaster AS c ON lm.leave_id=c.leave_id  WHERE lm.leave_id='$id'";
                $res=$this->db->query($query);
                return $res->result();
              }

              //Special Leave
              function get_special_leave_id($id){
               $query="SELECT * FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday' AND c.id ='$id'";

                $res=$this->db->query($query);
                return $res->result();
              }

              //Update Special Leave
              function udate_special_leave($leave_type,$leave_id,$leave_mas_id,$leave_date,$class_name,$leave_name,$leave_status){
                 $query="UPDATE edu_leavemaster SET leave_classes='$class_name', status='$leave_status',updated_at=NOW() WHERE leave_id='$leave_id'";
                 $res=$this->db->query($query);
                $query1="UPDATE edu_leaves SET leaves_name='$leave_name',leave_date='$leave_date',status='$leave_status',updated_at=NOW() WHERE leave_mas_id='$leave_mas_id'";
                $res1=$this->db->query($query1);
                if($res1){
                  $data= array("status" => "success");
                  return $data;
                }else{
                  $data= array("status" => "failure");
                  return $data;

                }

              }


              function udate_regular_leave($leave_type,$leave_id,$leave_mas_id,$years,$class_name,$days,$weeks,$leave_status){

                 $query="UPDATE edu_leavemaster SET leave_year='$years',leave_classes='$class_name',status='$leave_status',updated_at=NOW() WHERE leave_id='$leave_id'";

                $resultset1 = $this->db->query($query);

                $query1="UPDATE edu_leaves SET days='$days',week='$weeks',status='$leave_status',updated_at=NOW() WHERE leave_mas_id='$leave_mas_id'";
                $resultset2 = $this->db->query($query1);

                for($i=1;$i<=12;$i++)
              {
                    $mth_name = date("F", mktime(0, 0, 0, $i, 10)); // Get month name from number
                    $date = date('j', strtotime($mth_name. $years. $weeks. $days));
                    $temp_his1['mth_year'] = $years.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-'.$date;
                    $temp_his['day'] = $days;
                    $temp_his['on_week'] = $weeks;

                     $date_query3="UPDATE edu_holidays_list_history SET leave_list_date='$temp_his1[mth_year]',day='$days',on_week='$weeks' WHERE leave_masid='$leave_mas_id' AND sno='$i'";
                  //echo $i;
                  //echo "<br>";
                 $resultset3 = $this->db->query($date_query3);


              }

              if($resultset3){
                $data= array("status" => "success");
                return $data;
              }else{
                $data= array("status" => "failure");
                return $data;
              }


              }


              // GET SPECIAL LEAVE ON CALENDER
              function get_special_leave_all(){
                $query="SELECT leave_date AS start,leaves_name as title,leave_type AS description FROM edu_leavemaster AS lm INNER JOIN edu_leaves AS c  ON lm.leave_id=c.leave_mas_id WHERE lm.leave_type='Special Holiday' AND lm.status='Active'";
                $res=$this->db->query($query);
                return $res->result();

              }


              function get_allregular_leave_id($leave_masid){
                $query="SELECT * FROM edu_holidays_list_history WHERE leave_masid='$leave_masid'";
                $res=$this->db->query($query);
                return $res->result();
              }

              function delete_leave_dates($leave_date_id){
                 $query="DELETE FROM edu_holidays_list_history WHERE id='$leave_date_id'";
                $res=$this->db->query($query);
                if($res){
                  $data= array("status" => "success");
                  return $data;
                }else{
                  $data= array("status" => "failure");
                  return $data;
                }
              }


              function delete_specialleave_dates($leave_date_id){
                 $query="DELETE  FROM edu_leavemaster WHERE leave_id ='$leave_date_id'";
                $res=$this->db->query($query);
                 $query2="DELETE  FROM edu_leaves WHERE leave_mas_id ='$leave_date_id'";
                $res2=$this->db->query($query2);
                if($res2){
                  $data= array("status" => "success");
                  return $data;
                }else{
                  $data= array("status" => "failure");
                  return $data;
                }
              }

              function delete_regularleave_dates($leave_date_id){
               $query="DELETE  FROM edu_leavemaster WHERE leave_id ='$leave_date_id'";
               $res=$this->db->query($query);
               $query2="DELETE  FROM edu_leaves WHERE leave_mas_id ='$leave_date_id'";
               $res2=$this->db->query($query2);
               $query3="DELETE  FROM edu_holidays_list_history WHERE leave_masid ='$leave_date_id'";
               $res3=$this->db->query($query3);
               if($res3){
                 $data= array("status" => "success");
                 return $data;
               }else{
                 $data= array("status" => "failure");
                 return $data;
               }
              }

			  function get_all_regularleave()
			   {
					$query="SELECT eh.leave_list_date AS start,lm.leave_type AS title,lm.leave_type AS description FROM edu_holidays_list_history AS eh  LEFT OUTER JOIN edu_leavemaster AS lm ON lm.leave_id=eh.leave_masid";
					$result=$this->db->query($query);
					return $result->result();
               }
}
?>
