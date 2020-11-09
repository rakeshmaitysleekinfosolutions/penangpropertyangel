<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Profile extends AdminController {

    private $agent;
    private $address;

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
        $this->data['entryUsername']    = 'Username';
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

        $this->data['form']             = array(
            'id'    => 'frmEditProfile',
            'name'  => 'frmEditProfile',
        );
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
            $this->data['birthday'] = '';
        }
        // NRIC
        if (!empty($this->input->post('nric'))) {
            $this->data['nric'] = $this->input->post('nric');
        } elseif (!empty($this->agent)) {
            $this->data['nric'] = $this->agent->nric;
        } else {
            $this->data['nric'] = '';
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
        if (!empty($this->input->post('image'))) {
            $this->data['image'] = $this->input->post('image');
        } elseif (!empty($this->agent)) {
            $this->data['image'] = $this->agent->image;
        } else {
            $this->data['image'] = '';
        }

        if (!empty($this->input->post('image')) && is_file(DIR_IMAGE . $this->input->post('image'))) {
            $this->data['thumb'] = $this->resize($this->input->post('image'), 100, 100);
        } elseif (!empty($this->agent) && is_file(DIR_IMAGE . $this->agent->image)) {
            $this->data['thumb'] = $this->resize($this->agent->image, 100, 100);
        } else {
            $this->data['thumb'] = $this->resize('no_image.png', 100, 100);
        }
        $this->data['countries']    = Country_model::factory()->findAll();
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
    }

    /**
     *
     * @throws Exception
     */
    public function index() {
        $this->agent = Agent_model::factory()->findOne(25);
        $this->address = $this->agent->address;

        $this->init();

        $this->data['heading']          = 'Profile Management';
        $this->data['title']            = 'Edit Profile';



        $this->data['datePlaceholder']  = 'mm/dd/yyyy';
        $this->data['route']            = url('profile/update/'.userId());
        render('index', $this->data);
    }
    public function update($id) {
        try {
            $this->init();
            Agent_model::factory()->update([
                'firstname' => $this->data['firstname'],
                'lastname'  => $this->data['lastname'],
                'gender'    => $this->data['gender'],
                'birthday'  => $this->data['birthday'],
                'nric'      => $this->data['nric'],
                'phone'     => $this->data['phone'],
                'mobile'    => $this->data['mobile'],
                'fax'       => $this->data['fax'],
                'occupation'=> $this->data['occupation'],
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

            //dd($id);
            setMessage('message', "Success: You have modified profile! ");
            redirect(url('profile/index/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

}