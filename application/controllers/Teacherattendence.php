<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherattendence extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('teacherattendencemodel');
			$this->load->model('class_manage');
			$this->load->model('adminattendancemodel');
			$this->load->model('homeworkmodel');
			$this->load->model('smsmodel');
		  $this->load->model('mailmodel');
		  $this->load->model('notificationmodel');
	    $this->load->helper('url');
		  $this->load->library('encryption');
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
				 $datas['res']=$this->teacherattendencemodel->get_cur_year();
				 if($datas['res']['status']=="success"){
					  $datas['res']=$this->teacherattendencemodel->get_teacher_id($user_id);
						$this->load->view('adminteacher/teacher_header');
					  $this->load->view('adminteacher/attendence/add',$datas);
					  $this->load->view('adminteacher/teacher_footer');
				}else{
					$this->load->view('adminteacher/teacher_header');
					$this->load->view('adminteacher/attendence/noyear');
					$this->load->view('adminteacher/teacher_footer');
				}
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function view(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->teacherattendencemodel->get_teacher_id($user_id);
			 $datas['cls_tutor']=$this->homeworkmodel->get_cls_tutor($user_id,$user_type);
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/attendence/view',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}


		public function attendence($class_id){

				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				  $datas=$this->teacherattendencemodel->check_attendence($class_id);
				 if($datas['status']=="success"){
					$datas['res']=$this->teacherattendencemodel->get_studentin_class($class_id);
					$datas['class_id']=$class_id;
					$datas['cur']=$this->teacherattendencemodel->get_cur_year();
					if($datas['cur']['status']=="success"){
						$this->load->view('adminteacher/teacher_header');
						$this->load->view('adminteacher/attendence/attendence',$datas);
						$this->load->view('adminteacher/teacher_footer');
					}
				}else if($datas['status']=="special"){
					$datas['status']="This Day is marked AS Special Leave";
 					$this->load->view('adminteacher/teacher_header');
 					$this->load->view('adminteacher/attendence/attendence',$datas);
 					$this->load->view('adminteacher/teacher_footer');
				 }else if($datas['status']=="regular"){
					 $datas['status']="This Day Is marked AS Regular Leave";
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/attendence/attendence',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				 }else if($datas['status']=="taken"){
					 $datas['status']="Attendance already Taken for This Class";
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/attendence/attendence',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				 }else if($datas['status']=="noYearfound"){
					 $datas['status']="No Academic  Year found";
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/attendence/attendence',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				 }
				 else{
 					$this->load->view('adminteacher/teacher_header');
 					$this->load->view('adminteacher/attendence/attendence',$datas);
 					$this->load->view('adminteacher/teacher_footer');
		 }
			 }
			 else{
					redirect('/');
			 }
		}

		public function take_attendence(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$get_cur_year=$this->teacherattendencemodel->get_cur_year();
			 if($user_type==2){
			 $student_count=$this->input->post('student_count');
			 $get_academic=$get_cur_year['cur_year'];
			 $student_id=$this->input->post('student_id');
			 $class_id=$this->input->post('class_id');
			 $attendence_val=$this->input->post('attendence_val');
			 $a_taken=$this->input->post('user_id');
		   $datas=$this->teacherattendencemodel->get_attendence_class($class_id,$student_id,$attendence_val,$a_taken,$student_count,$get_academic);
			 if($datas['status']=="success"){
				 echo "success";
			 }else if($datas['status']=="taken"){
				  echo "Already Taken";
			 }else{
				 echo "failure";
			 }
			 }
			 else{
					redirect('/');
			 }
		}


		public function viewattendence($class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				 $datas['result']=$this->teacherattendencemodel->get_atten_val($class_id);
				 $datas['get_name_class']=$this->class_manage->edit_cs($class_id);
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/attendence/view_class_attendence',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }else{
				 redirect('/');
			 }
		}


		public function send_attendance($class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				 $datas['result']=$this->teacherattendencemodel->get_atten_val($class_id);
				 $datas['get_name_class']=$this->class_manage->edit_cs($class_id);
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/attendence/send_attendance',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }else{
				 redirect('/');
			 }
		}


		public function send_attendance_parents(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				 $msg_type=$this->input->post('msg_type');
				 $attend_id=$this->input->post('attend_id');
				 $acount=count($msg_type);

				 if($acount==3)
				{
					$datas=$this->smsmodel->send_sms_attendance($attend_id);
					$datas=$this->mailmodel->send_mail_attendance($attend_id);
					$datas=$this->notificationmodel->send_notification_attendance($attend_id);
				}

				if($acount==2)
				 {
				 $ct1=$msg_type[0];
					 $ct2=$msg_type[1];

					if($ct1=='SMS' && $ct2=='Mail')
				 {
					 $datas=$this->smsmodel->send_sms_attendance($attend_id);
	 				$datas=$this->mailmodel->send_mail_attendance($attend_id);

				 }
				 if($ct1=='SMS' && $ct2=='Notification')
				 {
					 $datas=$this->smsmodel->send_sms_attendance($attend_id);
	 				$datas=$this->notificationmodel->send_notification_attendance($attend_id);
				 }
				 if($ct1=='Mail' && $ct2=='Notification')
				 {

 					$datas=$this->mailmodel->send_mail_attendance($attend_id);
 					$datas=$this->notificationmodel->send_notification_attendance($attend_id);
				 }
			 }

			 if($acount==1)
			 {
				 $ct=$msg_type[0];
				// echo $ct;exit;
				 if($ct=='SMS')
				 {
					 $datas=$this->smsmodel->send_sms_attendance($attend_id);
				 }
				 if($ct=='Notification')
				 {
				$datas=$this->notificationmodel->send_notification_attendance($attend_id);
				 }
				 if($ct=='Mail')
				 {
					$datas=$this->mailmodel->send_mail_attendance($attend_id);
				 }
			 }
			  $datas=$this->teacherattendencemodel->send_attendance_status($attend_id);
				if($datas['status']=="success"){
					echo "success";
				}else if($datas['status']=="taken"){
					 echo "Already Taken";
				}else{
					echo "failure";
				}
			 }else{
				 redirect('/');
			 }
		}


		public function view_all($at_id,$class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
				$datas['result']=$this->teacherattendencemodel->get_list_record($at_id,$class_id);
				$datas['get_name_class']=$this->class_manage->edit_cs($class_id);
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/attendence/viewattendence',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }else{
				 redirect('/');
			 }
		}


		public function month($class_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
					$datas['result']=$this->adminattendancemodel->get_month_class($class_id);
					$datas['result_month']=$this->adminattendancemodel->get_year_class($class_id);
					$datas['get_name_class']=$this->class_manage->edit_cs($class_id);
					$datas['class_id']=$class_id;
				 $this->load->view('adminteacher/teacher_header');
				 $this->load->view('adminteacher/attendence/select_month',$datas);
				 $this->load->view('adminteacher/teacher_footer');
			 }else{
				 redirect('/');
			 }
		}

		public function attendance_month_view(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			$class_master_id=$this->input->post('class_master_id');
			$month_id=$this->input->post('month_id');
			$year_class=$this->input->post('year_class');
			$query_date = $year_class.'-'.$month_id.'-'.'01';
			$first= date('Y-m-01', strtotime($query_date));
			$last= date('Y-m-t', strtotime($query_date));
			$datas['month']=$month_id;
			$datas['year']=$year_class;
			$datas['res']=$this->adminattendancemodel->get_monthview_class($first,$last,$class_master_id);
		    $datas['res_total']=$this->adminattendancemodel->get_total_working_days($first,$last,$class_master_id);
				$datas['get_name_class']=$this->class_manage->edit_cs($class_master_id);
			  $this->load->view('adminteacher/teacher_header');
			  $this->load->view('adminteacher/attendence/attendance_month_view',$datas);
			  $this->load->view('adminteacher/teacher_footer');
		 }else{
			 redirect('/');
		}
		}

		public function view_dates_id(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==2){
			 $month_id=$this->input->post('month_id');
			 $year_id=$this->input->post('year_id');
			 $student_id=$this->input->post('student_id');
			 $datas['result']=$this->adminattendancemodel->get_leave_dates($student_id,$month_id,$year_id);
			 echo json_encode($datas['result']);
		 }
		 else{
				redirect('/');
		 }
		}

		public function monthview(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 $datas['res']=$this->teacherattendencemodel->get_teacher_id($user_id);
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/attendence/monthview',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}

















}
