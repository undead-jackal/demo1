<?php
namespace App\Controllers\enrollment;
use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;

class Enrollment extends BaseController
{
	use ResponseTrait;
	protected $request;

	public function index(){
		$student_params["where"] = array("id" => $this->session->get("id"));
		$data['student'] = $this->model->getData($student_params, "student")[0];
		$timeheet_params['orderBy'] = array("days","ASC	");
		$data['timesheet'] = $this->model->getData($timeheet_params, "time");

		$enroll["where"] = array("student_id" => $this->session->get("id"));
		$data["is_enrolled"] = (count($this->model->getData($enroll, "enrolled_subjects")) != 0) ? true : false ;
		$this->loadLayout('content/enrollment/index', $data);

	}

	public function studyload(){
		$enroll["where"] = array("student_id" => $this->session->get("id"));
		$is_enrolled = (count($this->model->getData($enroll, "enrolled_subjects")) != 0) ? true : false ;

		if ($is_enrolled) {
			$data['enroll'] = $this->model->getData($enroll, "enrolled_subjects")[0];
		}else {
			$data['enroll'] = false;
		}

		$this->loadLayout('content/enrollment/study', $data);
	}

	public function saveStud(){
		if ($this->request->isAjax()) {
			$data = array(
				"first_name" =>$this->request->getPost("fname") ,
			   "middle_name" =>$this->request->getPost("mname") ,
			   "last_name" =>$this->request->getPost("lname") ,
			   "bday" => $this->request->getPost("bday"),
			   "sex" => $this->request->getPost("sex"),
			   "status" => $this->request->getPost("status"),
			   "address_city" => json_encode($this->request->getPost("m_address")),
			   "address_pro" => json_encode($this->request->getPost("p_address")),
			   "email" => $this->request->getPost("email"),
			   "phone" =>$this->request->getPost("phone1")
         );
         $where = array(
           "id" => $this->session->get('id')
         );
         $update = $this->model->updateData($data,$where, "student");

			return $this->respond($update,200);
		}
	}

	public function enroll_now(){
		if ($this->request->isAjax()) {
			$subject_array = array();
			$subs = $this->request->getPost("sub");
			$time = $this->request->getPost("time");
			for ($i=0; $i < count($subs) ; $i++) {
				if ($subs[$i] != "") {
					$subs_params['where'] = array(
						'subjectschedule.subject_id' => $subs[$i],
						'subjectschedule.time_id' => $time[$i],
					);
					$subs_params['select'] = "subject.name,subject.id as sub,subject.code,subject.room,subject.requirement,subject.year,subject.unit,time.start_time,time.end_time,time.duration,time.days,time.id as time_id";
			 	  	  $subs_params['join'] = array(
			 	           array(
			 	             "table" => "subject",
			 	             "on" => "subject.id = subjectschedule.subject_id"
			 	           ),
			 	  			array(
			 	             "table" => "time",
			 	             "on" => "time.id = subjectschedule.time_id"
			 	           ),
			 	        );
			 	  	  $data = $this->model->getData($subs_params, "subjectschedule");
					array_push($subject_array,json_encode($data));
				}
			}
			$data_insert = array(
				"student_id" => $this->session->get("id"),
				"json_subjects" => json_encode($subject_array)
			);
			$insert = $this->model->insertData($data_insert,"enrolled_subjects");
			return $this->respond($insert,200);
		}
	}

	public function displaySubjects(){
		if ($this->request->isAjax()) {
		  $subs_params['limit'] = $this->request->getPost("per_page");
		  $subs_params['order'] = array('id', 'ASC');
		  $subs_params['offset'] = ($this->request->getPost("offset") != 0) ? ($params['limit']*$this->request->getPost("offset")):0;
		  $subs_params['select'] = "subject.name,subject.id as sub,subject.code,subject.room,subject.requirement,subject.year,subject.unit,time.start_time,time.end_time,time.duration,time.days,time.id as time_id";
	  	  $subs_params['join'] = array(
	           array(
	             "table" => "subject",
	             "on" => "subject.id = subjectschedule.subject_id"
	           ),
	  			array(
	             "table" => "time",
	             "on" => "time.id = subjectschedule.time_id"
	           ),
	        );
	  	  $data = $this->model->getData($subs_params, "subjectschedule");
		  $data_lock = count($this->model->getData($subs_params, "subjectschedule"));
		  $return = array(
			 'tableReturn' => $data,
			 'totalTable' =>ceil($data_lock / $subs_params['limit']),
		  );

		  return $this->respond($return,200);
		}
	}


}
