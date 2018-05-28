<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjectadd extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('subjectmodel');
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


	 	public function addsubject(){
	 		$datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result'] = $this->subjectmodel->getsubject();
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('subject/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function createsubject(){
			  $datas=$this->session->userdata();
	 		   $user_id=$this->session->userdata('user_id');
				 $user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$subjectname=$this->input->post('subjectname');
				$is_preferred_lang=$this->input->post('is_preferred_lang');
				$status=$this->input->post('status');
				$res = $this->subjectmodel->addsubject($subjectname,$is_preferred_lang,$status);
				if($res['status']=="success"){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				 redirect('subjectadd/addsubject');
			 }else{
				 $this->session->set_flashdata('msg', 'Subject Name Already Exist');
				 redirect('subjectadd/addsubject');
			 }
		 }else{
			 redirect('/');
		 }
		}

		public function updatesubject($subject_id){
					$res['datas'] = $this->subjectmodel->update_subject($subject_id);
					$this->load->view('header');
					$this->load->view('subject/edit',$res);
					$this->load->view('footer');
		}

		public function save_subject()
		{
			  $subject_name=$this->input->post('subjectname');
			  $subject_id=$this->input->post('subject_id');
				$is_preferred_lang=$this->input->post('is_preferred_lang');
			  $status=$this->input->post('status');
			  $data = $this->subjectmodel->save_subject($subject_name,$is_preferred_lang,$subject_id,$status);
				if($data['status']=="success"){
				 $this->session->set_flashdata('msg', 'Update Successfully');
				 redirect('subjectadd/addsubject');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to update');
				 redirect('subjectadd/addsubject');
			 }
		}


		public function delete_subject($subject_id){
					$res = $this->subjectmodel->delete_subject($subject_id);
					if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Deleted Successfully');
					 redirect('subjectadd/addsubject');
				 }else{
					 $this->session->set_flashdata('msg', 'Failed to Deleted');
					 redirect('subjectadd/addsubject');
				 }
		}









}
