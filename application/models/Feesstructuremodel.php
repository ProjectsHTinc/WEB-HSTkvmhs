<?php

Class Feesstructuremodel extends CI_Model
{

    public function __construct()
     {
        parent::__construct();
     }
  
    
	
	 function get_current_years()
		{
		  $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		  $result1=$this->db->query($get_year);
		  if($result1->num_rows()==0){
			$data= array("status" => "no data Found");
			return $data;
		  }else{
			$all_year= $result1->result();
			$data= array("status" => "success","all_years"=>$all_year);
			return $data;
			//print_r($all_year);
		  }

		}
		
		function get_all_enr_cls()
		{
			$cls="SELECT en.class_id,en.enroll_id,en.admission_id,cm.class_sec_id,cm.class,c.class_id,c.class_name FROM edu_enrollment AS en INNER JOIN edu_classmaster AS cm ON cm.class_sec_id=en.class_id INNER JOIN edu_class AS c ON cm.class=c.class_id GROUP BY c.class_name";
			$result=$this->db->query($cls);
			$all_cls=$result->result();
			return $all_cls;
			
			
		}
		
           
    function get_terms()
	    {	 
  		  $sql="SELECT * FROM edu_terms";
  		  $res=$this->db->query($sql);
  		  $result=$res->result();
        return $result;
		  }
		
		function get_all_quota()
		 {
		    $sql1="SELECT * FROM edu_quota WHERE status='Active'";
  		   $res1=$this->db->query($sql1);
  		  $result1=$res1->result();
        return $result1;
		 }
		
		function get_section($classid)
		{
			$query="SELECT cm.class_sec_id,cm.class,cm.section,se.* FROM edu_classmaster AS cm,edu_sections AS se WHERE class='$classid' AND cm.section=se.sec_id ";
            $resultset=$this->db->query($query);
			$row=$resultset->result();
			return $row;
		}
		
		function add_fees_details($year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id)
		{
           if($due_date_from<$due_date_to)
		   {
			   
		  $count_name = count($class_id);
		  //echo $count_name; exit;
		  for($i=0;$i<$count_name;$i++)
          {
           //print_r($exam_year);exit;
          $year_id1=$year_id;
          $terms1=$terms;
          $class_id1=$class_id[$i];
          $fees_amount1=$fees_amount[$i];
          $quota_name1=$quota_name;
          $due_date_from1=$due_date_from;
					$due_date_to1=$due_date_to;
					$notes1=$notes;
					$status1=$status;
					
					$check_exam_name="SELECT * FROM edu_fees_master WHERE year_id='$year_id1' AND class_master_id='$class_id1' AND quota_id='$quota_name1' AND term_id='$terms1'";
					$result=$this->db->query($check_exam_name);
					if($result->num_rows()==0)
					 {  
  						$query="INSERT INTO edu_fees_master(year_id,term_id,class_master_id,quota_id,fees_amount,due_date_from, due_date_to,notes,status,created_by,created_at) VALUES ('$year_id1','$terms1','$class_id1','$quota_name1','$fees_amount1','$due_date_from1','$due_date_to1','$notes1','$status1','$user_id',NOW())";
  						$resultset=$this->db->query($query);
  						$insert_id = $this->db->insert_id();
					 }else{
    					$data= array("status"=>"Already Exist");
    					return $data;
				  } 
				  
				  $stu="SELECT enroll_id,admission_id,admisn_no,status,class_id,quota_id FROM edu_enrollment WHERE class_id='$class_id1' AND quota_id='$quota_name1' AND  status='Active' ";
				  $res=$this->db->query($stu);
				  $result1=$res->result();
				  foreach($result1 as $rows){
				  $stu_id=$rows->enroll_id;
				  $sql="INSERT INTO edu_term_fees_status(year_id,fees_id,student_id,quota_id,class_master_id,fees_amt, status,paid_by,created_by,created_at) VALUES ('$year_id1','$insert_id','$stu_id','$quota_name1','$class_id1','$fees_amount1','Unpaid','','$user_id',NOW())";
				  $resultset=$this->db->query($sql);
				 }
			}
           	$data= array("status"=>"success");
           return $data;
		   }else{
			   $data= array("status"=>"Date");
               return $data;
		   }
			
		}

    		function view_fees_master_details()
    		{
    			$sql="SELECT fe.*,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_fees_master AS fe,edu_academic_year AS y,edu_terms AS t,edu_quota AS q,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE fe.year_id=y.year_id AND fe.term_id=t.term_id AND fe.quota_id=q.id AND fe.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id ORDER BY fe.id DESC";
    			$result=$this->db->query($sql);
    			$res=$result->result();
    			return $res;
    		}
            
    		function edit_fees_master_status($id)
    		{
    			$sql="SELECT fe.*,y.year_id,y.from_month,y.to_month,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_fees_master AS fe,edu_academic_year AS y,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE fe.year_id=y.year_id AND fe.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND fe.id='$id'";
    			$result1=$this->db->query($sql);
    			$res1=$result1->result();
    			return $res1;
    		}
    		
    		function update_fees_details($id,$year_id,$terms,$class_id,$fees_amount,$quota_name,$due_date_from,$due_date_to,$notes,$status,$user_id)
    		{
    			$query="UPDATE edu_fees_master SET year_id='$year_id',term_id='$terms',class_master_id='$class_id',quota_id='$quota_name',fees_amount='$fees_amount',due_date_from='$due_date_from',due_date_to='$due_date_to',notes='$notes',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
    			$result1=$this->db->query($query);
    			
    			$sql="UPDATE edu_term_fees_status SET year_id='$year_id',quota_id='$quota_name',class_master_id='$class_id',fees_amt='$fees_amount',updated_by='$user_id',updated_at=NOW() WHERE fees_id='$id'";
    			$result2=$this->db->query($sql);
    			
    			$data= array("status" => "success");
    			return $data;
    		}
				
				function view_term_fees_status($id)
				{
			     $sql="SELECT ts.*,fm.term_id,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,en.enroll_id,en.admission_id,en.admisn_no,en.name,en.class_id,en.quota_id FROM edu_term_fees_status AS ts,edu_fees_master AS fm,edu_academic_year AS y,edu_terms AS t,edu_quota AS q,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_enrollment AS en WHERE ts.fees_id=fm.id AND fm.term_id=t.term_id AND ts.year_id=y.year_id AND ts.quota_id=q.id AND ts.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND ts.student_id=en.enroll_id AND ts.class_master_id=en.class_id AND ts.quota_id=en.quota_id AND ts.fees_id='$id'";
      			$result=$this->db->query($sql);
      			$res=$result->result();
      			return $res;
				}
				
				function edit_term_fees_status($id)
				{
			      $sql="SELECT ts.*,fm.id as masid,fm.term_id,y.year_id,y.from_month,y.to_month,t.term_id,t.term_name,q.quota_name,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name,en.enroll_id,en.admission_id,en.admisn_no,en.name,en.class_id FROM edu_term_fees_status AS ts,edu_fees_master AS fm,edu_academic_year AS y,edu_terms AS t,edu_quota AS q,edu_classmaster AS cm,edu_class AS c,edu_sections AS s,edu_enrollment AS en WHERE ts.fees_id=fm.id AND fm.term_id=t.term_id AND ts.year_id=y.year_id AND ts.quota_id=q.id AND ts.class_master_id=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id AND ts.student_id=en.enroll_id AND ts.class_master_id=en.class_id AND ts.id='$id' ";
      			$result=$this->db->query($sql);
      			$res=$result->result();
      			return $res;
				}
             
			 function update_term_fees_status($fessid,$paid_status,$user_id,$paid_by)
			 {
  				 $sql="UPDATE edu_term_fees_status SET status='$paid_status',paid_by='$paid_by',updated_by='$user_id',updated_at=NOW() WHERE id='$fessid'";
  				 $result2=$this->db->query($sql);
				 $data= array("status" => "success");
				 return $data;
			 }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}
  ?>