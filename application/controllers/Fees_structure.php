<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees_structure extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('fees_structuremodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('yearsmodel');
		  $this->load->model('classmodel');
		  $this->load->model('sectionmodel');
		  $this->load->model('class_manage');
		  
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['result'] = $this->fees_structuremodel->getall_quota_list();
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/add_quota',$datas);
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
		
		$quota_name=$this->input->post('quota_name');
		$status=$this->input->post('status');
		
		$datas=$this->fees_structuremodel->create_quota_list($quota_name,$status,$user_id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('fees_structure/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('fees_structure/home');
		}
		
	}

	public function edit_quota($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
         
        $datas['edit']=$this->fees_structuremodel->edit_quota_list($id);
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/edit_quota',$datas);
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
		
		$quota_name=$this->input->post('quota_name');
		$status=$this->input->post('status');
		$id=$this->input->post('id');
		
		$datas=$this->fees_structuremodel->update_quota_list($quota_name,$status,$user_id,$id);
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('fees_structure/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('fees_structure/home');
		}
	}
	
	public function fees_master()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['years']=$this->fees_structuremodel->get_current_years();
		$datas['terms']=$this->fees_structuremodel->get_terms();
		$datas['getall_class']=$this->class_manage->getall_class();
		$datas['class'] = $this->classmodel->getclass();
		$datas['quota'] = $this->fees_structuremodel->get_all_quota();
		
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/fees_master',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	public function get_all_section()
	{
		 $classid = $this->input->post('clsid');
		//echo $classid;exit;
		 $data['res']=$this->fees_structuremodel->get_section($classid);
		 echo json_encode( $data['res']);
	}
	
	public function create_fees_structure()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		  {
			 $year_id=$this->input->post('year_id');
			 $terms=$this->input->post('terms');
			 $class_id=$this->input->post('class_id');
			 $fees_amount=$this->input->post('fees_amount');
			 $quota_name=$this->input->post('quota_name');
			 
			 $date_from=$this->input->post('due_date_from');
			 $duedate=new DateTime($date_from);
             $due_date_from=date_format($duedate,'Y-m-d' );
			 
			 
			 
			 $date_to=$this->input->post('due_date_to');
			 $duedateto=new DateTime($date_to);
             $due_date_to=date_format($duedateto,'Y-m-d' );
			 
			// echo $due_date_from;echo $due_date_to;exit;
			 
			 $notes=$this->input->post('notes');
			 $status=$this->input->post('status');
			 
			 $datas['result']=$this->fees_structuremodel->add_fees_details($year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id);
			 
			 //print_r($datas['result']);exit;
			 
			 if($datas['status']=="success")
		     {
				$this->session->set_flashdata('msg','Added Successfully');
				redirect('fees_structure/fees_master');
		     }else{
				$this->session->set_flashdata('msg','Faild To Add');
				redirect('fees_structure/fees_master');
		       }
			 
		  }
	}
	
	
	public function view_fees_master()
	{
		
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$datas['view'] = $this->fees_structuremodel->view_fees_master_details();
		
		//echo '<pre>';
		//print_r($datas['view']);exit;
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/fees_master_view',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
			 
	}
	 public function edit_fees_master_status($id)
	 {
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$datas['edit'] = $this->fees_structuremodel->edit_fees_master_status($id);
		$datas['terms']=$this->fees_structuremodel->get_terms();
		$datas['quota'] = $this->fees_structuremodel->get_all_quota();
		//echo '<pre>';
		//print_r($datas['edit']);exit;
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/edit_fees_master',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	 }
	 
	 public function update_fees_master()
	 {
		 
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		  {
			 $id=$this->input->post('id');
			 $year_id=$this->input->post('year_id');
			 $terms=$this->input->post('terms');
			 $class_id=$this->input->post('class_id');
			 $fees_amount=$this->input->post('fees_amount');
			 $quota_name=$this->input->post('quota_name');
			 
			 $date_from=$this->input->post('due_date_from');
			 $duedate=new DateTime($date_from);
             $due_date_from=date_format($duedate,'Y-m-d' );
			 
			 
			 
			 $date_to=$this->input->post('due_date_to');
			 $duedateto=new DateTime($date_to);
             $due_date_to=date_format($duedateto,'Y-m-d' );
			 
			// echo $due_date_from;echo $due_date_to;exit;
			 
			 $notes=$this->input->post('notes');
			 $status=$this->input->post('status');
			 
			 $datas=$this->fees_structuremodel->update_fees_details($id,$year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id);
			 //print_r($datas);exit;
			 if($datas['status']=="success")
		     {
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('fees_structure/view_fees_master');
		     }else{
				$this->session->set_flashdata('msg','Faild To Update');
				redirect('fees_structure/view_fees_master');
		       }
			 
		  }
		  
	 }



















	
 }		
?>