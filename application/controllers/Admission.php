<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends CI_Controller {


	function __construct() {
		 parent::__construct();
		  $this->load->model('admissionmodel');
		  $this->load->model('yearsmodel');
		  $this->load->model('classmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section


	 	public function home(){
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
	 		//$datas['result'] = $this->classmodel->getclass();
			$datas['class'] = $this->classmodel->getclass();
			$datas['result'] = $this->yearsmodel->getall_years();
			$datas['lang'] = $this->admissionmodel->getall_language_proposed();
			$datas['blood'] = $this->admissionmodel->getall_blood_group();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('admission/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		

		public function create()
		{
			$datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
		 	if($user_type==1){
				
			 $admission_year=$this->input->post('admission_year');
			 //echo $admission_year;exit; 
			 $admission_no=$this->input->post('admission_no');
			 $emsi_num=$this->input->post('emsi_num');
			 $admission_date=$this->input->post('admission_date');

			 $dateTime1 = new DateTime($admission_date);
			 $formatted_date=date_format($dateTime1,'Y-m-d' );

			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
			 $sec_email=$this->input->post('sec_email');
		     $sex=$this->input->post('sex');

			 $dob=$this->input->post('dob');
			 $dateTime = new DateTime($dob);
			 $dob_date=date_format($dateTime,'Y-m-d' );


			 $age=$this->input->post('age');
		     $nationality=$this->input->post('nationality');
			 $religion=$this->input->post('religion');
			 $community_class=$this->input->post('community_class');
		     $community=$this->input->post('community');
			 $mother_tongue=$this->input->post('mother_tongue');
			 
			 $language=$this->input->post('lang');
			 $blood_group=$this->input->post('blood_group');
			 $status=$this->input->post('status');
			 //echo $status;exit;
			 
			 $mobile=$this->input->post('mobile');
			 $sec_mobile=$this->input->post('sec_mobile');
		  // $student_pic=$this->input->post('student_pic');
			 $student_pic = $_FILES["student_pic"]["name"];
			 $userFileName =$student_pic;

				$uploaddir = 'assets/students/';
				$profilepic = $uploaddir.$userFileName;
				move_uploaded_file($_FILES['student_pic']['tmp_name'], $profilepic);
				
				$last_sch=$this->input->post('sch_name');
				$last_studied=$this->input->post('class_name');
				$qual=$this->input->post('qual');
				$tran_cert=$this->input->post('trn_cert');
				$recod_sheet=$this->input->post('rec_sheet');
				$emsi_num=$this->input->post('emsi_num');
				
				$datas=$this->admissionmodel->ad_create($admission_year,$admission_no,$emsi_num,$formatted_date,$name,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$language,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$blood_group,$status);
			     //print_r($datas['status']); print_r($datas['last_id']);exit;
               //print_r$data['admisn_no'] ; exit;
       
				if($datas['status']=="success"){
					$id=$datas['last_id'];
					//$this->session->set_flashdata('msg', 'Added Successfully');
					redirect('/parents/home/'.$id.'');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('admission/home');
				}	else if($datas['status']=="Already Mobile Number Exist"){
					$this->session->set_flashdata('msg', 'Already Number Exist');
					redirect('admission/home');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('admission/home');
				}
			 }
			 else{
					redirect('/');
			 }
		}

// GET ALL ADMISSION DETAILS

		public function view()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $gender=$this->input->post('gender');
			 
			 $datas['result'] = $this->admissionmodel->get_all_admission();
			 //echo "<pre>";print_r($datas['result']);exit;
			 //$datas['sorting'] = $this->admissionmodel->get_sorting_admission_details();
			 if(!empty($gender)){
			 $datas['gender'] = $this->admissionmodel->get_sorting_gender_details($gender);
			 }
			
		     if($user_type==1){
			 $this->load->view('header');
			 $this->load->view('admission/view',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}
        //-----------Sorting----------------
		
		/*  public function get_sorting_details()
		{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $gender=$this->input->post('gender');
		 $datas['result'] = $this->admissionmodel->get_all_admission();
		 //$datas['sorting'] = $this->admissionmodel->get_sorting_admission_details();
		 $datas['gender'] = $this->admissionmodel->get_sorting_gender_details($gender);
		 //echo "<pre>";print_r($datas['gender']);exit;
	 	 if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('admission/view',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
			
		}  */
		//-------------------------
		public function get_ad_id($admission_id){
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');

		 $datas['result'] = $this->yearsmodel->getall_years();
		 $datas['class'] = $this->classmodel->getclass();
		 $datas['res']=$this->admissionmodel->get_ad_id($admission_id);
		 $datas['lang'] = $this->admissionmodel->getall_language_proposed();
		 $datas['blood'] = $this->admissionmodel->getall_blood_group();
		//echo "<pre>";print_r($datas['res']);exit;
		
		if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('admission/edit',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}
		public function get_ad_id1($admission_id){
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');

		 $datas['result'] = $this->yearsmodel->getall_years();

		 $datas['res']=$this->admissionmodel->get_ad_id1($admission_id);
		 $datas['lang'] = $this->admissionmodel->getall_language_proposed();
		 $datas['blood'] = $this->admissionmodel->getall_blood_group();
		//	echo "<pre>";print_r(	$datas['res']);exit;
		$user_type=$this->session->userdata('user_type');
		if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('admission/edit',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}


		public function save_ad()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
			 $admission_id=$this->input->post('admission_id');
			 $admission_year=$this->input->post('admission_year');
			 $admission_no=$this->input->post('admission_no');
			 $admission_date=$this->input->post('admission_date');
			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
		     $sex=$this->input->post('sex');
			 $dob=$this->input->post('dob');
			 $age=$this->input->post('age');
		     $nationality=$this->input->post('nationality');
			 $religion=$this->input->post('religion');
			 $community_class=$this->input->post('community_class');
		     $community=$this->input->post('community');
			 $mother_tongue=$this->input->post('mother_tongue');
			 $lang=$this->input->post('lang');
			  $blood_group=$this->input->post('blood_group');
			 $mobile=$this->input->post('mobile');
			 
			 $sec_mobile=$this->input->post('sec_mobile');
			 $sec_email=$this->input->post('sec_email');
			 
			 $status=$this->input->post('status');
			 $last_sch=$this->input->post('sch_name');
			 $last_studied=$this->input->post('class_name');
			 $qual=$this->input->post('qual');
			 //echo $last_sch;exit;			 
				$tran_cert=$this->input->post('trn_cert');
				$recod_sheet=$this->input->post('rec_sheet');
				$emsi_num=$this->input->post('emsi_num');
				//echo $tran_cert;echo $recod_sheet;exit;
			    
			 $user_pic_old=$this->input->post('user_pic_old');
			 $student_pic = $_FILES["student_pic"]["name"];
			 $userFileName =$admission_no.'-'.$student_pic;

				$uploaddir = 'assets/students/';
				$profilepic = $uploaddir.$userFileName;
				move_uploaded_file($_FILES['student_pic']['tmp_name'], $profilepic);
				if(empty($student_pic)){
						$userFileName=$user_pic_old;
				}

				$datas=$this->admissionmodel->save_ad($admission_id,$admission_year,$admission_no,$emsi_num,$admission_date,$name,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$lang,$mobile,$sec_mobile,$email,$sec_email,$userFileName,$last_sch,$last_studied,$qual,$tran_cert,$recod_sheet,$blood_group,$status);
			//	print_r($datas['status']);exit;
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('admission/view');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('admission/view');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('admission/view');
				}
			 }
			 else{
					redirect('/');
			 }
		}

		public function check_email_exists($email){
			echo $email=$this->input->post('email');
			$data=$this->admissionmodel->check_email($email);

		}

           public function checker()
                {
					$email = $this->input->post('email');
					$numrows = $this->admissionmodel->getData($email);
					if ($numrows>0)
				     {
						echo "Email Id already Exist";
					 }
					else
					 {
						echo "Email Id Available";
					 }
                }

				 public function checker1()
                {
					$admission_no=$this->input->post('admission_no');
					$numrows1 = $this->admissionmodel->getData1($admission_no);
					if ($numrows1 > 0)
				     {
						echo "Admission Number already Exist";
					 }
					else
					 {
						echo "Admission Number Available";
					 }
                }
				
				public function cellchecker()
				{
					$cell = $this->input->post('cell');
					$numrows2 = $this->admissionmodel->checkcellnum($cell);
					if($numrows2 > 0) 
				     {
						echo "Mobile Number Not Found";
					 } 
					else 
					 {
						echo "Mobile Number Available";
					 }
				}



}
