<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Childstate extends AdminController {

    /**
     * @var object
     */
    private $childState;

    /**
     * Childstate constructor.
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
        $this->data['heading']                  = 'Child State Management';
        $this->data['entryState']               = 'State/Province';
        $this->data['entryCountry']             = 'Country';
        $this->data['entryName']                = 'Name';
        $this->data['entrySortOrder']           = 'Sort Order';
        $this->data['entryStatus']              = 'Status';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';
        $this->data['backToPreviousLevel']      = url('childstate');

        $this->data['form']             = array(
            'id'    => 'frmChildState',
            'name'  => 'frmChildState',
        );

        $this->data['country_id'] = 129;
        if (!empty($this->input->post('state_id'))) {
            $this->data['state_id'] = $this->input->post('state_id');
        } elseif (!empty($this->childState)) {
            $this->data['state_id'] = $this->childState->state_id;
        } else {
            $this->data['state_id'] = '';
        }
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->childState)) {
            $this->data['name'] = $this->childState->name;
        } else {
            $this->data['name'] = '';
        }
       
        // remarks
        if (!empty($this->input->post('remarks'))) {
            $this->data['remarks'] = $this->input->post('remarks');
        } elseif (!empty($this->childState)) {
            $this->data['remarks'] = $this->childState->remarks;
        } else {
            $this->data['remarks'] = '';
        }
        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->childState)) {
            $this->data['status'] = $this->childState->status;
        } else {
            $this->data['status'] = 1;
        }
        // Meta keyword
        if (!empty($this->input->post('sort_order'))) {
            $this->data['sort_order'] = $this->input->post('sort_order');
        } elseif (!empty($this->childState)) {
            $this->data['sort_order'] = $this->childState->sort_order;
        } else {
            $this->data['sort_order'] = '';
        }
       
        $this->data['back']         = url('childstate/');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['countries']    = Country_model::factory()->findAll(['id' => 129]);
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']    = 'Child State List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'State';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'Sort Order';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['add']       = url('childstate/create/');

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';

        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Childstate';
        $this->data['route'] = url('childstate/store/');
        render('create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
            ChildState_model::factory()->insert([
                'state_id'          => $this->data['state_id'],
                'name'              => $this->data['name'],
                'sort_order'        => $this->data['sort_order'],
                'remarks'           => $this->data['remarks'],
                'status'            => $this->data['status'],
            ]);
            setMessage('message', "Success: You have modified Childstate! ");
            redirect(url('childstate/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->childState = ChildState_model::factory()->findOne($id);
        if(!$this->childState) {
            setMessage('message', 'Info: Childstate does not exists!');
            redirect(url('Childstate'));
        }
        $this->init();
        $this->data['title']    = 'Edit Childstate';
        $this->data['route'] = url('childstate/update/'.$id);
        render('edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->childState = ChildState_model::factory()->findOne($id);
            if(!$this->childState) {
                setMessage('message', 'Info: Childstate does not exists!');
                redirect(url('Childstate'));
            }
            $this->init();
            ChildState_model::factory()->update([
                'state_id'          => $this->data['state_id'],
                'name'              => $this->data['name'],
                'sort_order'        => $this->data['sort_order'],
                'remarks'           => $this->data['remarks'],
                'status'            => $this->data['status'],
            ],[
                'id' => $id
            ]);
            setMessage('message', "Success: You have modified Childstate! ");
            redirect(url('childstate/edit/'.$id).'/');
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
                    ChildState_model::factory()->delete($id);
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
        $this->results = ChildState_model::factory()->findAll([],null,'sort_order','asc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'state'		    => $result->state->name,
                    'name'		    => $result->name,
                    'remarks' 		=> $result->remarks,
                    'sort_order' 		=> $result->sort_order,
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
                $this->data[$i][] = '<td>'.$row['state'].'</td>';
                $this->data[$i][] = '<td>'.$row['name'].'</td>';
                $this->data[$i][] = '<td>'.$row['remarks'].'</td>';
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
	                            <a href="'.url('childstate/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                ChildState_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}