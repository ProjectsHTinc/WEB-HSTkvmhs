<?php

Class Studentprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION
     function getuser($user_id)
	   {
       $query="SELECT s.subject_name,ed.*,ea.* FROM edu_users AS ed LEFT JOIN edu_admission AS ea ON ed.student_id=ea.admission_id LEFT JOIN edu_subject AS s ON s.subject_id=ea.language WHERE ed.user_id='$user_id'";
       $resultset=$this->db->query($query);
 		return $resultset->result();
	   }


      function update_details($admission_year,$admission_no,$userFileName,$admission_id)
	   {
		   //$query="UPDATE edu_admission SET admisn_year='$admission_year',admisn_no='$admission_no',emsi_num='$emsi_num',admisn_date='$admission_date',name='$name',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',mother_tongue='$mother_tongue',language='$lang',mobile='$mobile',sec_mobile='$sec_mobile',email='$email',sec_email='$sec_email',last_sch_name='$last_sch',last_studied='$last_studied',qualified_promotion='$qual',transfer_certificate='$tran_cert',record_sheet='$recod_sheet' WHERE admission_id='$admission_id'";
		   //$res=$this->db->query($query);

			$query6="UPDATE edu_users SET user_pic='$userFileName',updated_date=NOW() WHERE student_id='$admission_id' ";
			$res=$this->db->query($query6);

		   //$query7="UPDATE edu_enrollment SET name='$name' WHERE admisn_no='$admission_no' ";
			//$res=$this->db->query($query7);

			 if($res){
			 $data= array("status" => "success");
			 return $data;
		   }else{
			 $data= array("status" => "Failed to Update");
			 return $data;
		   }

       }

	    function change_pwd($user_id)
         {
			 $query="SELECT * FROM edu_users WHERE user_id='$user_id'";
			 $resultset=$this->db->query($query);
			 return $resultset->result();
        }
		function updatepwd($user_id,$oldpassword,$newpassword)
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
?>
