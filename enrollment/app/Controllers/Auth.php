<?php namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;


class Auth extends BaseController
{
  use ResponseTrait;
	protected $request;
	public function index(){
		return $this->loadLayout('content/auth/login',array(),false,false,false);
	}

  public function handleLogin(){
    if ($this->request->isAjax()) {
      $params['where'] = array(
        "username" => $this->request->getPost("username"),
        "password" => $this->request->getPost("password")
      );
      $result = $this->model->getData($params, "student")[0];
      if ($result) {
        $this->session->set('id',$result['id']);
        $this->session->set('fullname',$result['last_name'].",".$result['first_name']." " . $result['middle_name']);
        $this->session->set('type',1);
      }
      $return = array('is-logged' => true,'session' => $this->session->get());
      return $this->respond($return,200);
    }
  }

  public function logout(){
      $this->session->remove(array("id", "type","fullname"));
      return redirect()->to('/');
 }

	//--------------------------------------------------------------------

}
