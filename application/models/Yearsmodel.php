<?php
Class Yearsmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getYear()
    {
        $sqlYear     = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
        $year_result = $this->db->query($sqlYear);
        $ress_year   = $year_result->result();

        if ($year_result->num_rows() == 1) {
            foreach ($year_result->result() as $rows) {
                $year_id = $rows->year_id;
            }
            return $year_id;
        }
    }

    function add_years($formatted_date, $formatted_date1, $status)
    {

        $fy = date('Y', strtotime($formatted_date));
        //echo $fy;
        $ty = date('Y', strtotime($formatted_date1));
        //echo $ty;//exit;
        if ($fy < $ty && $fy != $ty) {
            $check_month = "SELECT * FROM edu_academic_year WHERE DATE_FORMAT(from_month,'%Y')='$fy' AND DATE_FORMAT(to_month,'%Y')='$ty' ";

            $result = $this->db->query($check_month);
            if ($result->num_rows() == 0) {
                $query     = "INSERT INTO edu_academic_year(from_month,to_month,status,created_date)VALUES('$formatted_date','$formatted_date1','$status',NOW())";
                $resultset = $this->db->query($query);
                $data      = array(
                    "status" => "success"
                );
                return $data;
            } else {
                $data = array(
                    "status" => "Already Exist The Year And Dates Are Same"
                );
                return $data;
            }
        } else {
            $data = array(
                "status" => "The From Year Must be Grater Than To Year"
            );
            return $data;
        }
    }

    function add_terms($year_id, $terms, $formatted_date, $formatted_date1, $status)
    {
        $fd = date('Y-m', strtotime($formatted_date));
        //echo $fy;
        $td = date('Y-m', strtotime($formatted_date1));
        //echo $ty;echo $year_id;
        if ($fd < $td && $fd != $td) {
            $check_month = "SELECT * FROM edu_terms  WHERE DATE_FORMAT(from_date,'%Y-%m')='$fd' AND DATE_FORMAT(to_date,'%Y-%m')='$td' AND term_name='$terms'";
            $result      = $this->db->query($check_month);
            if ($result->num_rows() == 0) {
                $query     = "INSERT INTO edu_terms(year_id,from_date,to_date,term_name,status,created_date)VALUES('$year_id','$formatted_date','$formatted_date1','$terms','$status',NOW())";
                $resultset = $this->db->query($query);
                $data      = array(
                    "status" => "success"
                );
                return $data;
            } else {
                $data = array(
                    "status" => "Already Exist the terms at the same year"
                );
                return $data;
            }
        } else {
            $data = array(
                "status" => "Must be graterthan the from-date to to-date"
            );
            return $data;
        }

    }

    function edit_year($year_id)
    {
        $query1 = "SELECT * FROM  edu_academic_year WHERE year_id='$year_id'";
        $res    = $this->db->query($query1);
        return $res->result();
    }


    function edit_term($term_id)
    {
        $query1 = "SELECT * FROM   edu_terms WHERE term_id='$term_id'";
        $res    = $this->db->query($query1);
        return $res->result();
    }



    function update_years($year_id, $formatted_date, $formatted_date1, $status)
    {
        $fy = date('Y', strtotime($formatted_date));
        $ty = date('Y', strtotime($formatted_date1));
        if ($fy < $ty && $fy = $ty) {
            /* $check_month="SELECT * FROM edu_academic_year WHERE DATE_FORMAT(from_month,'%Y')='$fy' AND DATE_FORMAT(to_month,'%Y')='$ty' ";
            $result=$this->db->query($check_month);
            if($result->num_rows()==0)
            { */
            $query = "UPDATE edu_academic_year SET from_month='$formatted_date',to_month='$formatted_date1',status='$status' WHERE year_id='$year_id'";
            $res   = $this->db->query($query);
            $data  = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "The From Year Must be Grater Than To Year"
            );
            return $data;
        }
        /* }else{
        $data= array("status"=>"The From Year Must be Grater Than To Year");
        return $data;
        } */

    }


    function update_terms($terms_id, $year_id, $terms, $formatted_date, $formatted_date1, $status)
    {
        $query = "UPDATE edu_terms SET year_id='$year_id',from_date='$formatted_date',to_date='$formatted_date1',term_name='$terms',status='$status' WHERE term_id='$terms_id'";
        $res   = $this->db->query($query);
        //return $res->result();
        if ($res) {
            $data = array(
                "status" => "success"
            );
            return $data;
        } else {
            $data = array(
                "status" => "Failed to Update"
            );
            return $data;
        }
    }

    function admisn_year()
    {
        $query  = "SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_enrollment AS e,edu_academic_year AS y WHERE e.admit_year=y.year_id";
        $result = $this->db->query($query);
        return $result->result();
    }

    //GET ALL Years

    function getall_years()
    {
        $query  = "SELECT * FROM edu_academic_year where status='Active'";
        $result = $this->db->query($query);
        return $result->result();
    }

    //GET ALL TERMS

    function getall_terms()
    {
        $year_id = $this->getYear();
        $query   = "SELECT * FROM edu_terms WHERE year_id='$year_id' AND status='Active'";
        $result  = $this->db->query($query);
        return $result->result();
    }


}
?>
