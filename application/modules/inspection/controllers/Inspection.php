<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Inspection extends AdminController {

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
    private $inspection;

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
        $this->data['heading']                  = 'Inspection Arranged';
        $this->data['entryName']                = 'Name';
        $this->data['entryDate']                = 'Date';
        $this->data['entryTime']                = 'Time';
        $this->data['entryContact']             = 'Contact No.';
        $this->data['entryEmail']               = 'Email';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['entryAgent']               = 'Agent';
        $this->data['datePlaceholder']          = 'mm/dd/yyyy';
        $this->data['exportXlsBtn']             = 'Export to Excel';
        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';

        $this->data['form']             = array(
            'id'    => 'frmHandbook',
            'name'  => 'frmHandbook',
        );
        // Agent Id
        if (!empty($this->input->post('agent_id'))) {
            $this->data['agent_id'] = $this->input->post('agent_id');
        } elseif (!empty($this->inspection)) {
            $this->data['agent_id'] = $this->inspection->agent_id;
        } else {
            $this->data['agent_id'] = 0;
        }
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->inspection)) {
            $this->data['name'] = $this->inspection->name;
        } else {
            $this->data['name'] = '';
        }
        // Date
        if (!empty($this->input->post('date'))) {
            $this->data['date'] = $this->input->post('date');
        } elseif (!empty($this->inspection)) {
            $this->data['date'] = $this->inspection->date;
        } else {
            $this->data['date'] = '';
        }
        // Time
        if (!empty($this->input->post('time'))) {
            $this->data['time'] = $this->input->post('time');
        } elseif (!empty($this->inspection)) {
            $this->data['time'] = $this->inspection->time;
        } else {
            $this->data['time'] = '';
        }
        // Contact
        if (!empty($this->input->post('contact'))) {
            $this->data['contact'] = $this->input->post('contact');
        } elseif (!empty($this->inspection)) {
            $this->data['contact'] = $this->inspection->contact;
        } else {
            $this->data['contact'] = '';
        }
        // Email
        if (!empty($this->input->post('email'))) {
            $this->data['email'] = $this->input->post('email');
        } elseif (!empty($this->inspection)) {
            $this->data['email'] = $this->inspection->email;
        } else {
            $this->data['email'] = '';
        }
        // remarks
        if (!empty($this->input->post('remarks'))) {
            $this->data['remarks'] = $this->input->post('remarks');
        } elseif (!empty($this->inspection)) {
            $this->data['remarks'] = $this->inspection->remarks;
        } else {
            $this->data['remarks'] = '';
        }
        $this->data['back']         = url('inspection');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $users = GroupAgent_model::factory()->find()->where('group_id', 2)->get()->result();
        $userIds = array();
        if(count($users) > 0) {
            foreach ($users as $user) {
                $userIds[] = $user->agent_id;
            }
        }
        $this->data['agents']  = Agent_model::factory()->findAll($userIds,null,'id', 'asc');

        $this->results = Inspection_model::factory()->findAll();
        if(count($this->results)) {
            $this->data['disabled'] = false;
        } else {
            $this->data['disabled'] = true;
        }

       // dd($this->data);
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']     = 'Inspection Arranged List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'DateTime (mm/dd/yy)';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'ContactNo.';
        $this->data['columns'][] = 'Email';
        $this->data['columns'][] = 'Agent Name';
        $this->data['columns'][] = 'Agent Tel';
        $this->data['columns'][] = 'Agent Email';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'URL';
        $this->data['columns'][] = 'UpdDt';

        $this->data['add']       = url('inspection/create');
        $this->data['addBtn']    = 'Add';
        $this->data['deleteBtn'] = 'Delete';
        $this->data['exportToXlsRoute'] = url('inspection/exportToXls');
        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Inspection Arranged';
        $this->data['route'] = url('inspection/store');
        render('inspection/create', $this->data);
    }
    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // Project Model
            Inspection_model::factory()->insert([
                'agent_id'          => $this->data['agent_id'],
                'name'              => $this->data['name'],
                'date'              => $this->data['date'],
                'time'              => $this->data['time'],
                'remarks'           => $this->data['remarks'],
                'contact'           => $this->data['contact'],
                'email'             => $this->data['email'],
            ]);
            setMessage('message', "Success: You have modified Inspection Arranged! ");
            redirect(url('inspection/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->inspection = Inspection_model::factory()->findOne($id);
        if(!$this->inspection) {
            setMessage('message', 'Info: Inspection Arranged does not exists!');
            redirect(url('inspection'));
        }
        $this->init();
        $this->data['title'] = 'Edit Inspection Arranged';
        $this->data['route'] = url('inspection/update/'.$id);
        render('inspection/edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->inspection = Inspection_model::factory()->findOne($id);
            if(!$this->inspection) {
                setMessage('message', 'Info: Inspection Arranged does not exists!');
                redirect(url('inspection'));
            }
            $this->init();
            // Project Model
            Inspection_model::factory()->update([
                'agent_id'          => $this->data['agent_id'],
                'name'              => $this->data['name'],
                'date'              => $this->data['date'],
                'time'              => $this->data['time'],
                'remarks'           => $this->data['remarks'],
                'contact'           => $this->data['contact'],
                'email'             => $this->data['email'],
            ],[
                'id' => $id
            ]);
            setMessage('message', "Success: You have modified Inspection Arranged! ");
            redirect(url('inspection/edit/'. $id));
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
                    Inspection_model::factory()->delete($productId);
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
        $this->results = Inspection_model::factory()->findAll([],null,'name','desc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'date'			=> $result->date,
                    'time'			=> $result->time,
                    'name'		    => $result->name,
                    'contact' 		=> $result->contact,
                    'email' 		=> $result->email,
                    'agentName' 	=> $result->agent->firstname.' '.$result->agent->lastname,
                    'agentPhone'    => $result->agent->phone,
                    'agentEmail'    => $result->agent->email,
                    'remarks' 		=> $result->remarks,
                    'url' 		    => url('/'),
                    'updated_at'    => $result->updated_at
                );
            }
            //dd($this->rows);
            $i = 0;
            $counter = 1;
            foreach($this->rows as $row) {
                $this->data[$i][] = '<td class="text-center">
											<label class="css-control css-control-primary css-checkbox">
												<input type="checkbox" class="css-control-input selectCheckbox" value="'.$row['id'].'" name="selected[]">
												<span class="css-control-indicator"></span>
											</label>
										</td>';
                $this->data[$i][] = '<td>'.$counter.'</td>';
                $this->data[$i][] = '<td>'.$row['date'].'-'.$row['time'].'</td>';
                $this->data[$i][] = '<td>'.$row['name'].'</td>';
                $this->data[$i][] = '<td>'.$row['contact'].'</td>';
                $this->data[$i][] = '<td>'.$row['email'].'</td>';
                $this->data[$i][] = '<td>'.$row['agentName'].'</td>';
                $this->data[$i][] = '<td>'.$row['agentPhone'].'</td>';
                $this->data[$i][] = '<td>'.$row['agentEmail'].'</td>';
                $this->data[$i][] = '<td>'.$row['remarks'].'</td>';
                $this->data[$i][] = '<td>'.$row['url'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';
                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('inspection/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
    public function exportToXls() {
        if($this->isPost()) {
            $this->results = Inspection_model::factory()->findAll([],null,'name','desc');
            if($this->results) {
                $this->rows[] = array(
                    'Id',
                    'DateTime (mm/dd/yyyy)',
                    'Name',
                    'ContactNo. (desc)',
                    'Email (desc1)',
                    'AgentName (desc2)',
                    'AgentTel (desc3)',
                    'AgentEmail (desc4)',
                    'Remarks',
                    'Url',
                    'UpdDt',
                );
                foreach ($this->results as $result) {
                    $this->rows[] = array(
                        $result->id,
                        $result->date.'-'.$result->time,
                        $result->name,
                        $result->contact,
                        $result->email,
                        $result->agent->firstname.' '.$result->agent->lastname,
                        $result->agent->phone,
                        $result->agent->email,
                        $result->remarks,
                        $result->url,
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