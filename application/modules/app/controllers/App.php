<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App extends AppController {

    private $project;
    /**
     * @var object
     */
    private $handbook;
    /**
     * @var array|int
     */
    private $handbooks;
    /**
     * @var array|int
     */
    private $projects;

    public function __construct()
    {
        parent::__construct();
        $this->setLayout('layout/app');

        $this->init();
    }

//    public function init() {
//        $this->data['registerForm'] = array(
//            'action' => url('app-register'),
//            'name' => 'frmRegister'
//        );
//        $this->data['loginForm'] = array(
//            'action' => url('app-login'),
//            'name' => 'frmLogin'
//        );
//    }
//    public function getImgThumbnail($projectId) {
//        if(ProjectImage_model::factory()->findOne(['project_id' => $projectId, 'thumbnail' => 1])) {
//            return ProjectImage_model::factory()->findOne(['project_id' => $projectId, 'thumbnail' => 1])->image;
//        }
//        return false;
//    }
    public function index() {
        // Features Project List
        $this->projects = Project_model::factory()->findAll(['status' => 1], 5,'created_at', 'ASC');
        if($this->projects) {
            foreach ($this->projects as $project) {
                $this->data['projects'][] = array(
                    'name'  => $project->name,
                    'url'   => url('p/'.$project->slug),
                    'img'   => resize($this->getImgThumbnail($project->id),603,392),
                    'price' => currencyFormat($project->price, getSession('currency')['code']),
                    'fit'   => currencyFormat($project->fit, getSession('currency')['code']),
                    'fit1'  =>currencyFormat($project->fit1, getSession('currency')['code'],'',true, false, false),
                    'fit2'  => currencyFormat($project->fit2, getSession('currency')['code'],'',true, false, false),
                );
            }
        }
        // Handbooks
        $this->handbooks = Handbook_model::factory()->findAll(['status' => 1], 4,'RAND()', 'desc');
        $this->data['handbooks'] = array();
        if($this->handbooks) {
            foreach ($this->handbooks as $handbook) {
                $this->data['handbooks'][] = array(
                    'id'      => $handbook->id,
                    'img'     => resizeAssetImage($handbook->handbook_type.'.png',360,298),
                    'name'    => $handbook->name,
                    'slug'    => $handbook->slug,
                    'url'   => url('foreigner-handbook/'.$handbook->slug)

                );
            }
        }
        render('index', $this->data);
    }

    public function features() {
        $this->projects = Project_model::factory()->findAll(['status' => 1], null,'name', 'ASC');
        if($this->projects) {
            foreach ($this->projects as $project) {
                $this->data['projects'][] = array(
                    'name'  => $project->name,
                    'url'   => url('p/'.$project->slug),
                    'img'   => resize($this->getImgThumbnail($project->id),603,392),
                    'price' => currencyFormat($project->price, getSession('currency')['code']),
                    'fit'   => currencyFormat($project->fit, getSession('currency')['code']),
                    'fit1'  =>currencyFormat($project->fit1, getSession('currency')['code'],'',true, false, false),
                    'fit2'  => currencyFormat($project->fit2, getSession('currency')['code'],'',true, false, false),
                );
            }
        }
        render('features/index', $this->data);
    }
    /**
     * @desc View Project
     * @param $slug
     */
    public function view($slug) {
        $project = Project_model::factory()->findOne(['slug' => $slug]);
        if(!$project) {
            redirect(url('/'));
        }
        $this->data['project'] = array(
            'id'      => $project->id,
            'name'      => $project->name,
            'images'    => $project->images($project->id),
            'price'     => currencyFormat($project->price, getSession('currency')['code']),
            'fit'       => currencyFormat($project->fit, getSession('currency')['code']),
            'fit1'      => currencyFormat($project->fit1, getSession('currency')['code'],'',true, false, false),
            'fit2'      => currencyFormat($project->fit2, getSession('currency')['code'],'',true, false, false),
            'description'  => $project->description->long_description,
            'snapshot'  => $project->description->snapshot,
            'features'  => $project->description->features,
            'subProjects'  => $project->subProjects,
        );
        $images = array();
        $this->data['sliderImages'] = array();
        $images  = $project->images($project->id);
        if(count($images) > 0) {
            foreach ($images as $image) {
                $this->data['sliderImages'][] = resize($image['image'],1024,768);
            }
        }
        //dd( $this->data['sliderImages']);
        render('view', $this->data);
    }

    public function fetchSubProject() {
        if($this->isAjaxRequest()) {
            $project = ProjectSub_model::factory()->findOne($this->input->post('sub_project_id'));
            $this->data['project'] = $project;
            $this->json['success'] = true;
           // dd($this->setOutput($this->load->view('partials/f_slider', $this->data)));
            //$this->json['body'] =
            return $this->response->setOutput($this->load->view('partials/f_slider', $this->data));
//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(200)
//                ->set_output(json_encode($this->json));
        }
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

    public function agents() {
        $users = GroupAgent_model::factory()->find()->where('group_id', 2)->get()->result();
        $userIds = array();
        if(count($users) > 0) {
            foreach ($users as $user) {
                $userIds[] = $user->agent_id;
            }
        }
        $agents = Agent_model::factory()->findAll(['id' => $userIds, 'status' => 1],null,'id', 'asc');
        $this->data['agents'] = array();
        if($agents) {
            foreach ($agents as $agent) {
                $this->data['agents'][] = array(
                    'name'  => $agent->firstname.' '.$agent->lastname,
                    'email' => $agent->email,
                    'phone' => $agent->phone,
                    'img'   => resize($agent->image,151,77),
                );
            }
        }
        //dd($this->data);
        render('agents/index', $this->data);
    }
    public function compare() {
        $projects = Project_model::factory()->findAll(['status' => 1], 5,'name', 'ASC');
        $this->data['projects'] = array();
        if($projects) {
            $this->data['projects'] = $projects;
        }
        render('compare', $this->data);
    }

    public function foreignerHandbooks() {
        $handbooks = Handbook_model::factory()->findAll(['status' => 1], null,'sort_order', 'asc');
        $this->data['handbooks'] = array();
        if($handbooks) {
            foreach ($handbooks as $handbook) {
                $this->data['handbooks'][] = array(
                  'id'      => $handbook->id,
                  'img'     => resizeAssetImage($handbook->handbook_type.'.png',360,298),
                  'name'    => $handbook->name,
                  'slug'    => $handbook->slug,
                    'url'   => url('foreigner-handbook/'.$handbook->slug)

                );
            }
        }
        //dd($this->data);
        render('foreigner-handbook/index', $this->data);
    }
    public function foreignerHandbook($slug) {
        $this->handbook = Handbook_model::factory()->findOne(['slug' => $slug]);
        if(!$this->handbook) {
            redirect(url('foreigner-handbook'));
        }
        $this->data['handbook'] = array();
        if($this->handbook) {
            $this->data['handbook'] = array(
                'id'                => $this->handbook->id,
                'img'               => resizeAssetImage($this->handbook->handbook_type.'.png',360,298),
                'name'              => $this->handbook->name,
                'small_description' => $this->handbook->description->small_description,
                'long_description'  => $this->handbook->description->long_description,
            );
        }
        // List of handbook escape current handbook
        $this->handbooks = Handbook_model::factory()->findAll(['status' => 1], null,'sort_order', 'asc');
        $this->data['handbooks'] = array();
        if($this->handbooks) {
            foreach ($this->handbooks as $handbook) {
                if($this->handbook->id != $handbook->id) {
                    $this->data['handbooks'][] = array(
                        'id'      => $handbook->id,
                        'img'     => resizeAssetImage($handbook->handbook_type.'.png',360,298),
                        'name'    => $handbook->name,
                        'slug'    => $handbook->slug,
                        'url'   => url('foreigner-handbook/'.$handbook->slug)

                    );
                }
            }
        }
        //dd($this->data);
        render('foreigner-handbook/view', $this->data);
    }
}