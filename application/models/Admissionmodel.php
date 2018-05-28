<?php
Class Admissionmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION

        function ad_create($admission_year,$admission_no,$emsi_num,$formatted_date,$name,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$language,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$blood_group,$status)
		      {
          
            $query="INSERT INTO edu_admission (admisn_year,admisn_no,emsi_num,admisn_date,name,sex,dob,age,nationality,religion,community_class,community,mother_tongue,language,mobile,sec_mobile,email,sec_email,student_pic,last_sch_name,last_studied,qualified_promotion,transfer_certificate,record_sheet,status,blood_group,created_at) VALUES ('$admission_year','$admission_no','$emsi_num','$formatted_date','$name','$sex','$dob_date','$age','$nationality','$religion','$community_class','$community','$mother_tongue','$language','$mobile','$sec_mobile','$email','$sec_email','$userFileName','$last_sch','$last_studied','$qual','$tran_cert','$recod_sheet','$status','$blood_group',NOW())";

            $resultset1=$this->db->query($query);
		        $insert_id = $this->db->insert_id();
            $data=array("status" => "success","last_id"=>$insert_id);
            return $data;
          }

       //GET ALL Admission Form
      function get_all_admission()
     {
        //$query="SELECT a.admission_id,a.name,a.admisn_no,a.sex,a.mobile,a.email,a.status,a.enrollment,a.parents_status,a.parnt_guardn_id,b.blood_group_name,(select GROUP_CONCAT(p.name SEPARATOR ',') from  edu_parents AS p where FIND_IN_SET (p.id,a.parnt_guardn_id)) as parentsname FROM edu_admission as a,edu_blood_group as b WHERE a.blood_group=b.id  ORDER BY a.admission_id DESC";
       $query="SELECT a.admission_id,a.name,a.admisn_no,a.sex,a.mobile,a.email,a.status,a.enrollment,a.parents_status,a.parnt_guardn_id,(select GROUP_CONCAT(p.name SEPARATOR ',') from edu_parents AS p where FIND_IN_SET (p.id,a.parnt_guardn_id)) as parentsname,(Select b.blood_group_name FROM edu_blood_group as b WHERE  b.id IN(a.blood_group)) AS blood_group_name FROM edu_admission as a ORDER BY a.admission_id DESC";
         $res=$this->db->query($query);
         return $res->result();
       }



	   
	   function get_sorting_gender_details($gender)
		 {
      $query="SELECT a.admission_id,a.name,a.admisn_no,a.sex,a.mobile,a.email,a.status,a.enrollment,a.parents_status,a.parnt_guardn_id,b.blood_group_name,(select GROUP_CONCAT(p.name SEPARATOR ',') from  edu_parents AS p where FIND_IN_SET (p.id,a.parnt_guardn_id)) as parentsname FROM edu_admission as a,edu_blood_group as b WHERE a.blood_group=b.id  ORDER BY a.admission_id DESC";
          return $res->result();
		  }
		

       function get_ad_id($admission_id){
         $query="SELECT * FROM edu_admission WHERE admission_id='$admission_id'";
         $res=$this->db->query($query);
         return $res->result();
       }

       function getall_language_proposed()
       {
        $lang="SELECT * FROM edu_subject WHERE is_preferred_lang='1'";
        $lang1=$this->db->query($lang);
        return $lang1->result();
       }

       function getall_blood_group()
       {
        $blood="SELECT * FROM edu_blood_group WHERE status='Active'";
        $blood1=$this->db->query($blood);
        return $blood1->result();
       }

       function get_ad_id1($admission_id){
         $query="SELECT * FROM edu_admission WHERE admission_id='$admission_id'";
         $res=$this->db->query($query);
         return $res->result();
       }
       function check_email($email){
         echo $query="SELECT * FROM edu_admission WHERE email='$email'";
         $res=$this->db->query($query);
         if($res->num->rows()!=0){
           $data="Email Already Exist";
           return $data;
         }
       }

       function save_ad($admission_id,$admission_year,$admission_no,$emsi_num,$admission_date,$name,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$lang,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$blood_group,$status)
       {
           //echo $name;echo $status; echo $admission_id; exit;
       $query="UPDATE edu_admission SET admisn_year='$admission_year',admisn_no='$admission_no',emsi_num='$emsi_num',admisn_date='$admission_date',name='$name',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',mother_tongue='$mother_tongue',language='$lang',mobile='$mobile',sec_mobile='$sec_mobile',email='$email',sec_email='$sec_email',student_pic='$userFileName',last_sch_name='$last_sch',last_studied='$last_studied',qualified_promotion='$qual',transfer_certificate='$tran_cert',record_sheet='$recod_sheet',status='$status',blood_group='$blood_group',updated_at=NOW()  WHERE admission_id='$admission_id'";
       $res=$this->db->query($query);

	       $query6="UPDATE edu_users SET name='$name',updated_date=NOW() WHERE student_id='$admission_id' ";
	        $res=$this->db->query($query6);

			$query7="UPDATE edu_enrollment SET name='$name',status='$status' WHERE admission_id='$admission_id' ";
	        $res=$this->db->query($query7);

         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }

	     function getData($email)
		   {
					$query = "SELECT * FROM edu_admission WHERE email='".$email."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());
        }

		   function getData1($admission_no)
		   {
			    $query = "SELECT * FROM edu_admission WHERE admisn_no='".$admission_no."'";
					$resultset = $this->db->query($query);
					return  count($resultset->result());
		   }
	  function get_enrollment_admisno()
	  {
		   $sql="SELECT admission_id,admisn_no FROM edu_admission WHERE enrollment=0";
		   $res=$this->db->query($sql);
		   return $res->result();

	  }

	   //sorting 

 	    function get_sorting_admission_details()
		{
		   $sql="SELECT sex FROM edu_admission GROUP BY sex ";
		   $res=$this->db->query($sql);
		   return $res->result();
			
		}
		
		function checkcellnum($cell)
		{
			$query = "select mobile from edu_admission WHERE mobile='".$cell."'";
			$resultset = $this->db->query($query);
			return count($resultset->result());
		}
		
		
}
?>
