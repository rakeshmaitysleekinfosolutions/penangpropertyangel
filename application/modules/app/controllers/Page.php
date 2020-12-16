<?php
class Page extends AppController {
    public function __construct() {
        parent::__construct();
        $this->setLayout('layout/app');
        $this->init();
    }
    public function index($slug) {
        $information = Page_model::factory()->findOne(['slug' => $slug]);
        if(!$information) {
            redirect(url('/page-not-found'));
        }
        //$this->dd($information);
        //$this->data['information'] = array();
        if($information) {
            $this->data['information'] = $information;
        }
        render('page/about', $this->data);
    }
    public function contact() {
        render('page/contact');
    }
}