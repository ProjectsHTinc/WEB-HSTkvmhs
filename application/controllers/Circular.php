<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Circular extends CI_Controller
{
      function __construct()
      {
      parent::__construct();
      $this->load->model('circularmodel');
      $this->load->model('subjectmodel');
      $this->load->model('class_manage');
	  $this->load->model('smsmodel');
	  $this->load->model('mailmodel');
	  $this->load->model('notificationmodel');
      $this->load->helper('url');
      $this->load->library('session');
      }
	  //-------------------------------Create Circular Master--------------------------
	  
	     public function create_circular_master()
          {
			  $datas=$this->session->userdata();
			  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  $datas['years']=$this->circularmodel->get_current_years();
			  $datas['result']=$this->circularmodel->get_all_result();
			  //echo'<pre>'; print_r($datas['result']);exit;
			  if($user_type==1)
			  {
			  $this->load->view('header');
			  $this->load->view('circular/create_circular_master',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
        }
		
		public function add_circular_master()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			
			$year_id=$this->input->post('year_id');
			$ctile=$this->db->escape_str($this->input->post('ctitle'));
			$cdescription=$this->db->escape_str($this->input->post('cdescription'));
	        $status=$this->input->post('status'); 
			
			  $datas=$this->circularmodel->create_circular_masters($year_id,$ctile,$cdescription,$status,$user_id);
			  //print_r($datas);exit;
			  if($datas['status']=="success")
			  {
			  $this->session->set_flashdata('msg', 'Added Successfully');
			  redirect('circular/create_circular_master');
			  }
			  else{
			  $this->session->set_flashdata('msg', 'Failed to Add');
			  redirect('circular/create_circular_master');
			  }
		}
	  
	  public function edit_circular_master($id)
	  {
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->circularmodel->edit_all_result($id);
			 //print_r($datas['result']);exit;
			  if($user_type==1)
			  {
			  $this->load->view('header');
			  $this->load->view('circular/edit_circular_master',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
	  }
	  
	  public function update_circular_master()
	  {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		
		$year_id=$this->input->post('year_id');
		$cid=$this->input->post('cid');
		
		$ctile=$this->db->escape_str($this->input->post('ctitle'));
		$cdescription=$this->db->escape_str($this->input->post('cdescription'));
		$status=$this->input->post('status'); 
		
		  $datas=$this->circularmodel->update_circular_masters($cid,$year_id,$ctile,$cdescription,$status,$user_id);
		  //print_r($datas);exit;
		  if($datas['status']=="success")
		  {
		  $this->session->set_flashdata('msg', 'Updated Successfully');
		  redirect('circular/create_circular_master');
		  }
		  else{
		  $this->session->set_flashdata('msg', 'Failed to Update');
		  redirect('circular/create_circular_master');
		  }
	  }
	  
	  
	  //-------------------------------Create Circular --------------------------------
      public function add_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $datas['teacher']=$this->circularmodel->get_teachers();
		  $datas['getall_class']=$this->class_manage->getall_class();
		  $datas['parents']=$this->circularmodel->getall_parents();
		  $datas['role']=$this->circularmodel->getall_roles();
		  $datas['cmaster']=$this->circularmodel->cmaster_type();
		 // echo'<pre>';print_r( $datas['cmaster']);exit;
		  
		  $user_type=$this->session->userdata('user_type');
		  if($user_type==1)
		  {
			  $this->load->view('header');
			  $this->load->view('circular/add',$datas);
			  $this->load->view('footer');
		  }
		  else{
		  	  redirect('/');
		  }
      }
	  public function view_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $user_type=$this->session->userdata('user_type');
		  
		  $datas['parents']=$this->circularmodel->get_parents_circular();
		  $datas['students']=$this->circularmodel->get_students_circular();
		  $datas['teachers']=$this->circularmodel->get_all_circular();

		  //echo '<pre>'; print_r($datas['teachers']); exit;

		  if($user_type==1)
		  {
		  $this->load->view('header');
		  $this->load->view('circular/view',$datas);
		  $this->load->view('footer');
		  }
		  else{
		  redirect('/');
		  }
      }
	  
	  public  function get_circular_title_list()
	  {
		    $ctype=$this->db->escape_str($this->input->post('ctype'));
		   //echo $ctype;exit;
		   $data=$this->circularmodel->get_circular_title_lists($ctype);
		   echo json_encode($data);
	  }
	  
	  public function get_description_list()
	  {
		   $ctitle=$this->db->escape_str($this->input->post('ctitle'));
		   //$ctype=$this->db->escape_str($this->input->post('ctype'));
		   //echo $ctype;exit;
		   $data=$this->circularmodel->get_circular_description_lists($ctitle);
		   echo json_encode($data);
	  }
	  
	  public function get_stu_list()
	  {
		   $classid = $this->input->post('classid');
		   //echo $classid;exit;
		   $data=$this->circularmodel->get_stu_name($classid);
		   echo json_encode($data);
	  }
	  
	  public function get_parent_list()
	  {
		   $studentid = $this->input->post('studentid');
		   //echo $classid;exit;
		   $data=$this->circularmodel->get_parent_name($studentid);
		   echo json_encode($data);
	  }
	  
      public function create()
      {
    	  $datas=$this->session->userdata();
    	  $user_id=$this->session->userdata('user_id');
    	  $user_type=$this->session->userdata('user_type');
		  
		  if($user_type==1)
		  {
			  $users_id=$this->input->post('users');
			  $tusers_id=$this->input->post('tusers');
			  //print_r($users_id);exit;
			  
			  $pusers_id=$this->input->post('pusers');
			  $stusers_id=$this->input->post('stusers');
			  //print_r($pusers_id);exit;
			  
			  $title=$this->input->post('ctitle'); 
			  $cdate=$this->input->post('date');
			  $dateTime = new DateTime($cdate);
			  $circulardate=date_format($dateTime,'Y-m-d' );
			  //echo $circulardate;exit;
			  $notes=$this->db->escape_str($this->input->post('notes'));
			  $citrcular_type=$this->db->escape_str($this->input->post('citrcular_type'));
			  $status=$this->input->post('status'); 
		  
			  if(empty($citrcular_type)){
				$citrcular_type1="null";
			  }else{
				$citrcular_type1=implode(',',$citrcular_type);
			  }
	
		   //print_r($citrcular_type);exit;
		   //$ct1=$citrcular_type[0];
		   //echo $ct1;exit;
		  
		  $datas=$this->circularmodel->circular_create($title,$notes,$circulardate,$citrcular_type1,$users_id,$tusers_id,$pusers_id,$stusers_id,$status,$user_id);
		  
		  //------------------------------SMS & MAIL & NOTIFICATION--------------------------------------------
		  $acount=count($citrcular_type);
	
		  if($acount==3)
		  {
			   $datasms = $this->smsmodel->send_circular_via_sms($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id); 
			   $datamail = $this->mailmodel->send_circular_via_mail($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id); 
			   $datanotify = $this->notificationmodel->send_circular_via_notification($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id);
		  } 
		  
		  if($acount==2)
		  {
			  $ct1=$citrcular_type[0];
			  $ct2=$citrcular_type[1];
			  
			  if($ct1=='SMS' && $ct2=='Mail')
			  {
				  $datasms = $this->smsmodel->send_circular_via_sms($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id); 
				  $datamail = $this->mailmodel->send_circular_via_mail($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id);
			  }
			  if($ct1=='SMS' && $ct2=='Notification')
			  {
				$datasms = $this->smsmodel->send_circular_via_sms($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id); 
				$datanotify = $this->notificationmodel->send_circular_via_notification($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id);  
			  }
			  if($ct1=='Mail' && $ct2=='Notification')
			  {
				 $datamail = $this->mailmodel->send_circular_via_mail($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id); 
				 $datanotify = $this->notificationmodel->send_circular_via_notification($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id);   
			  }
			  
		  }
		  if($acount==1)
		  {
			  $ct = $citrcular_type[0];
			  
			  if($ct=='SMS')
			  {
				  $datasms = $this->smsmodel->send_circular_via_sms($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id); 
			  }
			  if($ct=='Notification')
			  {
				  $datanotify = $this->notificationmodel->send_circular_via_notification($title,$notes,$tusers_id,$stusers_id,$pusers_id,$users_id);  
			  }
			  if($ct=='Mail')
			  {
				  $datamail = $this->mailmodel->send_circular_via_mail($title,$notes,$cdate,$tusers_id,$stusers_id,$pusers_id,$users_id); 
			  }
		  }
		  //----------------------------------------------------------------------------------------------
		  //print_r($datas); exit;
	
				  if($datas['status']=="success") { 
					echo "success";
				  }else{
					 echo "Something went wrong!";
				  }
		  
			}else{
			  redirect('/');
			}
     }
   
		
}
