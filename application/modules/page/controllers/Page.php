<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Page extends AdminController {
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
        $this->data['heading']                  = 'Pages';
        $this->data['entryTitle']               = 'Title';
        $this->data['entrySlug']                = 'Slug';
        $this->data['entryHeading']             = 'Heading';
        $this->data['entryContent']             = 'Body Content';
        $this->data['entryStatus']             = 'Status';
        $this->data['entryMetaTitle']           = 'Meta Title';
        $this->data['entryMetaDescription']     = 'Meta Description';
        $this->data['entryMetaKeywords']        = 'Meta Keywords';

        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';

        if (!empty($this->input->post('title'))) {
            $this->data['title'] = $this->input->post('title');
        } elseif (!empty($this->page)) {
            $this->data['title'] = $this->page->title;
        } else {
            $this->data['title'] = '';
        }
        if (!empty($this->input->post('heading'))) {
            $this->data['heading'] = $this->input->post('heading');
        } elseif (!empty($this->page)) {
            $this->data['heading'] = $this->page->heading;
        } else {
            $this->data['heading'] = '';
        }
        if (!empty($this->input->post('content'))) {
            $this->data['content'] = $this->input->post('content');
        } elseif (!empty($this->page)) {
            $this->data['content'] = $this->page->content;
        } else {
            $this->data['content'] = '';
        }
        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = url_title($this->input->post('slug'),'dash', true);
        } elseif (!empty($this->page)) {
            $this->data['slug'] = $this->page->slug;
        } else {
            $this->data['slug'] = url_title($this->input->post('title'),'dash', true);
        }
        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->page)) {
            $this->data['status'] = $this->page->status;
        } else {
            $this->data['status'] = 1;
        }
        // Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->page)) {
            $this->data['meta_title'] = $this->page->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->page)) {
            $this->data['meta_description'] = $this->page->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keywords'))) {
            $this->data['meta_keywords'] = $this->input->post('meta_keywords');
        } elseif (!empty($this->page)) {
            $this->data['meta_keywords'] = $this->page->meta_keywords;
        } else {
            $this->data['meta_keywords'] = '';
        }
        $this->data['form']             = array(
            'id'    => 'frmPage',
            'name'  => 'frmPage',
        );
        $this->data['back']         = url('page');

    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']     = 'Pages';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Title';
        $this->data['columns'][] = 'Heading';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';

        $this->data['add']       = url('page/create');

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';
        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['pageTitle'] = 'Add New Page';
        $this->data['route'] = url('page/store');
        render('create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // Project Model
            Page_model::factory()->insert([
                'title'     => $this->data['title'],
                'heading'   => $this->data['heading'],
                'slug'      => $this->data['slug'],
                'status'    => $this->data['status'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ]);
            setMessage('message', "Success: You have modified page! ");
            redirect(url('page/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->page = Page_model::factory()->findOne($id);
        if(!$this->page) {
            setMessage('message', 'Info: Page does not exists!');
            redirect(url('page'));
        }
        $this->init();
        $this->data['pageTitle']    = 'Edit Page';
        $this->data['route'] = url('page/update/'.$id);
        render('page/edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->page = Page_model::factory()->findOne($id);
            if(!$this->page) {
                setMessage('message', 'Info: Page does not exists!');
                redirect(url('page'));
            }
            $this->init();
            // Project Model
            Page_model::factory()->update([
                'title'     => $this->data['title'],
                'heading'   => $this->data['heading'],
                'content'   => $this->data['content'],
                'slug'      => $this->data['slug'],
                'status'    => $this->data['status'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ],[
                'id' => $id
            ]);
            setMessage('message', "Success: You have modified page! ");
            redirect(url('page/edit/'. $id));
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
                    Page_model::factory()->delete($productId);
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
        $this->results = Page_model::factory()->findAll([],null,'title','desc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'title'		    => $result->title,
                    'heading' 		=> $result->heading,
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
                $this->data[$i][] = '<td>'.$row['title'].'</td>';
                $this->data[$i][] = '<td>'.$row['heading'].'</td>';
                $this->data[$i][] = '<td>
                                        <select data-id="'.$row['id'].'" name="status" class="form-control select floating updateStatus" id="input-payment-status" >
                                            <option value="0" '.$selected.'>Inactive</option>
                                            <option value="1" '.$selected.'>Active</option>
                                        </select>
                                     </td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';

                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('page/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                Page_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}