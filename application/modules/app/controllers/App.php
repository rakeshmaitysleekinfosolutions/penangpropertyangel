<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

    public function __construct()
    {
        parent::__construct();
        $this->setLayout('layout/app');
    }

    public function init() {
        $this->data['registerForm'] = array(
            'action' => url('app-register'),
            'name' => 'frmRegister'
        );
        $this->data['loginForm'] = array(
            'action' => url('app-login'),
            'name' => 'frmLogin'
        );
    }
    public function index() {
        $this->init();
        render('index', $this->data);
    }
    public function register() {
        if($this->isAjaxRequest() && $this->isPost()) {
            $this->request = $this->xss_clean($this->input->post());
            if ((strlen(trim($this->request['firstname'])) < 1) || (strlen(trim($this->request['firstname'])) > 32)) {
                $this->json['error']['firstname'] = 'First Name must be between 1 and 32 characters!';
            }
            if ((strlen(trim($this->request['lastname'])) < 1) || (strlen(trim($this->request['lastname'])) > 32)) {
                $this->json['error']['lastname'] = 'Last Name must be between 1 and 32 characters!';
            }
            if ((strlen($this->request['email']) > 96) || !filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
                $this->json['error']['email'] = 'E-Mail Address does not appear to be valid!';
            }
            if (Agent_model::factory()->getTotalUsersByEmail($this->request['email'])) {
                $this->json['error']['warning'] = 'Email already exists!';
            }
            if ((strlen($this->request['password']) < 4) || (strlen($this->request['password']) > 20)) {
                $this->json['error']['password'] = 'Password must be between 4 and 20 characters!';
            }
            if ($this->request['confirm'] != $this->request['password']) {
                $this->json['error']['confirm'] = 'Password confirmation does not match password!';
            }
            if (!$this->input->post('agree')) {
                $this->json['error']['warning'] = 'Warning: You must agree to the %s!';
            }
            if (!$this->json) {
                $this->data['salt'] = token(9);
                Agent_model::factory()->insert([
                    'firstname' => $this->request['firstname'],
                    'lastname'  => $this->request['lastname'],
                    'email'     => $this->request['email'],
                    'salt'      => $this->data['salt'],
                    'password'  => sha1($this->data['salt'] . sha1($this->data['salt'] . sha1($this->request['password']))),
                    'status'    => 1,
                ]);
                $agentId = Agent_model::factory()->getLastInsertID();
                GroupAgent_model::factory()->insert([
                    'agent_id' => $agentId,
                    'group_id' => 3,
                ]);
                // Clear any previous login attempts for unregistered accounts.
                Agent_model::factory()->deleteLoginAttempts($this->request['email']);
                // Login
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

                $this->json['success']          = 'Registration has been successfully';
                $this->json['redirect'] 		= url('/');
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode('send a post request'));
    }
    public function login() {
        if($this->isAjaxRequest() && $this->isPost()) {
            $this->request = $this->xss_clean($this->input->post());
            if($this->user->login($this->request['email'], $this->request['password'])) {
                if(!empty($this->request['remember'])) {
                    setcookie("remember_me",$this->request['remember'],time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["remember_me"])) {
                        setcookie("remember_me","");
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
                $this->json['redirect'] = url('/');
            } else {
                $this->json['error']['warning']    = 'No match for Username and/or Password.';
                $this->json['redirect'] = url('login');
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode('send a post request'));
    }
    public function logout() {
        unsetSession('loggedIn');
        unsetSession('userId');
        unsetSession('userEmail');
        unsetSession('userName');
        unsetSession('userLastLogin');
        redirect('/');
    }
}