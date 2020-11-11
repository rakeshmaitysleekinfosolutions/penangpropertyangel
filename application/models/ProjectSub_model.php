<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ProjectSub_model extends BaseModel {

    protected $table = "projects_subs";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Mainstream creating field name
    const CREATED_AT = 'created_at';

    // Mainstream updating field name
    const UPDATED_AT = 'updated_at';

    // Use unixtime for saving datetime
    protected $dateFormat = 'datetime';

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    // 0: actived, 1: deleted
    protected $recordDeletedFalseValue = '1';

    protected $recordDeletedTrueValue = '0';

    public static function factory($attr = array()) {
        return new ProjectSub_model($attr);
    }
    public function images($projectId) {
        return ProjectSubImage_model::factory()->find()->where('project_sub_id', $projectId)->order_by('sort_order','ASC')->get()->result_array();
    }

}