<?php

Class Parentprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  function getuser($user_id)
   {
	   $query="SELECT ed.*,ed.user_pic as profile_pic,ep.* FROM edu_users AS ed,edu_parents AS ep WHERE ed.parent_id=ep.id AND ed.user_id='$user_id'";
       $resultset=$this->db->query($query);
       return $resultset->result();
   }
  
    function get_parentuser($user_id)
      {
         $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }
	   
	   function update_parents($user_id,$user_type,$parent_id,$student,$userFileName)
	   {
		     //echo $userFileName;exit;	
		     $query="SELECT user_master_id,parent_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
             $resultset=$this->db->query($query); 
			 $row=$resultset->result();
			 foreach($row as $rows){}
			 $parent_id=$rows->parent_id;
			 
	        $query6="UPDATE edu_users SET user_pic='$userFileName',updated_date=NOW() WHERE parent_id='$parent_id' ";
	        $res=$this->db->query($query6);

         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

      }
  function updateprofilepwd($user_id,$oldpassword,$newpassword)
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

 
  
 
}