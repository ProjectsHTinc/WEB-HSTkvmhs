<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extracurricular extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('extracurricularmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['result'] = $this->extracurricularmodel->getall_activities_list();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('extracurricular/add_extracurricular',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	  public function create_extracurricular()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$ext_name=$this->db->escape_str($this->input->post('ext_name'));
		$status=$this->input->post('status');
		
		$datas=$this->extracurricularmodel->create($ext_name,$status,$user_id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('extracurricular/home');
		}else if($datas['status']=="Name Already Exist"){
			$this->session->set_flashdata('msg','Name Already Exist');
			redirect('extracurricular/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('extracurricular/home');
		}
		
	}

	public function edit_activities($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
         
        $datas['edit']=$this->extracurricularmodel->edit_activities($id);
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('extracurricular/edit_extracurricular',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_activities()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$ext_name=$this->db->escape_str($this->input->post('ext_name'));
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->extracurricularmodel->update_activities_list($ext_name,$status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('extracurricular/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('extracurricular/home');
		}
	}  
 }
	?>