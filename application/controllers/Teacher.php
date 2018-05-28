<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('teachermodel');
			$this->load->model('subjectmodel');
			$this->load->model('class_manage');
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
			$datas['get_all_class_notexist']=$this->class_manage->get_all_class_notexist();
			$datas['getall_class']=$this->class_manage->getall_class();
			$datas['resubject'] = $this->subjectmodel->getsubject();
			$datas['groups']=$this->teachermodel->get_all_groups_details();
			$datas['activities']=$this->teachermodel->get_all_activities_details();
			$datas['res_user_role']=$this->teachermodel->get_user_rolename();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('teacher/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
 			if($user_type==1)
			{
		   $role_type_id=$this->input->post('role_type_id');
			 $class_name=$this->input->post('class_name');
			 $class_teacher=$this->input->post('class_teacher');
			 $subject=$this->input->post('subject');
			 $multiple_sub=$this->input->post('subject_multiple');
			 $qualification=$this->input->post('qualification');
			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
			 $sec_email=$this->input->post('sec_email');
		   $sex=$this->input->post('sex');
			 $dob=$this->input->post('dob');
			 $dateTime = new DateTime($dob);
       $formatted_date=date_format($dateTime,'Y-m-d' );
			 $age=$this->input->post('age');
		   $nationality=$this->input->post('nationality');
			 $religion=$this->input->post('religion');
		 	 $community_class=$this->input->post('community_class');
		   $community=$this->input->post('community');
			 $mobile=$this->input->post('mobile');
			 $sec_phone=$this->input->post('sec_phone');
			 $groups_id=$this->input->post('groups_id');
			 $activity=$this->input->post('activity_id');
			 if(!empty($activity)){
				 $activity_id=implode(',',$activity);
			 }else{
				 $activity_id=0;
			 }
			 $status=$this->input->post('status');
			 $address=$this->input->post('address');
			 $teacher_pic = $_FILES["teacher_pic"]["name"];
			 $userFileName =$teacher_pic;
			 $uploaddir = 'assets/teachers/';
			 $profilepic = $uploaddir.$userFileName;
				move_uploaded_file($_FILES['teacher_pic']['tmp_name'], $profilepic);
				$datas=$this->teachermodel->teacher_create($role_type_id,$name,$email,$sec_email,$sex,$formatted_date,$age,$nationality,$religion,$community_class,$community,$mobile,$sec_phone,$address,$class_teacher,$class_name,$subject,$multiple_sub,$qualification,$groups_id,$activity_id,$status,$user_id,$userFileName);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Added Successfully');
					redirect('teacher/view');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('teacher/home');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('teacher/home');
				}
			 }
			 else{
					redirect('/');
			 }
		}


// GET ALL ADMISSION DETAILS

		public function view(){
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
          $user_type=$this->session->userdata('user_type');
		  $gender=$this->input->post('gender');

		  $datas['getall_class']=$this->class_manage->getall_class();
		  $datas['result'] = $this->teachermodel->get_all_teacher();
		  $datas['resubject'] = $this->subjectmodel->getsubject();
		  if(!empty($gender)){
		   $datas['gender'] = $this->teachermodel->get_all_sorting_result($gender);
			}

		 if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('teacher/view',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}



		//Adding subject to teacher for class
		public function subject_handling(){
			$user_id=$this->session->userdata('user_id');
			$subject_id=$this->input->post('subject_id');
			$class_master_id=$this->input->post('class_master_id');
			$teacher_id=$this->input->post('teacher_id');
			$status=$this->input->post('status');
			$datas=$this->teachermodel->subject_handling($user_id,$subject_id,$class_master_id,$teacher_id,$status);
			if($datas['status']=="success"){
				echo "success";
			}else if($datas['status']=="already"){
				echo "Already Assigned";
			}else{
				echo "failed";
			}
		}

		//View subject handling
		public function view_subject_handling(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res'] = $this->teachermodel->view_subject_handling_teacher();
			//echo '<pre>';print_r($datas['result']);exit;
		 if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('teacher/teacher_subject_handling',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}

		// Get Subject for Teacher

		public function edit_subject_teacher($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');

			//echo '<pre>';print_r($datas['res']);exit;
		 if($user_type==1){
			 $datas['res'] = $this->teachermodel->get_subject_handling_teacher($id);
			$datas['resubject'] = $this->subjectmodel->getsubject();
			$datas['getall_class']=$this->class_manage->getall_class();
		 $this->load->view('header');
		 $this->load->view('teacher/edit_subject_handling',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}


		//save Subject Handling Teacher
		public function save_subject_handling(){
			$user_id=$this->session->userdata('user_id');
			$subject_id=$this->input->post('subject_id');
			$class_master_id=$this->input->post('class_master_id');
			$id=$this->input->post('id');
			$status=$this->input->post('status');
			$datas=$this->teachermodel->save_subject_handling($user_id,$subject_id,$class_master_id,$id,$status);
			if($datas['status']=="success"){
				echo "success";
			}else if($datas['status']=="already"){
				echo "Already Assigned";
			}else{
				echo "failed";
			}

		}

		public function get_teacher_id($teacher_id){
			$datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $datas['getall_class']=$this->class_manage->getall_class();
		 	$datas['res']=$this->teachermodel->get_teacher_id($teacher_id);
			$datas['resubject'] = $this->subjectmodel->getsubject();
			$datas['groups']=$this->teachermodel->get_all_groups_details();
			$datas['activities']=$this->teachermodel->get_all_activities_details();
			$datas['res_user_role']=$this->teachermodel->get_user_rolename();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('teacher/edit',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
		}


		public function save(){
				$datas=$this->session->userdata();
			 	$user_id=$this->session->userdata('user_id');
			 	$user_type=$this->session->userdata('user_type');
			 if($user_type==1){
				 $teacher_id=$this->input->post('teacher_id');
			 $class_name=$this->input->post('class_name');
			  $role_type_id=$this->input->post('role_type_id');
			 if($role_type_id=="5"){
				  $class_teacher="0";
			 }else{
				  $class_teacher=$this->input->post('class_teacher');
			 }
			 $subject=$this->input->post('subject');
			 $name=$this->input->post('name');
			 $email=$this->input->post('email');
			 $sec_email=$this->input->post('sec_email');
			 $sec_phone=$this->input->post('sec_phone');
			 $multiple_sub=$this->input->post('subject_multiple');
			 $qualification=$this->input->post('qualification');
		   $sex=$this->input->post('sex');
			 $dobdate=$this->input->post('dob');
			 $dateTime = new DateTime($dobdate);
       $dob=date_format($dateTime,'Y-m-d' );
			 $age=$this->input->post('age');
		   $nationality=$this->input->post('nationality');
			 $religion=$this->input->post('religion');
			 $community_class=$this->input->post('community_class');
		   $community=$this->input->post('community');
			 $mobile=$this->input->post('mobile');
			 $address=$this->input->post('address');
			 $status=$this->input->post('status');
			 $groups_id=$this->input->post('groups_id');
			 $activity=$this->input->post('activity_id');
			 if(!empty($activity)){ $activity_id=implode(',',$activity); }else{ $activity_id=0; }
			 $user_pic_old=$this->input->post('old_pic');
			 $teacher_pic = $_FILES["teacher_pic"]["name"];
			 $userFileName =time().'-'.$teacher_pic;
				$uploaddir = 'assets/teachers/';
				$profilepic = $uploaddir.$userFileName;
				move_uploaded_file($_FILES['teacher_pic']['tmp_name'], $profilepic);
				if(empty($teacher_pic)){
						$userFileName=$user_pic_old;
				}

				$datas=$this->teachermodel->save_teacher($role_type_id,$name,$email,$sec_email,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mobile,$sec_phone,$address,$userFileName,$class_teacher,$class_name,$subject,$multiple_sub,$qualification,$groups_id,$activity_id,$status,$user_id,$teacher_id);
			//	print_r($datas['status']);exit;
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('teacher/view');
				}else if($datas['status']=="Email Already Exist"){
					$this->session->set_flashdata('msg', 'Email Already Exist');
					redirect('teacher/view');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('teacher/view');
				}
			 }
			 else{
					redirect('/');
			 }
		}

		public function check_email(){
			echo $email=$this->input->post('email');
			$data=$this->admissionmodel->check_email($email);

		}

    public function checker(){
			$email = $this->input->post('email');
			$numrows = $this->teachermodel->getemail($email);

    }
		public function mobile_checker(){
			$mobile = $this->input->post('mobile');
			$numrows = $this->teachermodel->mobile_checker($mobile);
		}

		public function email_checker(){
			$email = $this->input->post('email');
			$teacher_id=$this->uri->segment(3);
			$numrows = $this->teachermodel->email_checker($email,$teacher_id);

		}
		public function mobile_exist_checker(){
			$mobile = $this->input->post('mobile');
			$teacher_id=$this->uri->segment(3);
			$numrows = $this->teachermodel->mobile_exist_checker($mobile,$teacher_id);

		}

}
