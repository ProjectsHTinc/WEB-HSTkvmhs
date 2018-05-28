<?php

Class Userleavemastermodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function getall_leave_list()
     {
    	 $query="SELECT * FROM edu_user_leave_master "; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     function create_leave($leave_name,$leave_type,$status,$user_id)
     {     
	   $check_name="SELECT * FROM edu_user_leave_master WHERE leave_title='$leave_name' AND leave_type='$leave_type'";
	   $result=$this->db->query($check_name);
	   if($result->num_rows()==0){
	     $sql="INSERT INTO edu_user_leave_master(leave_title,leave_type,status,created_by,created_at) VALUES ('$leave_name','$leave_type','$status','$user_id',NOW())";
         $resultset=$this->db->query($sql);
         if($resultset)
         {
			 $data= array("status" => "success");
			 return $data;
         }
	   }else{
		   $data= array("status" => "Name Already Exist");
		   return $data;
	   }
       
    }

    function edit_leave_list($id)
    {
       $query="SELECT * FROM edu_user_leave_master WHERE id='$id'"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

   function update_leave_list($leave_name,$leave_type,$status,$user_id,$id)
    {

       $sql="UPDATE edu_user_leave_master SET leave_title='$leave_name',leave_type='$leave_type',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    } 
}
	?>