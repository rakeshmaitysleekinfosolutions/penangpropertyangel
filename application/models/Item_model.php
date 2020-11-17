<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item_model extends BaseModel {
    
    protected $table = "items";

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
        return new Item_model($attr);
    }
    public function description() {
        return $this->hasOne(ItemDescription_model::class, 'item_id','id');
    }
    public function agent() {
        return $this->hasOne(Agent_model::class, 'id','agent_id');
    }
    public function category() {
        return $this->hasOne(Category_model::class, 'id','category_id');
    }
    public function state() {
        return $this->hasOne(State_model::class, 'id','state_id');
    }
    public function childState() {
        return $this->hasOne(ChildState_model::class, 'id','childstate_id');
    }
    public function projects($itemId) {
        $items = ItemProject_model::factory()->findAll(['item_id' => $itemId]);
        $ids = array();
        if(count($items) > 0) {
            foreach ($items as $item) {
                $ids[] = $item->project_id;
            }
        }

        if($ids) {
            return $ids;
        }
    }
    public function images($itemId) {
        return ItemImage_model::factory()->find()->where('item_id', $itemId)->order_by('sort_order','ASC')->get()->result_array();
    }

}