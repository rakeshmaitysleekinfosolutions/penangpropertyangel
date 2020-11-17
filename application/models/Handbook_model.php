<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Handbook_model extends BaseModel {

    protected $table = "handbooks";

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
        return new Handbook_model($attr);
    }
    public function description() {
        return $this->hasOne(HandbookDescription_model::class, 'handbook_id', 'id');
    }
    public function images($projectId) {
        return HandbookImage_model::factory()->find()->where('handbook_id', $projectId)->order_by('sort_order','ASC')->get()->result_array();
    }
}