<?php namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
class Home extends BaseController
{
	use ResponseTrait;
	protected $request;
	public function index()
	{
		$data['student'] = $this->model->getData(array(), "student");
		$this->loadLayout('content/home/index', $data, true);
	}

	public function reset(){
		if ($this->request->isAjax()) {
			$data = array("student_id" => $this->request->getPost("id"));
			$delete = $this->model->deleteData($data,"enrolled_subjects");
			return $this->respond($delete, 200);
		}

	}

	// public function reciever(){
	// 	if ($this->request->isAjax()) {
	// 		return $this->respond($this->request->getPost(), 200);
	//
	// 	}else {
	// 		return $this->respond("Error", 404);
	// 	}
	// }
	//
	//
	//  public function tableTest(){
	//     if ($this->request->isAjax()) {
	//       $params['limit'] = $this->request->getPost("per_page");
	//       $params['order'] = array('id', 'ASC');
	//       $params['offset'] = ($this->request->getPost("offset") != 0) ? ($params['limit']*$this->request->getPost("offset")):0;
	//
	//       $data = $this->model->getData($params, "names");
	//       $data_lock = count($this->model->getData(array(), "names"));
	//       $return = array(
	//         'tableReturn' => $data,
	//         'totalTable' =>ceil($data_lock / $params['limit']),
	//         'page' => $params['limit'],
	//       );
	//
	//       return $this->respond($return,200);
	//     }
	//   }

	//--------------------------------------------------------------------

}
