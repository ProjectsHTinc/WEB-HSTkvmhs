<?php

Class Usermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

	 function get_parents()
	 {
	   //$query="SELECT ep.email,eu.* FROM edu_users as eu left join edu_parents as ep on eu.parent_id=ep.id where eu.user_type='4'";
	   $query="SELECT ep.email,eu.name,eu.user_name,eu.user_id,eu.created_date,eu.status FROM edu_users as eu left join edu_parents as ep on eu.parent_id=ep.id where eu.user_type='4' ORDER BY `eu`.`user_master_id` DESC";
	   $result=$this->db->query($query);
	   return $result->result();
	 }
     function get_staff()
     {
        $query="SELECT ep.email,eu.* FROM edu_users as eu left join edu_teachers as ep on eu.teacher_id=ep.teacher_id where eu.user_type='2'";
        $result=$this->db->query($query);
        return $result->result();
     }
     function get_student()
     {
        $query="SELECT ep.email,eu.* FROM edu_users as eu left join edu_admission as ep on eu.student_id=ep.admission_id where eu.user_type='3'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function get_userid($user_id_profile)
     {

         $query="SELECT * FROM edu_users WHERE user_id='$user_id_profile'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function save_profile_id($user_profile_id,$status){
        $query="UPDATE edu_users SET status='$status' WHERE user_id='$user_profile_id'";
       $result=$this->db->query($query);
       $data= array("status"=>"success");
       return $data;
     }




}
?>
