<?php

Class Teachereventmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

		  //GET Teacher Id in user table


      function get_teacher_event($user_id){
          $get_teacher ="SELECT et.teacher_id FROM edu_users AS ed LEFT JOIN edu_teachers AS et ON ed.teacher_id=et.teacher_id WHERE user_id='$user_id'";
          $result1=$this->db->query($get_teacher);
          $teacher_id=$result1->result();
          foreach ($teacher_id as $rows) { }
          $teacher_id=$rows->teacher_id;
          $query="SELECT ev.event_id,ev.event_name,ev.event_date,evc.co_name_id FROM edu_events AS ev  LEFT JOIN edu_event_coordinator AS evc ON ev.event_id= evc.event_id
          WHERE  evc.co_name_id='$teacher_id' AND evc.status='Active' GROUP BY event_id ";
          $resultset=$this->db->query($query);
          if($resultset->num_rows()==0){
            $data= array("status" => "failure");
            return $data;
          }else{
            $res=$resultset->result();
            $data= array("status" => "success","event_li"=>$res);
            return $data;
          }
       }

       function get_teacher_allevent(){
          $query="SELECT ev.event_id,ev.event_name,ev.event_date FROM edu_events AS ev WHERE ev.status='Active' ORDER  BY event_date DESC";
           $resultset=$this->db->query($query);
           if($resultset->num_rows()==0){
             $data= array("status" => "failure");
             return $data;
           }else{
             $res=$resultset->result();
             $data= array("status" => "success","event_li"=>$res);
             return $data;
           }
        }


        function get_event_details($event_id){
          $query="SELECT ev.event_id,ev.event_name,ev.event_date,ev.event_details FROM edu_events AS ev WHERE ev.event_id='$event_id'";
           $resultset=$this->db->query($query);
           if($resultset->num_rows()==0){
             $data= array("status" => "failure");
             return $data;
           }else{
             $res=$resultset->result();
             $data= array("status" => "success","eventview"=>$res);
             return $data;
           }
        }

        function get_teacher_in_event($event_id)
		{
			  $query="SELECT ec.event_id,es.event_name,et.name,es.event_date,ec.sub_event_name,es.event_details FROM edu_event_coordinator AS ec LEFT JOIN edu_teachers AS et ON ec.co_name_id=et.teacher_id LEFT JOIN edu_events AS es ON es.event_id=ec.event_id WHERE ec.event_id='$event_id' AND ec.status='Active'";
			  $resultset=$this->db->query($query);
			  if($resultset->num_rows()==0){
			  $data= array("status" => "failure");
			  return $data;
			 }else{
			  $res=$resultset->result();
			  $data= array("status" => "success","event_li"=>$res);
			  return $data;
			}
        }


        function save_to_do_list($to_do_date,$to_do_list,$to_do_notes,$to_user,$user_type,$status){
          $query="INSERT INTO edu_reminder(user_id,to_do_date,to_do_title,to_do_description,status,created_by,created_at,updated_by,updated_at) VALUES ('$to_user','$to_do_date','$to_do_list','$to_do_notes','$status','$user_type',NOW(),'$user_type',NOW())";
          $resultset=$this->db->query($query);
          if($resultset){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failure");
            return $data;
          }
        }

        function view_all_reminder($user_id){
          $query="SELECT to_do_date AS start,to_do_title AS title,to_do_description AS description FROM edu_reminder AS eh WHERE user_id='$user_id' AND status='Active'";
          $result=$this->db->query($query);
          return $result->result();
        }













}
?>
