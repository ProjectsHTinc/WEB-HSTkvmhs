<?php

Class Quotamodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function getall_quota_list()
     {
    	 $query="SELECT * FROM edu_quota"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

    function create_quota_list($quota_name,$status,$user_id)
     {
	   $check_name="SELECT * FROM edu_quota WHERE quota_name='$quota_name'";
	   $result=$this->db->query($check_name);
	   if($result->num_rows()==0){
	   $sql="INSERT INTO edu_quota(quota_name,status,created_by,created_at) VALUES ('$quota_name','$status','$user_id',NOW())";
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

    function edit_quota_list($id)
    {
       $query="SELECT * FROM edu_quota WHERE id='$id'"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

    function update_quota_list($quota_name,$status,$user_id,$id)
    {

       $sql="UPDATE edu_quota SET quota_name='$quota_name',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    }
}
	?>