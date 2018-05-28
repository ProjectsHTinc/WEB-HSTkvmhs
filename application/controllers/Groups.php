<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('groupsmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$datas['result'] = $this->groupsmodel->getall_groups_list();
		$user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		 {
			 $this->load->view('header');
			 $this->load->view('groups/add_groups',$datas);
			 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
	 }
	
	 public function create_groups()
	  {
			$datas=$this->session->userdata();
		    $user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$groups_name=$this->db->escape_str($this->input->post('groups_name'));
			$status=$this->input->post('status');
			
			$datas=$this->groupsmodel->create_group_list($groups_name,$status,$user_id);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg','Added Successfully');
				redirect('groups/home');
			}if($datas['status']=="Name Already Exist"){
				$this->session->set_flashdata('msg','Name Already Exist');
				redirect('groups/home');
			}else{
				$this->session->set_flashdata('msg','Faild To Add');
				redirect('groups/home');
			}
		
	  }

	public function edit_group($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
         
        $datas['edit']=$this->groupsmodel->edit_groups_list($id);
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('groups/edit_groups',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_groups()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$groups_name=$this->db->escape_str($this->input->post('groups_name'));
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->groupsmodel->update_groups_list($groups_name,$status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('groups/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('groups/home');
		}
	} 
 }
	?>