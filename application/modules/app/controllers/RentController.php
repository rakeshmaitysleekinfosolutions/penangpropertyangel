<?php
class RentController extends AppController {
    public function __construct() {
        parent::__construct();
        $this->setLayout('layout/app');
    }
    public function index() {
        $categories = Category_model::factory()->findAll(['status' => 1],null,'sort_order', 'asc');
        $this->data['categories'] = array();
        if($categories) {
            foreach ($categories as $category) {
                $this->data['categories'][] = array(
                    'name'  => $category->name,
                    'slug'  => $category->slug,
                    'img'   => resize($category->image,100,100),
                );
            }
        }
        render('rent/index', $this->data);
    }


}