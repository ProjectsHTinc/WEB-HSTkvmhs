<?php

Class Subjectmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

       function getsubject(){
         $query="SELECT * FROM edu_subject ORDER BY subject_id DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//CREATE SECTION NAME
       function addsubject($subjectname,$is_preferred_lang,$status){
           $check_class="SELECT * FROM edu_subject WHERE subject_name='$subjectname' AND status='$status'";
           $res=$this->db->query($check_class);
           if($res->num_rows()==0){
           $query="INSERT INTO edu_subject (subject_name,is_preferred_lang,status) VALUES ('$subjectname','$is_preferred_lang','$status')";
           $resultset=$this->db->query($query);
           $data= array("status" => "success");
            return $data;
           }else{
             $data= array("status" => "Already exist");
              return $data;

         }


       }


       //  Teacher handling Subject
       function get_class_handling_subject($user_id){
         $query="SELECT eths.teacher_id,eths.class_master_id,eths.subject_id,et.name,c.class_name,s.sec_name,esu.subject_name FROM edu_teacher_handling_subject AS eths  LEFT JOIN edu_teachers AS et ON et.teacher_id=eths.teacher_id  LEFT JOIN edu_classmaster AS cm ON eths.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
         LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_users AS eu ON eu.user_master_id=et.teacher_id LEFT JOIN edu_subject AS esu ON eths.subject_id=esu.subject_id WHERE eu.user_id='$user_id' AND eths.status='Active'";
       $resultset=$this->db->query($query);
       return $resultset->result();
       }

//GET SPECIFIC SECTION NAME
       function update_subject($subject_id)
	   {
         $query="SELECT * FROM edu_subject WHERE subject_id='$subject_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


//UPDATE SECTION NAME
       function save_subject($subject_name,$is_preferred_lang,$subject_id,$status)
	   {

          $query="UPDATE edu_subject SET subject_name='$subject_name',status='$status',is_preferred_lang='$is_preferred_lang' WHERE subject_id='$subject_id'";
          $resultset=$this->db->query($query);
          $data= array("status" => "success");
          return $data;

       }

//DELETE SECTION NAME

       function delete_subject($subject_id){
           $query="DELETE FROM edu_subject WHERE subject_id='$subject_id'";
          $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;

       }

}
?>
