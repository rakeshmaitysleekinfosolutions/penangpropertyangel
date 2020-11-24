<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Agent_model extends BaseModel {
    
    protected $table = "agents";

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
        return new Agent_model($attr);
    }

	public function getAgentByEmail($email) {
		$query = $this->db->query("SELECT * FROM agents WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT id, firstname, lastname, email FROM `users` WHERE code = '" . $this->db->escape_str($code) . "' AND code != ''");

		return $query->row_array();
	}

	public function getUserByToken($token) {
		$query = $this->db->query("SELECT * FROM users WHERE token = '" . $this->db->escape_str($token) . "' AND token != ''");

		$this->db->query("UPDATE users SET token = ''");

		return $query->row_array();
	}

	public function getTotalusersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM agents WHERE LOWER(email) = '" . $this->db->escape_str(strtolower($email)) . "'");
		return $query->row_array()['total'];
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM users_login WHERE email = '" . $this->db->escape_str(strtolower((string)$email)) . "' AND ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "'");

		if (!$query->num_rows()) {
			$this->db->query("INSERT INTO users_login SET email = '" . $this->db->escape_str(strtolower((string)$email)) . "', ip = '" . $this->db->escape_str($this->input->server('REMOTE_ADDR')) . "', total = 1, created_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "', updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE users_login SET total = (total + 1), updated_at = '" . $this->db->escape_str(date('Y-m-d H:i:s')) . "' WHERE User_login_id = '" . (int)$query->row['User_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `users_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");

		return $query->row_array();
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `agents_login` WHERE email = '" . $this->db->escape_str(strtolower($email)) . "'");
	}

	public function address() {
        return $this->hasOne(AgentAddress_model::class, 'agent_id', 'id');
    }
}