<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sectionadd extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('sectionmodel');
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


	 	public function addsection(){
	 		$datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
	 		$datas['result'] = $this->sectionmodel->getsection();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('section/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function createsection(){
				$sectionname=$this->input->post('sectionname');
				$status=$this->input->post('status');
				$res = $this->sectionmodel->addsection($sectionname,$status);
				if($res['status']=="success"){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				 redirect('sectionadd/addsection');
			 }else{
				 $this->session->set_flashdata('msg', 'Section Name Already exist');
				 redirect('sectionadd/addsection');
			 }
		}

		public function updatesection($sec_id){
					$res['datas'] = $this->sectionmodel->update_section($sec_id);
					$this->load->view('header');
					$this->load->view('section/edit',$res);
					$this->load->view('footer');
		}

		public function save_section(){
			 $sec_name=$this->input->post('sectionname');
			 $status=$this->input->post('status');
			  $sec_id=$this->input->post('sec_id');
			 	$res = $this->sectionmodel->save_section($sec_name,$sec_id,$status);
				if($res['status']=="success"){
				 $this->session->set_flashdata('msg', 'Update Successfully');
				 redirect('sectionadd/addsection');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to update');
				 redirect('sectionadd/addsection');
			 }
		}


		public function delete_section($sec_id){
					$res = $this->sectionmodel->delete_section($sec_id);
					if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Deleted Successfully');
					 redirect('sectionadd/addsection');
				 }else{
					 $this->session->set_flashdata('msg', 'Failed to Deleted');
					 redirect('sectionadd/addsection');
				 }
		}









}
