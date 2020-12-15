<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Item extends AdminController {

    private $agent;
    private $address;
    /**
     * @var int
     */
    private $ItemId;
    /**
     * @var object
     */
    private $Item;
    /**
     * @var object
     */
    private $state;
    /**
     * @var int
     */
    private $itemId;
    /**
     * @var object
     */
    private $item;

    /**
     * Item constructor.
     */
    public function __construct() {
        parent::__construct();
        if(!isAdmin()) {
            redirect(url('admin/'));
        }
    }
    /**
     * @throws Exception
     */
    public function init() {
        $this->data['heading']                  = 'Item Management';
        $this->data['entryTitle']               = 'Title';
        $this->data['entryProject']             = 'Project';
        $this->data['entrySortOrder']           = 'Sort Order';
        $this->data['entryItem']                = 'Item';
        $this->data['entrySlug']                = 'Slug';
        $this->data['entryType']                = 'Type';
        $this->data['entryCategory']            = 'Category';
        $this->data['entryArea']                = 'Built-Up Area';
        $this->data['entrySize']                = 'Land Size';
        $this->data['entryHold']                = 'Title';
        $this->data['entryBedroom']             = 'Bedroom';
        $this->data['entryBathroom']            = 'Bathroom';
        $this->data['entryTenanted']            = 'Tenanted';
        $this->data['entryFeatured']            = 'Featured';
        $this->data['entryAgent']               = 'Agent';
        $this->data['entryLocation']            = 'Location';
        $this->data['entryAreaCategory']        = 'Area Category';
        $this->data['entryAddress']             = 'Address';
        $this->data['entryPrice']               = 'Price';
        $this->data['entryMap']                 = 'Embed Map (<a href="maps.google.com.my">maps.google.com.my</a>)';
        $this->data['entryNotes']                = 'Personal Notes (For internal use only)';
        $this->data['entryStatus']              = 'Status';
        $this->data['entrySmallDescription']    = 'Short Desc';
        $this->data['entryLongDescription']     = 'LongDesc';
        $this->data['entryYoutube']             = 'Youtube Link';

        $this->data['entryMetaTitle']            = 'Meta Title';
        $this->data['entryMetaDescription']      = 'Meta Description';
        $this->data['entryMetaKeywords']         = 'Meta Keywords';

        $this->data['entryItemDetails']         = 'Item Details';
        $this->data['entryItemDescription']     = 'Item Description';

        $this->data['datePlaceholder']          = 'mm-dd-yyyy';

        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';
        $this->data['exportXlsBtn']             = 'Export to Excel';

        $this->data['form']             = array(
            'id'    => 'frmItem',
            'name'  => 'frmItem',
        );
        /**
         * @desc Item Model
         */
        // Name
        if (!empty($this->input->post('title'))) {
            $this->data['itemTitle'] = $this->input->post('title');
        } elseif (!empty($this->item)) {
            $this->data['itemTitle'] = $this->item->title;
        } else {
            $this->data['itemTitle'] = '';
        }
        if (!empty($this->input->post('sort_order'))) {
            $this->data['sort_order'] = $this->input->post('sort_order');
        } elseif (!empty($this->item)) {
            $this->data['sort_order'] = $this->item->sort_order;
        } else {
            $this->data['sort_order'] = '';
        }
        // Type
        if ($this->input->post('type') != '') {
            $this->data['type'] = $this->input->post('type');
        } elseif (!empty($this->item)) {
            $this->data['type'] = $this->item->type;
        } else {
            $this->data['type'] = 1;
        }
        // Featured
        if ($this->input->post('featured') != '') {
            $this->data['featured'] = $this->input->post('featured');
        } elseif (!empty($this->item)) {
            $this->data['featured'] = $this->item->featured;
        } else {
            $this->data['featured'] = 0;
        }
        // Items Id
        if (!empty($this->input->post('projects_id'))) {
            $this->data['projects_id'] = $this->input->post('projects_id');
        } elseif (!empty($this->item)) {
            $this->data['projects_id'] = $this->item->projects($this->item->id);
        } else {
            $this->data['projects_id'] = array();
        }
        // Category
        if (!empty($this->input->post('category_id'))) {
            $this->data['category_id'] = $this->input->post('category_id');
        } elseif (!empty($this->item)) {
            $this->data['category_id'] = $this->item->category_id;
        } else {
            $this->data['category_id'] = array();
        }
        // Price
        if (!empty($this->input->post('price'))) {
            $this->data['price'] = $this->input->post('price');
        } elseif (!empty($this->item)) {
            $this->data['price'] = $this->item->price;
        } else {
            $this->data['price'] = 0.00;
        }
        // area
        if (!empty($this->input->post('area'))) {
            $this->data['area'] = $this->input->post('area');
        } elseif (!empty($this->item)) {
            $this->data['area'] = $this->item->area;
        } else {
            $this->data['area'] = '';
        }
        // area
        if (!empty($this->input->post('size'))) {
            $this->data['size'] = $this->input->post('size');
        } elseif (!empty($this->item)) {
            $this->data['size'] = $this->item->size;
        } else {
            $this->data['size'] = '';
        }
        // Tenanted
        if ($this->input->post('tenanted') != '') {
            $this->data['tenanted'] = $this->input->post('tenanted');
        } elseif (!empty($this->item)) {
            $this->data['tenanted'] = $this->item->tenanted;
        } else {
            $this->data['tenanted'] = 0;
        }
        // Agent Id
        if (!empty($this->input->post('agent_id'))) {
            $this->data['agent_id'] = $this->input->post('agent_id');
        } elseif (!empty($this->item)) {
            $this->data['agent_id'] = $this->item->agent_id;
        } else {
            $this->data['agent_id'] = 0;
        }
        // State ID
        if (!empty($this->input->post('state_id'))) {
            $this->data['state_id'] = $this->input->post('state_id');
        } elseif (!empty($this->item)) {
            $this->data['state_id'] = $this->item->state_id;
        } else {
            $this->data['state_id'] = 0;
        }
        // Child State
        if (!empty($this->input->post('childstate_id'))) {
            $this->data['childstate_id'] = $this->input->post('childstate_id');
        } elseif (!empty($this->item)) {
            $this->data['childstate_id'] = $this->item->childstate_id;
        } else {
            $this->data['childstate_id'] = 0;
        }
        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = url_title($this->input->post('slug'),'dash', true);
        } elseif (!empty($this->item)) {
            $this->data['slug'] = $this->item->slug;
        } else {
            $this->data['slug'] = url_title($this->input->post('title'),'dash', true);
        }

        // Price
        if (!empty($this->input->post('price'))) {
            $this->data['price'] = $this->input->post('price');
        } elseif (!empty($this->item)) {
            $this->data['price'] = $this->item->price;
        } else {
            $this->data['price'] = 0.00;
        }

        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->item)) {
            $this->data['status'] = $this->item->status;
        } else {
            $this->data['status'] = 1;
        }
        /**
         * @desc Item Description Model
         */
        // Hold
        if ($this->input->post('hold') != '') {
            $this->data['hold'] = $this->input->post('hold');
        } elseif (!empty($this->item)) {
            $this->data['hold'] = $this->item->description->hold;
        } else {
            $this->data['hold'] = 0;
        }
        // Address
        if (!empty($this->input->post('address'))) {
            $this->data['address'] = $this->input->post('address');
        } elseif (!empty($this->item)) {
            $this->data['address'] = $this->item->description->address;
        } else {
            $this->data['address'] = '';
        }

        // Bedroom
        if (!empty($this->input->post('bedroom1'))) {
            $this->data['bedroom1'] = $this->input->post('bedroom1');
        } elseif (!empty($this->item)) {
            $this->data['bedroom1'] = $this->item->description->bedroom1;
        } else {
            $this->data['bedroom1'] = 0;
        }
        // Bedroom
        if (!empty($this->input->post('bedroom2'))) {
            $this->data['bedroom2'] = $this->input->post('bedroom2');
        } elseif (!empty($this->item)) {
            $this->data['bedroom2'] = $this->item->description->bedroom2;
        } else {
            $this->data['bedroom2'] = 0;
        }
        // Bedroom
        if (!empty($this->input->post('bathroom1'))) {
            $this->data['bathroom1'] = $this->input->post('bathroom1');
        } elseif (!empty($this->item)) {
            $this->data['bathroom1'] = $this->item->description->bathroom1;
        } else {
            $this->data['bathroom1'] = 0;
        }
        // Bedroom
        if (!empty($this->input->post('bathroom2'))) {
            $this->data['bathroom2'] = $this->input->post('bathroom2');
        } elseif (!empty($this->item)) {
            $this->data['bathroom2'] = $this->item->description->bathroom2;
        } else {
            $this->data['bathroom2'] = 0;
        }
        // small description
        if (!empty($this->input->post('small_description'))) {
            $this->data['small_description'] = $this->input->post('small_description');
        } elseif (!empty($this->item)) {
            $this->data['small_description'] = $this->item->description->small_description;
        } else {
            $this->data['small_description'] = '';
        }
        // long description
        if (!empty($this->input->post('long_description'))) {
            $this->data['long_description'] = $this->input->post('long_description');
        } elseif (!empty($this->item)) {
            $this->data['long_description'] = $this->item->description->long_description;
        } else {
            $this->data['long_description'] = '';
        }
        // Youtube Link
        if (!empty($this->input->post('youtube_link'))) {
            $this->data['youtube_link'] = $this->input->post('youtube_link');
        } elseif (!empty($this->item)) {
            $this->data['youtube_link'] = $this->item->description->youtube_link;
        } else {
            $this->data['youtube_link'] = '';
        }
        // Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->item)) {
            $this->data['meta_title'] = $this->item->description->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->item)) {
            $this->data['meta_description'] = $this->item->description->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keywords'))) {
            $this->data['meta_keywords'] = $this->input->post('meta_keywords');
        } elseif (!empty($this->item)) {
            $this->data['meta_keywords'] = $this->item->description->meta_keywords;
        } else {
            $this->data['meta_keywords'] = '';
        }
        // Map
        if (!empty($this->input->post('map'))) {
            $this->data['map'] = $this->input->post('map');
        } elseif (!empty($this->item)) {
            $this->data['map'] = $this->item->description->map;
        } else {
            $this->data['map'] = '';
        }
        // Notes
        if (!empty($this->input->post('notes'))) {
            $this->data['notes'] = $this->input->post('notes');
        } elseif (!empty($this->item)) {
            $this->data['notes'] = $this->item->description->notes;
        } else {
            $this->data['notes'] = '';
        }
        // Images
       // dd($this->input->post('images'));
        if ($this->input->post('images')) {
            $itemImages = $this->input->post('images');
        } elseif (!empty($this->item)) {
            if($this->isPost()) {
                $itemImages = $this->input->post('images');
            } else {
                $itemImages = $this->item->images($this->item->id);
            }
        } else {
            $itemImages = array();
        }
        //dd($itemImages);
        $this->data['images'] = array();

       // dd($itemImages);
        foreach ($itemImages as $itemImage) {
            if (is_file(DIR_IMAGE . $itemImage['image'])) {
                $image = $itemImage['image'];
                $thumb = $itemImage['image'];
            } else {
                $image = '';
                $thumb = 'no_image.png';
            }
            $this->data['images'][] = array(
                'image'      => $image,
                'thumb'      => resize($thumb, 100, 100),
                'sort_order' => $itemImage['sort_order'],
                'thumbnail'  => $itemImage['thumbnail'],
            );
        }
        //dd($this->data);

        $this->data['back']         = url('item');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['projects']     = Project_model::factory()->findAll(['status' => 1],null,'id', 'asc');
        $this->data['states']       = State_model::factory()->findAll(['country_id' => 129],null,'id', 'asc');
        $this->data['childStates']  = ChildState_model::factory()->findAll(['status' => 1],null,'sort_order', 'asc');
        $this->data['categories']   = Category_model::factory()->findAll(['status' => 1],null,'sort_order', 'asc');
        $users = GroupAgent_model::factory()->find()->where('group_id', 2)->get()->result();
        $userIds = array();
        if(count($users) > 0) {
            foreach ($users as $user) {
                $userIds[] = $user->agent_id;
            }
        }
        $this->data['agents']  = Agent_model::factory()->findAll($userIds,null,'id', 'asc');

        $this->results = Item_model::factory()->findAll();
        if(count($this->results)) {
            $this->data['disabled'] = false;
        } else {
            $this->data['disabled'] = true;
        }
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']    = 'Item List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Agent';
        $this->data['columns'][] = 'Type';
        $this->data['columns'][] = 'Category';
        $this->data['columns'][] = 'Bedroom';
        $this->data['columns'][] = 'Bathroom';
        $this->data['columns'][] = 'Built-Up Area';
        $this->data['columns'][] = 'Title';
        $this->data['columns'][] = 'Price';
        $this->data['columns'][] = 'Price/SqFt';
        $this->data['columns'][] = 'Location';
        $this->data['columns'][] = 'Area Category';
        $this->data['columns'][] = 'Address';
        $this->data['columns'][] = 'Thumbnail';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['add']      = url('item/create');

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';
        $this->data['exportToXlsRoute'] = url('item/exportToXls');
        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Item';
        $this->data['route'] = url('item/store');
        render('item/create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // Item Model
            Item_model::factory()->insert([
                'title'         => $this->data['itemTitle'],
                'slug'          => $this->data['slug'],
                'type'          => $this->data['type'],
                'featured'      => $this->data['featured'],
                'category_id'   => $this->data['category_id'],
                'price'         => $this->data['price'],
                'area'          => $this->data['area'],
                'size'          => $this->data['size'],
                'tenanted'      => $this->data['tenanted'],
                'agent_id'      => $this->data['agent_id'],
                'state_id'      => $this->data['state_id'],
                'childstate_id' => $this->data['childstate_id'],
                'sort_order'    => $this->data['sort_order'],
                'status'                => $this->data['status'],
            ]);
            $this->itemId = Item_model::factory()->getLastInsertID();
            // Item Description Model
            ItemDescription_model::factory()->insert([
                'item_id'               => $this->itemId,
                'hold'                  => $this->data['hold'],
                'address'               => $this->data['address'],
                'map'                   => $this->data['map'],
                'notes'                 => $this->data['notes'],
                'bedroom1'              => $this->data['bedroom1'],
                'bedroom2'              => $this->data['bedroom2'],
                'bathroom1'             => $this->data['bathroom1'],
                'bathroom2'             => $this->data['bathroom2'],
                'small_description'     => $this->data['small_description'],
                'long_description'      => $this->data['long_description'],
                'youtube_link'          => $this->data['youtube_link'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],

            ]);
            // Item Project Model
            if(isset($this->data['projects_id'])) {
                foreach ($this->data['projects_id'] as $projectId) {
                    ItemProject_model::factory()->insert([
                        'item_id'       => $this->itemId,
                        'project_id'    => $projectId,
                    ]);
                }
            }
            // Item Image Model
            if(isset($this->data['images'])) {
                foreach ($this->data['images'] as $image) {
                    ItemImage_model::factory()->insert([
                        'item_id'       => $this->itemId,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'     => $image['thumbnail'],
                    ]);
                }
            }
            setMessage('message', "Success: You have modified item! ");
            redirect(url('item/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->item = Item_model::factory()->findOne($id);
        if(!$this->item) {
            setMessage('message', 'Info: Item does not exists!');
            redirect(url('item'));
        }
        $this->init();
       // dd($this->data);
        $this->data['title']    = 'Edit Item';
        $this->data['route']    = url('item/update/'.$id);
        render('item/edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->item = Item_model::factory()->findOne($id);
            if(!$this->item) {
                setMessage('message', 'Info: Item does not exists!');
                redirect(url('item'));
            }
            $this->init();
            if($this->isPost()) {
              // Item Model
              Item_model::factory()->update([
                  'title'         => $this->data['itemTitle'],
                  'slug'          => $this->data['slug'],
                  'type'          => $this->data['type'],
                  'featured'      => $this->data['featured'],
                  'category_id'   => $this->data['category_id'],
                  'price'         => $this->data['price'],
                  'area'          => $this->data['area'],
                  'size'          => $this->data['size'],
                  'tenanted'      => $this->data['tenanted'],
                  'agent_id'      => $this->data['agent_id'],
                  'state_id'      => $this->data['state_id'],
                  'childstate_id' => $this->data['childstate_id'],
                  'sort_order'    => $this->data['sort_order'],
                  'status'        => $this->data['status'],
              ],[
                  'id' => $this->item->id
              ]);
              // Item Description Model
              ItemDescription_model::factory()->update([
                  'item_id'               => $this->item->id,
                  'hold'                  => $this->data['hold'],
                  'address'               => $this->data['address'],
                  'map'                   => $this->data['map'],
                  'notes'                 => $this->data['notes'],
                  'bedroom1'              => $this->data['bedroom1'],
                  'bedroom2'              => $this->data['bedroom2'],
                  'bathroom1'             => $this->data['bathroom1'],
                  'bathroom2'             => $this->data['bathroom2'],
                  'small_description'     => $this->data['small_description'],
                  'long_description'      => $this->data['long_description'],
                  'youtube_link'          => $this->data['youtube_link'],
                  'meta_title'            => $this->data['meta_title'],
                  'meta_keywords'         => $this->data['meta_keywords'],
                  'meta_description'      => $this->data['meta_description'],
              ],[
                  'item_id' => $this->item->id
              ]);
              // Item Project Model
              if(isset($this->data['projects_id'])) {
                  ItemProject_model::factory()->delete([
                      'item_id' => $this->item->id
                  ], true);
                  foreach ($this->data['projects_id'] as $projectId) {
                      ItemProject_model::factory()->insert([
                          'item_id'       => $this->item->id,
                          'project_id'    => $projectId,
                      ]);
                  }
              }
              // Item Image Model
              if(isset($this->data['images'])) {
                  ItemImage_model::factory()->delete([
                      'item_id' => $this->item->id
                  ], true);
                  foreach ($this->data['images'] as $image) {
                      ItemImage_model::factory()->insert([
                          'item_id'       => $this->item->id,
                          'image'         => $image['image'],
                          'sort_order'    => $image['sort_order'],
                          'thumbnail'     => $image['thumbnail'],
                      ]);
                  }
              }
              setMessage('message', "Success: You have modified Item! ");
              redirect(url('item/edit/'. $id));
          }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    /**
     * @return mixed
     */
    public function delete() {
        if($this->isAjaxRequest()) {
            $this->request = $this->input->post();
            if(!empty($this->request['selected']) && isset($this->request['selected'])) {
                if(array_key_exists('selected', $this->request) && is_array($this->request['selected'])) {
                    $this->selected = $this->request['selected'];
                }
            }
            if($this->selected) {
                foreach ($this->selected as $productId) {
                    Item_model::factory()->delete($productId);
                    ItemDescription_model::factory()->delete(['item_id' => $productId]);
                    ItemImage_model::factory()->delete(['item_id' => $productId]);
                }
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => true,'message' => 'Record has been successfully deleted')));
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler(), 'status' => false, 'message' => 'Sorry! we could not delete this record')));
        }
    }
    public function getImgThumbnail($ItemId) {
        if(ItemImage_model::factory()->findOne(['Item_id' => $ItemId, 'thumbnail' => 1])) {
            return ItemImage_model::factory()->findOne(['Item_id' => $ItemId, 'thumbnail' => 1])->image;
        }
        return false;
    }
    /**
     * @return mixed
     * @throws Exception
     */
    public function onLoadDataTableEventHandler() {
        $this->results = Item_model::factory()->findAll([],null,'sort_order','desc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'agent'		    => (isset($result->agent)) ? $result->agent->firstname." ".$result->agent->lastname : '',
                    'type'		    => ($result->type == 1) ? 'Rent' : 'Sell',
                    'category' 		=> $result->category->name,
                    'bedroom'		=> $result->description->bedroom1.'+'.$result->description->bedroom2,
                    'bathroom'		=> $result->description->bathroom1.'+'.$result->description->bathroom2,
                    'area' 		    => $result->area,
                    'title' 		=> $result->title,
                    'price' 		=> $result->price,
                    'price_qft' 	=> $result->price,
                    'state' 		=> $result->state->name,
                    'childstate' 	=> (isset($result->childState->name)) ? $result->childState->name : '',
                    'address' 	    => $result->description->address,
                    'img' 		    => ($this->getImgThumbnail($result->id)) ? resize($this->getImgThumbnail($result->id),100,100) : resize('no_image.png', 32,32),
                    'status' 		=> ($result->status && $result->status == 1) ? 1 : 0,
                    'created_at'    => $result->created_at,
                    'updated_at'    => $result->updated_at
                );
            }
            //dd($this->rows);
            $i = 0;
            $counter = 1;
            foreach($this->rows as $row) {
                $selected = ($row['status']) ? 'selected' : '';
                $this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input type="checkbox" class="css-control-input selectCheckbox" value="'.$row['id'].'" name="selected[]">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
                $this->data[$i][] = '<td>'.$counter.'</td>';
                $this->data[$i][] = '<td>'.$row['agent'].'</td>';
                $this->data[$i][] = '<td>'.$row['type'].'</td>';
                $this->data[$i][] = '<td>'.$row['category'].'</td>';
                $this->data[$i][] = '<td>'.$row['bedroom'].'</td>';
                $this->data[$i][] = '<td>'.$row['bathroom'].'</td>';
                $this->data[$i][] = '<td>'.$row['area'].'</td>';
                $this->data[$i][] = '<td>'.$row['title'].'</td>';
                $this->data[$i][] = '<td>'.$row['price'].'</td>';
                $this->data[$i][] = '<td>'.$row['price_qft'].'</td>';
                $this->data[$i][] = '<td>'.$row['state'].'</td>';
                $this->data[$i][] = '<td>'.$row['childstate'].'</td>';
                $this->data[$i][] = '<td>'.$row['address'].'</td>';
                $this->data[$i][] = '<td><img src="'.$row['img'].'"></td>';
                $this->data[$i][] = '<td>
                                        <select data-id="'.$row['id'].'" name="status" class="form-control select floating updateStatus" id="input-payment-status" >
                                            <option value="0" '.$selected.'>Inactive</option>
                                            <option value="1" '.$selected.'>Active</option>
                                        </select>
                                     </td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('item/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
	                        </td>
                        ';
                $i++;
                $counter++;
            }
        }
        if($this->data) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => $this->data)));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => [])));
        }
    }
    /**
     * @return mixed
     */
    public function onChangeStatusEventHandler() {
        if($this->isAjaxRequest()) {
            $this->request = $this->input->post();
            if(isset($this->request['status']) && isset($this->request['id'])) {
                Item_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
    public function childstate() {
        if($this->isAjaxRequest()) {
            $this->state =  State_model::factory()->findOne(['status' => 1,'id' => $this->input->post('state_id')]);
            if ($this->state) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'states'            => $this->state->childStates(),
                    )));
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'states'            => [],
                )));
        }
    }
    public function exportToXls() {
        if($this->isPost()) {
            $this->results = Item_model::factory()->findAll([],null,'sort_order','desc');
            if($this->results) {
                $this->rows[] = array(
                    'Item ID',
                    'Item Status',
                    'User Username',
                    'Item Type',
                    'Item Category',
                    'Item Bedroom',
                    'Item Bathroom',
                    'Item Size',
                    'Item Name',
                    'Item Price',
                    'Item Location',
                    'Item Area',
                    'Item Address',
                    'UpdDt',
                );
                foreach ($this->results as $result) {
                    $this->rows[] = array(
                        $result->id,
                        ($result->status && $result->status == 1) ? 'SHOW' : 'OFF',
                        (isset($result->agent)) ? $result->agent->email : '',
                        ($result->type == 1) ? 'Rent' : 'Sell',
                        $result->category->name,
                        $result->description->bedroom1 . '+' . $result->description->bedroom2,
                        $result->description->bedroom3 . '+' . $result->description->bedroom4,
                        $result->size,
                        $result->title,
                        $result->price,
                        $result->state->name,
                        (isset($result->childState->name)) ? $result->childState->name : '',
                        $result->description->address,
                        $result->updated_at
                    );
                }
            }
        }
        $timestamp = time();
        $filename = $timestamp . '.csv';
        SimpleXLSXGen::fromArray( $this->rows )->addSheet( $this->rows, $timestamp)->downloadAs($filename);
    }
}