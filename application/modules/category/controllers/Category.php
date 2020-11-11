<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Category extends AdminController {

    /**
     * @var object
     */
    private $category;

    /**
     * category constructor.
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
        $this->data['heading']                  = 'Category Management';
        $this->data['entryName']                = 'Name';
        $this->data['entrySortOrder']           = 'Sort Order';
        $this->data['entrySlug']                = 'Slug';
        $this->data['entryStatus']              = 'Status';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['entryDescription']         = 'Description';
        $this->data['entrySequence']            = 'Sequence';
        $this->data['entryMetaTitle']            = 'Meta Title';
        $this->data['entryMetaDescription']      = 'Meta Description';
        $this->data['entryMetaKeywords']         = 'Meta Keywords';
        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';
        $this->data['backToPreviousLevel']      = url('category');

        $this->data['form']             = array(
            'id'    => 'frmCategory',
            'name'  => 'frmCategory',
        );
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->category)) {
            $this->data['name'] = $this->category->name;
        } else {
            $this->data['name'] = '';
        }
        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = url_title($this->input->post('slug'),'dash', true);
        } elseif (!empty($this->category)) {
            $this->data['slug'] = $this->category->slug;
        } else {
            $this->data['slug'] = url_title($this->input->post('name'),'dash', true);
        }
        // Name
        if (!empty($this->input->post('sequence'))) {
            $this->data['sequence'] = $this->input->post('sequence');
        } elseif (!empty($this->category)) {
            $this->data['sequence'] = $this->category->sequence;
        } else {
            $this->data['sequence'] = 0;
        }
        // remarks
        if (!empty($this->input->post('remarks'))) {
            $this->data['remarks'] = $this->input->post('remarks');
        } elseif (!empty($this->category)) {
            $this->data['remarks'] = $this->category->remarks;
        } else {
            $this->data['remarks'] = '';
        }
        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->category)) {
            $this->data['status'] = $this->category->status;
        } else {
            $this->data['status'] = 1;
        }
        // Meta keyword
        if (!empty($this->input->post('sort_order'))) {
            $this->data['sort_order'] = $this->input->post('sort_order');
        } elseif (!empty($this->category)) {
            $this->data['sort_order'] = $this->category->sort_order;
        } else {
            $this->data['sort_order'] = '';
        }
        if (!empty($this->input->post('image'))) {
            $this->data['image'] = $this->input->post('image');
        } elseif (!empty($this->category)) {
            $this->data['image'] = $this->category->image;
        } else {
            $this->data['image'] = '';
        }

        if (!empty($this->input->post('image')) && is_file(DIR_IMAGE . $this->input->post('image'))) {
            $this->data['thumb'] = $this->resize($this->input->post('image'), 100, 100);
        } elseif (!empty($this->category) && is_file(DIR_IMAGE . $this->category->image)) {
            $this->data['thumb'] = $this->resize($this->category->image, 100, 100);
        } else {
            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
        }
// Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->category)) {
            $this->data['meta_title'] = $this->category->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->category)) {
            $this->data['meta_description'] = $this->category->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keywords'))) {
            $this->data['meta_keywords'] = $this->input->post('meta_keywords');
        } elseif (!empty($this->category)) {
            $this->data['meta_keywords'] = $this->category->meta_keywords;
        } else {
            $this->data['meta_keywords'] = '';
        }
        $this->data['back']         = url('category/');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['categorys'] = Category_model::factory()->findAll();
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']    = 'category List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Seq';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'Img';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'Sort Order';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['add']       = url('category/create/');

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';

        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add category';
        $this->data['route'] = url('category/store/');
        render('create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // category Model
            Category_model::factory()->insert([
                'name'              => $this->data['name'],
                'slug'              => $this->data['slug'],
                'sort_order'        => $this->data['sort_order'],
                'remarks'           => $this->data['remarks'],
                'sequence'          => $this->data['sequence'],
                'status'            => $this->data['status'],
                'image'             => $this->data['image'],
                'meta_title'        => $this->data['meta_title'],
                'meta_keywords'     => $this->data['meta_keywords'],
                'meta_description'  => $this->data['meta_description'],
            ]);
            setMessage('message', "Success: You have modified category! ");
            redirect(url('category/create/'.$this->data['category_id']));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->category = Category_model::factory()->findOne($id);
        if(!$this->category) {
            setMessage('message', 'Info: category does not exists!');
            redirect(url('category'));
        }
        $this->init();
        $this->data['title']    = 'Edit category';
        $this->data['route'] = url('category/update/'.$id);
        render('edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->category = Category_model::factory()->findOne($id);
            if(!$this->category) {
                setMessage('message', 'Info: category does not exists!');
                redirect(url('category'));
            }
            $this->init();
            //dd($this->data);
            // category Model
            Category_model::factory()->update([
                'image'             => $this->data['image'],
                'name'              => $this->data['name'],
                'sort_order'        => $this->data['sort_order'],
                'slug'              => $this->data['slug'],
                'remarks'           => $this->data['remarks'],
                'sequence'          => $this->data['sequence'],
                'status'            => $this->data['status'],
                'meta_title'        => $this->data['meta_title'],
                'meta_keywords'     => $this->data['meta_keywords'],
                'meta_description'  => $this->data['meta_description'],
            ],[
                'id' => $id
            ]);
            setMessage('message', "Success: You have modified category! ");
            redirect(url('category/edit/'.$id).'/');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function delete() {
        $this->init();
        if($this->isAjaxRequest()) {
            $this->request = $this->input->post();
            if(!empty($this->request['selected']) && isset($this->request['selected'])) {
                if(array_key_exists('selected', $this->request) && is_array($this->request['selected'])) {
                    $this->selected = $this->request['selected'];
                }
            }
            if($this->selected) {
                foreach ($this->selected as $id) {
                    Category_model::factory()->delete($id);
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
    /**
     * @return mixed
     * @throws Exception
     */
    public function onLoadDataTableEventHandler() {
        $this->results = Category_model::factory()->findAll([],null,'sort_order','asc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'name'		    => $result->name,
                    'sequence' 		=> $result->sequence,
                    'remarks' 		=> $result->remarks,
                    'sort_order' 		=> $result->sort_order,
                    'img' 		    => resize($result->image,32,32),
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
	                            <a href="'.url('category/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                Category_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}