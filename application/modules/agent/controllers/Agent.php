<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Agent extends AdminController {

    public function __constructor() {
        parent::__construct();
        $this->template->set_template('layout/admin');
    }

    /**
     * @throws Exception
     */
    public function setData() {
        $this->data['salt'] = token(9);
        if (!empty($this->agent)) {
            $this->data['title'] = 'Edit Agent';
            $this->data['route'] = url('agent/update');
            $this->data['uuid'] = $this->agent->uuid;
        } else {
            $this->data['title'] = 'Add Agent';
            $this->data['route'] = url('agent/store');
            $this->data['uuid'] = $this->uuid();
        }
        $this->data['form'] = 'frmAgent';
        // User ID
        if (!empty($this->input->post('id'))) {
            $this->data['id'] = $this->input->post('id');
        } elseif (!empty($this->agent)) {
            $this->data['id'] = $this->agent->id;
        } else {
            $this->data['id'] = '';
        }
        // First Name
        if (!empty($this->input->post('firstname'))) {
            $this->data['firstname'] = $this->input->post('firstname');
        } elseif (!empty($this->agent)) {
            $this->data['firstname'] = $this->agent->firstname;
        } else {
            $this->data['firstname'] = '';
        }

        // Last Name
        if (!empty($this->input->post('lastname'))) {
            $this->data['lastname'] = $this->input->post('lastname');
        } elseif (!empty($this->agent)) {
            $this->data['lastname'] = $this->agent->lastname;
        } else {
            $this->data['lastname'] = '';
        }
        // Email
        if (!empty($this->input->post('email'))) {
            $this->data['email'] = $this->input->post('email');
        } elseif (!empty($this->agent)) {
            $this->data['email'] = $this->agent->email;
        } else {
            $this->data['email'] = '';
        }
        // Email
        if (!empty($this->input->post('password'))) {
            $this->data['password'] = sha1($this->data['salt'] . sha1($this->data['salt'] . sha1($this->input->post('password'))));
        } elseif (!empty($this->agent)) {
            $this->data['password'] = $this->agent->password;
        } else {
            $this->data['password'] = '';
        }
        // Gender
        if (!empty($this->input->post('gender'))) {
            $this->data['gender'] = $this->input->post('gender');
        } elseif (!empty($this->agent)) {
            $this->data['gender'] = $this->agent->gender;
        } else {
            $this->data['gender'] = 0;
        }
        // Birthday
        if (!empty($this->input->post('birthday'))) {
            $this->data['birthday'] = $this->input->post('birthday');
        } elseif (!empty($this->agent)) {
            $this->data['birthday'] = $this->agent->birthday;
        } else {
            $this->data['birthday'] = 0;
        }
        // NRIC
        if (!empty($this->input->post('nric'))) {
            $this->data['nric'] = $this->input->post('nric');
        } elseif (!empty($this->agent)) {
            $this->data['nric'] = $this->agent->nric;
        } else {
            $this->data['nric'] = 0;
        }
        // Telephone
        if (!empty($this->input->post('phone'))) {
            $this->data['phone'] = $this->input->post('phone');
        } elseif (!empty($this->agent)) {
            $this->data['phone'] = $this->agent->phone;
        } else {
            $this->data['phone'] = '';
        }
        // Mobile Optional
        if (!empty($this->input->post('mobile'))) {
            $this->data['mobile'] = $this->input->post('mobile');
        } elseif (!empty($this->agent)) {
            $this->data['mobile'] = $this->agent->mobile;
        } else {
            $this->data['mobile'] = '';
        }
        // Fax
        if (!empty($this->input->post('fax'))) {
            $this->data['fax'] = $this->input->post('fax');
        } elseif (!empty($this->agent)) {
            $this->data['fax'] = $this->agent->fax;
        } else {
            $this->data['fax'] = '';
        }
        // Occupation
        if (!empty($this->input->post('occupation'))) {
            $this->data['occupation'] = $this->input->post('occupation');
        } elseif (!empty($this->agent)) {
            $this->data['occupation'] = $this->agent->occupation;
        } else {
            $this->data['occupation'] = '';
        }
        // Address 1
        if (!empty($this->input->post('address_1'))) {
            $this->data['address_1'] = $this->input->post('address_1');
        } elseif (!empty($this->address)) {
            $this->data['address_1'] = $this->address->address_1;
        } else {
            $this->data['address_1'] = '';
        }
        // Address 2 Optional
        if (!empty($this->input->post('address_2'))) {
            $this->data['address_2'] = $this->input->post('address_2');
        } elseif (!empty($this->address)) {
            $this->data['address_2'] = $this->address->address_2;
        } else {
            $this->data['address_2'] = '';
        }

        // Address ID
        if (!empty($this->input->post('address_id'))) {
            $this->data['address_id'] = $this->input->post('address_id');
        } elseif (!empty($this->address)) {
            $this->data['address_id'] = $this->address->id;
        } else {
            $this->data['address_id'] = '';
        }
        if (!empty($this->input->post('country_id'))) {
            $this->data['country_id'] = $this->input->post('country_id');
        } elseif (!empty($this->address)) {
            $this->data['country_id'] = $this->address->country_id;
        } else {
            $this->data['country_id'] = '';
        }
        if (!empty($this->input->post('state_id'))) {
            $this->data['state_id'] = $this->input->post('state_id');
        } elseif (!empty($this->address)) {
            $this->data['state_id'] = $this->address->state_id;
        } else {
            $this->data['state_id'] = '';
        }
        // City
        if (!empty($this->input->post('city'))) {
            $this->data['city'] = $this->input->post('city');
        } elseif (!empty($this->address)) {
            $this->data['city'] = $this->address->city;
        } else {
            $this->data['city'] = '';
        }
        // PostCode
        if (!empty($this->input->post('postcode'))) {
            $this->data['postcode'] = $this->input->post('postcode');
        } elseif (!empty($this->address)) {
            $this->data['postcode'] = $this->address->postcode;
        } else {
            $this->data['postcode'] = '';
        }
        // Status
        if (!empty($this->input->post('status'))) {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->agent)) {
            $this->data['status'] = $this->agent->status;
        } else {
            $this->data['status'] = 0;
        }
        if (!empty($this->input->post('logo'))) {
            $this->data['logo'] = $this->input->post('logo');
        } elseif (!empty($this->agent)) {
            $this->data['logo'] = $this->agent->logo;
        } else {
            $this->data['logo'] = '';
        }

        if (!empty($this->input->post('logo')) && is_file(DIR_IMAGE . $this->input->post('logo'))) {
            $this->data['thumb'] = $this->resize($this->input->post('logo'), 100, 100);
        } elseif (!empty($this->agent) && is_file(DIR_IMAGE . $this->agent->logo)) {
            $this->data['thumb'] = $this->resize($this->agent->logo, 100, 100);
        } else {
            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
        }
        $this->data['countries']    = Country_model::factory()->findAll();
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['back']         = url('agent');
    }

    /**
     *
     */
    public function index() {

        //$this->beforeRender();

        $this->data['title'] = 'agent';
        //$this->data['datatable'] = array();
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'FB';
        $this->data['columns'][] = 'Username';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Gender';
        $this->data['columns'][] = 'Birthday';
        $this->data['columns'][] = 'NRIC';
        $this->data['columns'][] = 'Tel';
        $this->data['columns'][] = 'Mobile';
        $this->data['columns'][] = 'Fax';
        $this->data['columns'][] = 'Occupation';
        $this->data['columns'][] = 'Address';
        $this->data['columns'][] = 'Avatar';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        //$this->data['columns'][] = 'Action';

        $this->data['addLink'] = url('agent/create');
        $this->template->set_template('layout/admin');
        $this->template->content->view('index', $this->data);
        $this->template->publish();
    }

    /**
     * @throws Exception
     */
    public function create() {
        $this->setData();
        $this->template->set_template('layout/admin');
        $this->template->content->view('agent/create', $this->data);
        $this->template->publish();

    }

    /**
     *
     */
    public function store() {
        try {
            $this->setData();
            Agent_model::factory()->insert([
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'email'     => $this->data['email'],
                'uuid'      => $this->data['uuid'],
                'salt'      => $this->data['salt'],
                'password'  => $this->data['password'],
            ]);
            $this->create();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function edit($id) {}
    public function update() {}
    public function delete() {}
    public function validateForm() {}
    public function onLoadDatatableEventHandler() {
        $this->load->model('Agent_model', 'Agent_model');
        $this->results = $this->agent_model->findAll();
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'firstname'		=> $result->firstname,
                    'lastname' 		=> $result->lastname,
                    'email' 		=> $result->email,
                    'status' 		=> ($result->status && $result->status == 1) ? 1 : 0,
                    'created_at'    => Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans(),
                    'updated_at'    => ($result->updated_at) ? Carbon::createFromTimeStamp(strtotime($result->updated_at))->diffForHumans() : ''
                );
            }
            $i = 0;
            foreach($this->rows as $row) {
                $selected = ($row['status']) ? 'selected' : '';
                $this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input data-id="'.$row['id'].'" type="checkbox" class="css-control-input selectCheckbox" id="row_'.$row['id'].'" name="row_'.$row['id'].'">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
                $this->data[$i][] = '<td>'.$row['firstname'].'</td>';
                $this->data[$i][] = '<td>'.$row['lastname'].'</td>';
                $this->data[$i][] = '<td>'.$row['email'].'</td>';
//					$this->data[$i][] = '<td>
//											<div class="material-switch pull-right">
//											<input data-id="'.$row['id'].'" class="checkboxStatus" id="chat_module" type="checkbox" value="'.$row['status']['value'].'" '.$checked.'/>
//											<label for="chat_module" class="label-success"></label>
//										</div>
//                                        </td>';
                $this->data[$i][] = '<td>
                                            <select data-id="'.$row['id'].'" name="status" class="select floating checkboxStatus" id="input-payment-status" >
                                                <option value="0" '.$selected.'>Inactive</option>
                                                <option value="1" '.$selected.'>Active</option>
                                            </select>
                                        </td>';
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <div class="dropdown">
	                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	                                <ul class="dropdown-menu pull-right">
	                                    <li><a class="edit" href="javascript:void(0);" data-id="'.$row['id'].'" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
	                                    <li><a class="delete" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
	                                </ul>
	                            </div>
	                        </td>
                        ';

                //  $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $i++;
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
    public function onChangeStatusEventHandler() {
        if($this->isAjaxRequest()) {
            $this->request = $this->input->post();
            if(isset($this->request['status']) && isset($this->request['id'])) {

                $this->agentId   = (isset($this->request['id'])) ? $this->request['id'] : '';
                $this->status       = (isset($this->request['status'])) ? $this->request['status'] : '';

                $this->load->model('Agent_model');
                $this->agent_model->updateStatus($this->agentId, $this->status);

                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}