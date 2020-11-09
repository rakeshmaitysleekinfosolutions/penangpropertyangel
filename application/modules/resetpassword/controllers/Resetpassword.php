<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword extends AdminController {
    /**
     * @var mixed
     */
    private $old;
    /**
     * @var mixed
     */
    private $password;
    
    public function __construct()
    {
        parent::__construct();
        if(!isAdmin()) {
            redirect(url('admin/'));
        }
    }
    public function init() {
        $this->data['heading']          = 'Password Management';
        $this->data['entryOldPassword'] = 'Old Password';
        $this->data['entryPassword']    = 'Password';
        $this->data['entryConfirmPassword']    = 'Confirm Password';

        $this->data['form']             = array(
            'id'    => 'frmResetPassword',
            'name'  => 'frmResetPassword',
        );

        $this->data['salt'] = token(9);

        if (!empty($this->input->post('password'))) {
            $this->data['password'] = sha1($this->data['salt'] . sha1($this->data['salt'] . sha1($this->input->post('password'))));
            $this->data['origi'] = $this->input->post('password');
        } else {
            $this->data['password'] = '';
            $this->data['origi'] = '';
        }

    }
    public function index() {
        $this->init();
        $this->data['title'] = 'Reset Password';
        $this->data['route'] = url('resetpassword/update');
        render('index', $this->data);
    }

    public function update() {
        try {
            $this->init();
            if($this->isAjaxRequest()) {

                $this->old      = ($this->input->post('old')) ? $this->input->post('old') : '';
                $this->password = ($this->input->post('password')) ? $this->input->post('password') : '';



                if(!$this->user->getUserByPassword($this->old)) {
                    $this->json['error'] = "Invalid old password, please provide correct password";
                } else {
                    Agent_model::factory()->update([
                        'salt'      => $this->data['salt'],
                        'password'  => $this->data['password'],
                    ],['id' => userId()]);
                    $this->json['success'] = "Password has been successfully updated";
                    $this->user->logout();
                    $this->json['redirect'] = url('admin');
                }
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


}