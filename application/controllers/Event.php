<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {


	function __construct() {
		 parent::__construct();

			$this->load->model('eventmodel');
			$this->load->model('yearsmodel');
		    $this->load->helper('url');
		    $this->load->library('session');
			$this->load->helper('menu');
			$this->load->model('teachermodel');


 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section




	 	public function home(){
	 		 	$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
  			$datas['years'] = $this->yearsmodel->getall_years();
				$datas['terms'] = $this->yearsmodel->getall_terms();
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('event/calender',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


    public function create(){
        $datas=$this->session->userdata();
        $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$datas['result']=$this->eventmodel->getall_events();

				if($user_type==1){
       $this->load->view('header',$datas);
       $this->load->view('event/add',$datas);
       $this->load->view('footer');
       }
       else{
          redirect('/');
       }
    }


		public function add(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $event_date=$this->input->post('event_date');
			 $event_name=$this->input->post('event_name');
			 $event_details= $this->db->escape_str($this->input->post('event_details'));
			 $event_status=$this->input->post('event_status');
			 $datas=$this->eventmodel->create_event($event_date,$event_name,$event_details,$event_status);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Added Successfully');
				 redirect('event/create');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to Add');
				 redirect('event/create');
			 }
		 }
		 else{
				redirect('/');
		 }

		}

		public function view(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['result']=$this->eventmodel->getall_events();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $this->load->view('header',$datas);
			 $this->load->view('event/create');
			 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }

		}

		public function edit($event_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['res']=$this->eventmodel->get_event_id($event_id);
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $this->load->view('header',$datas);
			 $this->load->view('event/edit',$datas);
			 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }

		}

		public function save(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $event_id=$this->input->post('event_id');
			 $event_date=$this->input->post('event_date');
			 $event_name=$this->input->post('event_name');
			 $event_details=$this->db->escape_str($this->input->post('event_details'));
			 $event_status=$this->input->post('event_status');
			 $datas=$this->eventmodel->save_event($event_id,$event_date,$event_name,$event_details,$event_status);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Updated  Successfully');
				 redirect('event/create');
			 }else{
				 $this->session->set_flashdata('msg', 'Failed to Add');
				 redirect('event/create');
			 }
		 }
		 else{
				redirect('/');
		 }
		}

		public function getall_act_event()
		{
			$data['res']=$this->eventmodel->getall_act_event();
			echo json_encode($data['res']);
		}

		public function get_all_regularleave()
		{

			$data['reg']=$this->eventmodel->get_all_regularleave();
			//$s= unset($data);
			echo json_encode($data['reg']);
		}

     public function create_sub_event()
	{
		    $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1)
			 {
				 $event_id=$this->input->post('event_id');
				 $sub_event_name=$this->input->post('sub_name');
				 $co_name=$this->input->post('co_name');
				 $status=$this->input->post('status');
				//$data['teacher']=$this->Teachermodel->get_all_teacher1();
				 $datas=$this->eventmodel->save_sub_event($event_id,$sub_event_name,$co_name,$status);

				if($datas['status']=='success')
				{
					echo "Added Successfully";
					//$this->session->set_flashdata('msg', 'Added Successfully');
					//redirect('event/create');

				}else if($datas['status']=="Event Name Already Exist")
				{
					echo "Event Name Already Exist";
					//$this->session->set_flashdata('msg', 'Sub Event Name Already Exist');
					//redirect('event/create');

				}	else{
					  echo "Failed to Add";
					//$this->session->set_flashdata('msg', 'Failed to Add');
					//redirect('event/create');
				}

    	}
  }

		public function view_sub_event($event_id)
		{
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$datas['res']=$this->eventmodel->view_sub_event($event_id);
				   //print_r($datas['res']);
				   //exit;
					$user_type=$this->session->userdata('user_type');
					if($user_type==1){
					 $this->load->view('header',$datas);
					 $this->load->view('event/sub_event_view',$datas);
					 $this->load->view('footer');
				 }
				 else{
						redirect('/');
				 }
		}


			public function sub_event_edit($co_id)
			{
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('user_id');
						$datas['res']=$this->eventmodel->edit_sub_event($co_id);
					   //print_r($datas['res']);
					   //exit;
						$user_type=$this->session->userdata('user_type');
						if($user_type==1){
						 $this->load->view('header',$datas);
						 $this->load->view('event/edit_sub_event',$datas);
						 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
			}

			public function sub_event_update()
			{
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('user_id');
						$user_type=$this->session->userdata('user_type');
						if($user_type==1)
						 {
							 $event_id=$this->input->post('event_id');
							 $co_id=$this->input->post('co_id');
							 $sub_event_name=$this->input->post('sub_event_name');
							 $co_name=$this->input->post('co_name');
               $status=$this->input->post('status');
							 $datas=$this->eventmodel->update_sub_event($event_id,$co_id,$sub_event_name,$co_name,$status);

							 if($datas['status']=="success"){
							 $this->session->set_flashdata('msg', 'Updated  Successfully');
							redirect('event/create');
						 }else{
							 $this->session->set_flashdata('msg', 'Failed to Add');
							redirect('event/create');
						 }
			}
			}

     public function todolist(){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
				 if($user_type==1){
					$to_do_date=$this->input->post('to_do_date');
					$to_do_list=$this->input->post('to_do_list');
					$to_do_notes=$this->input->post('to_do_notes');
					$status=$this->input->post('status');
					$to_user=$user_id;
					$datas=$this->eventmodel->save_to_do_list($to_do_date,$to_do_list,$to_do_notes,$to_user,$user_type,$status);
					if($datas['status']=="success"){
						echo "success";
					}else{
						echo "failed";
					}
			 }
			 else{
					redirect('/');
			 }
		}

		public function view_all_reminder()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$data['reg']=$this->eventmodel->view_all_reminder($user_id);
			//$s= unset($data);
			echo json_encode($data['reg']);
		}





}
