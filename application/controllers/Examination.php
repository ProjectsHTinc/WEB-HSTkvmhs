<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination extends CI_Controller
{
function __construct()
{
	parent::__construct();
	$this->load->model('examinationmodel');
	$this->load->model('subjectmodel');
	$this->load->model('classmodel');
	$this->load->model('class_manage');
	$this->load->model('yearsmodel');
	$this->load->model('teachermodel');
	$this->load->helper('url');
	$this->load->library('session');
}

public function details_view()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$datas['result'] = $this->examinationmodel->get_details_view();
	$user_type=$this->session->userdata('user_type');
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/view',$datas);
		$this->load->view('footer');
	}
	else{
		redirect('/');
	}
}

public function add_exam()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');
	$datas['result'] = $this->examinationmodel->get_exam_details();
	$datas['years'] = $this->examinationmodel->get_years_details();
	//echo '<pre>'; print_r($datas['years']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/add',$datas);
		$this->load->view('footer');
	}
	else{
		redirect('/');
	}
}
public function add_exam_detail()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	$class_name = $this->input->post('class_id');
	$datas['filter'] = $this->examinationmodel->search_details_view($class_name);

	$datas['year'] = $this->examinationmodel->get_exam_details();
	$datas['result1'] = $this->examinationmodel->get_details_view1();
	$datas['result'] = $this->examinationmodel->get_details_view();
	$datas['sec'] = $this->subjectmodel->getsubject();
	$datas['class'] = $this->classmodel->getclass();
	$datas['getall_class']=$this->class_manage->getall_class();
	$datas['teacheres'] = $this->teachermodel->get_all_teacher1();

	//echo'<pre>';print_r($datas['result']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/add_exam_details',$datas);
		$this->load->view('footer');
	}else{
		redirect('/');
	}
}

public function checker()
{
	$classid = $this->input->post('classid');
	//echo $classid;exit;
	$data=$this->examinationmodel->get_subject($classid);
	echo json_encode($data);
}

public function create()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	$datas['result'] = $this->yearsmodel->getall_years();

	if($user_type==1)
	{
		$exam_year=$this->input->post('exam_year');
		$exam_name=$this->input->post('exam_name');
		$status=$this->input->post('status');
		$exam_flag=$this->input->post('exam_flag');

		$datas=$this->examinationmodel->exam_details($exam_year,$exam_name,$exam_flag,$status);
		//print_r($datas['status']);exit;
		//print_r($data['exam_name']);exit;

	if($datas['status']=="success"){
		$this->session->set_flashdata('msg','Added Successfully');
		redirect('examination/add_exam');
	}else if($datas['status']=="Exam Name Already Exist")
	{
		$this->session->set_flashdata('msg','Exam Name Already Exist');
		redirect('examination/add_exam');
	}else{
		$this->session->set_flashdata('msg','Failed to Add');
		redirect('examination/add_exam');
	}
	}else{
		redirect('/');
	}
}


public function edit_exam($exam_id)
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');

	$datas['res']=$this->examinationmodel->edit_exam($exam_id);
	//echo "<pre>";print_r(	$datas['res']);exit;
	$user_type=$this->session->userdata('user_type');
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/edit',$datas);
		$this->load->view('footer');
	}else{
		redirect('/');
	}
}
public function update()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	if($user_type==1)
	{
		$exam_id=$this->input->post('exam_id');
		$exam_year=$this->input->post('exam_year');
		$exam_name=$this->input->post('exam_name');
		$status=$this->input->post('status');
		$exam_flag=$this->input->post('exam_flag');
		$datas=$this->examinationmodel->update_exam($exam_id,$exam_year,$exam_name,$exam_flag,$status);

	if($datas['status']=="success")
	{
		$this->session->set_flashdata('msg','Updated Successfully');
		redirect('examination/add_exam');
	}else{
		$this->session->set_flashdata('msg','Failed To Updated');
		redirect('examination/add_exam');
	}
	}
}


public function add_exam_details()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');
	if($user_type==1)
	{
		$exam_year=$this->input->post('exam_year');
		$class_name=$this->input->post('class_name');
		$subject_name=$this->input->post('subject_id');
		//print_r($subject_name);exit;
		$exdate=$this->input->post('exam_dates');
	
		$time=$this->input->post('time');
		//print_r($time);exit;
		$teacher_id=$this->input->post('teacher_id');
		$status=$this->input->post('status');
		//print_r($notes);exit;

		$sub_total=$this->input->post('sub_total');
		$inter_mark=$this->input->post('inter_mark');
		$exter_mark=$this->input->post('exter_mark');
		$inter_exter_mark=$this->input->post('inter_exter_mark'); 

	$datas=$this->examinationmodel->add_exam_details($exam_year,$class_name,$subject_name,$exdate,$time,$teacher_id,$status,$sub_total,$inter_mark,$exter_mark,$inter_exter_mark,$user_id);
	if($datas['status']=="success"){
		$this->session->set_flashdata('msg','Added Successfully');
		redirect('examination/add_exam_detail');
	}else if($datas['status']=="Exam Already Exist")
	{
		$this->session->set_flashdata('msg','Exam Already Exist');
		redirect('examination/add_exam_detail');
	}else{
		$this->session->set_flashdata('msg','Failed to Add');
		redirect('examination/add_exam_detail');
	}
	}
	else{
		redirect('/');
	}
}

public function view_exam_details($exam_id,$classmaster_id)
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');
	$datas['view_details']=$this->examinationmodel->view_exam_details($exam_id,$classmaster_id);
	//echo'<pre>';print_r($datas['view_details']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/view_exam_details',$datas);
		$this->load->view('footer');
	}
	else{
		redirect('/');
	}
	
}

public function edit_exam_details($exam_detail_id)
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');
	$datas['res']=$this->examinationmodel->edit_exam_details($exam_detail_id);
	//$datas['result'] = $this->examinationmodel->get_details_view();
	//echo "<pre>";print_r($datas['res']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/edit_exam_details',$datas);
		$this->load->view('footer');
	}
	else{
		redirect('/');
	}
}

public function update_exam_details()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	if($user_type==1)
	{
		$id=$this->input->post('id');
		$exam_year=$this->input->post('eid');
		//echo $exam_year; 
		$class_name=$this->input->post('class_name');

		$subject_name=$this->input->post('subject_name');
		//echo $subject_name; exit;
		$exam_date=$this->input->post('exam_date'); 
		$dateTime = new DateTime($exam_date);
		$formatted_date=date_format($dateTime,'Y-m-d' );

		$time=$this->input->post('time');
		$status=$this->input->post('status');

		 //$exam_id=$this->input->post('exam_id');
		$classmaster_id=$this->input->post('classmaster_id');
       // echo $exam_year; echo $classmaster_id; exit;

		$teacher_id=$this->input->post('teacher_id');

		$sub_total=$this->input->post('sub_total');
		$inter_mark=$this->input->post('inter_mark');
		$exter_mark=$this->input->post('exter_mark');
		//echo $inter_mark; echo $exter_mark; exit;
		$inter_exter_mark=$this->input->post('inter_exter_mark'); 

		$datas=$this->examinationmodel->update_exam_detail($id,$exam_year,$class_name,$subject_name,$formatted_date,$time,$teacher_id,$status,$sub_total,$inter_mark,$exter_mark,$inter_exter_mark,$user_id);

      
	if($datas['status']=="success")
	{
		$this->session->set_flashdata('msg','Updated Successfully');
		redirect('examination/view_exam_details/'.$exam_year.'/'.$classmaster_id.'');
	}else if($datas['status']=="Exam Already Exist")
	{
		$this->session->set_flashdata('msg','Exam Already Exist');
		redirect('examination/view_exam_details/'.$exam_year.'/'.$classmaster_id.'');
	}else{
		$this->session->set_flashdata('msg','Failed To Updated');
		redirect('examination/view_exam_details/'.$exam_year.'/'.$classmaster_id.'');
		}
	}
}

public function subcheck()
{
	$classid=$this->input->post('clsmasid');
	$examid=$this->input->post('examid');
	//echo $examid;echo $classid; exit;
	$resultset=$this->examinationmodel->check_add_exam($classid,$examid);
	if ($resultset>0)
	{
		echo "Already Exam Added";
	}
	else
	{
		echo "Add Exam";
	}

}
//--------------------Exam Result------------------------------

public function exam_name_status()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');
	$datas['exam_name']=$this->examinationmodel->exam_name_status();
	//print_r($datas['exam_name']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/exam_name',$datas);
		$this->load->view('footer');
	}else{
		redirect('/');
	}

}

public function marks_status($exam_id)
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	$datas['cls']=$this->examinationmodel->marks_statuss($exam_id);
	// print_r($datas['cls']);exit;
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('examination/exam_result',$datas);
		$this->load->view('footer');
	}
	else{
		redirect('/');
	} 

}

public function exam_mark_details_cls_teacher()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	$cls_masid=$this->input->get('var1');
	$exam_id=$this->input->get('var2');
	//echo $cls_masid;echo $exam_id;exit;
	$datas=$this->examinationmodel->getall_subname($user_id,$cls_masid,$exam_id);
	$datas['stu']=$this->examinationmodel->getall_stuname($user_id,$cls_masid,$exam_id);
	//echo "<pre>";print_r($datas['stu']);exit;
	$datas['cls_exam']=$this->examinationmodel->clsname_examname($exam_id,$cls_masid);
	$datas['smark']=$this->examinationmodel->marks_status_details($cls_masid,$exam_id);
	$datas['eflag'] = $this->examinationmodel->getall_exam_inter_exter_details($exam_id,$cls_masid);
	//echo '<pre>';print_r($datas);
	//echo '<pre>';print_r($datas['stu']); exit;

	if($user_type==1)
	{ 
		$this->load->view('header');
		$this->load->view('examination/exam_class_result',$datas);
		$this->load->view('footer');
	}else{
		redirect('/');
	}

}

public function marks_status_update()
{
	$datas=$this->session->userdata();
	$user_id=$this->session->userdata('user_id');
	$user_type=$this->session->userdata('user_type');

	$exid=$this->input->post('exams_id');
	$cmid=$this->input->post('cls_id');
	//echo $exid; echo $cmid;exit;
	$datas=$this->examinationmodel->update_exam_status($exid,$cmid,$user_id);

	// print_r($datas);exit;
	if($datas['status']=="success")
	{ 
		$a=$datas['var1']; $b=$datas['var2'];//echo $a;exit;
		$this->session->set_flashdata('msg','Approved Successfully');
		redirect('examination/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);
	}elseif($datas['status']=="Already Approved Exam Marks")
	{ 
		$a=$datas['var1']; $b=$datas['var2'];
		$this->session->set_flashdata('msg','Already Approved Exam Marks');
		redirect('examination/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);  
	}else{
		$a=$datas['var1']; $b=$datas['var2'];
		$this->session->set_flashdata('msg','Falid To Approve');
		redirect('examination/exam_mark_details_cls_teacher?var1='.$b.'&var2='.$a.'',$datas);
	}

}





}
