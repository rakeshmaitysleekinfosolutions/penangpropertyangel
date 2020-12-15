<?php
use Gregwar\Captcha\CaptchaBuilder;


class Item extends AppController {
    private $itemType;
    private $builder;
    public function __construct() {
        parent::__construct();
        $this->setLayout('layout/app');
        $this->builder = new CaptchaBuilder;
    }

    /**
     * @throws Exception
     */
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

    /**
     * @param $id
     * @return bool
     */
    public function getImgThumbnail($id) {
        if(ItemImage_model::factory()->findOne(['item_id' => $id, 'thumbnail' => 1])) {
            return ItemImage_model::factory()->findOne(['item_id' => $id, 'thumbnail' => 1])->image;
        }
        return false;
    }

    /**
     * @param $slug
     * @throws Exception
     */
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
                    'url'     => url($this->uri->segment(1).'/'.$rentCategory->slug.'/'.$item->slug),
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

    /**
     * @param $categorySlug
     * @param $itemSlug
     */
    public function getItem($categorySlug, $itemSlug) {
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => url('/')
        );


        switch ($this->uri->segment(1)) {
            case 'rent':
                $this->itemType = 2;
                break;
            case 'buy':
                $this->itemType = 1;
                break;
        }
        // Get Rent Category
        $this->category = Category_model::factory()->findOne(['slug' => $categorySlug]);
        if(!$this->category) {
            redirect(url('/rent'));
        }
        if($this->category) {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->category->name,
                'href' => url($this->uri->segment(1).'/'.$this->category->slug)
            );
        }
        // Get Item by rent category
        $this->item = Item_model::factory()->findOne(['type' => (int)$this->itemType, 'slug' => $itemSlug],10,'sort_order', 'ASC');
        $this->data['item'] = array();
        if(!empty($this->item)) {

            $this->data['breadcrumbs'][] = array(
                'text' => $this->item->title,
                'href' => url($this->uri->segment(1).'/'.$this->category->slug.'/'.$this->item->title)
            );
            $area = round($this->item->area, (int)$this->options['currency']['decimal_place']);
            $this->data['item'] = array(
                'id'            => $this->item->id,
                'title'         => $this->item->title,
                'small_description'    => $this->item->description->small_description,
                'long_description'     => $this->item->description->long_description,
                'bedroom'       => $this->item->description->bedroom1 .'+'.$this->item->description->bedroom2,
                'bathroom'      => $this->item->description->bathroom1 .'+'.$this->item->description->bathroom2,
                'img'           => ($this->getImgThumbnail($this->item->id)) ? resize($this->getImgThumbnail($this->item->id),319,264) : resize('no_image.png',319,264),
                'type'          => ($this->itemType == 1) ? 'BUY' : 'RENT',
                'hold'          => ($this->item->description->hold) ? 'Leasehold' : 'Freehold',
                'price'         => currencyFormat($this->item->price, $this->options['currency']['code']),
                'area'          => number_format($area, (int)$this->options['currency']['decimal_place'], $this->config->item('decimal_point'), $this->config->item('thousand_point')).' sq.ft',
                'images'        => $this->item->images($this->item->id),
                'agent'         => $this->item->agent,
                'map'           => $this->item->description->map,
                'youtube_link'  => $this->item->description->youtube_link,
            );

        }
// Get Item list by rent category
        $related_item = Item_model::factory()->findOne(['category_id' => $this->category->id, 'type' => (int)$this->itemType],1,'RAND()', 'ASC');
        $this->data['related_item'] = array();
        if(!empty($related_item)) {
                $area = round($related_item->area, (int)$this->options['currency']['decimal_place']);
                $this->data['related_item'] = array(
                    'id'      => $related_item->id,
                    'title'   => $related_item->title,
                    'img'     => ($this->getImgThumbnail($related_item->id)) ? resize($this->getImgThumbnail($related_item->id),319,264) : resize('no_image.png',319,264),
                    'slug'    => $related_item->slug,
                    'url'     => url($this->uri->segment(1).'/'.$this->category->slug.'/'.$related_item->slug),
                    'price'   => currencyFormat($related_item->price, $this->options['currency']['code']),
                    'area'    => number_format($area, (int)$this->options['currency']['decimal_place'], $this->config->item('decimal_point'), $this->config->item('thousand_point')).' sq.ft',
                    'images'  => $related_item->images($related_item->id)
                );
        }
        $this->builder->setBackgroundColor(255, 255, 255);
        $this->builder->build($width = 350, $height = 80, $font = null);
        $this->data['builder'] = $this->builder;
        setSession('phrase',$this->builder->getPhrase());
        render('item/view', $this->data);
    }

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function submitInspectionArranged() {

        if($this->isAjaxRequest()) {
            $phrase = '';
            if(!empty(getSession('phrase'))) {
                $phrase = getSession('phrase');
            }
            if($phrase == $this->input->post('code')) {
                // instructions if user phrase is good
                $datetime = $this->input->post('datetime');
                $explodeDatetime = explode(' ', $datetime);
                $date = ($explodeDatetime[0]) ? $explodeDatetime[0] : '';
                $time = ($explodeDatetime[1]) ? $explodeDatetime[1] : '';
                Inspection_model::factory()->insert([
                    'agent_id'          => $this->input->post('agent_id'),
                    'name'              => $this->input->post('name'),
                    'date'              => $date,
                    'time'              => $time,
                    'contact'           => $this->input->post('contact'),
                    'email'             => $this->input->post('email'),
                ]);
                $this->json['success'] = true;
                $this->json['message'] = 'Message has been successfully sent!';
            }
            else {
                // user phrase is wrong
                $this->json['error'] = true;
                $this->json['message'] = 'Captcha Invalid';

            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));

        }
    }

    /**
     *
     */
    public function downloadAllFiles() {
        if($this->isPost()) {
            $files = $this->input->post('files');
            //$this->dd($files);
            $tmpFile = tempnam('/tmp', '');
            $zip = new ZipArchive;
            $zip->open($tmpFile, ZipArchive::CREATE);
            foreach ($files as $file) {
                // download file
                $fileContent = file_get_contents($file);
                $zip->addFromString(basename($file), $fileContent);
            }
            $zip->close();
            $date = new DateTime();
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            //header("Content-length: " . filesize($filename));
            header("Content-disposition: attachment;filename = " . $date->format('Y-m-d H:i:sP') . ".zip");
            header("Content-Transfer-Encoding: binary");
            readfile($tmpFile);
            ob_end_clean();
            unlink($tmpFile);
        }
    }
}