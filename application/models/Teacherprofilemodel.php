<?php

Class Teacherprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  function getYear()
  {
    $sqlYear = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
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

  function getuser($user_id)
   {

     $query="SELECT ed.*,et.* FROM edu_users AS ed LEFT JOIN edu_teachers AS et ON ed.teacher_id=et.teacher_id WHERE ed.user_id='$user_id'";
     $resultset=$this->db->query($query);
     return $resultset->result();
   }

   function get_teacheruser($user_id)
      {
         $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }

  function updateprofile($user_id,$oldpassword,$newpassword)
  {
         $checkpassword="SELECT user_id FROM edu_users WHERE user_password='$oldpassword' AND user_id='$user_id'";
         $res=$this->db->query($checkpassword);
         if($res->num_rows()==1)
		 {
           $query="UPDATE edu_users SET user_password='$newpassword',updated_date=NOW() WHERE user_id='$user_id'";
           $ex=$this->db->query($query);
            $data= array("status" => "success");
           return $data;
         }else{
           $data= array("status" => "failure");
          return $data;
         }
       }


  function teacherprofileupdate($user_id,$userFileName)
    {
	   $query="UPDATE edu_teachers SET update_at=NOW() WHERE teacher_id='$user_id'";

     $query1="UPDATE edu_users SET user_pic='$userFileName',updated_date=NOW() WHERE teacher_id='$user_id' ";
	   $res1=$this->db->query($query1);
     $res=$this->db->query($query);
     if($res)
		 {
        $data= array("status" => "success");
        return $data;
      }else{
        $data= array("status" => "Failed to Update");
        return $data;
       }
 }

 //get all groups deatis

		   function get_all_groups_details()
		   {
			   $query="SELECT * FROM edu_groups WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			     return $res;
		   }

		   //get all activities deatis

		   function get_all_activities_details()
		   {
			   $query="SELECT * FROM edu_extra_curricular WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			     return $res;
		   }



      //  Grouping message for teacher
       function get_groups_for_teacher($user_id){
         $year_id=$this->getYear();
         $query="SELECT egm.group_lead_id,egm.group_title,et.name,eu.user_master_id,egm.id,egm.status FROM edu_grouping_master AS egm
         LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_lead_id AND eu.user_type='2' LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id
         WHERE year_id='$year_id' AND egm.group_lead_id='$user_id' AND egm.status='Active'";
         $resultset=$this->db->query($query);
         return  $res=$resultset->result();
       }

       function get_message_history($user_id){
         $query="SELECT egh.group_title_id,egm.group_title,egh.notes,egh.notification_type,egh.created_at FROM edu_grouping_history AS egh
         LEFT JOIN edu_grouping_master AS egm  ON egh.group_title_id=egm.id WHERE egh.created_by='$user_id'";
         $resultset=$this->db->query($query);
         return  $res=$resultset->result();
       }



}
