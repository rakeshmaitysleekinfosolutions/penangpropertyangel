<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Inspection_model extends BaseModel {

    protected $table = "inspections";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new Inspection_model($attr);
    }
    public function agent() {
        return $this->hasOne(Agent_model::class, 'id','agent_id');
    }
}