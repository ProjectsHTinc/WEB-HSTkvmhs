<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends CI_Controller
 {


	function __construct()
	{
		 parent::__construct();
		
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('homeworkmodel');
		  $this->load->model('class_manage');
		  $this->load->model('subjectmodel');
		  $this->load->model('smsmodel');
		  $this->load->model('mailmodel');
		  $this->load->model('notificationmodel');
		  
        }
         
	public function home()
	 {
	 		 $datas=$this->session->userdata();
  	 		 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==2){
			 //$datas=$this->homeworkmodel->get_teacher_id($user_id);
			 $datas['cls_sec']=$this->homeworkmodel->get_teacher_class_sec($user_id,$user_type);
			 $datas['cls_tutor']=$this->homeworkmodel->get_cls_tutor($user_id,$user_type);
			 $datas['result']=$this->homeworkmodel->getall_details($user_id,$user_type);
			 $datas['ayear']=$this->homeworkmodel->get_acdaemicyear();
			 //echo'<pre>';print_r($datas['cls_tutor']);exit;
	 		 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/add',$datas);
	 		 $this->load->view('adminteacher/teacher_footer');
	 		 }
	 		 else{
	 		  redirect('/');
	 		 }
	 	}
		
		public function add_mark($hw_id)
		{
			  
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result'] = $this->homeworkmodel->get_stu_details($hw_id,$user_id,$user_type);
				//echo'<pre>';print_r($datas['result']);exit;
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/add_test',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
			
		} 
		
	  public function marks()
		{
			$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$enroll=$this->input->post('enroll');
			$hwid=$this->input->post('hwid');
			$marks=$this->input->post('marks');
			//print_r($enroll);exit;
			$remarks=$this->db->escape_str($this->input->post('remarks'));
			$datas = $this->homeworkmodel->enter_marks($enroll,$hwid,$marks,$remarks,$user_id,$user_type);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Added');
                redirect('homework/home',$datas);	  
			  }
			
			
			
		}
	 public function create()
		{ 
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			//echo $user_id;exit;
			$test_type=$this->input->post('test_type');
			
			//echo $test_type;
			//exit;
			
			$year_id=$this->input->post('year_id');
			
			$class_id=$this->input->post('class_id');
			$title=$this->db->escape_str($this->input->post('title'));
			$subject_name=$this->input->post('subject_name');
			//echo $subject_name;exit;
			$tet_date=$this->input->post('tet_date');
			
			$dateTime = new DateTime($tet_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );
             
            $submission_date=$this->input->post('sub_date');
			$dateTime = new DateTime($submission_date);
			$format_date=date_format($dateTime,'Y-m-d' );
			
			$details=$this->db->escape_str($this->input->post('details'));
		    $datas=$this->homeworkmodel->create_test($year_id,$class_id,$user_id,$user_type,$test_type,$title,$subject_name,$formatted_date,$format_date,$details); 
			//echo'<pre>';print_r($datas["res"]);
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Added Successfully');
                redirect('homework/home',$datas);
			   //redirect('add_test');		
			}else if($datas['status']=="Already Exist"){
				$this->session->set_flashdata('msg','Test Date Already Exist');
                redirect('homework/home',$datas);
			}else{
				$this->session->set_flashdata('msg','Falid To Added');
                redirect('homework/home',$datas);
			}
	 		 
	 	} 
		//----2---------
		public function checker()
		{
			$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$classid=$this->input->post('id');
		    $data=$this->homeworkmodel->get_subject($classid,$user_id,$user_type);
			//print_r($data['res']);exit;
			echo json_encode($data);
		}
		
		
		public function edit_mark($hw_id)
		{
			    $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result']=$this->homeworkmodel->edit_details($hw_id,$user_id,$user_type);
				//echo'<pre>';print_r($datas['result']);exit;
				$datas['resubject'] = $this->subjectmodel->getsubject();
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/edit_marks',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
		}
	
       public function update()
	   {
		    $datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
		    $enroll=$this->input->post('enroll');
			$hwid=$this->input->post('hwid');
			$marks=$this->input->post('marks');
			//print_r($enroll);exit;
			$remarks=$this->db->escape_str($this->input->post('remarks'));
			$datas = $this->homeworkmodel->update_marks($enroll,$hwid,$marks,$remarks,$user_id,$user_type);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Update Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Update');
                redirect('homework/home',$datas);	  
			  }
			
		   
	   }
	   
	   public function edit_test($hw_id)
	   {
		        $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result']=$this->homeworkmodel->edit_test_details($hw_id,$user_id,$user_type);
				
				//echo'<pre>';print_r($datas['result']);exit;
				
			    if($user_type==2)
			      {
					 $this->load->view('adminteacher/teacher_header');
					 $this->load->view('adminteacher/homework/edit_test',$datas);
					 $this->load->view('adminteacher/teacher_footer');
				  }
	 		   else{
	 				redirect('/');
	 		 }
	   }
	   
	   public function update_test()
	   {
		        $datas=$this->session->userdata();
  	 		    $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type'); 
				
		    $test_details=$this->db->escape_str($this->input->post('test_details'));
		    $id=$this->input->post('id');
		    $hw_type=$this->input->post('hw_type');
			$title=$this->db->escape_str($this->input->post('title'));
			
			$test_date=$this->input->post('test_date');
			$dateTime = new DateTime($test_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );
			
			$submission_date=$this->input->post('sub_date');
			$dateTime = new DateTime($submission_date);
			$format_date=date_format($dateTime,'Y-m-d' );
			
			$status=$this->input->post('status');
			
			$datas= $this->homeworkmodel->update_test_details($id,$hw_type,$title,$formatted_date,$format_date,$test_details,$status,$user_id,$user_type);
			  if($datas['status']=="success")
			  {
				$this->session->set_flashdata('msg','Update Successfully');
                redirect('homework/home',$datas);  
			  }else{
			   $this->session->set_flashdata('msg','Falid To Update');
                redirect('homework/home',$datas);	  
			  }
	   }
	   
	   //SMS
	   public function get_all_homework($cls_tutor_id)
	   { 
		   $datas=$this->session->userdata();
  	 	   $user_id=$this->session->userdata('user_id');
		   $user_type=$this->session->userdata('user_type');
		  
		   $datas['tutor_homework']=$this->homeworkmodel->get_all_ctutor_homework($user_id,$cls_tutor_id);
           //echo'<pre>';print_r($datas['tutor_homework']);exit;
		   if($user_type==2)
		   {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/send_sms',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		   }else{
	 		  redirect('/');
	 		 }
	   }
	   
	   public function send_sms_all_homework()
	   {
		   $datas=$this->session->userdata();
  	 	   $user_id=$this->session->userdata('user_id');
		   $user_type=$this->session->userdata('user_type');
		   if($user_type==2)
		  {
					  
		   $createdate=$this->input->post('tdate');
		   $clssid=$this->input->post('clsid');
		   $sendtype=$this->input->post('sendoption');
		   $acount=count($sendtype); 
		   
		   $datas['send_status']=$this->homeworkmodel->send_homework_status($user_id,$createdate,$clssid);
		   
		 if($acount==3)
		 {
		   $datas=$this->smsmodel->send_sms_homework($user_id,$user_type,$createdate,$clssid);
		   $datas=$this->mailmodel->send_mail_homework($user_id,$user_type,$createdate,$clssid);
		   $datas=$this->notificationmodel->send_notify_homework($user_id,$user_type,$createdate,$clssid);
		 }
		 
		 if($acount==2)
	    {
		  $ct1=$sendtype[0];
	      $ct2=$sendtype[1];
		 
		   if($ct1=='SMS' && $ct2=='Mail')
		  {
			$datas=$this->smsmodel->send_sms_homework($user_id,$user_type,$createdate,$clssid);
		    $datas=$this->mailmodel->send_mail_homework($user_id,$user_type,$createdate,$clssid);
		  }
		  if($ct1=='SMS' && $ct2=='Notification')
		  {
			$datas=$this->smsmodel->send_sms_homework($user_id,$user_type,$createdate,$clssid);
		    $datas=$this->notificationmodel->send_notify_homework($user_id,$user_type,$createdate,$clssid);
		  }
		  if($ct1=='Mail' && $ct2=='Notification')
		  {
			 $datas=$this->mailmodel->send_mail_homework($user_id,$user_type,$createdate,$clssid); 
			 $datas=$this->notificationmodel->send_notify_homework($user_id,$user_type,$createdate,$clssid);   
		  } 
	  }
	  
	  if($acount==1)
	  {
		  $ct=$sendtype[0];
		  if($ct=='SMS')
		  {
			 $datas=$this->smsmodel->send_sms_homework($user_id,$user_type,$createdate,$clssid);
		  }
		  if($ct=='Notification')
		  { 
			 $datas=$this->notificationmodel->send_notify_homework($user_id,$user_type,$createdate,$clssid); 
		  }
		  if($ct=='Mail')
		  {
			 $datas=$this->mailmodel->send_mail_homework($user_id,$user_type,$createdate,$clssid);
		  }
	  }
	  if($datas['status']=="success")
	  { 
	    echo "success";
	  }else{
         echo "Something went wrong!";
      }
		  }else{
             redirect('/');
			 }
	   }
	   
	   
	   public function view_send_all_homework($tdate,$cid)
	   {
		  
		   $datas=$this->session->userdata();
		   $user_id=$this->session->userdata('user_id');
		   $user_type=$this->session->userdata('user_type');
		   $datas['view_all']=$this->homeworkmodel->view_send_homework_all($user_id,$tdate,$cid); 
		   if($user_type==2)
		   {
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/homework/view_send_all_hw',$datas);
			 $this->load->view('adminteacher/teacher_footer');
		   }else{
	 		  redirect('/');
	 		 }
	   }
	

	
	
 }