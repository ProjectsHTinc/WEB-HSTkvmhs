<?php

Class Extracurricularmodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    function getall_activities_list()
     {
    	 $query="SELECT * FROM edu_extra_curricular"; 
    	 $res=$this->db->query($query);
         $result=$res->result();
    	 return $result;
     }

     function create($ext_name,$status,$user_id)
     {
	   $check_name="SELECT * FROM edu_extra_curricular WHERE extra_curricular_name='$ext_name'";
	   $result=$this->db->query($check_name);
	  if($result->num_rows()==0){
	   $sql="INSERT INTO edu_extra_curricular(extra_curricular_name,status,created_by,created_at) VALUES ('$ext_name','$status','$user_id',NOW())";
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

    function edit_activities($id)
    {
       $query="SELECT * FROM edu_extra_curricular WHERE id='$id'"; 
       $res=$this->db->query($query);
       $result=$res->result();
       return $result;

    }

   function update_activities_list($ext_name,$status,$user_id,$id)
    {

       $sql="UPDATE edu_extra_curricular SET extra_curricular_name='$ext_name',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
       $resultset=$this->db->query($sql);
       if($resultset)
        {
         $data= array("status" => "success");
         return $data;
        }
    }  
}
	?>