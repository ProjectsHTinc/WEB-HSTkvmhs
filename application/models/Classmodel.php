<?php

Class Classmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL CLASS 

       function getclass(){
         $query="SELECT * FROM edu_class ORDER BY class_id DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//CREATE CLASS NAME
       function addclass($classname,$status){
           $check_class="SELECT * FROM edu_class WHERE class_name='$classname'";
           $res=$this->db->query($check_class);
           if($res->num_rows()==0){
           $query="INSERT INTO edu_class (class_name,status) VALUES ('$classname','$status')";
           $resultset=$this->db->query($query);
           $data= array("status" => "success");
            return $data;
           }else{
             $data= array("status" => "Already exist");
              return $data;

         }


       }

//GET SPECIFIC CLASS NAME
       function update_class($class_id){
         $query="SELECT * FROM edu_class WHERE class_id='$class_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//UPDATE CLASS NAME
       function save_class($classname,$class_id,$status){
         $check_class="SELECT * FROM edu_class WHERE class_name='$classname' AND status='$status'";
         $res=$this->db->query($check_class);
         if($res->num_rows()==0){
          $query="UPDATE edu_class SET class_name='$classname',status='$status' WHERE class_id='$class_id'";
          $resultset=$this->db->query($query);
          $data= array("status" => "success");
          return $data;
        }else{
          $data= array("status" => "Already exist");
           return $data;
        }
       }

//DELETE CLASS NAME

       function delete_class($class_id){
          $query="DELETE FROM edu_class WHERE class_id='$class_id'";
          $resultset=$this->db->query($query);
         $data= array("status" => "Deleted Successfully");
         return $data;

       }

}
?>
