<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userleavemaster extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('userleavemastermodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['result'] = $this->userleavemastermodel->getall_leave_list();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('userleave/add_user_leave',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	public function create_leave()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$leave_name=$this->input->post('leave_name');
		$leave_type=$this->input->post('leave_type');
		$status=$this->input->post('status');
		
		$datas=$this->userleavemastermodel->create_leave($leave_name,$leave_type,$status,$user_id);
		if($datas['status']=="success"){
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('userleavemaster/home');
		}else if($datas['status']=="Name Already Exist"){
			$this->session->set_flashdata('msg','Name Already Exist');
			redirect('userleavemaster/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('userleavemaster/home');
		}
		
	}

	public function edit_leave($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
        $datas['edit']=$this->userleavemastermodel->edit_leave_list($id);
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('userleave/edit_user_leave',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_leave()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$leave_name=$this->input->post('leave_name');
		$leave_type=$this->input->post('leave_type');
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->userleavemastermodel->update_leave_list($leave_name,$leave_type,$status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('userleavemaster/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('userleavemaster/home');
		}
	}  
 }
	?>