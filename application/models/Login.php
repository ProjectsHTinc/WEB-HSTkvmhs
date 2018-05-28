<?php

Class Login extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

       function login($email,$password)
       {
         $query = "SELECT * FROM edu_users WHERE  user_name = '$email'";
          $resultset=$this->db->query($query);
          if($resultset->num_rows()==1){
             $pwdcheck="SELECT * FROM edu_users WHERE user_name='$email' AND user_password='$password'";
            $res=$this->db->query($pwdcheck);

            if($res->num_rows()==1){
               foreach($res->result() as $rows){
                 $quer="SELECT status FROM edu_users WHERE user_id='$rows->user_id'";
                 $resultset=$this->db->query($quer);
                // return $resultset->result();
                 $status= $rows->status;
                 switch($status){
                    case "Active":
                      $data = array("user_name"  => $rows->user_name,"msg"  =>"success","name"=>$rows->name, "school_id" => $rows->school_id,"user_type"=>$rows->user_type,"status"=>$rows->status,"user_id"=>$rows->user_id,"user_pic"=>$rows->user_pic);
                      return $data;
                      //break;
                     print_r($data);exit;
                      // break;
                    case "Deactive":

                            $data= array("status" => "Deactive","msg" => "Your Account Is De-Activated");
                            return $data;
                      break;


                 }


                //  if($rows->status=='A'){
                //    $data = array("user_name"  => $rows->user_name,"msg"  =>"success","name"=>$rows->name, "school_id" => $rows->school_id,"user_type"=>$rows->user_type,"status"=>$rows->status,"user_id"=>$rows->user_id,"user_pic"=>$rows->user_pic);
                //
                //  }

                   $data = array("user_name"  => $rows->user_name,"msg"  =>"success","name"=>$rows->name, "school_id" => $rows->school_id,"user_type"=>$rows->user_type,"status"=>$rows->status,"user_id"=>$rows->user_id,"user_pic"=>$rows->user_pic);
                   $this->session->set_userdata($data);
                   return $data;
                   }
                 }
                 else{
                  $data= array("status" => "notRegistered","msg" => "Password Wrong");
                  return $data;
                 }
                 }

                else{
                  $data= array("status" => "notRegistered","msg" => " Email invalid");
                  return $data;

            }

       }
       function getuser($user_id){
         $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }

       function updateprofile($user_id,$oldpassword,$newpassword){
         $checkpassword="SELECT user_id FROM edu_users WHERE user_password='$oldpassword' AND user_id='$user_id'";
         $res=$this->db->query($checkpassword);
         if($res->num_rows()==1){
           $query="UPDATE edu_users SET user_password='$newpassword',	updated_date=NOW() WHERE user_id='$user_id'";
           $ex=$this->db->query($query);
            $data= array("status" => "success");
           return $data;
         }else{
           $data= array("status" => "failure");
          return $data;
         }
       }

       function profileupdate($userFileName,$user_id,$name){
         $query="UPDATE edu_users SET user_pic='$userFileName',name='$name' WHERE user_id='$user_id'";
          $ex=$this->db->query($query);
         $data= array("status" => "success");
         return $data;
       }




}
?>
