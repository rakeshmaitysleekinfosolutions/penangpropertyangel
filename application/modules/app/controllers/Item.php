<?php
class Item extends AppController {
    private $itemType;
    public function __construct() {
        parent::__construct();
        $this->setLayout('layout/app');
    }
    public function index() {
        if(!$this->uri->segment(1)) {
            redirect(url('/'));
        }
        switch ($this->uri->segment(1)) {
            case 'rent':
                $this->itemType = $this->uri->segment(1);
                break;
            case 'buy':
                $this->itemType = $this->uri->segment(1);
                break;
        }
        $categories = Category_model::factory()->findAll(['status' => 1],null,'sort_order', 'asc');
        $this->data['categories'] = array();
        if($categories) {
            foreach ($categories as $category) {
                $this->data['categories'][] = array(
                    'name'  => $category->name,
                    'slug'  => $category->slug,
                    'url'   => url($this->itemType.'/'.$category->slug),
                    'img'   => resize($category->image,360,298),
                );
            }
        }
        render('item/index', $this->data);
    }
    public function getImgThumbnail($id) {
        if(ItemImage_model::factory()->findOne(['item_id' => $id, 'thumbnail' => 1])) {
            return ItemImage_model::factory()->findOne(['item_id' => $id, 'thumbnail' => 1])->image;
        }
        return false;
    }
    public function getItems($slug) {
        switch ($this->uri->segment(1)) {
            case 'rent':
                $this->itemType = 2;
                break;
            case 'buy':
                $this->itemType = 1;
                break;
        }
        // Get Rent Category
        $rentCategory = Category_model::factory()->findOne(['slug' => $slug]);
        if(!$rentCategory) {
            redirect(url('/rent'));
        }
        // Get Bedrooms
        $bedrooms = ItemDescription_model::factory()->findAll();
        if(!empty($bedrooms)) {
            foreach ($bedrooms as $bedroom) {
                $this->data['bedrooms1'][] = $bedroom['bedroom1'];
                $this->data['bedrooms2'][] = $bedroom['bedroom2'];
            }
        }

        if($this->data['bedrooms1']) {
            $this->data['bedrooms1'] = array_unique($this->data['bedrooms1']);
        }
        if($this->data['bedrooms2']) {
            $this->data['bedrooms2'] = array_unique($this->data['bedrooms2']);
        }
        // Get States
        $this->data['states']       = State_model::factory()->findAll(['country_id' => 129],null,'id', 'asc');
        // Get Item list by rent category
        $items = Item_model::factory()->findAll(['category_id' => $rentCategory->id, 'type' => (int)$this->itemType],10,'sort_order', 'ASC');
        $this->data['items'] = array();
        if(!empty($items)) {
            foreach ($items as $item) {
                $area = round($item->area, (int)$this->options['currency']['decimal_place']);
                $this->data['items'][] = array(
                    'id'      => $item->id,
                    'title'   => $item->title,
                    'img'     => ($this->getImgThumbnail($item->id)) ? resize($this->getImgThumbnail($item->id),319,264) : resize('no_image.png',319,264),
                    'slug'    => $item->slug,
                    'url'     => url($rentCategory->slug.'/'.$item->slug),
                    'price'   => currencyFormat($item->price, $this->options['currency']['code']),
                    'area'    => number_format($area, (int)$this->options['currency']['decimal_place'], $this->config->item('decimal_point'), $this->config->item('thousand_point')).' sq.ft',
                    'images'  => $item->images($item->id)
                );
            }
        }
        $this->data['type'] = $this->itemType;
        $this->data['slug'] = $rentCategory->slug;
        render('item/list', $this->data);
    }

    public function filter() {
        if($this->isAjaxRequest()) {

            $rentCategory = Category_model::factory()->findOne(['slug' => $this->input->post('slug')]);

            $this->data['bedroom1']         = ($this->input->post('bedroom1')) ? $this->input->post('bedroom1') : '';
            $this->data['bedroom2']         = ($this->input->post('bedroom2')) ? $this->input->post('bedroom2') : '';

            $this->data['state_id']         = ($this->input->post('state_id')) ? $this->input->post('state_id') : '';
            $this->data['child_state_id']   = ($this->input->post('child_state_id')) ? $this->input->post('child_state_id') : '';

            $this->data['min_area']         = ($this->input->post('min_area')) ? $this->input->post('min_area') : '';
            $this->data['max_area']         = ($this->input->post('max_area')) ? $this->input->post('max_area') : '';

            $this->data['min_price']        = ($this->input->post('min_price')) ? $this->input->post('min_price') : '';
            $this->data['max_price']        = ($this->input->post('max_price')) ? $this->input->post('max_price') : '';

            $this->data['type']             = $this->input->post('type'); // Rent Type Data
            $this->data['category_id']      = $rentCategory->id; // Category Id


            $items = Item_model::factory()->getFilterData($this->data);
            $this->data['items'] = array();
            if(!empty($items)) {
                foreach ($items as $value) {
                    $item = Item_model::factory()->findOne($value['ItemId']);
                    $this->data['items'][] = array(
                        'id'      => $item->id,
                        'title'   => $item->title,
                        'img'     => ($this->getImgThumbnail($item->id)) ? resize($this->getImgThumbnail($item->id),319,264) : resize('no_image.png',319,264),
                        'slug'    => $item->slug,
                        'url'     => url($rentCategory->slug.'/'.$item->slug),
                        'price'   => currencyFormat($item->price, $this->options['currency']['code']),
                        'area'    => $item->area.' sq.ft',
                        'images'  => $item->images($item->id)
                    );
                }
            }
            return $this->response->setOutput($this->load->view('item/partials/index', $this->data));
        }
    }

}