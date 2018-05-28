<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onduty extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('ondutymodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
		
	 }
	
	//------------------------------------On Duty Teacher--------------------------
	 public function teachers()
	  {
			$datas=$this->session->userdata();
		    $user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->ondutymodel->get_teacher_onduty_details();
			//echo '<pre>';print_r($datas['result']);exit;
		    if($user_type==1)
			{
			 $this->load->view('header');
			 $this->load->view('onduty/onduty_teacher',$datas);
			 $this->load->view('footer');
			}else{
			  redirect('/');
			 }
		
	  }

	public function edit_teacher_onduty($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
        $datas['edit']=$this->ondutymodel->edit_teacher($id);
		//echo '<pre>';print_r($datas['edit']);exit;
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('onduty/edit_teacher_onduty',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_onduty()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->ondutymodel->update_teacher_onduty($status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('onduty/teachers');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('onduty/teachers');
		}
	} 
	
	
	//----------------------------Student Onduty---------------------------------
	
	public function students()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result']=$this->ondutymodel->get_student_onduty_details();
		//echo '<pre>';print_r($datas['result']);exit;
		if($user_type==1)
		{
		 $this->load->view('header');
		 $this->load->view('onduty/onduty_student',$datas);
		 $this->load->view('footer');
		}else{
		  redirect('/');
		 }
	}
	
	public function edit_student_onduty($id)
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
        $datas['edit']=$this->ondutymodel->edit_student($id);
		//echo '<pre>';print_r($datas['edit']);exit;
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('onduty/edit_studentr_onduty',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	
	public function update_stuonduty()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->ondutymodel->update_student_onduty($status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('onduty/students');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('onduty/students');
		}
	} 
	
 }
	?>