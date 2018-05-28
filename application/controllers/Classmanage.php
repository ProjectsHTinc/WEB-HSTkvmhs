<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classmanage extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('sectionmodel');
			$this->load->model('subjectmodel');
			$this->load->model('classmodel');
			$this->load->model('class_manage');
		  $this->load->helper('url');
		  $this->load->library('session');


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
	 		$datas['sec'] = $this->sectionmodel->getsection();
			$datas['class'] = $this->classmodel->getclass();
			$datas['getall_class']=$this->class_manage->getall_class();
			$datas['subres'] = $this->subjectmodel->getsubject();
			$datas['resubject'] = $this->subjectmodel->getsubject();
			//print_r($datas['getall_class']);exit;
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('classmanage/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function subject_to_class(){
			$user_id=$this->session->userdata('user_id');
			$subject_id=$this->input->post('subject_id');
		 	$class_master_id=$this->input->post('class_master_id');
		 	$exam_flag=$this->input->post('exam_flag');
			$status=$this->input->post('status');
			$datas=$this->class_manage->subject_to_class($user_id,$subject_id,$class_master_id,$exam_flag,$status);
			if($datas['status']=="success"){
				echo "success";
			}else if($datas['status']=="already"){
				echo "Already Assigned";
			}else{
				echo "failed";
			}
		}

		public function assign(){
			 	$sec_id=$this->input->post('section_name');
				$class_id=$this->input->post('class_name');
				$subject=$this->input->post('subject');
				//$subject = implode(',',$sub);
				$status=$this->input->post('status');
				$data=$this->class_manage->assign($sec_id,$class_id,$subject,$status);
				if($data['status']=="success"){
						$this->session->set_flashdata('msg', 'Successfully Added');
						redirect('classmanage/home');
				}
				elseif($data['status']=="Already Exist"){
					$this->session->set_flashdata('msg', 'Already Added ');
						redirect('classmanage/home');
				}
				else{
					$this->session->set_flashdata('msg', 'Something Went wrong');
						redirect('classmanage/home');
				}

		}

		public function editcs($class_sec_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$datas['res']=$this->class_manage->edit_cs($class_sec_id);
			//echo "<pre>"; print_r($datas['res']);exit;
			$datas['sec'] = $this->sectionmodel->getsection();
			$datas['clas'] = $this->class_manage->getclass();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			$this->load->view('header');
			$this->load->view('classmanage/edit',$datas);
			$this->load->view('footer');
			}
			else{
				 redirect('/');
			}
		}


		public function view_subjects($class_sec_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['sec'] = $this->sectionmodel->getsection();
				$datas['class'] = $this->classmodel->getclass();
				$datas['getall_class']=$this->class_manage->getall_class();
				$datas['subres'] = $this->subjectmodel->getsubject();
				$datas['resubject'] = $this->subjectmodel->getsubject();
				$datas['res']=$this->class_manage->view_subjects($class_sec_id);
				$datas['class_master_id']=$class_sec_id;

				$this->load->view('header');
				$this->load->view('classmanage/view_subjects',$datas);
				$this->load->view('footer');
			}else{
				 redirect('/');
			}
		}

		public function edit_subjects_class($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$datas['res']=$this->class_manage->edit_subjects_class($id);
				//print_r($datas['res']);exit;
				$this->load->view('header');
				$this->load->view('classmanage/edit_subjects',$datas);
				$this->load->view('footer');
			}else{
				 redirect('/');
			}
		}

		public function save_subject(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 $id=$this->input->post('id');
				$exam_flag=$this->input->post('exam_flag');
				$status=$this->input->post('status');
				$datas=$this->class_manage->save_subject($id,$exam_flag,$status);
				if($datas['status']=="success"){
						$this->session->set_flashdata('msg', 'Successfully Updated');
						redirect('classmanage/home');
				}
				elseif($datas['status']=="failure"){
					$this->session->set_flashdata('msg', 'Something Went Wrong ');
						redirect('classmanage/home');
				}
			}else{
				 redirect('/');
			}
		}


		public function update_cs(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$subject=$this->input->post('subject');
				//$subject = implode(',',$sub);
				$class_sec_id=$this->input->post('class_sec_id');
				$class=$this->input->post('class_name');
				$section=$this->input->post('section_name');
				$status=$this->input->post('status');
				$datas=$this->class_manage->save_cs($class_sec_id,$class,$section,$subject,$status);
			//	print_r($datas);exit;
				if($datas['status']=="success"){
						$this->session->set_flashdata('msg', 'Successfully Updated');
						redirect('classmanage/home');
				}
				elseif($datas['status']=="updated"){
					$this->session->set_flashdata('msg', 'Saved');
						redirect('classmanage/home');
				}
				else{
					$this->session->set_flashdata('msg', 'Saved');
						redirect('classmanage/home');
				}
			}
			else{
				 redirect('/');
			}
		}


		public function getListClass(){
			$subject_id=$this->input->post('subject_id');
			$datas['res']=$this->class_manage->getListClass($subject_id);
			echo json_encode($datas['res']);
		}


		public function deletecs($class_sec_id){
			$data=$this->class_manage->delete_cs($class_sec_id);
			if($data['status']=="success"){
				$this->session->set_flashdata('msg', 'Deleted Successfully');
				redirect('classmanage/home');
			}else{
				$this->session->set_flashdata('msg', 'Something Went wrong');
					redirect('classmanage/home');
			}
		}

















}
