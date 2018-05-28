<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentprofile extends CI_Controller {


	function __construct() {
		 parent::__construct();
		 $this->load->model('parentprofilemodel');
		 $this->load->model('subjectmodel');
		 $this->load->model('class_manage');
		 $this->load->helper('url');
		 $this->load->library('session');


 }
	public function home(){}

	public function profile_edit()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		//echo $user_id;exit;
		$datas['result'] = $this->parentprofilemodel->getuser($user_id);
        //echo'<pre>';print_r($datas['result']);exit;
		if($user_type==1 || $user_type==2 || $user_type==3 ||$user_type==4 ){
		$this->load->view('adminparent/parent_header',$datas);
		$this->load->view('adminparent/profile_update',$datas);
		$this->load->view('adminparent/parent_footer');
		}
		else{
			 redirect('/');
		}
}

  public function update_parents()
	{
	 $datas=$this->session->userdata();
	 $user_id=$this->session->userdata('user_id');
	 $user_type=$this->session->userdata('user_type');
	 if($user_type==4)
	 {
		$user_id=$this->session->userdata('user_id');
		$parent_id=$this->input->post('parent_id');
		$student=$this->input->post('student');
		$old_pic=$this->input->post('old_pic');

	   $parents_pic = $_FILES["user_pic"]["name"];
		$temp = pathinfo($parents_pic, PATHINFO_EXTENSION);
		$userFileName = round(microtime(true)) . '.' . $temp;
	    $uploaddir = 'assets/parents/profile/';
		$profilepic = $uploaddir.$userFileName;
		move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
      if(empty($parents_pic)){
         $userFileName=$old_pic;
      }

	$datas=$this->parentprofilemodel->update_parents($user_id,$user_type,$parent_id,$student,$userFileName);
		if($datas['status']=="success"){
			$this->session->set_flashdata('msg', 'Updated Successfully');
			redirect('parentprofile/profile_edit');
		}else if($datas['status']=="Email Already Exist"){
			$this->session->set_flashdata('msg', 'Email Already Exist');
			redirect('parentprofile/profile_edit');
		}else{
			$this->session->set_flashdata('msg', 'Failed to Add');
			redirect('parentprofile/profile_edit');
		}
	 }
	 else{
			redirect('/');
	 }
	}


	public function pwd_edit()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->parentprofilemodel->get_parentuser($user_id);
		 //print_r($datas['result']);exit;
		 $user_type=$this->session->userdata('user_type');
			// echo $user_type;exit;
			 if($user_type==4){
				$this->load->view('adminparent/parent_header',$datas);
		        $this->load->view('adminparent/resetpassword',$datas);
		        $this->load->view('adminparent/parent_footer');
				}
				else{
					 redirect('/');
				}
        }

  public function updatepwd()
  {
	    $datas=$this->session->userdata();
		$user_name=$this->session->userdata('user_name');
		$user_type=$this->session->userdata('user_type');
	 	if($user_type==4)
		{
		 		    $user_id=$this->input->post('user_id');
				//echo $user_id;exit;

						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));
						$user_password_old=$this->input->post('user_password_old');

						$res=$this->parentprofilemodel->updateprofilepwd($user_id,$oldpassword,$newpassword);

                    //print_r($res);exit;
					if($res['status']=="success"){
					 $this->session->set_flashdata('msg', 'Update Successfully');
					  redirect('parentprofile/pwd_edit');

					  }else{
							$this->session->set_flashdata('msg', 'Failed to update');
							 redirect('parentprofile/pwd_edit');
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
