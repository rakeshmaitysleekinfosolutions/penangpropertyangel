<?php

class User {
	private $user;
	private $ci;
	private $id;
	private $email;
	private $roleId;

    /**
     * Agent constructor.
     */
	public function __construct() {
	    $this->ci = &get_instance();
		if (userId()) {
			$this->user = Agent_model::factory()->findOne([
			    'id' => userId(),
			    'status' => 1,
            ]);
			if($this->user) {
			    Agent_model::factory()->update([
                    'ip' => $this->ci->input->server('REMOTE_ADDR')
                ],$this->user->id);

			    $this->userIp = AgentIp_model::factory()->findOne([
			        'agent_id'  => $this->user->id,
			        'ip'        => $this->ci->input->server('REMOTE_ADDR'),
                ]);
			    if(!$this->userIp) {
                    AgentIp_model::factory()->insert([
                        'ip'        => $this->ci->input->server('REMOTE_ADDR'),
                        'agent_id'  => $this->user->id,
                    ]);
                }
            } else {
			    $this->logout();
            }
		}
	}

    /**
     * @param $email
     * @param $password
     * @return bool
     */
	public function login($email, $password, $overwrite = false) {
        if ($overwrite) {
            $query = $this->ci->db->query("SELECT * FROM ".Agent_model::factory()->getTable()." WHERE LOWER(email) = '" . $this->ci->db->escape_str(strtolower($email)) . "' AND status = '1'");
        } else {
            $query = $this->ci->db->query("SELECT * FROM ".Agent_model::factory()->getTable()." WHERE LOWER(email) = '" . $this->ci->db->escape_str(strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->ci->db->escape_str($password) . "'))))) OR password = '" . $this->ci->db->escape_str(md5($password)) . "') AND status = '1'");
        }
//	    if($overwrite) {
//            $this->user = Agent_model::factory()->findOne([
//                'email' => $this->ci->db->escape_str(strtolower($email)),
//                'status' => 1,
//            ]);
//        } else {
//            $this->user = Agent_model::factory()->findOne([
//                'email'     => $this->ci->db->escape_str(strtolower($email)),
//                'password'  => SHA1(CONCAT($this->user->salt, SHA1(CONCAT($this->user->salt, SHA1($this->ci->db->escape_str($password)))))),
//                'status'    => 1,
//            ]);
//
//        }
        if($query->num_rows()) {
            $groupAgent     = GroupAgent_model::factory()->findOne(['agent_id' => $query->row_object()->id]);
            $this->roleId   = $groupAgent->group_id;
            $this->id       = $query->row_object()->id;
            $this->email    = $query->row_object()->email;

            Agent_model::factory()->update([
                'ip' => $this->ci->input->server('REMOTE_ADDR')
            ],$query->row_object()->id);
            return true;
        } else {
            return false;
        }
	}
    public function getUserByPassword($password) {
        $query = $this->ci->db->query("SELECT * FROM ".Agent_model::factory()->getTable()." WHERE  (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->ci->db->escape_str($password) . "'))))) OR password = '" . $this->ci->db->escape_str(md5($password)) . "') AND status = '1'");
        return $query->row();
	}
	public function logout() {
        unsetSession('isAdmin');
        unsetSession('loggedIn');
        unsetSession('userId');
        unsetSession('userEmail');
        unsetSession('userName');
        unsetSession('userLastLogin');
		return true;
	}
	public function isLogged() {
		return $this->id;
	}
	public function getId() {
		return $this->id;
	}
	public function getFirstName() {
		return $this->firstname;
	}
	public function getLastName() {
		return $this->lastname;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	public function getCreatedAt() {
		return $this->createdAt;
	}
	public function getRoleId() {
	    return $this->roleId;
    }


	

	
}
