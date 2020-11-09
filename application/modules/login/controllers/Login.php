<?php
class Login extends BaseController {

    public function __construct() {
        parent::__construct();
       // dd($_SESSION);
//        if(!isAdmin()) {
//            redirect(url('admin/login'));
//        }
        $this->setLayout('layout/login');
    }

    public function index() {
        if($this->isAjaxRequest()) {
            $this->request = $this->xss_clean($this->input->post());
            if($this->user->login($this->request['email'], $this->request['password'])) {
                if(!empty($this->request['remember'])) {
                    setcookie ("remember_me",$this->request['remember'],time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["remember_me"])) {
                        setcookie ("remember_me","");
                    }
                }
                if($this->user->getRoleId() == 1) {
                    setSession('isAdmin', true);
                } else {
                    setSession('isAdmin', true);
                }
                setSession('loggedIn', true);
                setSession('userId', $this->user->getId());
                setSession('userEmail', $this->user->getEmail());
                setSession('username', $this->user->getEmail());
                setSession('userLastLogin', '');

                $this->json['success']  = 'Successfully Login';
                $this->json['redirect'] = url('profile');
            } else {
                $this->json['error']    = 'No match for Username and/or Password.';
                $this->json['redirect'] = url('admin/login');
            }

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
        $this->data['route'] = url('login');
        $this->data['form'] = 'frmLogin';
        $this->data['title'] = 'Admin Panel';

        render('index', $this->data);
    }

    public function doLogin() {

    }
    public function logout() {
        $this->user->logout();
        redirect('admin');
    }
}