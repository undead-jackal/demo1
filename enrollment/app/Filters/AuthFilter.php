<?php
// careers@dreamscapenetworks.com
// Web Modification Specialist
namespace App\Filters;
use CodeIgniter\Config\Services;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface {
    private $session;

    public function before(RequestInterface $request, $arguments = NULL) {
        $this->session = \Config\Services::session();
        $auth = \Config\Services::authentif();
        $uri = $request->uri;

        if ($auth->isLoggedIn()) {

          $url_for_admin = array();
          $url_for_user = array("enrollment/enroll","enrollment/result");

          if ($this->session->get("type") == 0) {
            if (!in_array($uri->getPath(), $url_for_admin)) {
              return redirect()->to('/admin');
            }
          }elseif ($this->session->get("type") == 1) {
            if (!in_array($uri->getPath(), $url_for_user)) {
              return redirect()->to('/enrollment/enroll');
            }
          }
        } else {
          if ($uri->getPath() != "/") {
            return redirect()->to('/');
          }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response,$arguments = NULL) {
    }
}

?>
