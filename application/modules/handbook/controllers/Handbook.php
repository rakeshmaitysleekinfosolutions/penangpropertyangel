<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Handbook extends AdminController {

    private $agent;
    private $address;
    /**
     * @var int
     */
    private $handbookId;
    /**
     * @var object
     */
    private $project;
    /**
     * @var object
     */
    private $handbook;

    /**
     * Project constructor.
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
        $this->data['heading']                  = 'Handbook Management';
        $this->data['entrySortOrder']           = 'Sort Order';
        $this->data['entryName']                = 'Name';
        $this->data['entrySlug']                = 'Slug';
        $this->data['entrySequence']            = 'Sequence';
        $this->data['entryStatus']              = 'Status';
        $this->data['entryHandbookType']        = 'Handbook Type';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['entrySmallDescription']    = 'Short Desc';
        $this->data['entryLongDescription']     = 'Long Desc';

        $this->data['entryMetaTitle']           = 'Meta Title';
        $this->data['entryMetaDescription']     = 'Meta Description';
        $this->data['entryMetaKeywords']        = 'Meta Keywords';

        $this->data['datePlaceholder']          = 'mm-dd-yyyy';

        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';

        $this->data['form']             = array(
            'id'    => 'frmHandbook',
            'name'  => 'frmHandbook',
        );
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->handbook)) {
            $this->data['name'] = $this->handbook->name;
        } else {
            $this->data['name'] = '';
        }
        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = url_title($this->input->post('slug'),'dash', true);
        } elseif (!empty($this->handbook)) {
            $this->data['slug'] = $this->handbook->slug;
        } else {
            $this->data['slug'] = url_title($this->input->post('name'),'dash', true);
        }
        // remarks
        if (!empty($this->input->post('remarks'))) {
            $this->data['remarks'] = $this->input->post('remarks');
        } elseif (!empty($this->handbook)) {
            $this->data['remarks'] = $this->handbook->remarks;
        } else {
            $this->data['remarks'] = '';
        }
        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->handbook)) {
            $this->data['status'] = $this->handbook->status;
        } else {
            $this->data['status'] = 1;
        }
        if (!empty($this->input->post('sort_order'))) {
            $this->data['sort_order'] = $this->input->post('sort_order');
        } elseif (!empty($this->handbook)) {
            $this->data['sort_order'] = $this->handbook->sort_order;
        } else {
            $this->data['sort_order'] = '';
        }
        // sequence
        if (!empty($this->input->post('sequence'))) {
            $this->data['sequence'] = $this->input->post('sequence');
        } elseif (!empty($this->handbook)) {
            $this->data['sequence'] = $this->handbook->sequence;
        } else {
            $this->data['sequence'] = 0;
        }

        // Handbook Type
        if (!empty($this->input->post('handbook_type'))) {
            $this->data['handbook_type'] = $this->input->post('handbook_type');
        } elseif (!empty($this->handbook)) {
            $this->data['handbook_type'] = $this->handbook->handbook_type;
        } else {
            $this->data['handbook_type'] = '';
        }
       
        // small description
        if (!empty($this->input->post('small_description'))) {
            $this->data['small_description'] = $this->input->post('small_description');
        } elseif (!empty($this->handbook)) {
            $this->data['small_description'] = $this->handbook->description->small_description;
        } else {
            $this->data['small_description'] = '';
        }
        // long description
        if (!empty($this->input->post('long_description'))) {
            $this->data['long_description'] = $this->input->post('long_description');
        } elseif (!empty($this->handbook)) {
            $this->data['long_description'] = $this->handbook->description->long_description;
        } else {
            $this->data['long_description'] = '';
        }
        // Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->handbook)) {
            $this->data['meta_title'] = $this->handbook->description->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->handbook)) {
            $this->data['meta_description'] = $this->handbook->description->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keywords'))) {
            $this->data['meta_keywords'] = $this->input->post('meta_keywords');
        } elseif (!empty($this->handbook)) {
            $this->data['meta_keywords'] = $this->handbook->description->meta_keywords;
        } else {
            $this->data['meta_keywords'] = '';
        }
//        if (!empty($this->input->post('image'))) {
//            $this->data['image'] = $this->input->post('image');
//        } elseif (!empty($this->handbook)) {
//            $this->data['image'] = $this->handbook->image;
//        } else {
//            $this->data['image'] = '';
//        }
//
//        if (!empty($this->input->post('image')) && is_file(DIR_IMAGE . $this->input->post('image'))) {
//            $this->data['thumb'] = $this->resize($this->input->post('image'), 100, 100);
//        } elseif (!empty($this->handbook) && is_file(DIR_IMAGE . $this->handbook->image)) {
//            $this->data['thumb'] = $this->resize($this->handbook->image, 100, 100);
//        } else {
//            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
//        }
        // Images
        if (!empty($this->input->post('images'))) {
            $projectImages = $this->input->post('images');
        } elseif (!empty($this->handbook)) {
            if($this->isPost()) {
                $projectImages = $this->input->post('images');
            } else {
                $projectImages = $this->handbook->images($this->handbook->id);
            }
        } else {
            $projectImages = array();
        }
        //dd($projectImages);
        $this->data['images'] = array();

       // dd($projectImages);
        foreach ($projectImages as $projectImage) {
            if (is_file(DIR_IMAGE . $projectImage['image'])) {
                $image = $projectImage['image'];
                $thumb = $projectImage['image'];
            } else {
                $image = '';
                $thumb = 'no_image.png';
            }
            $this->data['images'][] = array(
                'image'      => $image,
                'thumb'      => resize($thumb, 100, 100),
                'sort_order' => $projectImage['sort_order'],
                'thumbnail'  => $projectImage['thumbnail'],
            );
        }
        //dd($this->data);

        $this->data['back']         = url('handbook');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']     = 'Handbook List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Type';
        $this->data['columns'][] = 'Seq';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'Img';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'Sort Order';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';

        $this->data['add']       = url('handbook/create');
        $this->data['addBtn']    = 'Add';
        $this->data['deleteBtn'] = 'Delete';

        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Handbook';
        $this->data['route'] = url('handbook/store');
        render('handbook/create', $this->data);
    }
    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // Project Model
            Handbook_model::factory()->insert([
                'name'      => $this->data['name'],
                'slug'      => $this->data['slug'],
                'sort_order'      => $this->data['sort_order'],
                'remarks'   => $this->data['remarks'],
                'status'    => $this->data['status'],
                'sequence'  => $this->data['sequence'],
                'handbook_type'  => $this->data['handbook_type'],
            ]);
            $this->handbookId = Handbook_model::factory()->getLastInsertID();
            // Project Description Model
            HandbookDescription_model::factory()->insert([
                'handbook_id'           => $this->handbookId,
                'small_description'     => $this->data['small_description'],
                'long_description'      => $this->data['long_description'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ]);
            // Project Image Model
            if(isset($this->data['images'])) {
                foreach ($this->data['images'] as $image) {
                    HandbookImage_model::factory()->insert([
                        'handbook_id'   => $this->handbookId,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'     => $image['thumbnail'],
                    ]);
                }
            }
            setMessage('message', "Success: You have modified handbook! ");
            redirect(url('handbook/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->handbook = Handbook_model::factory()->findOne($id);
        if(!$this->handbook) {
            setMessage('message', 'Info: Handbook does not exists!');
            redirect(url('handbook'));
        }
        $this->init();
        $this->data['title'] = 'Edit Handbook';
        $this->data['route'] = url('handbook/update/'.$id);
        render('handbook/edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->handbook = Handbook_model::factory()->findOne($id);
            if(!$this->handbook) {
                setMessage('message', 'Info: Handbook does not exists!');
                redirect(url('handbook'));
            }
            $this->init();
            // Project Model
            Handbook_model::factory()->update([
                'name'      => $this->data['name'],
                'slug'      => $this->data['slug'],
                'sort_order'      => $this->data['sort_order'],
                'remarks'   => $this->data['remarks'],
                'status'    => $this->data['status'],
                'sequence'  => $this->data['sequence'],
                'handbook_type'  => $this->data['handbook_type'],
            ],[
                'id' => $id
            ]);

            // Project Description Model
            HandbookDescription_model::factory()->update([
                'handbook_id'           => $id,
                'small_description'     => $this->data['small_description'],
                'long_description'      => $this->data['long_description'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ],[
                'handbook_id' => $id
            ]);
            // Project Image Model
            if(isset($this->data['images'])) {
                HandbookImage_model::factory()->delete([
                    'handbook_id' => $id
                ], true);
                foreach ($this->data['images'] as $image) {
                    HandbookImage_model::factory()->insert([
                        'handbook_id'   => $id,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'     => $image['thumbnail'],
                    ]);
                }
            }
            setMessage('message', "Success: You have modified handbook! ");
            redirect(url('handbook/edit/'. $id));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    /**
     * @return mixed
     * @throws Exception
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
                    Handbook_model::factory()->delete($productId);
                    HandbookDescription_model::factory()->delete(['handbook_id' => $productId]);
                    HandbookImage_model::factory()->delete(['handbook_id' => $productId]);
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
    public function getImgThumbnail($handbookId) {
        if(HandbookImage_model::factory()->findOne(['handbook_id' => $handbookId, 'thumbnail' => 1])) {
            return HandbookImage_model::factory()->findOne(['handbook_id' => $handbookId, 'thumbnail' => 1])->image;
        }
        return false;
    }
    /**
     * @return mixed
     * @throws Exception
     */
    public function onLoadDataTableEventHandler() {
        $this->results = Handbook_model::factory()->findAll([],null,'sort_order','asc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'name'		    => $result->name,
                    'handbook_type' => resizeAssetImage($result->handbook_type.'.png',100,100),
                    'sequence' 		=> $result->sequence,
                    'remarks' 		=> $result->remarks,
                    'sort_order' 		=> $result->sort_order,
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
                $this->data[$i][] = '<td><img src="'.$row['handbook_type'].'"></td>';
                $this->data[$i][] = '<td>'.$row['sequence'].'</td>';
                $this->data[$i][] = '<td>'.$row['name'].'</td>';
                $this->data[$i][] = '<td>'.$row['remarks'].'</td>';
                $this->data[$i][] = '<td><img src="'.$row['img'].'"></td>';

                $this->data[$i][] = '<td>
                                        <select data-id="'.$row['id'].'" name="status" class="form-control select floating updateStatus" id="input-payment-status" >
                                            <option value="0" '.$selected.'>Inactive</option>
                                            <option value="1" '.$selected.'>Active</option>
                                        </select>
                                     </td>';
                $this->data[$i][] = '<td>'.$row['sort_order'].'</td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('handbook/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                Handbook_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}