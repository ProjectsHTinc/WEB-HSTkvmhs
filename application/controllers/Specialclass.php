<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specialclass extends CI_Controller
 {


	function __construct()
	  {
		  parent::__construct();
		  $this->load->model('specialclassmodel');
		  $this->load->model('subjectmodel');
          $this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');
      }   
		
    public function home()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['teacher']=$this->specialclassmodel->get_teachers();
            $datas['getall_class']=$this->class_manage->getall_class();
			$datas['result'] = $this->specialclassmodel->getall_details();
			//echo'<pre>';print_r($datas['result']);exit;
			$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('specialclass/add_special_cls',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}
	
	public function checker()
               {
					 $classid = $this->input->post('classid');
					//echo $classid;exit;
					 $data=$this->specialclassmodel->get_subject($classid);
					 echo json_encode($data);
               }
	
	public function add_special_cls()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$class_name=$this->input->post('class_name');
		$teacher=$this->input->post('teacher');
		$subject_name=$this->input->post('subject_name');
		$sub_topic=$this->db->escape_str($this->input->post('sub_topic'));
		//echo $sub_topic;
		$special_date=$this->input->post('spe_date');
		 $dateTime = new DateTime($special_date);
         $spe_date=date_format($dateTime,'Y-m-d' );
		
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$status=$this->input->post('status');
		
		$datas=$this->specialclassmodel->create_special_class($class_name,$teacher,$subject_name,$sub_topic,$spe_date,$stime,$etime,$status,$user_id);
		if($datas['status']=="success"){
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('specialclass/home');
		}else if($datas['status']=="Already Exist"){
			$this->session->set_flashdata('msg','Already Exist');
			redirect('specialclass/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('specialclass/home');
		}
		
	}

	public function edit_specls($id)
	{
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
         
        $datas['edit']=$this->specialclassmodel->edit_special_class($id);
		$datas['teacher']=$this->specialclassmodel->get_teachers();
        $datas['getall_class']=$this->class_manage->getall_class();
		//echo '<pre>';print_r($datas['edit']);exit;
        if($user_type==1)
			 {
				 $this->load->view('header');
				 $this->load->view('specialclass/edit_special_cls',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
	}

	public function update_special_cls()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$class_name=$this->input->post('class_name');
		$teacher=$this->input->post('teacher');
		$subject_name=$this->input->post('subject_name');
		$sub_topic=$this->db->escape_str($this->input->post('sub_topic'));
		//echo $subject_name; exit;
		$special_date=$this->input->post('spe_date');
		$dateTime = new DateTime($special_date);
        $spe_date=date_format($dateTime,'Y-m-d' );
		$specls_id=$this->input->post('id');
		
		$stime=$this->input->post('stime');
		$etime=$this->input->post('etime');
		$status=$this->input->post('status');
		
		$datas=$this->specialclassmodel->update($class_name,$teacher,$subject_name,$sub_topic,$spe_date,$stime,$etime,$status,$user_id,$specls_id);
		//print_r($datas);exit;
		
		if($datas['status']=="success")
		{
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('specialclass/home');
		}else if($datas['status']=="Already Exist"){
			$this->session->set_flashdata('msg','Already Exist');
			redirect('specialclass/home');
		}else{
			$this->session->set_flashdata('msg','Faild To Update');
			redirect('specialclass/home');
		}
	}
 }
	?>