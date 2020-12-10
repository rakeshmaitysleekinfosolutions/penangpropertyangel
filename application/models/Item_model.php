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

    public function getFilterData($data) {
       // print_r($data);
        $sql = "SELECT i.id as ItemId FROM items i LEFT JOIN items_descriptions idesc ON (i.id = idesc.item_id) WHERE i.status = 1";
        if (!empty($data['type'])) {
            $sql .= " AND i.type = '" . $data['type'] . "'";
        }
        if (!empty($data['category_id'])) {
            $sql .= " AND i.category_id = '" . $data['category_id'] . "'";
        }
        if (!empty($data['bedroom1'])) {
            $sql .= " AND idesc.bedroom1 = '" . $data['bedroom1'] . "'";
        }
        if (!empty($data['bedroom2'])) {
            $sql .= " AND idesc.bedroom2 = '" . $data['bedroom2'] . "'";
        }
        if (!empty($data['state_id'])) {
            $sql .= " AND i.state_id = '" . $data['state_id'] . "'";
        }
        if (!empty($data['child_state_id'])) {
            $sql .= " AND i.child_state_id = '" . $data['child_state_id'] . "'";
        }
        if (!empty($data['min_area']) && !empty($data['max_area'])) {
            $sql .= " AND i.area BETWEEN '" . $data['min_area'] . "' AND '".$data['max_area']."'";
        }
        if (!empty($data['min_price']) && !empty($data['max_price'])) {
            $sql .= " AND i.price BETWEEN '" . $data['min_price'] . "' AND '".$data['max_price']."'";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}