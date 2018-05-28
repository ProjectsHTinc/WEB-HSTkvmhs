<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('promotionmodel');
			$this->load->model('teachermodel');
			$this->load->model('groupingmodel');
			$this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');
			$this->load->library('encrypt');


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

			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['years']=$this->promotionmodel->getall_years();
				$datas['res_class']=$this->groupingmodel->get_all_classes_for_year();
				$datas['res_class_all']=$this->promotionmodel->get_all_classes_for_year();
				$datas['res_year']= $this->promotionmodel->get_all_academic_year();
				$datas['res_pro']= $this->promotionmodel->promotion_history();
	 		 $this->load->view('header');
	 		 $this->load->view('promotion/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}



		public function create_promotion(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$current_year_id=$this->input->post('current_academic_year_id');
				$next_year_id=$this->input->post('next_year_id');
				$class_master_id_for_last=$this->input->post('class_master_id_for_last_academic_year');
				$promotion_class_master_id=$this->input->post('promotion_class_master_id');
				$student_id=$this->input->post('student_reg_id_for_last_academic_year');
				$result_status=$this->input->post('result_status');
				$data=$this->promotionmodel->create_promotion($current_year_id,$next_year_id,$class_master_id_for_last,$promotion_class_master_id,$student_id,$result_status,$user_id);
				if($data['status']=="success"){
					echo "success";
				}else if($data['status']=="Already"){
					echo "Some Students  Already Exist";
				}else{
					echo "Something Went Wrong";
				}
			}else{
					redirect('/');
			}
		}




				public function edit_promotion($id){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
					if($user_type==1){
					  $datas['res_pro']= $this->promotionmodel->edit_promotion_history($id);
						$datas['years']=$this->promotionmodel->getall_years();
						$datas['res_class']=$this->groupingmodel->get_all_classes_for_year();
						$datas['res_class_all']=$this->promotionmodel->get_all_classes_for_year();
						$datas['res_year']= $this->promotionmodel->get_all_academic_year();
					 $this->load->view('header');
					 $this->load->view('promotion/edit_promotion',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
				}




				public function save_promotion(){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
					if($user_type==1){
						$current_year_id=$this->input->post('current_year_id');
						$student_admission_id=$this->input->post('student_admission_id');
						$next_year_id=$this->input->post('next_year_id');
						$promotion_class_master_id=$this->input->post('promotion_class_master_id');
						$result_status=$this->input->post('result_status');
						$id=$this->input->post('id');
						$data=$this->promotionmodel->save_promotion($current_year_id,$student_admission_id,$next_year_id,$promotion_class_master_id,$result_status,$id,$user_id);
						if($data['status']=="success"){
							echo "success";
						}else if($data['status']=="Already"){
							echo "Some Students  Already Exist";
						}else{
							echo "Something Went Wrong";
						}
					}else{
							redirect('/');
					}
				}



				public function view_list_for_year($year_id){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
					if($user_type==1){
					 $datas['res_list']= $this->promotionmodel->view_list_for_year($year_id);
					  $datas['res_year']= $this->promotionmodel->get_year_name($year_id);
					 $this->load->view('header');
					 $this->load->view('promotion/view_list_for_year',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
				}




}
