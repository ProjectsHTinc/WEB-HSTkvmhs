<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachertimetable extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('teacherattendencemodel');
			$this->load->model('timetablemodel');
			$this->load->model('class_manage');
		  $this->load->helper('url');
			$this->load->model('subjectmodel');
			//$this->load->library('encryption');

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
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->teacherattendencemodel->get_teacher_id($user_id);
			// print_r($datas);
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/timetable/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}



		public function classhandling_subject(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->subjectmodel->get_class_handling_subject($user_id);
			// print_r($datas);
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/special_class/teacher_handling_subject',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}


		public function view($class_mas_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$class_sec_id=base64_decode($class_mas_id);
			$datas['restime']=$this->timetablemodel->view_time($class_sec_id);
		 if($user_type==2){
			 if($datas['restime']['st']=="no data Found"){
				 $data=$datas['restime'];
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/timetable/nodata');
				 $this->load->view('adminteacher/teacher_footer');
			 }else {
				 	$data['res'] = $this->timetablemodel->get_subject_class($class_sec_id);
				 $data['restime']=$datas['restime']['time'];
				 $data['class_id']=$class_sec_id;
				 $data['user_id']=$user_id;$data['user_type']=$user_type;
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/timetable/view',$data);
				 $this->load->view('adminteacher/teacher_footer');
			 }

		 }
		 else{
			 redirect('/');
		 }
		}

		public function review(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==2){
			$class_id=$this->input->post('class_id');
			$user_id=$this->input->post('user_id');
			$subject_id=$this->input->post('subject_id');
			$period_id=$this->input->post('period_id');
			$user_type=$this->input->post('user_type');
		 	$cur_date1=$this->input->post('cur_date');
			$cls_date = new DateTime($cur_date1);
			$cur_date= $cls_date->format('Y-m-d h:i:s');
			 $comments=$this->input->post('comments');
			 $data=$this->timetablemodel->save_review($class_id,$user_id,$user_type,$subject_id,$cur_date,$comments,$period_id);
			 if($data['status']=="success"){
				 echo "success";
			 }else{
				 echo "failure";
			 }
			}else{
				redirect('/');
			}
		}


		public function reviewview(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['res']=$this->timetablemodel->view_review($user_id);
				//echo "<pre>"; print_r($datas['res']);exit;
			 if($user_type==2){
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/timetable/review',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}



		public function teachertimetable(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==2){
						$datas['restime']=$this->timetablemodel->teacher_timetable($user_id);
 					 $this->load->view('adminteacher/teacher_header');
 					 $this->load->view('adminteacher/timetable/teacher_timetable',$datas);
 					 $this->load->view('adminteacher/teacher_footer');
 			 }
			 else{
					redirect('/');
			 }
		}
























}
