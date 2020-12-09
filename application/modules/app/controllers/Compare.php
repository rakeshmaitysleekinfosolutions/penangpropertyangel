<?php
class Compare extends AppController {
    public function __construct()
    {
        parent::__construct();
        $this->setLayout('layout/app');
    }

    public function index() {

        //unsetSession('compare1');
       // session_destroy();
        $projects = Project_model::factory()->findAll(['status' => 1], 5,'name', 'ASC');
        $this->data['projects'] = array();
        if($projects) {
            $this->data['projects'] = $projects;
        }
        // Compare First dropdown
        $compare = getSession('compare1');
        $project = array();
        if($compare) {
            $project = Project_model::factory()->findOne($compare);
        }
        $this->data['compare1'] = array();
        if($project) {
            $this->data['compare1'] = array(
                'id'            => $project->id,
                'name'          => $project->name,
                'url'           => url('p/'.$project->slug),
                'img'           => resize($this->getImgThumbnail($project->id),325,211),
                'price'         => currencyFormat($project->price, getSession('currency')['code']),
                'fit'           => currencyFormat($project->fit, getSession('currency')['code']),
                'fit1'          => currencyFormat($project->fit1, getSession('currency')['code'],'',true, false, false),
                'fit2'          => currencyFormat($project->fit2, getSession('currency')['code'],'',true, false, false),
                'description'   => $project->description->long_description,
                'snapshot'      => $project->description->snapshot,
                'features'      => $project->description->features,
            );
        }
        // Compare Second dropdown
        $compare2 = getSession('compare2');
        $project2 = array();
        if($compare2) {
            $project2 = Project_model::factory()->findOne($compare2);
        }
        $this->data['compare2'] = array();
        if($project2) {
            $this->data['compare2'] = array(
                'id'            => $project2->id,
                'name'          => $project2->name,
                'url'           => url('p/'.$project2->slug),
                'img'           => resize($this->getImgThumbnail($project2->id),325,211),
                'price'         => currencyFormat($project2->price, getSession('currency')['code']),
                'fit'           => currencyFormat($project2->fit, getSession('currency')['code']),
                'fit1'          => currencyFormat($project2->fit1, getSession('currency')['code'],'',true, false, false),
                'fit2'          => currencyFormat($project2->fit2, getSession('currency')['code'],'',true, false, false),
                'description'   => $project2->description->long_description,
                'snapshot'      => $project2->description->snapshot,
                'features'      => $project2->description->features,
            );
        }
        // Compare Third dropdown
        $compare3 = getSession('compare3');
        $project3 = array();
        if($compare3) {
            $project3 = Project_model::factory()->findOne($compare3);
        }
        $this->data['compare3'] = array();
        if($project3) {
            $this->data['compare3'] = array(
                'id'            => $project3->id,
                'name'          => $project3->name,
                'url'           => url('p/'.$project3->slug),
                'img'           => resize($this->getImgThumbnail($project3->id),325,211),
                'price'         => currencyFormat($project3->price, getSession('currency')['code']),
                'fit'           => currencyFormat($project3->fit, getSession('currency')['code']),
                'fit1'          => currencyFormat($project3->fit1, getSession('currency')['code'],'',true, false, false),
                'fit2'          => currencyFormat($project3->fit2, getSession('currency')['code'],'',true, false, false),
                'description'   => $project3->description->long_description,
                'snapshot'      => $project3->description->snapshot,
                'features'      => $project3->description->features,
            );
        }
        //dd($this->data);
        render('compare/index', $this->data);
    }

    public function add() {
        if($this->isAjaxRequest()) {
            if ($this->input->post('product_id')) {
                $product_id = $this->input->post('product_id');
            } else {
                $product_id = 0;
            }

            //dd($product_id);
            if ($this->input->post('compare')) {
                $compareKey = $this->input->post('compare');
            } else {
                $compareKey = '';
            }
            if(!getSession($compareKey)) {
                setSession($compareKey, array());
            }

            //dd(getSession($compareKey));
            $project = Project_model::factory()->findOne($product_id);
            if ($project) {
                setSession($compareKey, $project->id);
                $this->json['success'] = true;
                $this->json['redirect'] = url('/compare');
            } else{
                setSession($compareKey, $product_id);
                $this->json['success'] = true;
                $this->json['redirect'] = url('/compare');

            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
    }
}