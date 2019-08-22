<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller
{


	function __construct()
	 {
		  parent::__construct();
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('rankmodel');
		  $this->load->model('yearsmodel');
			$this->load->model('class_manage');

    }

			public function home()
			{
		 		$datas=$this->session->userdata();
		 		$user_id=$this->session->userdata('user_id');
		 		$user_type=$this->session->userdata('user_type');
				 if($user_type==1)
				 {
					 $datas['result'] = $this->yearsmodel->getall_years();
					 $datas['exam_view'] = $this->rankmodel->get_exam_details_view();
					 $datas['cls_view'] = $this->rankmodel->get_cls_details_view();
					 $this->load->view('header');
					 $this->load->view('rank/exam_name_list',$datas);
					 $this->load->view('footer');
		 		 }
		 		 else{
		 				redirect('/');
		 		 }
			}




			public  function class_name_list($exam_id)
			{
				$datas=$this->session->userdata();
		 		$user_id=$this->session->userdata('user_id');
		 		$user_type=$this->session->userdata('user_type');
				 if($user_type==1)
				 {
					 $datas['examid'] =$exam_id;
		 		   $datas['cls_view'] = $this->rankmodel->get_cls_details_view();
					 $this->load->view('header');
					 $this->load->view('rank/class_list',$datas);
					 $this->load->view('footer');
		 		 }
		 		 else{
		 				redirect('/');
		 		 }
			}

			public function get_all_rank()
			{
		      $datas=$this->session->userdata();
			 		$user_id=$this->session->userdata('user_id');
			 		$user_type=$this->session->userdata('user_type');
		     if($user_type==1)
					{
			   // $year_id=$this->input->post('year_id');
			 		$examid=$this->input->post('exam_id');
			 		$cls_id=$this->input->post('class_id');
			 		$sname=$this->input->post('sub_name_id');
		      $pass_mark=$this->input->post('pass_mark');
			 		$sub_id=implode(',', $sname);
		 	    $datas['cls_rank'] = $this->rankmodel->get_rank_details_view($examid,$cls_id,$sub_id,$pass_mark);
					 $this->load->view('header');
					 $this->load->view('rank/view_rank',$datas);
					 $this->load->view('footer');
		 		 }
		 		 else{
		 				redirect('/');
		 		 }
			}

			public function get_subject_list()
			{
				$datas=$this->session->userdata();
		 		$user_id=$this->session->userdata('user_id');
		 		$user_type=$this->session->userdata('user_type');
		 		$exam_id=$this->input->post('exam_id');
				$class_id=$this->input->post('class_id');
		    $data= $this->rankmodel->get_all_subject_details($exam_id,$class_id);
		 		echo json_encode($data);
			}



			public function get_mark_average(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
				{
					$datas['getall_class']=$this->class_manage->getall_class();
					$this->load->view('header');
					$this->load->view('rank/marks_average',$datas);
					$this->load->view('footer');
				}else{

				}
			}


			public function get_marks_average_result(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
			 if($user_type==1)
				{
				$exam_id=$this->input->post('exam_id');
				$exid =implode(',', $exam_id);
				$cls_id=$this->input->post('class_id');
				$marktype=$this->input->post('marktype');
				$datas['marktype']=$marktype;
				$datas['exam_id']=$this->rankmodel->get_exam_name($exid);
			 	$datas['res_student'] = $this->rankmodel->get_marks_average($exid,$cls_id,$marktype);
				 $this->load->view('header');
				 $this->load->view('rank/view_average_marks',$datas);
				 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
			}

			public function get_exam_for_class(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				$clss_id=$this->input->post('clsid');
				$data= $this->rankmodel->get_exam_for_class($clss_id);
				echo json_encode($data);
			}


}
?>
