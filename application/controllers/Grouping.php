<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grouping extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('groupingmodel');
			$this->load->model('teachermodel');
			$this->load->model('classmodel');
			$this->load->model('smsmodel');
			$this->load->model('mailmodel');
			$this->load->model('notificationmodel');
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
			$datas['list_of_teacher'] = $this->groupingmodel->get_all_teacher();
			$datas['list_of_grouping']=$this->groupingmodel->get_all_grouping();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('grouping/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}

		public function send(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$datas['list_of_grouping']=$this->groupingmodel->get_all_grouping();
		$datas['get_board_members']=$this->groupingmodel->get_board_members();
		$user_type=$this->session->userdata('user_type');
		if($user_type==1){
		 $this->load->view('header');
		 $this->load->view('grouping/send',$datas);
		 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
	}


	public function send_msg(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1){
			$group_id=$this->input->post('group_id');
			$members_id=$this->input->post('members_id');
			$notes=$this->db->escape_str($this->input->post('notes'));
			$circular_type=$this->db->escape_str($this->input->post('circular_type'));

			 $cir=implode(',',$circular_type);
			 $cir_cnt=count($circular_type);


				if($cir_cnt==1){
				 $ct1=$circular_type[0];
				 }
				 if($cir_cnt==2){
				 $ct1=$circular_type[0];
				 $ct2=$circular_type[1];
				 }
				 if($cir_cnt==3){
				 $ct0=$circular_type[0];
				 $ct1=$circular_type[1];
				 $ct2=$circular_type[2];
					}
					if($cir_cnt==3)
				 {
					 $data=$this->smsmodel->send_msg($group_id,$notes,$user_id,$members_id);
					 $data=$this->notificationmodel->send_notification($group_id,$notes,$user_id,$members_id);
					 $data=$this->mailmodel->send_mail($group_id,$notes,$user_id,$members_id);
				 }
			 if($cir_cnt==2)  {
		 		  $ct1=$circular_type[0];
		 	    $ct2=$circular_type[1];

		 		  if($ct1=='SMS' && $ct2=='Mail')
		 		  {
					 $data=$this->smsmodel->send_msg($group_id,$notes,$user_id,$members_id);
 					 $data=$this->mailmodel->send_mail($group_id,$notes,$user_id,$members_id);
		 		  }
		 		  if($ct1=='SMS' && $ct2=='Notification')
		 		  {
					 $data=$this->smsmodel->send_msg($group_id,$notes,$user_id,$members_id);
 					 $data=$this->notificationmodel->send_notification($group_id,$notes,$user_id,$members_id);
		 		  }
		 		  if($ct1=='Mail' && $ct2=='Notification')
		 		  {

 					 $data=$this->notificationmodel->send_notification($group_id,$notes,$user_id,$members_id);
 					 $data=$this->mailmodel->send_mail($group_id,$notes,$user_id,$members_id);
		 		  }

		 	  }
			 if($cir_cnt==1) {
				  $ct=$circular_type[0];
				  if($ct=='SMS')
				  {
						$data=$this->smsmodel->send_msg($group_id,$notes,$user_id,$members_id);

				  }
				  if($ct=='Notification')
				  {
						 $data=$this->notificationmodel->send_notification($group_id,$notes,$user_id,$members_id);
				  }
				  if($ct=='Mail')
				  {
						$data=$this->mailmodel->send_mail($group_id,$notes,$user_id,$members_id);
				  }
			  }

				$datas=$this->groupingmodel->save_group_history($group_id,$cir,$notes,$user_id,$members_id);

				if($datas['status']=="success"){
					echo "success";
				}else if($datas['status']=="Already"){
					echo "Already Exist";
				}else{
					echo "Something Went Wrong";
				}


		}else{
				redirect('/');
		}
	}

		public function create_group(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$group_title=$this->input->post('group_title');
				$group_lead=$this->input->post('group_lead');
				$status=$this->input->post('status');
				$data=$this->groupingmodel->create_group($group_title,$group_lead,$status,$user_id);
				if($data['status']=="success"){
					echo "success";
				}else if($data['status']=="Already"){
					echo "Already Exist";
				}else{
					echo "Something Went Wrong";
				}
			}else{
					redirect('/');
			}
		}


		public function save_group(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$group_title=$this->input->post('group_title');
				$group_lead=$this->input->post('group_lead_id');
				$status=$this->input->post('status');
				$id=$this->input->post('id');
				$data=$this->groupingmodel->save_group($group_title,$group_lead,$status,$user_id,$id);
				if($data['status']=="success"){
					echo "success";
				}else if($data['status']=="Already"){
					echo "Already Exist";
				}else{
					echo "Something Went Wrong";
				}
			}else{
					redirect('/');
			}
		}


		public function deleteing_member(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 $del_id=$this->input->post('del_id');
				 $data=$this->groupingmodel->delete_member($del_id);
				 if($data['status']=="success"){
 					echo "success";
 				}else{
 					echo "Something Went Wrong";
 				}
			}else{
					redirect('/');
			}
		}

		public function edit_group($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['res']=$this->groupingmodel->get_group_id($id);
				$datas['list_of_teacher'] = $this->groupingmodel->get_all_teacher();
				$this->load->view('header');
				$this->load->view('grouping/edit_group',$datas);
				$this->load->view('footer');
			}else{
					redirect('/');
			}
		}


		public function view_members($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['res']=$this->groupingmodel->view_members_in_groups($id);
				$datas['res_group_name']=$this->groupingmodel->get_group_name($id);
				$datas['res_class']=$this->groupingmodel->get_all_classes_for_year();
				//print_r($datas['res']);exit;
				$datas['id']=$id;
				$this->load->view('header');
				$this->load->view('grouping/view_members',$datas);
				$this->load->view('footer');

			}else{
					redirect('/');
			}
}


	public function getListstudent(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1){
			$class_master_id=$this->input->post('class_master_id');
			$data['res']=$this->groupingmodel->getListstudent($class_master_id);
			echo json_encode($data['res']);
		}else{
				redirect('/');
		}
	}


		public function adding_members_to_group(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$members_id=$this->input->post('members_id');
				$group_id=$this->input->post('group_id');
				$status=$this->input->post('status');
				$data=$this->groupingmodel->adding_members_to_group($members_id,$group_id,$status,$user_id);
				if($data['status']=="success"){
					echo "success";
				}else if($data['status']=="already"){
					echo "Already Exist";
				}else{
					echo "Something Went Wrong";
				}
			}else{
					redirect('/');
			}
		}


		public function message_history(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['list_of_message']=$this->groupingmodel->get_message_history();
				$this->load->view('header');
				$this->load->view('grouping/message_history',$datas);
				$this->load->view('footer');

			}else{
					redirect('/');
			}
		}




}
