<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classadd extends CI_Controller {


	function __construct() {
		 parent::__construct();
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


	 	public function addclass(){
	 		$datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
	 		$datas['result'] = $this->classmodel->getclass();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('class/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function createclass(){
				$classname=$this->input->post('classname');
				$status=$this->input->post('status');
				$res = $this->classmodel->addclass($classname,$status);
				//print_r($res);exit;
				if($res['status']=="success"){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				 redirect('classadd/addclass');
			 }else{
				 $this->session->set_flashdata('msg', 'Class Name Already exist');
				 redirect('classadd/addclass');
			 }
		}

		public function updateclass($class_id){
					$res['datas'] = $this->classmodel->update_class($class_id);
					$this->load->view('header');
					$this->load->view('class/edit',$res);
					$this->load->view('footer');
		}

		public function save_class(){
			 $class_name=$this->input->post('classname');
			  $class_id=$this->input->post('class_id');
			  $status=$this->input->post('status');
			 	$res = $this->classmodel->save_class($class_name,$class_id,$status);
				if($res['status']=="success"){
				 $this->session->set_flashdata('msg', 'Update Successfully');
				 redirect('classadd/addclass');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to update');
				 redirect('classadd/addclass');
			 }
		}


		public function delete_class($class_id){
					$res = $this->classmodel->delete_class($class_id);
					if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Deleted Successfully');
					 redirect('classadd/addclass');
				 }else{
					 $this->session->set_flashdata('msg', 'Failed to Deleted');
					 redirect('classadd/addclass');
				 }
		}









}
