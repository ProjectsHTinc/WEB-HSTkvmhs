<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('studentmodel');
        $this->load->model('teachereventmodel');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('class_manage');
        $this->load->model('adminparentmodel');
        $this->load->model('subjectmodel');
    }


    public function homework_view()
    {
        $datas           = $this->session->userdata();
        $user_id         = $this->session->userdata('user_id');
        $user_type       = $this->session->userdata('user_type');
        //echo $user_id;
        $datas['result'] = $this->studentmodel->get_stu_homework_details($user_id, $user_type);
        //print_r($datas['result']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/homeworkview/hw_view', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function view_mark($hw_id)
    {
        $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('user_id');
        $user_type    = $this->session->userdata('user_type');
        //echo $user_id; echo $hw_id;exit;
        $datas['res'] = $this->studentmodel->view_homework_marks($user_id, $hw_id);
        //print_r($datas['res']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/homeworkview/marks_view', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    // ---------------------Examination Marks Result Controller-----------------------------------------


    public function exam_views()
    {
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('user_id');
        $user_type     = $this->session->userdata('user_type');
        $datas['exam'] = $this->studentmodel->get_all_exam($user_id);
        //echo '<pre>';print_r($datas['exam']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/exam_result/add', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function exam_result($exam_id)
    {
        $datas           = $this->session->userdata();
        $user_id         = $this->session->userdata('user_id');
        $user_type       = $this->session->userdata('user_type');
        $datas['result'] = $this->studentmodel->exam_marks($user_id,$exam_id,$user_type);
        //$datas['eflag']  = $this->studentmodel->getall_exam_details($exam_id,$user_id,$user_type);
        //echo '<pre>';print_r($datas['result']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/exam_result/exam_marks', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function exam_name_calender()
    {
        $datas              = $this->session->userdata();
        $user_id            = $this->session->userdata('user_id');
        $user_type          = $this->session->userdata('user_type');
        $datas['exam_view'] = $this->studentmodel->get_all_exam_views($user_id);
        //echo '<pre>';print_r($datas['exam_view']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/exam_result/exam_name', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function exam_calender($exams_id)
    {
        $datas             = $this->session->userdata();
        $user_id           = $this->session->userdata('user_id');
        //echo $user_id;
        $user_type         = $this->session->userdata('user_type');
        $datas['calender'] = $this->studentmodel->exam_calender_details($user_id, $exams_id, $user_type);
        //echo '<pre>';print_r($datas['calender']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/exam_result/view_exam_calender', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }

    }
    //------------------------Fees Status------------------------------//

    public function fees_status()
    {

        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('user_id');
        //echo $user_id;
        $user_type     = $this->session->userdata('user_type');
        $datas['fees'] = $this->studentmodel->get_fees_status_details($user_id);
        //echo '<pre>';print_r($datas['fees']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/fees_status/fees_status_view', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }


    }

    //------------------------------------------------------------------------//

    public function attendance()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3) {
            $datas['total'] = $this->adminparentmodel->get_total_working_days($user_id, $user_type);
			$datas['ableavedays'] = $this->adminparentmodel->get_absent_leave_days_student($user_id, $user_type);
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/attendance/calender', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function get_attendance_user()
    {
        $datas        = $this->session->userdata();
        $user_id      = $this->session->userdata('user_id');
        $user_type    = $this->session->userdata('user_type');
        $datas['res'] = $this->studentmodel->get_student_user($user_id);
        echo json_encode($datas['res']);
    }



    public function timetable()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3) {
            $datas['restime'] = $this->studentmodel->get_timetable($user_id);
            if ($datas['restime']['st'] == "no data Found") {
                $data = $datas['restime'];
                $this->load->view('adminstudent/student_header');
                $this->load->view('adminstudent/timetable/nodata');
                $this->load->view('adminstudent/student_footer');
            } else {
                $data['restime']  = $datas['restime']['time'];
              //  $data['class_id'] = $class_sec_id;
                $data['user_id']   = $user_id;
                $data['user_type'] = $user_type;
                $this->load->view('adminstudent/student_header');
                $this->load->view('adminstudent/timetable/view', $data);
                $this->load->view('adminstudent/student_footer');
            }
        } else {
            redirect('/');
        }
    }


    public function event()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3) {
            //$datas['res']=$this->teachereventmodel->get_teacher_event($user_id);
            $datas['event_all'] = $this->teachereventmodel->get_teacher_allevent();
            //print_r(  $datas['event_all']);exit;
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/event/eventview', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }
    public function view_event($event_id)
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3) {

            $datas['result'] = $this->teachereventmodel->get_event_details($event_id);
            $datas['res']    = $this->teachereventmodel->get_teacher_in_event($event_id);

            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/event/event_list', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }
    //--------------------------Circular----------------------//
    public function view_all_circular()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $datas['circular'] = $this->studentmodel->get_circular($user_id);
        //echo'<pre>';print_r($datas['circular']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/circular/view', $datas);
            $this->load->view('adminstudent/student_footer');
        }
    }

    //--------------------------Leaves----------------------//

    public function get_all_regularleave()
    {
        $datas       = $this->session->userdata();
        $user_id     = $this->session->userdata('user_id');
        $user_type   = $this->session->userdata('user_type');
        $data['reg'] = $this->studentmodel->get_all_regularleave($user_id);
        //$s= unset($data);
        echo json_encode($data['reg']);
    }

    public function get_all_special_leave()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $datas['res'] = $this->studentmodel->get_special_leave_all($user_id);
        echo json_encode($datas['res']);
    }

    //---------------------------On Duty--------------------------//

    public function onduty()
    {
        $datas           = $this->session->userdata();
        $user_id         = $this->session->userdata('user_id');
        $user_type       = $this->session->userdata('user_type');
        $datas['result'] = $this->studentmodel->getall_details($user_id, $user_type);

        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/onduty/add_onduty', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }

    public function apply_onduty()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $reason = $this->db->escape_str($this->input->post('reason'));
        $notes  = $this->db->escape_str($this->input->post('notes'));

        $from_date = $this->input->post('fdate');
        $dateTime  = new DateTime($from_date);
        $fdate     = date_format($dateTime, 'Y-m-d');

        $to_date   = $this->input->post('tdate');
        $dateTime1 = new DateTime($to_date);
        $tdate     = date_format($dateTime1, 'Y-m-d');

        //$status=$this->input->post('status');
        $datas = $this->studentmodel->apply_onduty($user_type, $user_id, $reason, $fdate, $tdate, $notes);
        //print_r($datas);exit;
        if ($datas['status'] == "success") {
            $this->session->set_flashdata('msg', 'Added Successfully');
            redirect('student/onduty');
        } else if ($datas['status'] == "Date") {
            $this->session->set_flashdata('msg', 'From Date Should be Less Than To Date');
            redirect('student/onduty');
        } else {
            $this->session->set_flashdata('msg', 'Faild To Add');
            redirect('student/onduty');
        }

    }

    public function edit_onduty($id)
    {
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('user_id');
        $user_type     = $this->session->userdata('user_type');
        $datas['edit'] = $this->studentmodel->edit_onduty_form($id, $user_type);
        //echo'<pre>';print_r($datas['edit']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/onduty/edit_onduty', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }

    }

    public function update_onduty()
    {
        $datas     = $this->session->userdata();
        $user_id   = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $reason = $this->db->escape_str($this->input->post('reason'));
        $notes  = $this->db->escape_str($this->input->post('notes'));

        $from_date = $this->input->post('fdate');
        $dateTime  = new DateTime($from_date);
        $fdate     = date_format($dateTime, 'Y-m-d');

        $to_date   = $this->input->post('tdate');
        $dateTime1 = new DateTime($to_date);
        $tdate     = date_format($dateTime1, 'Y-m-d');

        $duty_id = $this->input->post('id');

        $datas = $this->studentmodel->update($duty_id, $user_type, $user_id, $reason, $fdate, $tdate, $notes);
        //print_r($datas);exit;

        if ($datas['status'] == "success") {
            $this->session->set_flashdata('msg', 'Updated Successfully');
            redirect('student/onduty');
        } else if ($datas['status'] == "Date") {
            $this->session->set_flashdata('msg', 'From Date Should be Less Than To Date');
            redirect('student/onduty');
        } else {
            $this->session->set_flashdata('msg', 'Faild To Update');
            redirect('student/onduty');
        }
    }

    //----------------------Special Class Status-------------------------------------

    public function special_class_details()
    {
        $datas         = $this->session->userdata();
        $user_id       = $this->session->userdata('user_id');
        $user_type     = $this->session->userdata('user_type');
        $datas['view'] = $this->studentmodel->special_class_details($user_id, $user_type);
        //echo'<pre>';print_r($datas['view']);exit;
        if ($user_type == 3) {
            $this->load->view('adminstudent/student_header');
            $this->load->view('adminstudent/special_class/view_special_cls', $datas);
            $this->load->view('adminstudent/student_footer');
        } else {
            redirect('/');
        }
    }




}
