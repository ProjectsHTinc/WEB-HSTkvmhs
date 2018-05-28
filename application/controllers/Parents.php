<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parents extends CI_Controller {


	function __construct() {
		 parent::__construct();
		  $this->load->model('parentsmodel');
		  $this->load->model('admissionmodel');
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
	 	public function home($admission_id){
	 		 $datas=$this->session->userdata();
	 		 $user_id=$this->session->userdata('user_id');
	 		//$datas['result'] = $this->classmodel->getclass();
			  $user_type=$this->session->userdata('user_type');
			  $datas['result']=$admission_id;
			 // $datas['admission_id']; $this->admissionmodel->get_ad_id();
			 if($user_type==1)
			 {
	 		 $this->load->view('header');
	 		 $this->load->view('parents/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
		 	if($user_type==1)
			{
				    $admission_id=$this->input->post('admission_no');
					$priority=$this->input->post('priority');
					
					//echo $admission_id; echo $priority;
					
					//Father Details
					$fname=$this->input->post('fname');
					$foccupation=$this->input->post('foccupation');
					$fincome=$this->input->post('fincome');
					$fhaddress=$this->input->post('fhaddress');
					$fpemail=$this->input->post('fpemail');
					$fsemail=$this->input->post('fsemail');
					$fpmobile=$this->input->post('fpmobile');
					$fsmobile=$this->input->post('fsmobile');
					$fhome_phone=$this->input->post('fhome_phone');
				    $foffice_address=$this->input->post('foffice_address');
					$foffice_phone=$this->input->post('foffice_phone');
				    $frelationship=$this->input->post('frelationship');
					$fstatus=$this->input->post('fstatus');
					$flogin=$this->input->post('flogin');
					
					
					$father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$father_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
				  if(!empty($fname)){ $userFileName =$father_pic; }else{ 
					$userFileName=""; 
					}
				   //echo $flogin; exit;
				//Mother Details
				    $mname=$this->input->post('mname');
					$moccupation=$this->input->post('moccupation');
					$mincome=$this->input->post('mincome');
					$mhaddress=$this->input->post('mhaddress');
					$mpemail=$this->input->post('mpemail');
					$msemail=$this->input->post('msemail');
					$mpmobile=$this->input->post('mpmobile');
					$msmobile=$this->input->post('msmobile');
					$mhome_phone=$this->input->post('mhome_phone');
				    $moffice_address=$this->input->post('moffice_address');
					$moffice_phone=$this->input->post('moffice_phone');
				    $mrelationship=$this->input->post('mrelationship');
					$mstatus=$this->input->post('mstatus');
					$mlogin=$this->input->post('mlogin');
					
					$mother_pic = $_FILES["mother_pic"]["name"];
					$userFileName1 =$mother_pic;
					$uploaddir1 = 'assets/parents/';
					$profilepic1 = $uploaddir1.$userFileName1;
					move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					
					if(!empty($mother_pic))
					{ $userFileName1 =$mother_pic;
					}else{ 
					$userFileName1=""; }
					//echo $mname; echo $mpemail; echo $mpmobile;
					
					
				// Guardian Details
				    $gname=$this->input->post('gname');
					$goccupation=$this->input->post('goccupation');
					$gincome=$this->input->post('gincome');
					$ghaddress=$this->input->post('ghaddress');
					$gpemail=$this->input->post('gpemail');
					$gsemail=$this->input->post('gsemail');
					$gpmobile=$this->input->post('gpmobile');
					$gsmobile=$this->input->post('gsmobile');
					$ghome_phone=$this->input->post('ghome_phone');
				    $goffice_address=$this->input->post('goffice_address');
					$goffice_phone=$this->input->post('goffice_phone');
				    $grelationship=$this->input->post('grelationship');
					$gstatus=$this->input->post('gstatus');
					$glogin=$this->input->post('glogin');
					
					$guardn_pic = $_FILES["guardian_pic"]["name"];
					$userFileName2 =$guardn_pic;
					$uploaddir2 = 'assets/parents/';
					$profilepic2 = $uploaddir2.$userFileName2;
					move_uploaded_file($_FILES['guardian_pic']['tmp_name'], $profilepic2);
					if(!empty($gname)){ $userFileName2 =$guardn_pic; }else{$userFileName2="";}	
						
	$datas=$this->parentsmodel->add_parents($admission_id,$fname,$foccupation,$fincome,$fhaddress,$fpemail,$fsemail,$fpmobile,$fsmobile,$fhome_phone,$foffice_address,$foffice_phone,$frelationship,$fstatus,$flogin,$userFileName,$mname,$moccupation,$mincome,$mhaddress,$mpemail,$msemail,$mpmobile,$msmobile,$mhome_phone,$moffice_address,$moffice_phone,$mrelationship,$mstatus,$mlogin,$userFileName1,$gname,$goccupation,$gincome,$ghaddress,$gpemail,$gsemail,$gpmobile,$gsmobile,$ghome_phone,$goffice_address,$goffice_phone,$grelationship,$gstatus,$glogin,$userFileName2,$user_id);
	
			//print_r($datas['status']);exit;
				if($datas['status']=="success")
				{
					$this->session->set_flashdata('msg','Added Successfully');
					redirect('parents/view');
				}else if($datas['status']=="MNAE"){
						$this->session->set_flashdata('msg', 'Mobile Number Already Exist');
						redirect('parents/view');
				  }else{
						$this->session->set_flashdata('msg', 'Failed to Add');
						redirect('parents/view');
				   }
			   }
			 else
			 {
					redirect('/');
			 }
		}
		
		public function create_new_parents_details($admission_id,$eid)
	    { 
             $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['aid']=$admission_id;
			 $datas['eid']=$eid;
			 $datas['alldetails']=$this->parentsmodel->get_all_details($admission_id);
			 //print_r($datas['alldetails']);exit;
		 	 if($user_type==1)
			 { 
				 $this->load->view('header');
				 $this->load->view('parents/add_new_parents',$datas);
				 $this->load->view('footer');
			 }else{
				 redirect('/');
			 }
			
	    }
		
		public function create_new_parents()
		{    
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 { 
			        $admission_id=$this->input->post('admission_id');
					$oldadmission_id=$this->input->post('insertadmission_no');
                   //echo $oldadmission_id;exit;
					$priority=$this->input->post('priority');
					$name=$this->input->post('name');
					$occupation=$this->input->post('occupation');
					$income=$this->input->post('income');
					$haddress=$this->input->post('haddress');
					$pemail=$this->input->post('pemail');
					$semail=$this->input->post('semail');
					$pmobile=$this->input->post('pmobile');
					$smobile=$this->input->post('smobile');
					$home_phone=$this->input->post('home_phone');
				    $office_address=$this->input->post('office_address');
					$office_phone=$this->input->post('office_phone');
				    $relationship=$this->input->post('relationship');
					$status=$this->input->post('status');
					//echo $priority; 
					
					$parent_pic = $_FILES["parents_picture"]["name"];
				    $userFileName =$parent_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['parents_picture']['tmp_name'], $profilepic);
				    if(!empty($parent_pic)){ $userFileName =$parent_pic; }else{ 
					$userFileName=""; 
					}
				 $datas=$this->parentsmodel->add_new_parents($admission_id,$oldadmission_id,$name,$occupation,$income,$haddress,$pemail,$semail,$pmobile,$smobile,$home_phone,$office_address,$office_phone,$relationship,$status,$priority,$userFileName,$user_id);
                 
                 //print_r($datas);exit;	
                 if($datas['status']=="success")
				 {
				   $this->session->set_flashdata('msg','Updated Successfully');
				   redirect('parents/view'); 
				 }else{
				  $this->session->set_flashdata('msg','Updated Successfully');
				  redirect('parents/view'); 
				 }
			}else{
				 redirect('/');
			 }
			
		}
	   
// GET ALL ADMISSION DETAILS

			public function view()
			{
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$datas['result'] = $this->parentsmodel->get_all_parents_details();
				//echo "<pre>";print_r($datas['result']);exit;
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
			 $this->load->view('header');
			 $this->load->view('parents/view',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
			}
		
			public function edit_parents($admission_id)
				{
					 $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');
					  $user_type=$this->session->userdata('user_type');
					 $datas['editres']=$this->parentsmodel->edit_parents($admission_id);
					 $datas['sid']=$admission_id;
					 //echo "<pre>";print_r($datas['editres']);exit;
					
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/edit',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}
					
			public function edit_parent($parnt_guardn_id)
				{
					 $datas=$this->session->userdata();
					 $user_id=$this->session->userdata('user_id');
					 $user_type=$this->session->userdata('user_type');
					  
					 $datas['res']=$this->parentsmodel->edit_parent($parnt_guardn_id);
					 
					 //echo "<pre>";print_r($datas['res']);exit;
				
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/edit',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
					}
				
		
		public function update_parents()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
		 	 if($user_type==1)
			 {
				    $admission_id=$this->input->post('admission_no');
					$priority=$this->input->post('priority');
					$morestu=$this->input->post('morestu');
					$newstu=$this->input->post('newstu');
					$oldstu=$this->input->post('oldstu');
					$sname=$this->input->post('stu_name');
					$stu_name=implode(',',$sname);
                     //print_r($stu_name);exit;
					//Father Details
					$fid=$this->input->post('fid');
					$fname=$this->input->post('fname');
					$foccupation=$this->input->post('foccupation');
					$fincome=$this->input->post('fincome');
					$fhaddress=$this->input->post('fhaddress');
					$fpemail=$this->input->post('fpemail');
					$fsemail=$this->input->post('fsemail');
					$fpmobile=$this->input->post('fpmobile');
					$fsmobile=$this->input->post('fsmobile');
					$fhome_phone=$this->input->post('fhome_phone');
				    $foffice_address=$this->input->post('foffice_address');
					$foffice_phone=$this->input->post('foffice_phone');
				    $frelationship=$this->input->post('frelationship');
					$fstatus=$this->input->post('fstatus');
					$flogin=$this->input->post('flogin');
					
					$old_father_pic=$this->input->post('old_father_pic');
					
                    if(!empty($_FILES["father_pic"]["name"])){
				    $father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$father_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
				    
					if(!empty($userFileName)){
					    $userFileName=$userFileName;
					}else{ 
					$userFileName=$old_father_pic; 
					}
                    }else{ $userFileName=$old_father_pic;  }
				   //echo $flogin; 
				
				//Mother Details
				    $mid=$this->input->post('mid');
				    $mname=$this->input->post('mname');
					$moccupation=$this->input->post('moccupation');
					$mincome=$this->input->post('mincome');
					$mhaddress=$this->input->post('mhaddress');
					$mpemail=$this->input->post('mpemail');
					$msemail=$this->input->post('msemail');
					$mpmobile=$this->input->post('mpmobile');
					$msmobile=$this->input->post('msmobile');
					$mhome_phone=$this->input->post('mhome_phone');
				    $moffice_address=$this->input->post('moffice_address');
					$moffice_phone=$this->input->post('moffice_phone');
				    $mrelationship=$this->input->post('mrelationship');
					$mstatus=$this->input->post('mstatus');
					$mlogin=$this->input->post('mlogin');
					$old_mother_pic=$this->input->post('old_mother_pic');

					 if(!empty($_FILES["mother_pic"]["name"])){
						$mother_pic = $_FILES["mother_pic"]["name"];	
						$userFileName1 =$mother_pic;
						$uploaddir1 = 'assets/parents/';
						$profilepic1 = $uploaddir1.$userFileName1;
						move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					 if(!empty($userFileName1)){ 
					     $userFileName1=$userFileName1; }else{ $userFileName1=$old_mother_pic; }
					 }else{ $userFileName1=$old_mother_pic; }

				// Guardian Details
				    $gid=$this->input->post('gid');
				    $gname=$this->input->post('gname');
					$goccupation=$this->input->post('goccupation');
					$gincome=$this->input->post('gincome');
					$ghaddress=$this->input->post('ghaddress');
					$gpemail=$this->input->post('gpemail');
					$gsemail=$this->input->post('gsemail');
					$gpmobile=$this->input->post('gpmobile');
					$gsmobile=$this->input->post('gsmobile');
					$ghome_phone=$this->input->post('ghome_phone');
				    $goffice_address=$this->input->post('goffice_address');
					$goffice_phone=$this->input->post('goffice_phone');
				    $grelationship=$this->input->post('grelationship');
					$gstatus=$this->input->post('gstatus');
					$glogin=$this->input->post('glogin');
					$old_guardian_pic=$this->input->post('old_guardian_pic');
					
					//$guardn_pic = $_FILES["guardian_pic"]["name"];
					
					 if(!empty($_FILES["guardian_pic"]["name"])){
						$guardn_pic = $_FILES["guardian_pic"]["name"];
						$userFileName2 =$guardn_pic;
						$uploaddir2 = 'assets/parents/';
						$profilepic2 = $uploaddir2.$userFileName2;
						move_uploaded_file($_FILES['guardian_pic']['tmp_name'], $profilepic2);
					if(!empty($userFileName2)){ $userFileName2=$userFileName2;	}else{ $userFileName2=$old_guardian_pic; }
					 }else{ $userFileName2=$old_guardian_pic; }
						//echo $fname; echo $gname; 
	$datas=$this->parentsmodel->update_parents_details($stu_name,$admission_id,$morestu,$newstu,$oldstu,$flogin,$fid,$fname,$foccupation,$fincome,$fhaddress,$fpemail,$fsemail,$fpmobile,$fsmobile,$fhome_phone,$foffice_address,$foffice_phone,$frelationship,$fstatus,$userFileName,$mlogin,$mid,$mname,$moccupation,$mincome,$mhaddress,$mpemail,$msemail,$mpmobile,$msmobile,$mhome_phone,$moffice_address,$moffice_phone,$mrelationship,$mstatus,$userFileName1,$glogin,$gid,$gname,$goccupation,$gincome,$ghaddress,$gpemail,$gsemail,$gpmobile,$gsmobile,$ghome_phone,$goffice_address,$goffice_phone,$grelationship,$gstatus,$userFileName2,$user_id);
		//print_r($datas['status']);exit;
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('parents/view');
			}else{
				$this->session->set_flashdata('msg', 'Failed to Add');
				redirect('parents/view');
				}
		   }
		 else{
			redirect('/');
		 }
		}
		
		
		public function update_exiting_parents()
		{
			$datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
		 	if($user_type==1)
			{
				    //$admission_id=$this->input->post('admission_no');
					$morestu=$this->input->post('morestu');
					$newstu=$this->input->post('newstu');
					$oldstu=$this->input->post('oldstu');
                     //echo $oldstu; echo'<br>'; echo $newstu; echo'<br>';echo $morestu;  echo'<br>'; exit;
					//Father Details
					$fid=$this->input->post('fid');
					$fname=$this->input->post('fname');
					$foccupation=$this->input->post('foccupation');
					$fincome=$this->input->post('fincome');
					$fhaddress=$this->input->post('fhaddress');
					$fpemail=$this->input->post('fpemail');
					$fsemail=$this->input->post('fsemail');
					$fpmobile=$this->input->post('fpmobile');
					$fsmobile=$this->input->post('fsmobile');
					$fhome_phone=$this->input->post('fhome_phone');
				    $foffice_address=$this->input->post('foffice_address');
					$foffice_phone=$this->input->post('foffice_phone');
				    $frelationship=$this->input->post('frelationship');
					$fstatus=$this->input->post('fstatus');
					$flogin=$this->input->post('flogin');
					
					$old_father_pic=$this->input->post('old_father_pic');
					//$father_pic = $_FILES["father_pic"]["name"];
					
					
				   if(!empty( $_FILES["father_pic"]["name"])){ 
				    $father_pic = $_FILES["father_pic"]["name"];
				    $userFileName =$father_pic;
				    $uploaddir = 'assets/parents/';
				    $profilepic = $uploaddir.$userFileName;
				    move_uploaded_file($_FILES['father_pic']['tmp_name'], $profilepic);
					}else{ 
					$userFileName=$old_father_pic; 
					}
				   //echo $flogin; 
				
				//Mother Details
				    $mid=$this->input->post('mid');
				    $mname=$this->input->post('mname');
					$moccupation=$this->input->post('moccupation');
					$mincome=$this->input->post('mincome');
					$mhaddress=$this->input->post('mhaddress');
					$mpemail=$this->input->post('mpemail');
					$msemail=$this->input->post('msemail');
					$mpmobile=$this->input->post('mpmobile');
					$msmobile=$this->input->post('msmobile');
					$mhome_phone=$this->input->post('mhome_phone');
				    $moffice_address=$this->input->post('moffice_address');
					$moffice_phone=$this->input->post('moffice_phone');
				    $mrelationship=$this->input->post('mrelationship');
					$mstatus=$this->input->post('mstatus');
					$mlogin=$this->input->post('mlogin');
					$old_mother_pic=$this->input->post('old_mother_pic');
                    //$mother_pic=$_FILES["mother_pic"]["name"];	
					
					if(!empty($_FILES["mother_pic"]["name"]))
					{
						$mother_pic = $_FILES["mother_pic"]["name"];	
						$userFileName1 =$mother_pic;
						$uploaddir1 = 'assets/parents/';
						$profilepic1 = $uploaddir1.$userFileName1;
						move_uploaded_file($_FILES['mother_pic']['tmp_name'], $profilepic1);
					   }else{ $userFileName1=$old_mother_pic; }

				// Guardian Details
				    $gid=$this->input->post('gid');
				    $gname=$this->input->post('gname');
					$goccupation=$this->input->post('goccupation');
					$gincome=$this->input->post('gincome');
					$ghaddress=$this->input->post('ghaddress');
					$gpemail=$this->input->post('gpemail');
					$gsemail=$this->input->post('gsemail');
					$gpmobile=$this->input->post('gpmobile');
					$gsmobile=$this->input->post('gsmobile');
					$ghome_phone=$this->input->post('ghome_phone');
				    $goffice_address=$this->input->post('goffice_address');
					$goffice_phone=$this->input->post('goffice_phone');
				    $grelationship=$this->input->post('grelationship');
					$gstatus=$this->input->post('gstatus');
					$glogin=$this->input->post('glogin');
					$old_guardian_pic=$this->input->post('old_guardian_pic');
					
					//$guardn_pic = $_FILES["guardian_pic"]["name"];
					
					if(!empty($_FILES["guardian_pic"]["name"])){
						$guardn_pic = $_FILES["guardian_pic"]["name"];
						$userFileName2 =$guardn_pic;
						$uploaddir2 = 'assets/parents/';
						$profilepic2 = $uploaddir2.$userFileName2;
						move_uploaded_file($_FILES['guardian_pic']['tmp_name'], $profilepic2);
						}else{ $userFileName2=$old_guardian_pic; }	
						
						//echo $fname; echo $gname; 
						
	$datas=$this->parentsmodel->update_exiting_parents_details($morestu,$newstu,$oldstu,$flogin,$fid,$fname,$foccupation,$fincome,$fhaddress,$fpemail,$fsemail,$fpmobile,$fsmobile,$fhome_phone,$foffice_address,$foffice_phone,$frelationship,$fstatus,$userFileName,$mlogin,$mid,$mname,$moccupation,$mincome,$mhaddress,$mpemail,$msemail,$mpmobile,$msmobile,$mhome_phone,$moffice_address,$moffice_phone,$mrelationship,$mstatus,$userFileName1,$glogin,$gid,$gname,$goccupation,$gincome,$ghaddress,$gpemail,$gsemail,$gpmobile,$gsmobile,$ghome_phone,$goffice_address,$goffice_phone,$grelationship,$gstatus,$userFileName2,$user_id);

			//print_r($datas['status']);exit;
				if($datas['status']=="success")
				{
					$this->session->set_flashdata('msg','Added Successfully');
					redirect('parents/view');
				}
				else 
					if($datas['status']=="MNAE")
				      {
							$this->session->set_flashdata('msg', 'Mobile Number Already Exist');
							redirect('parents/view');
				      }
					   else
					   {
							$this->session->set_flashdata('msg', 'Failed to Add');
							redirect('parents/view');
				       }
			   }
			 else
			 {
					redirect('/');
			 }
			
		}
		
		public function search()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 if($user_type==1)
			 {
				$cell=$this->input->post('cell');
				$admission_id=$this->input->post('admission_no');
				
				$datas['newstu']=$admission_id;
				$datas['stuname']=$this->parentsmodel->get_stu_name($admission_id);
				$datas['editres']=$this->parentsmodel->search_parent($cell);
			   //echo'<pre>'; print_r($datas['stuname']);exit;
                $user_type=$this->session->userdata('user_type');
					if($user_type==1)
					{
					 $this->load->view('header');
					 $this->load->view('parents/add_exist',$datas);
					 $this->load->view('footer');
					 }
					 else{
							redirect('/');
					 }
			 }
			
		}
		
		   		public function checkrelation()
				{
					$relation = $this->input->post('relation');
					$stuid = $this->input->post('aid');
					$numrows1 = $this->parentsmodel->get_relation($relation,$stuid);
					if ($numrows1>0) 
				     {
						echo "Relation already Added";
					 } 
					else 
					 {
						echo "Available To Add";
					 }
					
				}					
			   public function checker() 
                {
					$email = $this->input->post('email');
					$numrows = $this->parentsmodel->getData($email);
					if ($numrows>0) 
				     {
						echo "Email Id already Exit";
					 } 
					else 
					 {
						echo "Email Id Available";
					 }
                }
  
              public function cellchecker()
			  {
				    $cell = $this->input->post('cell');
					$numrows1 = $this->parentsmodel->checkcellnum($cell);
					if ($numrows1!='') 
				     {
						echo "Mobile Number Available";
					 } 
					else 
					 {
						echo "Mobile Number Not Found";
					 }
			  }
			  
			  public function cellchecker1()
			  {
				    $cell = $this->input->post('cell');
					$numrows1 = $this->parentsmodel->checkcellnum($cell);
					if($numrows1>0) 
				     {
						echo "Mobile Number Not Found";
					 } 
					else 
					 {
						echo "Mobile Number Available";
					 }
			  }
	
	
		       



}
