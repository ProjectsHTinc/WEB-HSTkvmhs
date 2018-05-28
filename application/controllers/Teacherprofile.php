<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		 $this->load->model('teacherprofilemodel');
		 $this->load->model('subjectmodel');
		 $this->load->model('class_manage');
		 $this->load->model('smsmodel');
		 $this->load->model('mailmodel');
		 $this->load->model('groupingmodel');
		 $this->load->model('notificationmodel');
		 $this->load->helper('url');
		 $this->load->library('session');

 }


	public function profilepic()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $datas['result'] = $this->teacherprofilemodel->getuser($user_id);
           //print_r($datas['result']);exit;
		 $datas['resubject'] = $this->subjectmodel->getsubject();
		 $datas['getall_class']=$this->class_manage->getall_class();
		 $datas['groups']=$this->teacherprofilemodel->get_all_groups_details();
		 $datas['activities']=$this->teacherprofilemodel->get_all_activities_details();
		if($user_type==2){
		$this->load->view('adminteacher/teacher_header',$datas);
		$this->load->view('adminteacher/profile_update',$datas);
		$this->load->view('adminteacher/teacher_footer');
		}
		else{
			 redirect('/');
		}
}


	public function grouping(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==2){
			$datas['list_of_grouping']=$this->teacherprofilemodel->get_groups_for_teacher($user_id);
				$datas['get_board_members']=$this->groupingmodel->get_board_members();
			$this->load->view('adminteacher/teacher_header',$datas);
			$this->load->view('adminteacher/communication/send_msg',$datas);
			$this->load->view('adminteacher/teacher_footer');
		}else{
			 redirect('/');
		}
	}


	public function message_history(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==2){
			$datas['list_of_message']=$this->teacherprofilemodel->get_message_history($user_id);
			$this->load->view('adminteacher/teacher_header',$datas);
			$this->load->view('adminteacher/communication/message_history',$datas);
			$this->load->view('adminteacher/teacher_footer');
		}else{
			 redirect('/');
		}
	}
	public function send_msg(){
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==2){
			$group_id=$this->input->post('group_id');
			$members_id=$this->input->post('members_id');
			 $notes=$this->input->post('notes');
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
					 $data=$this->smsmodel->send_msg($group_id,$notes,$user_id);
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
				$data=$this->groupingmodel->save_group_history($group_id,$cir,$notes,$user_id,$members_id);
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






	public function profileupdate(){
			$datas=$this->session->userdata();
			$user_name=$this->session->userdata('user_name');
			$user_type=$this->session->userdata('user_type');
		 	if($user_type==2)
			{
		      $user_id=$this->input->post('user_id');
	         //echo $user_id;exit;
				//$teachername=$this->input->post('name');
				$user_pic_old=$this->input->post('user_pic_old');
		      $teacher_pic = $_FILES["user_pic"]["name"];
		      $temp = pathinfo($teacher_pic, PATHINFO_EXTENSION);
		      $userFileName = round(microtime(true)) . '.' . $temp;
		      //$userFileName =time();
		      $uploaddir = 'assets/teachers/profile/';
			   $profilepic = $uploaddir.$userFileName;
			   move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
			   if(empty($teacher_pic))
			   {
			    $userFileName=$user_pic_old;
		       }
			$res=$this->teacherprofilemodel->teacherprofileupdate($user_id,$userFileName);
				if($res['status']=="success"){
					$this->session->set_flashdata('msg', 'Update Successfully');
					 redirect('teacherprofile/profilepic');
				    }else{
					 $this->session->set_flashdata('msg', 'Failed to update');
					  redirect('teacherprofile/profilepic');
				  }
		 }
	}


	public function profile()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->teacherprofilemodel->get_teacheruser($user_id);
		 $user_type=$this->session->userdata('user_type');
			// echo $user_type;exit;
			 if($user_type==2){
				$this->load->view('adminteacher/teacher_header');
		        $this->load->view('adminteacher/resetpassword',$datas);
		        $this->load->view('adminteacher/teacher_footer');
				}
				else{
					 redirect('/');
				}
        }



  public function updateprofile()
  {
	    $datas=$this->session->userdata();
		$user_name=$this->session->userdata('user_name');
		$user_type=$this->session->userdata('user_type');
	 	if($user_type==2)
		{
		 		$user_id=$this->input->post('user_id');
				//echo $user_id;exit;

						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));

						 $user_password_old=$this->input->post('user_password_old');

						$res=$this->teacherprofilemodel->updateprofile($user_id,$oldpassword,$newpassword);

						if($res['status']=="success"){
						 $this->session->set_flashdata('msg', 'Update Successfully');
						  redirect('teacherprofile/profile');

					      }else{
					 	        $this->session->set_flashdata('msg', 'Failed to update');
								 redirect('teacherprofile/profile');
					          }

	 }
	 else{
			redirect('/');
	 }
  }

	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('/');
	}






}
