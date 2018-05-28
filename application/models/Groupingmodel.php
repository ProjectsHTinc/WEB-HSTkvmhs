<?php

Class Groupingmodel extends CI_Model
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

        function get_all_teacher(){

          $query="SELECT eu.user_id,et.name FROM edu_users AS eu LEFT JOIN edu_teachers AS et ON eu.user_master_id =et.teacher_id WHERE eu.user_type='2' AND et.status='Active'";
          $res=$this->db->query($query);
          return $res->result();
        }


          function create_group($group_title,$group_lead,$status,$user_id)
           {
           $year_id=$this->getYear();
      	   $check_name="SELECT * FROM edu_grouping_master WHERE group_title='$group_title'";
      	   $result=$this->db->query($check_name);
      	   if($result->num_rows()==0){
      	   $sql="INSERT INTO edu_grouping_master(group_title,group_lead_id,year_id,status,created_by,created_at) VALUES ('$group_title','$group_lead','$year_id','$status','$user_id',NOW())";
             $resultset=$this->db->query($sql);
             if($resultset)
              {
               $data= array("status" => "success");
               return $data;
              }
             }else{
      		   $data= array("status" => "Already");
                 return $data;
      	   }
          }

          function save_group($group_title,$group_lead,$status,$user_id,$id){

            $check_name="SELECT * FROM edu_grouping_master WHERE group_title='$group_title' and group_lead_id='$group_lead' and status='$status'";
            $result=$this->db->query($check_name);
            if($result->num_rows()==0){
              $sql="UPDATE  edu_grouping_master SET group_title='$group_title',group_lead_id='$group_lead',status='$status',updated_by='$user_id',updated_at=NOW() where id='$id'";
          $resultset=$this->db->query($sql);
              if($resultset)
               {
                $data= array("status" => "success");
                return $data;
               }
              }else{
              $data= array("status" => "Already");
                  return $data;
            }
          }


          function delete_member($delete_id){
            $query="DELETE  FROM edu_grouping_members   WHERE id='$delete_id'";
            $res=$this->db->query($query);
            if($res)
             {
              $data= array("status" => "success");
              return $data;
            }else{
              $data= array("status" => "failed");
              return $data;
            }
          }
          function get_group_id($id){
            $query="SELECT * FROM edu_grouping_master AS egm  WHERE id='$id'";
            $res=$this->db->query($query);
            return $res->result();
          }

          function get_all_grouping()
          {
             $year_id=$this->getYear();
             $query="SELECT egm.group_lead_id,egm.group_title,et.name,eu.user_master_id,egm.id,egm.status FROM edu_grouping_master AS egm
             LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_lead_id AND eu.user_type='2' LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id";
             $res=$this->db->query($query);
             return $res->result();


          }

          function get_group_name($id){
            $query="SELECT group_title FROM edu_grouping_master AS egm  WHERE id='$id'";
            $res=$this->db->query($query);
            return $res->result();
          }

          function view_members_in_groups($id){
            $query="SELECT egm.id,egm.group_member_id,eu.user_master_id,ee.name,c.class_name,s.sec_name,egm.status  FROM edu_grouping_members AS egm
            LEFT JOIN edu_users AS eu ON  eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON eu.user_master_id=ea.admission_id
            LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id LEFT JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id
            LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id WHERE egm.group_title_id='$id' ORDER BY egm.id DESC
            ";
            $res=$this->db->query($query);
            return $res->result();
          }

          function get_all_classes_for_year()
          {
            $year_id=$this->getYear();
            $query="SELECT ee.class_id,c.class_name,s.sec_name FROM edu_enrollment AS ee LEFT JOIN edu_classmaster AS cm ON ee.class_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
             LEFT JOIN edu_sections AS s ON cm.section=s.sec_id WHERE admit_year='$year_id' GROUP BY ee.class_id";
             $res=$this->db->query($query);
            return $res->result();


          }

          function getListstudent($class_master_id){
             $year_id=$this->getYear();
              $query="SELECT eu.user_id,ee.name,ee.enroll_id FROM edu_users AS eu LEFT JOIN edu_admission AS ea ON eu.user_master_id=ea.admission_id AND eu.user_type='3'
LEFT JOIN edu_enrollment AS ee ON ee.admission_id=ea.admission_id WHERE  ee.class_id='$class_master_id' AND ee.admit_year='$year_id' AND ee.status='Active'";
            $resultset=$this->db->query($query);
            if($resultset->num_rows()==0){
              $data= array("status" => "nodata");
              return $data;
            }else{
              $res= $resultset->result();
              $data= array("status" => "success","res" => $res);
              return $data;
            }

          }


          function adding_members_to_group($members_id,$group_id,$status,$user_id){
            $members_id_cnt=count($members_id);
            for($i=0;$i<$members_id_cnt;$i++){
              $members_id_list=$members_id[$i];
              $check ="SELECT * FROM edu_grouping_members WHERE group_title_id='$group_id' AND group_member_id='$members_id_list'";
              $result=$this->db->query($check);
             if($result->num_rows()==0){
                 $query="INSERT INTO  edu_grouping_members (group_title_id,group_member_id,status,created_at,created_by) VALUES('$group_id','$members_id_list','$status',NOW(),'$user_id')";
                 $res=$this->db->query($query);
             }
             else{
               $data= array("status" => "already");
               return $data;
             }
           }
           if($res){
             $data= array("status" => "success");
             return $data;
           }else{
             $data= array("status" => "failure");
             return $data;
           }
          }


          function save_group_history($group_id,$cir,$notes,$user_id){
             $query="INSERT INTO  edu_grouping_history (group_title_id,notes,notification_type,status,created_at,created_by) VALUES('$group_id','$notes','$cir','Active',NOW(),'$user_id')";
            $res=$this->db->query($query);
            if($res){
              $data= array("status" => "success");
              return $data;
            }else{
              $data= array("status" => "failure");
              return $data;
            }
          }


          function get_board_members(){
            $select="Select * from edu_teachers where role_type_id='5' and status='Active'";
            $resultset=$this->db->query($select);
            return  $res=$resultset->result();
          }

          function get_message_history(){
            $query="SELECT egh.group_title_id,egm.group_title,egh.notes,egh.notification_type,egh.created_by,eu.name,egh.created_at FROM edu_grouping_history AS egh
            LEFT JOIN edu_grouping_master AS egm  ON egh.group_title_id=egm.id LEFT JOIN edu_users as eu ON eu.user_id=egh.created_by order by egh.id desc;";
            $resultset=$this->db->query($query);
            return  $res=$resultset->result();
          }


}
	?>
