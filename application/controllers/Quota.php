<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quota extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('quotamodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['result'] = $this->quotamodel->getall_quota_list();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('quota/add_quota',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	public function create_quota()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$quota_name=$this->db->escape_str($this->input->post('quota_name'));
		$status=$this->input->post('status');
		
		$datas=$this->quotamodel->create_quota_list($quota_name,$status,$user_id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('quota/home');
		}else if($datas['status']=="Name Already Exist"){
			$this->session->set_flashdata('msg','Name Already Exist');
			redirect('quota/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('quota/home');
		}
		
	}

	public function edit_quota($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
         
        $datas['edit']=$this->quotamodel->edit_quota_list($id);
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('quota/edit_quota',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_quota()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$quota_name=$this->db->escape_str($this->input->post('quota_name'));
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->quotamodel->update_quota_list($quota_name,$status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('quota/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('quota/home');
		}
	}
 }
	?>