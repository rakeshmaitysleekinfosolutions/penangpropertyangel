<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Project extends AdminController {

    private $agent;
    private $address;
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
        $this->data['entryName']                = 'Name';
        $this->data['entrySlug']                = 'Slug';
        $this->data['entrySlider']              = 'Show Slider (Home)';
        $this->data['entrySequence']            = 'Sequence';
        $this->data['entryDate']                = 'Sale Ends (date)';
        $this->data['entryPrice']               = 'Price';
        $this->data['entryFit']                 = 'RM/Sq.Ft (flt)';
        $this->data['entryFit1']                = 'Sq.Ft From (flt1)';
        $this->data['entryFit2']                = 'Sq.Ft To (flt12)';
        $this->data['entryStatus']              = 'Status';
        $this->data['entryRemarks']             = 'Remarks';
        $this->data['entrySmallDescription']    = 'Short Desc (desc) (Home Page)';
        $this->data['entryLongDescription']     = 'LongDesc (desc1) (Project Page)';
        $this->data['entrySnapshot']            = 'Snapshot (desc2)';
        $this->data['entryFeatures']            = 'Features (desc3)';

        $this->data['entryMetaTitle']            = 'Meta Title';
        $this->data['entryMetaDescription']      = 'Meta Description';
        $this->data['entryMetaKeywords']         = 'Meta Keywords';

        $this->data['datePlaceholder']          = 'mm-dd-yyyy';

        $this->data['btnSave']                  = 'Save & Update';
        $this->data['btnBack']                  = 'Back';

        $this->data['form']             = array(
            'id'    => 'frmProject',
            'name'  => 'frmProject',
        );

        if (!empty($this->project)) {
            $this->data['uuid'] = $this->project->uuid;
        } else {
            $this->data['uuid'] = $this->uuid();
        }

        // Project ID
        if (!empty($this->input->post('id'))) {
            $this->data['id'] = $this->input->post('id');
        } elseif (!empty($this->project)) {
            $this->data['id'] = $this->project->id;
        } else {
            $this->data['id'] = '';
        }
        // Name
        if (!empty($this->input->post('name'))) {
            $this->data['name'] = $this->input->post('name');
        } elseif (!empty($this->project)) {
            $this->data['name'] = $this->project->name;
        } else {
            $this->data['name'] = '';
        }
        // Slug
        if (!empty($this->input->post('slug'))) {
            $this->data['slug'] = url_title($this->input->post('slug'),'dash', true);
        } elseif (!empty($this->project)) {
            $this->data['slug'] = $this->project->slug;
        } else {
            $this->data['slug'] = url_title($this->input->post('name'),'dash', true);
        }

        // Price
        if (!empty($this->input->post('price'))) {
            $this->data['price'] = $this->input->post('price');
        } elseif (!empty($this->project)) {
            $this->data['price'] = $this->project->price;
        } else {
            $this->data['price'] = '';
        }
        // RM/Sq.Ft (flt)
        if (!empty($this->input->post('fit'))) {
            $this->data['fit'] = $this->input->post('fit');
        } elseif (!empty($this->project)) {
            $this->data['fit'] = $this->project->fit;
        } else {
            $this->data['fit'] = '';
        }
        // Sq.Ft From (flt1)
        if (!empty($this->input->post('fit1'))) {
            $this->data['fit1'] = $this->input->post('fit1');
        } elseif (!empty($this->project)) {
            $this->data['fit1'] = $this->project->fit1;
        } else {
            $this->data['fit1'] = '';
        }
        // Sq.Ft To (flt2)
        if (!empty($this->input->post('fit2'))) {
            $this->data['fit2'] = $this->input->post('fit2');
        } elseif (!empty($this->project)) {
            $this->data['fit2'] = $this->project->fit2;
        } else {
            $this->data['fit2'] = '';
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
        // slider
        if (!empty($this->input->post('slider'))) {
            $this->data['slider'] = $this->input->post('slider');
        } elseif (!empty($this->project)) {
            $this->data['slider'] = $this->project->slider;
        } else {
            $this->data['slider'] = 1;
        }
        // sequence
        if (!empty($this->input->post('sequence'))) {
            $this->data['sequence'] = $this->input->post('sequence');
        } elseif (!empty($this->project)) {
            $this->data['sequence'] = $this->project->sequence;
        } else {
            $this->data['sequence'] = '';
        }
        // date
        if (!empty($this->input->post('date'))) {
            $this->data['date'] = $this->input->post('date');
        } elseif (!empty($this->project)) {
            $this->data['date'] = $this->project->date;
        } else {
            $this->data['date'] = '';
        }
        // snapshot
        if (!empty($this->input->post('snapshot'))) {
            $this->data['snapshot'] = $this->input->post('snapshot');
        } elseif (!empty($this->project)) {
            $this->data['snapshot'] = $this->project->description->snapshot;
        } else {
            $this->data['snapshot'] = '';
        }
        // features
        if (!empty($this->input->post('features'))) {
            $this->data['features'] = $this->input->post('features');
        } elseif (!empty($this->project)) {
            $this->data['features'] = $this->project->description->features;
        } else {
            $this->data['features'] = '';
        }
        // small description
        if (!empty($this->input->post('small_description'))) {
            $this->data['small_description'] = $this->input->post('small_description');
        } elseif (!empty($this->project)) {
            $this->data['small_description'] = $this->project->description->small_description;
        } else {
            $this->data['small_description'] = '';
        }
        // long description
        if (!empty($this->input->post('long_description'))) {
            $this->data['long_description'] = $this->input->post('long_description');
        } elseif (!empty($this->project)) {
            $this->data['long_description'] = $this->project->description->long_description;
        } else {
            $this->data['long_description'] = '';
        }
        // Meta Title
        if (!empty($this->input->post('meta_title'))) {
            $this->data['meta_title'] = $this->input->post('meta_title');
        } elseif (!empty($this->project)) {
            $this->data['meta_title'] = $this->project->description->meta_title;
        } else {
            $this->data['meta_title'] = '';
        }
        // Meta Description
        if (!empty($this->input->post('meta_description'))) {
            $this->data['meta_description'] = $this->input->post('meta_description');
        } elseif (!empty($this->project)) {
            $this->data['meta_description'] = $this->project->description->meta_description;
        } else {
            $this->data['meta_description'] = '';
        }
        // Meta keyword
        if (!empty($this->input->post('meta_keywords'))) {
            $this->data['meta_keywords'] = $this->input->post('meta_keywords');
        } elseif (!empty($this->project)) {
            $this->data['meta_keywords'] = $this->project->description->meta_keywords;
        } else {
            $this->data['meta_keywords'] = '';
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

        $this->data['back']         = url('project');
        $this->data['placeholder']  = $this->resize('no_image.png', 100, 100);
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->init();
        $this->data['title']    = 'Project List';
        $this->data['columns'][] = 'NO';
        $this->data['columns'][] = 'Seq';
        $this->data['columns'][] = 'Date';
        $this->data['columns'][] = 'Name';
        $this->data['columns'][] = 'Remarks';
        $this->data['columns'][] = 'Img';
        $this->data['columns'][] = 'Status';
        $this->data['columns'][] = 'CrtDt';
        $this->data['columns'][] = 'UpdDt';
        $this->data['columns'][] = 'Sub List';
        $this->data['columns'][] = 'Add Sub';
        $this->data['add']      = url('project/create');

        $this->data['addBtn'] = 'Add';
        $this->data['deleteBtn'] = 'Delete';
        render('index', $this->data);
    }
    /**
     * @throws Exception
     */
    public function create() {
        $this->init();
        $this->data['title'] = 'Add Project';
        $this->data['route'] = url('project/store');
        render('project/create', $this->data);
    }

    /**
     *
     */
    public function store() {
        try {
            $this->init();
            // Project Model
            Project_model::factory()->insert([
                'uuid'      => $this->data['uuid'],
                'name'      => $this->data['name'],
                'slug'      => $this->data['slug'],
                'price'     => $this->data['price'],
                'fit'       => $this->data['fit'],
                'fit1'      => $this->data['fit1'],
                'fit2'      => $this->data['fit2'],
                'remarks'   => $this->data['remarks'],
                'status'    => $this->data['status'],
                'slider'    => $this->data['slider'],
                'sequence'  => $this->data['sequence'],
                'date'      => $this->data['date'],
            ]);
            $this->projectId = Project_model::factory()->getLastInsertID();
            // Project Description Model
            ProjectDescription_model::factory()->insert([
                'project_id'            => $this->projectId,
                'small_description'     => $this->data['small_description'],
                'long_description'      => $this->data['long_description'],
                'snapshot'              => $this->data['snapshot'],
                'features'              => $this->data['features'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ]);
            // Project Image Model
            if(isset($this->data['images'])) {
                foreach ($this->data['images'] as $image) {
                    ProjectImage_model::factory()->insert([
                        'project_id'    => $this->projectId,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'    => $image['thumbnail'],
                    ]);
                }
            }
            setMessage('message', "Success: You have modified project! ");
            redirect(url('project/create/'));
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function edit($id) {
        $this->project = Project_model::factory()->findOne($id);
        if(!$this->project) {
            setMessage('message', 'Info: Project does not exists!');
            redirect(url('agent'));
        }
        $this->init();
        $this->data['title']    = 'Edit Project';
        $this->data['route'] = url('project/update/'.$id);
        render('project/edit', $this->data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        try {
            $this->project = Project_model::factory()->findOne($id);
            if(!$this->project) {
                setMessage('message', 'Info: Project does not exists!');
                redirect(url('project'));
            }
            $this->init();
            //dd($this->data);
            // Project Model
            Project_model::factory()->update([
                'uuid'      => $this->data['uuid'],
                'name'      => $this->data['name'],
                'slug'      => $this->data['slug'],
                'price'     => $this->data['price'],
                'fit'       => $this->data['fit'],
                'fit1'      => $this->data['fit1'],
                'fit2'      => $this->data['fit2'],
                'remarks'   => $this->data['remarks'],
                'status'    => $this->data['status'],
                'slider'    => $this->data['slider'],
                'sequence'  => $this->data['sequence'],
                'date'      => $this->data['date'],
            ],[
                'id' => $id
            ]);

            // Project Description Model
            ProjectDescription_model::factory()->update([
                'small_description'     => $this->data['small_description'],
                'long_description'      => $this->data['long_description'],
                'snapshot'              => $this->data['snapshot'],
                'features'              => $this->data['features'],
                'meta_title'            => $this->data['meta_title'],
                'meta_keywords'         => $this->data['meta_keywords'],
                'meta_description'      => $this->data['meta_description'],
            ],[
                'project_id' => $id
            ]);
            // Project Image Model


            if(isset($this->data['images'])) {
                ProjectImage_model::factory()->delete([
                    'project_id' => $id
                ], true);
                foreach ($this->data['images'] as $image) {
                    ProjectImage_model::factory()->insert([
                        'project_id'    => $id,
                        'image'         => $image['image'],
                        'sort_order'    => $image['sort_order'],
                        'thumbnail'     => $image['thumbnail'],
                    ]);
                }
            }

            setMessage('message', "Success: You have modified project! ");
            redirect(url('project/edit/'. $id));
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
                    Project_model::factory()->delete($productId);
                    ProjectDescription_model::factory()->delete(['project_id' => $productId]);
                    ProjectImage_model::factory()->delete(['project_id' => $productId]);

                    ProjectSub_model::factory()->delete(['project_id' => $productId]);
                    ProjectSubImage_model::factory()->delete(['project_id' => $productId]);
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
    public function getImgThumbnail($projectId) {
        if(ProjectImage_model::factory()->findOne(['project_id' => $projectId, 'thumbnail' => 1])) {
            return ProjectImage_model::factory()->findOne(['project_id' => $projectId, 'thumbnail' => 1])->image;
        }
        return false;
    }
    /**
     * @return mixed
     * @throws Exception
     */
    public function onLoadDataTableEventHandler() {
        $this->results = Project_model::factory()->findAll([],null,'name','desc');
        if($this->results) {
            foreach($this->results as $result) {
                $this->rows[] = array(
                    'id'			=> $result->id,
                    'name'		    => $result->name,
                    'sequence' 		=> $result->sequence,
                    'remarks' 		=> $result->remarks,
                    'img' 		    => ($this->getImgThumbnail($result->id)) ? resize($this->getImgThumbnail($result->id),32,32) : resize('no_image.png', 32,32),
                    'date' 		    => $result->date,
                    'countSubs'     => count($result->subProjects),
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
                $this->data[$i][] = '<td>'.$row['date'].'</td>';
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

                $this->data[$i][] = '<td><a href="'.url('projectsub/index/').$row['id'].'/">Sub List('.$row['countSubs'].')</a></td>';
                $this->data[$i][] = '<td><a href="'.url('projectsub/create/').$row['id'].'/">Add Sub</a></td>';
                $this->data[$i][] = '<td class="text-right">
	                            <a href="'.url('project/edit/').$row['id'].'/" id="button-image" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
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
                Project_model::factory()->update(['status' => $this->request['status']], ['id' => $this->request['id']]);
                $this->json['status'] = 'Status has been successfully updated';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($this->json));
            }
        }
    }
}