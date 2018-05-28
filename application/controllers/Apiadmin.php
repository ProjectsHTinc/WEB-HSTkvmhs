<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apiadmin extends CI_Controller {

	function __construct() {
		 parent::__construct();

		 	$this->load->model('apiadminmodel');
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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
			public function index()
			{
				$this->load->view('welcome_message');
			}




			public function checkMethod()
			{
				if($_SERVER['REQUEST_METHOD'] != 'POST')
				{
					$res = array();
					$res["scode"] = 203;
					$res["message"] = "Request Method not supported";

					echo json_encode($res);
					return FALSE;
				}
				return TRUE;
			}

		// GET ALL CLASS

			public function get_all_classes()
			{

				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				 $user_id=$this->input->post('user_id');
				$data['result']=$this->apiadminmodel->get_classes($user_id);
				$response = $data['result'];
				echo json_encode($response);
			}


			// GET SECTION

			public function get_all_sections()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				  $class_id=$this->input->post('class_id');


				$data['result']=$this->apiadminmodel->get_all_sections($class_id);
				$response = $data['result'];
				echo json_encode($response);
			}

			// GET ALL STUDENTS IN CLASSES

			public function get_all_students_in_classes()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG  ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				  $class_id=$this->input->post('class_id');
					$section_id=$this->input->post('section_id');


				$data['result']=$this->apiadminmodel->get_all_students_in_classes($class_id,$section_id);
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET ALL STUDENTS DETAILS

			public function get_student_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				   $student_id=$this->input->post('student_id');
				  
				$data['result']=$this->apiadminmodel->get_student_details($student_id);
				$response = $data['result'];
				echo json_encode($response);
			}


			// GET ALL HOMEWORK DETAILS

			public function get_all_howework_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG  ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
					$student_id=$this->input->post('student_id');



				$data['result']=$this->apiadminmodel->get_all_howework_details($student_id);
				$response = $data['result'];
				echo json_encode($response);
			}

			// GET ALL HOMEWORK DETAILS

			public function get_howework_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG  ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
					$hw_id=$this->input->post('hw_id');

				$data['result']=$this->apiadminmodel->get_howework_details($hw_id);
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET ALL CLASSTEST DETAILS

			public function get_all_classtest_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG  ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
					$student_id=$this->input->post('student_id');



				$data['result']=$this->apiadminmodel->get_all_classtest_details($student_id);
				$response = $data['result'];
				echo json_encode($response);
			}


			// GET ALL CLASSTEST  DETAILS

			public function get_classtest_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				$hw_id=$this->input->post('ct_id');
				$data['result']=$this->apiadminmodel->get_classtest_details($hw_id);
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET ALL EXAM  DETAILS

			public function get_all_exam_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}

				$data['result']=$this->apiadminmodel->get_all_exam_details();
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET ALL INDIVIDUAL EXAM  DETAILS

			public function get_exam_details()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				$student_id=$this->input->post('student_id');
				$exam_id=$this->input->post('exam_id');
				$data['result']=$this->apiadminmodel->get_exam_details($student_id,$exam_id);
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET ALL TEACHERS

			public function get_all_teachers()
			{
				$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}

				$data['result']=$this->apiadminmodel->get_all_teachers();
				$response = $data['result'];
				echo json_encode($response);
			}



			// GET  TEACHER DETAIlS

			public function get_teacher()
			{
				 $_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}

				echo $teacher_id=$this->input->post('teacher_id');
				$data['result']=$this->apiadminmodel->get_teacher($teacher_id);
				$response = $data['result'];
				echo json_encode($response);
			}


			// GET  TEACHER CLASS DETAIlS
			public function get_teacher_class_details()
			{
			 $_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				$teacher_id=$this->input->post('teacher_id');
				$data['result']=$this->apiadminmodel->get_teacher_class_details($teacher_id);
				$response = $data['result'];

		    echo json_encode($response);
			}



			// GET  LIST OF PARENTS
			public function get_list_of_parents()
			{
			
	    		$_POST = json_decode(file_get_contents("php://input"), TRUE);

				if(!$this->checkMethod())
				{
					return FALSE;
				}

				if($_POST == FALSE)
				{
					$res = array();
					$res["opn"] = "SOMETHING WENT WRONG ";
					$res["scode"] = 204;
					$res["message"] = "Input error";

					echo json_encode($res);
					return;
				}
				$class_id=$this->input->post('class_id');
				$section_id=$this->input->post('section_id');
				$data['result']=$this->apiadminmodel->get_list_of_parents($class_id,$section_id);
				$response = $data['result'];
				echo json_encode($response);
			}



					// GET  PARENT DETAILS
					public function get_parent_details()
					{
					    
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}
					 	  $admission_id=$this->input->post('admission_id');
					 	
						$data['result']=$this->apiadminmodel->get_parent_details($admission_id);
					$response = $data['result'];
	               // print_r($response);
					echo json_encode($response);
					}



                    						// GET  PARENT DETAILS
						public function get_parent_student_list()
						{
							$_POST = json_decode(file_get_contents("php://input"), TRUE);

							if(!$this->checkMethod())
							{
								return FALSE;
							}

							if($_POST == FALSE)
							{
								$res = array();
								$res["opn"] = "SOMETHING WENT WRONG ";
								$res["scode"] = 204;
								$res["message"] = "Input error";

								echo json_encode($res);
								return;
							}
						 	$parent_id=$this->input->post('parent_id');
							$data['result']=$this->apiadminmodel->get_parent_student_list($parent_id);
							$response = $data['result'];
							echo json_encode($response);
						}

					// GET  LIST OF TEACHER FOR A CLASS
					public function list_of_teachers_for_class()
					{
						$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}
						$class_id=$this->input->post('class_id');
						$section_id=$this->input->post('section_id');
						$data['result']=$this->apiadminmodel->list_of_teachers_for_class($class_id,$section_id);
						$response = $data['result'];
						echo json_encode($response);
					}





						// GET  LIST OF EXAM FOR A CLASS
						public function list_of_exams_class()
						{
							$_POST = json_decode(file_get_contents("php://input"), TRUE);

							if(!$this->checkMethod())
							{
								return FALSE;
							}

							if($_POST == FALSE)
							{
								$res = array();
								$res["opn"] = "SOMETHING WENT WRONG ";
								$res["scode"] = 204;
								$res["message"] = "Input error";

								echo json_encode($res);
								return;
							}
							$class_id=$this->input->post('class_id');
							$section_id=$this->input->post('section_id');
							$data['result']=$this->apiadminmodel->list_of_exams_class($class_id,$section_id);
							$response = $data['result'];
							echo json_encode($response);
						}



				// GET  Timetable FOR A CLASS
				public function get_timetable_for_class()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$class_id=$this->input->post('class_id');
					$section_id=$this->input->post('section_id');
					$data['result']=$this->apiadminmodel->get_timetable_for_class($class_id,$section_id);
					$response = $data['result'];
					echo json_encode($response);
				}


				// GET  FEES MASTER FOR A CLASS
				public function get_fees_master_class()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$class_id=$this->input->post('class_id');
					$section_id=$this->input->post('section_id');
					$data['result']=$this->apiadminmodel->get_fees_master_class($class_id,$section_id);
					$response = $data['result'];
					echo json_encode($response);
				}


				// GET  FEES MASTER FOR A CLASS
				public function get_fees_details()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$fees_id=$this->input->post('fees_id');
					$data['result']=$this->apiadminmodel->get_fees_details($fees_id);
					$response = $data['result'];
					echo json_encode($response);
				}


				// GET  FEES STATUS FOR A CLASS
				public function get_fees_status()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$class_id=$this->input->post('class_id');
					$section_id=$this->input->post('section_id');
					$fees_id=$this->input->post('fees_id');
					$data['result']=$this->apiadminmodel->get_fees_status($class_id,$section_id,$fees_id);
					$response = $data['result'];
					echo json_encode($response);
				}



				// GET  LIST OF EXAM  FOR A CLASS
				public function get_list_exam_class()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$class_id=$this->input->post('class_id');
					$section_id=$this->input->post('section_id');

					$data['result']=$this->apiadminmodel->get_list_exam_class($class_id,$section_id);
					$response = $data['result'];
					echo json_encode($response);
				}



				// GET   EXAM  DETAILS FOR A CLASS
				public function get_exam_details_class()
				{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

					if(!$this->checkMethod())
					{
						return FALSE;
					}

					if($_POST == FALSE)
					{
						$res = array();
						$res["opn"] = "SOMETHING WENT WRONG ";
						$res["scode"] = 204;
						$res["message"] = "Input error";

						echo json_encode($res);
						return;
					}
					$exam_id=$this->input->post('exam_id');
					$class_id=$this->input->post('class_id');

					$data['result']=$this->apiadminmodel->get_exam_details_class($exam_id,$class_id);
					$response = $data['result'];
					echo json_encode($response);
				}




					// GET   EXAM  MARKS FOR A CLASS
					public function get_exam_marks_class()
					{
						$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}
						$exam_id=$this->input->post('exam_id');
						$class_id=$this->input->post('class_id');
						$section_id=$this->input->post('section_id');

						$data['result']=$this->apiadminmodel->get_exam_marks_class($exam_id,$class_id,$section_id);
						$response = $data['result'];
						echo json_encode($response);
					}


					// GET  TEACHERS OD VIEW
					public function get_teachers_od_view()
					{
					$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}

						$user_id=$this->input->post('user_id');
						$data['result']=$this->apiadminmodel->get_teachers_od_view($user_id);
						$response = $data['result'];
						echo json_encode($response);
					}


					// GET  STUDENTS OD VIEW
					public function get_students_od_view()
					{
						$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}

						$user_id=$this->input->post('user_id');
						$data['result']=$this->apiadminmodel->get_students_od_view($user_id);
						$response = $data['result'];
						echo json_encode($response);
					}



					// GET  TEACHERS LEAVE
					public function get_teachers_leaves()
					{
						$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}

						$user_id=$this->input->post('user_id');
						$data['result']=$this->apiadminmodel->get_teachers_leaves($user_id);
						$response = $data['result'];
						echo json_encode($response);
					}

					// GET ALL Cricular 
					public function get_all_circular_view()
					{
						$_POST = json_decode(file_get_contents("php://input"), TRUE);

						if(!$this->checkMethod())
						{
							return FALSE;
						}

						if($_POST == FALSE)
						{
							$res = array();
							$res["opn"] = "SOMETHING WENT WRONG ";
							$res["scode"] = 204;
							$res["message"] = "Input error";

							echo json_encode($res);
							return;
						}

						$user_id=$this->input->post('user_id');
						$data['result']=$this->apiadminmodel->get_all_circular_view($user_id);
						$response = $data['result'];
						echo json_encode($response);
					}



}
