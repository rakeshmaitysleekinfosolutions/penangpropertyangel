<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ItemImage_model extends BaseModel {
    
    protected $table = "items_images";

    protected $primaryKey = 'id';

    protected $timestamps = true;

    // Record status for checking is deleted or not
    const SOFT_DELETED = 'is_deleted';

    public static function factory($attr = array()) {
        return new ItemImage_model($attr);
    }


}