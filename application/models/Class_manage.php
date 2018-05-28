<?php

Class Class_manage extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL SECTION

       function assign($sec_id,$class_id,$subject,$status){
          $query="SELECT * FROM edu_classmaster WHERE class='$class_id' AND section='$sec_id'";
          $resultset=$this->db->query($query);
          if($resultset->num_rows()==0){
          $query="INSERT INTO edu_classmaster (class,section,subject,status,created_at) VALUES ($class_id,'$sec_id','$subject','$status',NOW())";
          $resultset=$this->db->query($query);
          $data= array("status" => "success");
           return $data;
          }else{
            $data= array("status" => "Already Exist");
             return $data;
           }

       }


       //Allocate Subject to class
       function subject_to_class($user_id,$subject_id,$class_master_id,$exam_flag,$status){
          $subject_cnt=count($subject_id);
          for($i=0;$i<$subject_cnt ;$i++){
            $subject_id_cls=$subject_id[$i];
            $check ="SELECT * FROM edu_subject_to_class WHERE class_master_id='$class_master_id' AND subject_id='$subject_id_cls'";
           $result=$this->db->query($check);
           if($result->num_rows()==0){
               $query="INSERT INTO  edu_subject_to_class (class_master_id,subject_id,exam_flag,status,created_at,created_by,updated_at) VALUES('$class_master_id','$subject_id_cls','$exam_flag','$status',NOW(),'$user_id',NOW())";
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


       //View subject for class
       function view_subjects($class_sec_id){
         $query="SELECT estc.subject_id,estc.class_master_id,estc.class_master_id,c.class_name,s.sec_name,esu.subject_name,estc.status,estc.id FROM edu_subject_to_class AS estc
         LEFT JOIN edu_classmaster AS cm ON estc.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id
         LEFT JOIN edu_subject AS esu ON estc.subject_id=esu.subject_id WHERE estc.class_master_id='$class_sec_id'";
         $resultset=$this->db->query($query);
        return $resultset->result();

       }

       //View subject for class
       function edit_subjects_class($id){
         $query="SELECT estc.exam_flag,estc.subject_id,estc.class_master_id,estc.class_master_id,c.class_name,s.sec_name,esu.subject_name,estc.status,estc.id FROM edu_subject_to_class AS estc
         LEFT JOIN edu_classmaster AS cm ON estc.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id
         LEFT JOIN edu_subject AS esu ON estc.subject_id=esu.subject_id WHERE estc.id='$id'";
         $resultset=$this->db->query($query);
         return $resultset->result();

       }


      //  Save Subject for Class
      function save_subject($id,$exam_flag,$status){
         $query="UPDATE edu_subject_to_class SET exam_flag='$exam_flag',status='$status' WHERE id='$id'";
        $resultset=$this->db->query($query);
        if($resultset){
          $data= array("status" => "success");
          return $data;
         }else{
          $data= array("status" => "failure");
          return $data;
        }
      }

          function getclass(){
			 $query="SELECT class_id,class_name FROM edu_class ORDER BY class_id DESC";
			 $resultset=$this->db->query($query);
			 return $resultset->result();
        }

       function getall_class(){
         $query="SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.status FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
         $result=$this->db->query($query);
         return $result->result();
       }

       function edit_cs($class_sec_id){
          $query="SELECT c.class_name,c.class_id,s.sec_name,s.sec_id,cm.class_sec_id,cm.subject,cm.status,cm.section FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id AND cm.class_sec_id='$class_sec_id'";
          $result=$this->db->query($query);
          return $result->result();
       }


       function save_cs($class_sec_id,$class,$section,$subject,$status){
                 $check_class="SELECT * FROM edu_classmaster WHERE class='$class' AND section='$section'";
                  $query="UPDATE edu_classmaster SET class='$class',subject='$subject',status='$status' WHERE class_sec_id='$class_sec_id'";
                  $resultset=$this->db->query($query);
               $resultset=$this->db->query($check_class);
               if($resultset->num_rows()==0){
                 $query="UPDATE edu_classmaster SET class='$class',section='$section',subject='$subject',status='$status' WHERE class_sec_id='$class_sec_id'";
                 $resultset=$this->db->query($query);
                 if($resultset){
                 $data= array("status" => "success");
                  return $data;
                 }
               }else{
                //  $query="UPDATE edu_classmaster SET class='$class',section='$section',subject='$subject' WHERE class_sec_id='$class_sec_id'";
                //  $resultset=$this->db->query($query);
                 $data= array("status" => "already");
                 return $data;
               }
       }


       function delete_cs($class_sec_id){
         $query="DELETE FROM edu_classmaster WHERE class_sec_id='$class_sec_id'";
         $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;
       }

        public function get_subject($classid)
         {
			$query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$classid'";
              $resultset=$this->db->query($query);
			  $row=$resultset->result();
			 // print_r($row);exit;
			 if(empty($row))
			 {
				 $data= array("status" => "Subject Not Found");
				 return $data;
			 }
			  foreach($row as $rows)
			  { }
				        $id=$rows->subject;
						 //echo $id;exit;
						// $id=$rows->subject;
					   $sQuery = "SELECT * FROM edu_subject";
					   $objRs=$this->db->query($sQuery);
					   $rows=$objRs->result();
					   foreach ($rows as $rows1)
					   {
						   $s= $rows1->subject_id;
						   $sec=$rows1->subject_name;
						   $arryPlatform = explode(",",$id);
						   $sPlatform_id  = trim($s);
						   $sPlatform_name  = trim($sec);
						   if(in_array($sPlatform_id, $arryPlatform ))
							   {
								  $sub_name[]=$sec;
								  $sub_id[]=$s;
							   }
						 //return $a;
					  }

					  $data= array("status" => "Success","subject_id" => $sub_id,"subject_name"=>$sub_name);
					 return $data;
      //  print_r($id1);
      }


      //Class NOTEXIST

      function get_all_class_notexist(){
        $query="SELECT  e.class_sec_id,c.class_name,s.sec_name FROM    edu_classmaster AS e INNER JOIN edu_classmaster AS cm ON e.class_sec_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE   NOT EXISTS (SELECT  NULL FROM edu_teachers d WHERE   d.class_teacher = e.class_sec_id) ";
        $result=$this->db->query($query);
        return $result->result();
      }


      function getListClass($subject_id){
        $query="SELECT estc.subject_id,estc.class_master_id,c.class_name,s.sec_name,esu.subject_name  FROM edu_subject_to_class AS estc LEFT JOIN edu_classmaster AS cm ON estc.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
        LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON estc.subject_id=esu.subject_id WHERE estc.subject_id='$subject_id'";
        $resultset=$this->db->query($query);
         if($resultset->num_rows()==0){
           $data= array("status" => "nodata");
           return $data;
         }else{

           $res= $resultset->result();
             $data= array("status" => "success","res" => $res);
          //  foreach($res as $rows){
          //     $class_sec_id=$rows->class_sec_id;
          //
           //
          //    }
               return $data;




         }

        //return $result->result();
      }
 }
?>
