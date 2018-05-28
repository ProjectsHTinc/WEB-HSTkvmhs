<?php

Class Communicationmodel extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    function get_teachers()
    {
        $query     = "SELECT * FROM edu_teachers WHERE status='Active'";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }
    
    function getall_parents()
    {
        $query     = "SELECT * FROM edu_teachers";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }
    
    
    function get_classes()
    {
        $query     = "SELECT * FROM  edu_class";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }
    
    
    
    function user_leaves()
    {
        $get_year = "SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
        $result1  = $this->db->query($get_year);
        $all_year = $result1->result();
        foreach ($all_year as $cyear) {
        }
        $current_year = $cyear->year_id;
        
        $query     = "SELECT u.user_id,u.user_type,u.user_master_id,ul.*,lm.leave_title,lm.leave_type,lm.id,t.teacher_id,t.name FROM edu_user_leave AS ul,edu_teachers AS t,edu_user_leave_master AS lm,edu_users AS u WHERE u.user_type=ul.user_type AND u.user_id=ul.user_id AND ul.year_id='$current_year' AND t.teacher_id=u.user_master_id AND ul.leave_master_id=lm.id  ORDER BY ul.leave_id DESC";
        $resultset = $this->db->query($query);
        $result    = $resultset->result();
        return $result;
        
    }
    
    
    function edit_leave($leave_id)
    {
        $que        = "SELECT l.*,u.user_id,u.user_type,u.user_master_id,t.name,t.teacher_id,t.phone,em.leave_title FROM edu_user_leave AS l,edu_teachers AS t,edu_users AS u,edu_user_leave_master as em WHERE l.leave_id='$leave_id' AND u.user_type=l.user_type AND u.user_id=l.user_id  AND t.teacher_id=u.user_master_id AND l.leave_master_id=em.id";
        $resultset1 = $this->db->query($que);
        $row        = $resultset1->result();
        return $row;
        
    }
    
    function get_all_leave($leave_id)
    {
        $que        = "SELECT ul.*,lm.id,lm.leave_title,lm.leave_type FROM edu_user_leave AS ul,edu_user_leave_master AS lm WHERE ul.type_leave=lm.leave_type AND ul.leave_id='$leave_id'";
        $resultset1 = $this->db->query($que);
        $row        = $resultset1->result();
        return $row;
    }
    
    function update_leave($leave_id,$status)
    {
        $query4  = "UPDATE edu_user_leave SET status='$status',updated_at=NOW() WHERE leave_id='$leave_id'";
        $result1 = $this->db->query($query4);
		//$result2 = $result1->result();
        if($result1){
			$data = array("status"=>"success");
            return $data;
        }else{
              $data= array("status"=>"failure");
              return $data;
            }
        
    }
    
    function get_all_teachers_list($leave_id)
    {
        $sql       = "SELECT leave_id,user_id,user_type,from_leave_date,to_leave_date FROM edu_user_leave WHERE leave_id='$leave_id'";
        $resultset = $this->db->query($sql);
        $row       = $resultset->result();
        foreach ($row as $res) {
        }
        $uid   = $res->user_id;
        $utype = $res->user_type;
        
        $que       = "SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_teachers AS t,edu_users AS u WHERE u.user_id='$uid' AND u.user_type='$utype' AND t.teacher_id NOT IN(u.user_master_id)";
        $resultset = $this->db->query($que);
        $row       = $resultset->result();
        return $row;
    }
    
    function get_all_class_list($leave_id)
    {
        $sql       = "SELECT leave_id,user_id,user_type,from_leave_date,to_leave_date FROM edu_user_leave WHERE leave_id='$leave_id'";
        $resultset = $this->db->query($sql);
        $row       = $resultset->result();
        foreach ($row as $res) {
        }
        $tid   = $res->user_id;
        $utype = $res->user_type;
        $ldate = $res->from_leave_date;
        $tdate = $res->to_leave_date;
        $lid   = $res->leave_id;
        //return $tid;
        //echo $tid;
        // exit;
        
        $sql1       = "SELECT u.user_id,u.user_type,u.user_master_id,estc.id,estc.class_master_id,estc.subject_id,estc.teacher_id,estc.status,t.name,t.teacher_id,t.phone,c.class_id,c.class_name,s.sec_id,s.sec_name,cm.class_sec_id,cm.class,cm.section FROM edu_users AS u,edu_teacher_handling_subject AS estc,edu_class AS c,edu_sections AS s ,edu_classmaster AS cm,edu_teachers AS t WHERE u.user_id='$tid' AND u.user_type='$utype' AND estc.teacher_id=u.user_master_id AND t.teacher_id=u.user_master_id AND estc.class_master_id=cm.class_sec_id AND cm.class = c.class_id AND cm.section = s.sec_id GROUP BY estc.class_master_id";
        $resultset3 = $this->db->query($sql1);
        $res1       = $resultset3->result();
        if (empty($res1)) {
            $data = array("status" => "Subject Not Found");
            return $data;
        } else {
            foreach ($res1 as $rows1) {
                $class_id[]   = $rows1->class_sec_id;
                $class_name[] = $rows1->class_name;
                $sec_n[]      = $rows1->sec_name;
                $tname        = $rows1->name;
                $cell         = $rows1->phone;
                $teid         = $rows1->teacher_id;
            }
            $data = array(
                "class_id" => $class_id,
                "class_name" => $class_name,
                "sec_name" => $sec_n,
                "teacher_id" => $teid,
                "from_leave_date" => $ldate,
                "to_leave_date" => $tdate,
                "leave_id" => $lid,
                "teaname" => $tname,
                "cell" => $cell,
                "status" => "success"
            );
            return $data;
            //echo "<pre>"; print_r($data);exit;            
        }
        
    }
    
    function get_all_view_list($leave_id)
    {
        $sql       = "SELECT leave_id,user_id,user_type,from_leave_date,to_leave_date FROM edu_user_leave WHERE leave_id='$leave_id'";
        $resultset = $this->db->query($sql);
        $row       = $resultset->result();
        foreach ($row as $res) {
        }
        $uid   = $res->user_id;
        $utype = $res->user_type;
        
        $query  = "SELECT u.user_id,u.user_type,u.user_master_id,s.*,t.teacher_id,t.name,c.class_id,c.class_name,se.sec_name,se.sec_id,cm.class_sec_id,cm.class,cm.section FROM edu_substitution AS s,edu_users AS u,edu_teachers AS t,edu_class AS c,edu_sections AS se,edu_classmaster AS cm WHERE u.user_id='$uid' AND u.user_type='$utype' AND  s.teacher_id=u.user_master_id AND t.teacher_id=s.sub_teacher_id AND s.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=se.sec_id ORDER BY s.id DESC";
        $result = $this->db->query($query);
        $row    = $result->result();
        return $row;
    }
    
    function add_substitution_list($user_id, $cls_id, $teacher_id, $leave_date, $sub_teacher, $period_id, $leave_id, $status)
    {
        $quy  = "SELECT teacher_id,sub_date,class_master_id,period_id FROM edu_substitution WHERE teacher_id='$teacher_id' AND sub_date='$leave_date' AND class_master_id='$cls_id' AND period_id='$period_id' ";
        $res1 = $this->db->query($quy);
        if ($res1->num_rows() == 0) {
            $sql       = "INSERT INTO edu_substitution(teacher_id,sub_teacher_id,sub_date,class_master_id,period_id,status,created_by,created_at) VALUES ('$teacher_id','$sub_teacher','$leave_date','$cls_id','$period_id','$status','$user_id',NOW())";
            $resultset=$this->db->query($sql);
			//$resultset1=$resultset->result();
            if ($resultset) {
                $data = array("status" => "success");
                return $data;
            }
        } else {
            $data = array("status" => "Already_Exist");
            return $data;
        }
    }
    
    
    function get_all_class_list1($teacher_id)
    {
        //echo $teacher_id;exit;
        $sql1       = "SELECT estc.id,estc.class_master_id,estc.subject_id,estc.teacher_id,estc.status,c.class_id,c.class_name,s.sec_id,s.sec_name,cm.class_sec_id,cm.class,cm.section FROM edu_teacher_handling_subject AS estc,edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE estc.teacher_id='$teacher_id' AND estc.class_master_id=cm.class_sec_id AND cm.class = c.class_id AND cm.section = s.sec_id GROUP BY estc.class_master_id";
        $resultset3 = $this->db->query($sql1);
        $res1       = $resultset3->result();
        if (empty($res1)) {
            $data = array(
                "status" => "Subject Not Found"
            );
            return $data;
        } else {
            foreach ($res1 as $rows1) {
                $class_id[]   = $rows1->class_sec_id;
                $class_name[] = $rows1->class_name;
                $sec_n[]      = $rows1->sec_name;
            }
            $data = array(
                "class_id" => $class_id,
                "class_name" => $class_name,
                "sec_name" => $sec_n,
                "status" => "success"
            );
            return $data;
            //echo "<pre>"; print_r($data);exit;            
        }
        
    }
    
    function edit_substitution_list($id)
    {
        $sql    = "SELECT * FROM edu_substitution WHERE id='$id'";
        $result = $this->db->query($sql);
        $row    = $result->result();
        return $row;
    }
    
    function update_substitution_list($user_id, $cls_id, $teacher_id, $leave_date, $sub_teacher, $period_id, $id, $status)
    {
        $sql    = "UPDATE edu_substitution SET teacher_id='$teacher_id',sub_teacher_id='$sub_teacher',sub_date='$leave_date',class_master_id='$cls_id',period_id='$period_id',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
        $result = $this->db->query($sql);
        //$row=$result->result();
        if ($result) {
            $datas = array(
                "status" => "success"
            );
            return $datas;
        } else {
            $datas = array(
                "status" => "Failed to Update"
            );
            return $datas;
        }
    }
    
    
    
}
?>