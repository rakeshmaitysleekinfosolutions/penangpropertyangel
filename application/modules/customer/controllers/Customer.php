<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Customer extends AdminController {

    private $agent;
    private $address;
    private $customer;

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
        $this->data['heading']          = 'Customer Management';
        $this->data['entryUsername']    = 'Username';
        $this->data['entryPassword']    = 'Password';
        $this->data['entryConfirmPassword']    = 'Confirm Password';
        $this->data['entryFirstname']   = 'First Name';
        $this->data['entryLastname']    = 'Last Name';
        $this->data['entryGender']      = 'Gender';
        $this->data['entryBirthday']    = 'Birthday';
        $this->data['entryNric']        = 'NRIC';
        $this->data['entryTelephone']   = 'Telephone';
        $this->data['entryMobile']      = 'Mobile';
        $this->data['entryFax']         = 'Fax';
        $this->data['entryOccupation']  = 'Occupation';
        $this->data['entryAddress']     = 'Address';
        $this->data['entryCity']        = 'City';
        $this->data['entryState']       = 'State/Province';
        $this->data['entryCountry']     = 'Country';
        $this->data['entryZipcode']     = 'Zipcode';
        $this->data['entryAvatar']      = 'Avatar';
        $this->data['entryStatus']      = 'Status';
        $this->data['datePlaceholder']  = 'mm-dd-yyyy';
        $this->data['form']             = array(
            'id'    => 'frmAgent',
            'name'  => 'frmAgent',
        );

        $this->data['salt'] = token(9);
        if (!empty($this->customer)) {
            $this->data['uuid'] = $this->customer->uuid;
        } else {
            $this->data['uuid'] = $this->uuid();
        }

        // User ID
        if (!empty($this->input->post('id'))) {
            $this->data['id'] = $this->input->post('id');
        } elseif (!empty($this->customer)) {
            $this->data['id'] = $this->customer->id;
        } else {
            $this->data['id'] = '';
        }
        // First Name
        if (!empty($this->input->post('firstname'))) {
            $this->data['firstname'] = $this->input->post('firstname');
        } elseif (!empty($this->customer)) {
            $this->data['firstname'] = $this->customer->firstname;
        } else {
            $this->data['firstname'] = '';
        }

        // Last Name
        if (!empty($this->input->post('lastname'))) {
            $this->data['lastname'] = $this->input->post('lastname');
        } elseif (!empty($this->customer)) {
            $this->data['lastname'] = $this->customer->lastname;
        } else {
            $this->data['lastname'] = '';
        }
        // Email
        if (!empty($this->input->post('email'))) {
            $this->data['email'] = $this->input->post('email');
        } elseif (!empty($this->customer)) {
            $this->data['email'] = $this->customer->email;
        } else {
            $this->data['email'] = '';
        }
        // Email
        if (!empty($this->input->post('password'))) {
            $this->data['password'] = sha1($this->data['salt'] . sha1($this->data['salt'] . sha1($this->input->post('password'))));
        } elseif (!empty($this->customer)) {
            $this->data['password'] = $this->customer->password;
        } else {
            $this->data['password'] = sha1($this->data['salt'] . sha1($this->data['salt'] . sha1(123456)));;
        }
        // Gender
        if (!empty($this->input->post('gender'))) {
            $this->data['gender'] = $this->input->post('gender');
        } elseif (!empty($this->customer)) {
            $this->data['gender'] = $this->customer->gender;
        } else {
            $this->data['gender'] = 0;
        }
        // Birthday
        if (!empty($this->input->post('birthday'))) {
            $this->data['birthday'] = $this->input->post('birthday');
        } elseif (!empty($this->customer)) {
            $this->data['birthday'] = $this->customer->birthday;
        } else {
            $this->data['birthday'] = '';
        }
        // NRIC
        if (!empty($this->input->post('nric'))) {
            $this->data['nric'] = $this->input->post('nric');
        } elseif (!empty($this->customer)) {
            $this->data['nric'] = $this->customer->nric;
        } else {
            $this->data['nric'] = '';
        }
        // Telephone
        if (!empty($this->input->post('phone'))) {
            $this->data['phone'] = $this->input->post('phone');
        } elseif (!empty($this->customer)) {
            $this->data['phone'] = $this->customer->phone;
        } else {
            $this->data['phone'] = '';
        }
        // Mobile Optional
        if (!empty($this->input->post('mobile'))) {
            $this->data['mobile'] = $this->input->post('mobile');
        } elseif (!empty($this->customer)) {
            $this->data['mobile'] = $this->customer->mobile;
        } else {
            $this->data['mobile'] = '';
        }
        // Fax
        if (!empty($this->input->post('fax'))) {
            $this->data['fax'] = $this->input->post('fax');
        } elseif (!empty($this->customer)) {
            $this->data['fax'] = $this->customer->fax;
        } else {
            $this->data['fax'] = '';
        }
        // Occupation
        if (!empty($this->input->post('occupation'))) {
            $this->data['occupation'] = $this->input->post('occupation');
        } elseif (!empty($this->customer)) {
            $this->data['occupation'] = $this->customer->occupation;
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
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->customer)) {
            $this->data['status'] = $this->customer->status;
        } else {
            $this->data['status'] = 0;
        }
        if (!empty($this->input->post('image'))) {
            $this->data['image'] = $this->input->post('image');
        } elseif (!empty($this->customer)) {
            $this->data['image'] = $this->customer->image;
        } else {
            $this->data['image'] = '';
        }

        if (!empty($this->input->post('image')) && is_file(DIR_IMAGE . $this->input->post('image'))) {
            $this->data['thumb'] = $this->resize($this->input->post('image'), 100, 100);
        } elseif (!empty($this->customer) && is_file(DIR_IMAGE . $this->customer->image)) {
            $this->data['thumb'] = $this->resize($this->customer->image, 100, 100);
        } else {
            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
        }
        $this->data['countries']    = Country_model::factory()->findAll();
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['back']         = url('customer');
    }
    public function index() {
        $this->init();
        $this->data['title']    = 'Customer List';
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
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['addLink']   = url('customer/create');
        render('index', $this->data);
    }

    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Customer';
        $this->data['route'] = url('customer/store');
        render('customer/create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->customer = Agent_model::factory()->getAgentByEmail($this->input->post('email'));
            if ($this->customer) {
                setWarning('message', "Warning: Customer already exists on {$this->customer->email} this mail id!");
                redirect(url('customer/create/'));
            }
            $this->init();
            Agent_model::factory()->insert([
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'email'     => $this->data['email'],
                'uuid'      => $this->data['uuid'],
                'salt'      => $this->data['salt'],
                'password'  => $this->data['password'],
                'gender'    => $this->data['gender'],
                'birthday'  => $this->data['birthday'],
                'nric'      => $this->data['nric'],
                'phone'     => $this->data['phone'],
                'mobile'    => $this->data['mobile'],
                'fax'       => $this->data['fax'],
                'occupation'=> $this->data['occupation'],
                'status'    => $this->data['status'],
                'image'     => $this->data['image'],

            ]);
            $customerId = Agent_model::factory()->getLastInsertID();
            AgentAddress_model::factory()->insert([
                'agent_id'  => $customerId,
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'address_1' => $this->data['address_1'],
                'country_id'=> $this->data['country_id'],
                'state_id'  => $this->data['state_id'],
                'city'      => $this->data['city'],
                'postcode'  => $this->data['postcode'],
            ]);
            GroupAgent_model::factory()->insert([
               'agent_id' => $customerId,
               'group_id' => 3,
            ]);
            setMessage('message', "Success: You have modified customer! ");
            redirect(url('customer/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->customer = Agent_model::factory()->findOne($id);
        if(!$this->customer) {
            setMessage('message', 'Info: Customer does not exists!');
            redirect(url('customer'));
        }
        $this->address = $this->customer->address;
        $this->init();
        $this->data['title']    = 'Edit Customer';
        $this->data['route'] = url('customer/update/'.$id);
        render('customer/edit', $this->data);
    }
    public function update($id) {
        try {
            $this->init();
            Agent_model::factory()->update([
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'email'     => $this->data['email'],
                'uuid'      => $this->data['uuid'],
                'salt'      => $this->data['salt'],
                'password'  => $this->data['password'],
                'gender'    => $this->data['gender'],
                'birthday'  => $this->data['birthday'],
                'nric'      => $this->data['nric'],
                'phone'     => $this->data['phone'],
                'mobile'    => $this->data['mobile'],
                'fax'       => $this->data['fax'],
                'occupation'=> $this->data['occupation'],
                'status'    => $this->data['status'],
                'image'     => $this->data['image'],

            ],['id' => $id]);
            AgentAddress_model::factory()->update([
                'agent_id'   => $id,
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'address_1' => $this->data['address_1'],
                'country_id'=> $this->data['country_id'],
                'state_id'  => $this->data['state_id'],
                'city'      => $this->data['city'],
                'postcode'  => $this->data['postcode'],
            ], ['agent_id' => $id]);

            setMessage('message', "Success: You have modified customer! ");
            redirect(url('customer/edit/'. $id));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


    }
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
                    Agent_model::factory()->delete($productId);
                    AgentAddress_model::factory()->delete(['agent_id' => $productId]);
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
    public function validateForm() {}
    public function onLoadDatatableEventHandler() {
        $users = GroupAgent_model::factory()->find()->where('group_id', 3)->get()->result();
        if(count($users) > 0) {
            $userIds = array();
            foreach ($users as $user) {
                $userIds[] = $user->agent_id;
            }
            $this->results = Agent_model::factory()->findAll($userIds);

            if($this->results) {
                foreach($this->results as $result) {
                    $this->rows[] = array(
                        'id'			=> $result->id,
                        'uuid'			=> $result->uuid,
                        'firstname'		=> $result->firstname,
                        'lastname' 		=> $result->lastname,
                        'email' 		=> $result->email,
                        'gender' 		=> $result->gender,
                        'birthday' 		=> $result->birthday,
                        'phone' 		=> $result->phone,
                        'mobile' 		=> $result->mobile,
                        'occupation' 	=> $result->occupation,
                        'address' 	    => $result->address->address_1,
                        'image' 	    => $result->image,
                        'nric' 	        => $result->nric,
                        'fax' 	        => $result->fax,
                        'status' 		=> ($result->status && $result->status == 1) ? 1 : 0,
                        'created_at'    => $result->created_at,
                        'updated_at'    => $result->updated_at
                    );
                }
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
                    $this->data[$i][] = '<td>'.$row['uuid'].'</td>';
                    $this->data[$i][] = '<td>'.$row['email'].'</td>';
                    $this->data[$i][] = '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
                    $this->data[$i][] = '<td>'.$row['gender'].'</td>';
                    $this->data[$i][] = '<td>'.$row['birthday'].'</td>';
                    $this->data[$i][] = '<td>'.$row['nric'].'</td>';
                    $this->data[$i][] = '<td>'.$row['phone'].'</td>';
                    $this->data[$i][] = '<td>'.$row['mobile'].'</td>';
                    $this->data[$i][] = '<td>'.$row['fax'].'</td>';
                    $this->data[$i][] = '<td>'.$row['occupation'].'</td>';
                    $this->data[$i][] = '<td>'.$row['address'].'</td>';
                    $this->data[$i][] = '<td><img src="'.resize($row['image'],32,32).'"></td>';
                    $this->data[$i][] = '<td>
                                        <select data-id="'.$row['id'].'" name="status" class="form-control select floating updateStatus" id="input-payment-status" >
                                            <option value="0" '.$selected.'>Inactive</option>
                                            <option value="1" '.$selected.'>Active</option>
                                        </select>
                                     </td>';
                    $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                    $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                    $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('customer/edit/').$row['id'].'" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
	                        </td>
                        ';

                    //  $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                    $i++;
                    $counter++;
                }


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

                $this->customerId   = (isset($this->request['id'])) ? $this->request['id'] : '';
                $this->status       = (isset($this->request['status'])) ? $this->request['status'] : '';


                Agent_model::factory()->updateStatus($this->customerId, $this->status);

                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
    public function states() {
        if($this->isAjaxRequest()) {
            $json = array();

            $this->country =  Country_model::factory()->findOne($this->input->post('country_id'));

            if ($this->country) {
                $json = array(
                    'country_id'        => $this->country->id,
                    'states'            => $this->country->states(),
                );
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($json));
        }
    }
}