<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feesstructure extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('feesstructuremodel');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('yearsmodel');
		  $this->load->model('classmodel');
		  $this->load->model('sectionmodel');
		  $this->load->model('class_manage');
		  
      }   
		
   
	
	public function fees_master()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['years']=$this->feesstructuremodel->get_current_years();
		$datas['terms']=$this->feesstructuremodel->get_terms();
		$datas['getall_class']=$this->class_manage->getall_class();
		$datas['class'] = $this->classmodel->getclass();
		$datas['enr_cls']=$this->feesstructuremodel->get_all_enr_cls();
		//echo"<pre>";print_r($datas['enr_cls']);exit;
		$datas['quota'] = $this->feesstructuremodel->get_all_quota();
		
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
		 $data['res']=$this->feesstructuremodel->get_section($classid);
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
			
			 $notes=$this->db->escape_str($this->input->post('notes'));
			 $status=$this->input->post('status');
			 $datas=$this->feesstructuremodel->add_fees_details($year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id);
			//print_r($datas);exit;
			 if($datas['status']=="success")
		     {
				$this->session->set_flashdata('msg','Added Successfully');
				redirect('feesstructure/view_fees_master');
		     }else if($datas['status']=="Date"){
				 $this->session->set_flashdata('msg','To Date Should Be Grater Than From Date');
				redirect('feesstructure/fees_master');
			 }else{
				$this->session->set_flashdata('msg','Faild To Add');
				redirect('feesstructure/fees_master');
		       }
			 
		  }
	}
	
	
	public function view_fees_master()
	{
		
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$datas['view'] = $this->feesstructuremodel->view_fees_master_details();
		//echo '<pre>';print_r($datas['view']);exit;
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
		
		$datas['edit'] = $this->feesstructuremodel->edit_fees_master_status($id);
		$datas['terms']=$this->feesstructuremodel->get_terms();
		$datas['quota'] = $this->feesstructuremodel->get_all_quota();
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
			 
			 $notes=$this->db->escape_str($this->input->post('notes'));
			 $status=$this->input->post('status');
			 
			 $datas=$this->feesstructuremodel->update_fees_details($id,$year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id);
			 //print_r($datas);exit;
			 if($datas['status']=="success")
		     {
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('feesstructure/view_fees_master');
		     }else{
				$this->session->set_flashdata('msg','Faild To Update');
				redirect('feesstructure/view_fees_master');
		       }
			 
		  }
		  
	 }
	 
	 //---------------------class fees status-------------------------------
	 
	public function view_term_fees_master()
	   {
		
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['view'] = $this->feesstructuremodel->view_fees_master_details();
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/term__fees_master_view',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
			 
	   }
	
	
	 //---------------------student fees status -----------------------------
	public function view_term_fees($id)
	  {
		
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['view'] = $this->feesstructuremodel->view_term_fees_status($id);
		//echo '<pre>';print_r($datas['view']);exit;
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/view_term_fees_status',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	 }
	 
	 public function edit_term_fees_status($id)
	  {
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$datas['edit'] = $this->feesstructuremodel->edit_term_fees_status($id);
		$datas['quota'] = $this->feesstructuremodel->get_all_quota();
		//echo '<pre>';print_r($datas['edit']);exit;
		if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('fees/edit_term_fees_status',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	  }
	 
	 public function update_term_fees_status()
	 {
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$fessid=$this->input->post('id');
	    $paid_status=$this->input->post('paid_status');
		$paid_by=$this->input->post('paid_by');
		
		$id=$this->input->post('fees_id');
		
		$datas=$this->feesstructuremodel->update_term_fees_status($fessid,$paid_status,$user_id,$paid_by);
		//print_r($datas);exit;
		if($datas['status']=="success")
		     {
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('feesstructure/view_term_fees/'.$id.'');
		     }else{
				$this->session->set_flashdata('msg','Faild To Update');
				redirect('feesstructure/view_term_fees/'.$id.'');
		       }
	 }



	
 }		
?>