<?php

class LogErroModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Insert($data){
        $this->db->insert('logErro', $data);
        return $this->db->insert_id();
    }
}