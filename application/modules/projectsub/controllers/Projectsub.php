<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Projectsub extends AdminController {
    /**
     * @var int
     */
    private $projectId;
    /**
     * @var object
     */
    private $project;

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
        $this->data['heading']                  = 'Project Management';
        $this->data['entryParent']              = 'Parent';
        $this->data['entryName']                = 'Name';
        $this->data['entryStatus']              = 'Status';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['entryDescription']         = 'Description';
        $this->data['entrySequence']            = 'Sequence';

        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';
        $this->data['btnBackToPreviousLevel']   = 'Back to Previous Level';
        $this->data['backToPreviousLevel']      = url('project');

        $this->data['form']             = array(
            'id'    => 'frmChildProject',
            'name'  => 'frmChildProject',
        );
        // Project ID // Parent Id or Foreign key
        if (!empty($this->uri->segment(3))) {
            $this->data['parent_id'] = $this->uri->segment(3);
        } else {
            $this->data['parent_id'] = '';
        }
        // Project Sub ID or Primary key
        if (!empty($this->uri->segment(4))) {
            $this->data['child_id'] = $this->uri->segment(4);
        } else {
            $this->data['child_id'] = '';
        }
        // Project ID
        if (!empty($this->input->post('project_id'))) {
            $this->data['project_id'] = $this->input->post('project_id');
        } elseif (!empty($this->project)) {
            $this->data['project_id'] = $this->project->project_id;
        } else {
            $this->data['project_id'] = '';
        }
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->project)) {
            $this->data['name'] = $this->project->name;
        } else {
            $this->data['name'] = '';
        }
        // Name
        if (!empty($this->input->post('sequence'))) {
            $this->data['sequence'] = $this->input->post('sequence');
        } elseif (!empty($this->project)) {
            $this->data['sequence'] = $this->project->sequence;
        } else {
            $this->data['sequence'] = 0;
        }
        // remarks
        if (!empty($this->input->post('remarks'))) {
            $this->data['remarks'] = $this->input->post('remarks');
        } elseif (!empty($this->project)) {
            $this->data['remarks'] = $this->project->remarks;
        } else {
            $this->data['remarks'] = '';
        }
        // Status
        if ($this->input->post('status') != '') {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($this->project)) {
            $this->data['status'] = $this->project->status;
        } else {
            $this->data['status'] = 1;
        }

        // small description
        if (!empty($this->input->post('description'))) {
            $this->data['description'] = $this->input->post('description');
        } elseif (!empty($this->project)) {
            $this->data['description'] = $this->project->description;
        } else {
            $this->data['description'] = '';
        }

        // Images
        if (!empty($this->input->post('images'))) {
            $projectImages = $this->input->post('images');
        } elseif (!empty($this->project)) {
            $projectImages = $this->project->images($this->project->id);
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

        $this->data['back']         = url('projectsub/index/'. $this->data['parent_id']);
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
        $this->data['projects'] = Project_model::factory()->findAll();
    }

    /**
     * @throws Exception
     */
    public function index($id) {
        $project = Project_model::factory()->findOne($id);
        if(!$project) {
            redirect(url('project'));
        }

        $this->init();
        $this->data['title']    = 'Project List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Seq';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'Img';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['add']       = url('projectsub/create/'.$id);

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';

        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create($id) {
        $this->init();
        $this->data['title'] = 'Add Project';
        $this->data['route'] = url('projectsub/store/');
        render('create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
           // dd($this->data);
            // Project Model
            ProjectSub_model::factory()->insert([
                'project_id'    => $this->data['project_id'],
                'name'          => $this->data['name'],
                'remarks'       => $this->data['remarks'],
                'sequence'      => $this->data['sequence'],
                'status'        => $this->data['status'],
                'description'   => $this->data['description'],
            ]);
            $lastInsertedId = ProjectSub_model::factory()->getLastInsertID();

            // Project Image Model
            if(isset($this->data['images'])) {
                foreach ($this->data['images'] as $image) {
                    ProjectSubImage_model::factory()->insert([
                        'project_id'    => $this->data['project_id'],
                        'project_sub_id'    => $lastInsertedId,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'    => $image['thumbnail'],
                    ]);
                }
            }
            setMessage('message', "Success: You have modified project! ");
            redirect(url('projectsub/create/'.$this->data['project_id']));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($parentId, $childId) {
        $this->project = ProjectSub_model::factory()->findOne($childId);
        if(!$this->project) {
            setMessage('message', 'Info: Project does not exists!');
            redirect(url('projectsub/index/'.$parentId));
        }
        $this->init();
        $this->data['title']    = 'Edit Project';
        $this->data['route'] = url('projectsub/update/'.$childId);
        render('edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->project = ProjectSub_model::factory()->findOne($id);
            if(!$this->project) {
                setMessage('message', 'Info: Project does not exists!');
                redirect(url('project'));
            }
            $this->init();
            //dd($this->data);
            // Project Model
            ProjectSub_model::factory()->update([
                'project_id'    => $this->data['project_id'],
                'name'          => $this->data['name'],
                'remarks'       => $this->data['remarks'],
                'sequence'      => $this->data['sequence'],
                'status'        => $this->data['status'],
                'description'   => $this->data['description'],
            ],[
                'id' => $id
            ]);
            // Project Image Model
            if(isset($this->data['images'])) {
                ProjectSubImage_model::factory()->delete([
                    'project_sub_id' => $id
                ], true);
                foreach ($this->data['images'] as $image) {
                    ProjectSubImage_model::factory()->insert([
                        'project_sub_id'    => $id,
                        'project_id'        => $this->data['project_id'],
                        'image'             => $image['image'],
                        'sort_order'        => $image['sort_order'],
                        'thumbnail'         => $image['thumbnail'],
                    ]);
                }
            }

            setMessage('message', "Success: You have modified project! ");
            redirect(url('projectsub/edit/'. $this->data['project_id'].'/'.$id).'/');
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
                foreach ($this->selected as $productId) {
                    ProjectSub_model::factory()->delete($productId);
                    ProjectSubImage_model::factory()->delete(['project_sub_id' => $productId]);
                }
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler($this->data['parent_id']), 'status' => true,'message' => 'Record has been successfully deleted')));
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array('data' => $this->onLoadDatatableEventHandler($this->data['parent_id']), 'status' => false, 'message' => 'Sorry! we could not delete this record')));
        }
    }
    public function getImgThumbnail($projectId) {
        return ProjectSubImage_model::factory()->findOne(['project_sub_id' => $projectId, 'thumbnail' => 1])->image;
    }
    /**
     * @return mixed
     * @throws Exception
     */
    public function onLoadDataTableEventHandler($id) {
        $this->results = ProjectSub_model::factory()->findAll(['project_id' => $id],null,'name','desc');

        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'project_id'			=> $result->project_id,
                    'name'		    => $result->name,
                    'sequence' 		=> $result->sequence,
                    'remarks' 		=> $result->remarks,
                    'img' 		    => resize($this->getImgThumbnail($result->id),32,32),
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
                $this->data[$i][] = '<td>'.$row['created_at'].'</td>';
                $this->data[$i][] = '<td>'.$row['updated_at'].'</td>';

                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('projectsub/edit/'.$row['project_id'].'/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                ProjectSub_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}