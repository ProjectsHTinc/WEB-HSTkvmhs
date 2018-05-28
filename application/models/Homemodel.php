<?php

Class Homemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

       function get_teacher_id($user_id)
	   {
             $query="SELECT teacher_id from edu_users WHERE user_id='$user_id'";
             $resultset=$this->db->query($query);
             $results = $resultset->result();
             return $results[0]->teacher_id;
       }
       
        function get_class_name($teacher_id)
        {
            $query="SELECT class_name from edu_teachers WHERE teacher_id='$teacher_id'";
            $resultset1=$this->db->query($query);
            $result1= $resultset1->result();
            return $result1[0]->class_name;
            
        }
        
        function get_class_section($class_name)
        {
            
            $query="SELECT * from edu_classmaster WHERE class_sec_id IN ($class_name)";
            $resultset2=$this->db->query($query);
            $result2= $resultset2->result();
            return $result2;
            //return $result2[0]->class_name;  
        }
        function convert_id_name($class_section)
        {
            foreach($class_section as $id )
            {
                $query="select c.class_name,s.sec_name FROM edu_class AS c,edu_sections AS s WHERE c.class_id ='".$id->class."' AND s.sec_id='".$id->section."'";
                $resultset2=$this->db->query($query);
                $result2[]= $resultset2->result();
                
            }
            return $result2;
        }



}
?>
