<?php
Class Timetablemodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }



    function getYear()
    {
        $sqlYear     = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
        $year_result = $this->db->query($sqlYear);
        $ress_year   = $year_result->result();

        if ($year_result->num_rows() == 1) {
            foreach ($year_result->result() as $rows) {
                $year_id = $rows->year_id;
            }
            return $year_id;
        }
    }

    function getTerm()
    {
        $sqlYear     = "SELECT * FROM edu_terms WHERE CURDATE() >= from_date AND CURDATE() <= to_date AND status = 'Active'";
        $term_result = $this->db->query($sqlYear);
        $ress_year   = $term_result->result();

        if ($term_result->num_rows() == 1) {
            foreach ($term_result->result() as $rows) {
                $term_id = $rows->term_id;
            }
            return $term_id;
        }
    }
    //Create timetable

    function create_timetable($year_id, $term_id, $class_id, $subject_id, $teacher_id, $day_id, $period_id)
    {
        $check   = "SELECT * FROM edu_timetable WHERE class_id='$class_id' AND year_id='$year_id' AND term_id='$term_id'";
        $result1 = $this->db->query($check);
        if ($result1->num_rows() >= 1) {
            $data = array(
                "status" => "Already"
            );
            return $data;
        }
        //  exit;

        $count_name = count($teacher_id);
        for ($i = 0; $i < $count_name; $i++) {
            $day       = $day_id[$i];
            $period    = $period_id[$i];
            $classid   = $class_id;
            $termid    = $term_id;
            $yearid    = $year_id;
            $subjectid = $subject_id[$i];
            $teacherid = $teacher_id[$i];
            $query     = "INSERT INTO edu_timetable (year_id,term_id,class_id,subject_id,teacher_id,day,period,status,created_at,updated_at) VALUES ('$yearid','$termid','$classid','$subjectid','$teacherid','$day','$period','Active',NOW(),NOW())";
            $resultset = $this->db->query($query);
        }
        if ($resultset) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "failure"
            );
            return $data;
        }
    }

    //GET ALL Class assisgned for time table

    function view_class_timetable()
    {
        $year_id = $this->getYear();
        $term_id = $this->getTerm();
        $query   = "SELECT tt.class_id AS timid,cm.class_sec_id,cm.class,cm.section,c.class_id,tt.term_id,tt.year_id,a.from_month,a.to_month,c.class_name,s.sec_name
                   FROM edu_timetable AS tt  INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
                   INNER JOIN edu_academic_year AS a ON tt.year_id=a.year_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE tt.year_id='$year_id' AND tt.term_id='$term_id' GROUP BY tt.class_id";
        $result  = $this->db->query($query);
        return $result->result();
    }


    function termwise($term_id)
    {
        $year_id = $this->getYear();
        $query   = "SELECT tt.class_id AS timid,cm.class_sec_id,cm.class,cm.section,c.class_id,tt.year_id,tt.term_id,a.from_month,a.to_month,c.class_name,s.sec_name
                  FROM edu_timetable AS tt  INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id
                  INNER JOIN edu_academic_year AS a ON tt.year_id=a.year_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id WHERE tt.year_id='$year_id' AND tt.term_id='$term_id' GROUP BY tt.class_id";
        $result  = $this->db->query($query);
        return $result->result();
    }

    function getall_years()
    {
        $get_year = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month";
        $result1  = $this->db->query($get_year);
        if ($result1->num_rows() == 0) {
            $data = array(
                "status" => "no data Found"
            );
            return $data;
        } else {
            $all_year = $result1->result();
            $data     = array(
                "status" => "success",
                "all_years" => $all_year
            );
            return $data;
        }

    }

    //GET ALL TIME TABLE
    function view($class_sec_id, $term_id)
    {
        $get_year = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month";
        $result1  = $this->db->query($get_year);
        foreach ($result1->result() as $res) {
        }
        $year_id = $res->year_id;
        $query   = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_sec_id' AND tt.year_id='$year_id' AND tt.term_id='$term_id' ORDER BY tt.table_id ASC";
        $result  = $this->db->query($query);
        if ($result->num_rows() == 0) {
            $data = array(
                "status" => "no data Found"
            );
            return $data;
        } else {
            // $data= array("status" => "no data Found","data"=>$result->result());
            // return $data;
            return $result->result();
        }

    }

    function view_time($class_sec_id)
    {
        $term_id = $this->getTerm();
        $year_id = $this->getYear();
        $query  = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,tt.period FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id WHERE tt.class_id='$class_sec_id' AND tt.term_id='$term_id'
        AND tt.year_id='$year_id' ORDER BY tt.table_id ASC";
        $result = $this->db->query($query);
        $time   = $result->result();
        if ($result->num_rows() == 0) {
            $data = array(
                "st" => "no data Found"
            );
            return $data;
        } else {
            $data = array(
                "st" => "success",
                "time" => $time
            );
            return $data;
            // return $result->result();
        }

    }

    function get_subject_class($class_sec_id)
    {
        $query  = "SELECT * FROM edu_classmaster WHERE class_sec_id='$class_sec_id'";
        $result = $this->db->query($query);
        foreach ($result->result() as $rows) {
        }
        $sPlatform = $rows->subject;
        $sQuery    = "SELECT estc.subject_id,estc.class_master_id,c.class_name,s.sec_name,esu.subject_name FROM edu_subject_to_class AS estc LEFT JOIN edu_classmaster AS cm ON estc.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id
                        LEFT JOIN edu_subject AS esu ON estc.subject_id=esu.subject_id WHERE estc.class_master_id='$class_sec_id'  AND estc.status='Active'";

        $objRs     = $this->db->query($sQuery);
        $res       = $objRs->result();
        if ($result->num_rows() == 0) {
            $data = array(
                "status" => "no data Found"
            );
            return $data;
        } else {
            $data = array(
                "status" => "success",
                "res" => $res
            );
            return $data;
            // return $result->result();
        }

    }

    // Get Teacher To Class
    function get_teacher_class($class_sec_id)
    {
        $query     = "SELECT eths.teacher_id,et.name  FROM edu_teacher_handling_subject AS eths LEFT JOIN edu_teachers AS et ON et.teacher_id=eths.teacher_id
                WHERE class_master_id='$class_sec_id' GROUP BY eths.teacher_id";
        $resultset = $this->db->query($query);
        if ($resultset->num_rows() == 0) {
            $data = array(
                "status" => "No Record Found"
            );
            return $data;
        } else {
            $res  = $resultset->result();
            $data = array(
                "status" => "success",
                "res" => $res
            );
            return $data;
        }
    }


    //Save Review

    function save_review($class_id, $user_id, $user_type, $subject_id, $cur_date, $comments, $period_id)
    {
        $year_id   = $this->getYear();
        $query     = "INSERT INTO edu_timetable_review (time_date,year_id,class_id,subject_id,period_id,user_type,user_id,comments,status,created_at,updated_at) VALUES ('$cur_date','$year_id','$class_id','$subject_id','$period_id','$user_type','$user_id','$comments','Active',NOW(),NOW())";
        $resultset = $this->db->query($query);
        if ($resultset) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "failure"
            );
            return $data;
        }


    }
    //View Review

    function view_review($user_id)
    {
        $year_id   = $this->getYear();
        $query     = "SELECT etr.class_id,etr.period_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks FROM edu_timetable_review AS etr
                INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id  WHERE user_id ='$user_id'and etr.year_id='$year_id' ORDER BY etr.updated_at ASC";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }


    function view_review_all()
    {
        $year_id   = $this->getYear();
        $query     = "SELECT etr.timetable_id,etr.user_id,etr.period_id,edu.name,etr.class_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks FROM edu_timetable_review AS etr
                  INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                  INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id  INNER JOIN edu_users AS edu ON etr.user_id=edu.user_id where etr.year_id='$year_id' ORDER BY etr.created_at ASC";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }

    function edit_review_all($timetable_id)
    {
        $query     = "SELECT etr.timetable_id,etr.user_id,etr.period_id,edu.name,etr.class_id,c.class_name,s.sec_name,etr.subject_id,etr.time_date,esu.subject_name,etr.comments,etr.remarks
                    FROM edu_timetable_review AS etr INNER JOIN edu_classmaster AS cm ON etr.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS s ON cm.section=s.sec_id
                    INNER JOIN edu_subject AS esu ON etr.subject_id=esu.subject_id INNER JOIN edu_users AS edu ON etr.user_id=edu.user_id WHERE etr.timetable_id='$timetable_id'";
        $resultset = $this->db->query($query);
        return $resultset->result();
    }


    function save_user_review($timetable_id, $remarks)
    {
        $query     = "UPDATE edu_timetable_review SET remarks='$remarks',updated_at=NOW() WHERE timetable_id='$timetable_id'";
        $resultset = $this->db->query($query);
        if ($resultset) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "failure"
            );
            return $data;
        }

    }



    function teacher_timetable($user_id)
    {
        $year_id      = $this->getYear();
        $term_id      = $this->getTerm();
        $get_teach_id = "SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
        $resultset    = $this->db->query($get_teach_id);
        foreach ($resultset->result() as $rows) {
        }
        $teacher_id = $rows->teacher_id;
        $query      = "SELECT tt.table_id,tt.class_id,tt.subject_id,s.subject_name,tt.teacher_id,t.name,tt.day,dd.list_day,tt.period,ss.sec_name,c.class_name
                FROM edu_timetable AS tt LEFT JOIN edu_subject AS s ON tt.subject_id=s.subject_id LEFT JOIN edu_teachers AS t ON tt.teacher_id=t.teacher_id
                INNER JOIN edu_classmaster AS cm ON tt.class_id=cm.class_sec_id INNER JOIN edu_class AS c ON cm.class=c.class_id INNER JOIN edu_sections AS ss ON cm.section=ss.sec_id
                INNER JOIN edu_days AS dd ON tt.day=dd.d_id WHERE  tt.teacher_id='$teacher_id' AND tt.year_id='$year_id' AND tt.term_id='$term_id' ORDER BY tt.period ASC";
        $result     = $this->db->query($query);
        return $result->result();
    }


    function update_timetable($year_id, $term_id, $class_id, $subject_id, $teacher_id, $day_id, $period_id)
    {
        $year_id    = $this->getYear();
        $query      = "DELETE FROM edu_timetable WHERE class_id='$class_id' AND year_id='$year_id'";
        $result     = $this->db->query($query);
        $count_name = count($teacher_id);
        for ($i = 0; $i < $count_name; $i++) {
            $day       = $day_id[$i];
            $period    = $period_id[$i];
            $classid   = $class_id;
            $termid    = $term_id;
            $yearid    = $year_id;
            $subjectid = $subject_id[$i];
            $teacherid = $teacher_id[$i];
            $query     = "INSERT INTO edu_timetable (year_id,term_id,class_id,subject_id,teacher_id,day,period,status,created_at,updated_at) VALUES ('$yearid','$termid','$classid','$subjectid','$teacherid','$day','$period','Active',NOW(),NOW())";
            $resultset = $this->db->query($query);
        }
        if ($resultset) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "failure"
            );
            return $data;
        }

    }


    //Delete timetable
    function delete_time($class_sec_id, $termid)
    {
        $year_id = $this->getYear();
        $query   = "DELETE FROM edu_timetable WHERE class_id='$class_sec_id' AND term_id='$termid' AND year_id='$year_id'";
        $result  = $this->db->query($query);
        if ($result) {
            $data = array(
                "status" => "success"
            );
            return $data;
        }
    }
}
?>
