<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrolemanage extends CI_Controller {


	function __construct() {
		 parent::__construct();

		  $this->load->model('usermodel');
			 $this->load->model('smsmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->helper('menu');


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

		 public function parents()
		 {
	 		  $datas=$this->session->userdata();
	 		  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  $datas['parents']=$this->usermodel->get_parents();
				 //echo'<pre>';print_r($datas['parents']);exit;
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('userrole/parents',$datas);
				 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function teachers()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['parents']=$this->usermodel->get_staff();
				//print_r($datas['parents']);exit;
			if($user_type==1)
			{
				$this->load->view('header');
				$this->load->view('userrole/teachers',$datas);
				$this->load->view('footer');
			}
			else{
				 redirect('/');
			}
	 }

	 public function students()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['parents']=$this->usermodel->get_student();
			 //print_r($datas['parents']);exit;
		 if($user_type==1)
		 {
			 $this->load->view('header');
			 $this->load->view('userrole/students',$datas);
			 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
	}


	public function get_userid($user_id)
	{

		  $datas=$this->session->userdata();
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->usermodel->get_userid($user_id);
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('userrole/edit',$datas);
			$this->load->view('footer');
		}
		else{
			 redirect('/');
		}
 }

 public function get_user_student($user_id)
 {

		 $datas=$this->session->userdata();
		 $user_type=$this->session->userdata('user_type');
		 $datas['result']=$this->usermodel->get_userid($user_id);
	 if($user_type==1)
	 {
		 $this->load->view('header');
		 $this->load->view('userrole/edit_student',$datas);
		 $this->load->view('footer');
	 }
	 else{
			redirect('/');
	 }
}


public function get_user_parents($user_id)
{

		$datas=$this->session->userdata();
		$user_type=$this->session->userdata('user_type');
		$datas['result']=$this->usermodel->get_userid($user_id);
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('userrole/edit_parent',$datas);
		$this->load->view('footer');
	}
	else{
		 redirect('/');
	}
}


	 public function save_teacher()
	 {
			 $datas=$this->session->userdata();
			 $user_type=$this->session->userdata('user_type');
		  	if($user_type==1)
		  {
			  $user_profile_id=$this->input->post('user_profile_id');
			  $status=$this->input->post('status');
				$datas=$this->usermodel->save_profile_id($user_profile_id,$status);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('userrolemanage/teachers');
				}else{
					$this->session->set_flashdata('msg', 'SomeThing Went Wrong');
					redirect('userrolemanage/teachers');
				}
		 }
		 else{
				redirect('/');
		 }
	}


	public function save_parents()
	{
			$datas=$this->session->userdata();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
		 {
			 $user_profile_id=$this->input->post('user_profile_id');
			 $status=$this->input->post('status');
			 $datas=$this->usermodel->save_profile_id($user_profile_id,$status);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect('userrolemanage/parents');
			 }else{
				 $this->session->set_flashdata('msg', 'SomeThing Went Wrong');
				 redirect('userrolemanage/parents');
			 }
		}
		else{
			 redirect('/');
		}
 }



 public function save_students()
 {
		 $datas=$this->session->userdata();
		 $user_type=$this->session->userdata('user_type');
			if($user_type==1)
		{
			$user_profile_id=$this->input->post('user_profile_id');
			$status=$this->input->post('status');
			$datas=$this->usermodel->save_profile_id($user_profile_id,$status);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg', 'Updated Successfully');
				redirect('userrolemanage/students');
			}else{
				$this->session->set_flashdata('msg', 'SomeThing Went Wrong');
				redirect('userrolemanage/students');
			}
	 }
	 else{
			redirect('/');
	 }
 }




 public function users_dob_wishes()
 {
	 	$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
		$cur_date=$dateTime->format("Y-m-d");
		$datas['res']=$this->smsmodel->student_dob_wishes($cur_date);
		$datas['res']=$this->smsmodel->teacher_dob_wishes($cur_date);

 }





















}
