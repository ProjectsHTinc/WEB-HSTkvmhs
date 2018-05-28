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
    }

	public function home()
	{
 		$datas=$this->session->userdata();
 		$user_id=$this->session->userdata('user_id');
 		$user_type=$this->session->userdata('user_type');

        $datas['result'] = $this->yearsmodel->getall_years();
 		$datas['exam_view'] = $this->rankmodel->get_exam_details_view();
 		$datas['cls_view'] = $this->rankmodel->get_cls_details_view();
		//echo'<pre>';print_r($datas['exam_view']);exit;
		 if($user_type==1)
		 {
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
       $datas['examid'] =$exam_id;
 		$datas['cls_view'] = $this->rankmodel->get_cls_details_view();

		 if($user_type==1)
		 {
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
	        $year_id=$this->input->post('year_id');
	 		$exid=$this->input->post('exam_id');
	 		$cls_id=$this->input->post('class_id');
	 		$sname=$this->input->post('sub_name_id');
	 		//print_r($exid); echo'<br>'; echo $clsid; exit;
            $pass_mark=$this->input->post('pass_mark');
	 		$examid=implode(',', $exid);
	 		$sub_id=implode(',', $sname);
	       //echo'<br>'; echo $examid; echo'<br>'; echo $cls_id;

	 	    $datas['cls_rank'] = $this->rankmodel->get_rank_details_view($year_id,$examid,$cls_id,$sub_id,$pass_mark);
 		   //echo'<pre>';print_r($datas['cls_rank']);exit;

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

 		$clss_id=$this->input->post('clsid');
        $data= $this->rankmodel->get_all_subject_details($clss_id);
        //echo'<pre>';print_r($datas['views']);exit;
 		echo json_encode($data);
	}


}
?>
