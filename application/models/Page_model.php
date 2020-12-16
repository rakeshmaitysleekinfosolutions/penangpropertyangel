<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Page_model extends BaseModel {


    protected $table = "pages";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new Page_model($attr);
    }


}
