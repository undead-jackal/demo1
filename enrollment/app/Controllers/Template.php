<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;

class Template extends BaseController
{
  use ResponseTrait;
  protected $request;

  public function index(){
    return $this->loadLayout('content/template/test', array(),true);
  }


}


?>
