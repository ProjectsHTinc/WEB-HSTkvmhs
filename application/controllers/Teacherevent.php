<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherevent extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('teachereventmodel');
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
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->teachereventmodel->get_teacher_event($user_id);
			 $datas['event_all']=$this->teachereventmodel->get_teacher_allevent();
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/event/eventview',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function calender(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/event/teachercalender',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function todolist(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==2){
			 	$to_do_date=$this->input->post('to_do_date');
 				$to_do_list=$this->input->post('to_do_list');
 				$to_do_notes=$this->input->post('to_do_notes');
				$status=$this->input->post('status');
 		 		$to_user=$user_id;
				$datas=$this->teachereventmodel->save_to_do_list($to_do_date,$to_do_list,$to_do_notes,$to_user,$user_type,$status);
				if($datas['status']=="success"){
					echo "success";
				}else{
					echo "failed";
				}
		 }
		 else{
				redirect('/');
		 }
		}

		public function view_event($event_id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->teachereventmodel->get_teacher_in_event($event_id);
			 $datas['result']=$this->teachereventmodel->get_event_details($event_id);

			//  echo "<pre>";
			//  print_r( $datas['result']);exit;
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/event/event_list',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function view_all_reminder()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$data['reg']=$this->teachereventmodel->view_all_reminder($user_id);
			//$s= unset($data);
			echo json_encode($data['reg']);
		}


























}
