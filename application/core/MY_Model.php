<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Model
 *
 * @author khaled.sdd
 */
class MY_Model extends CI_Model {
    
    protected $tableName;

    function __construct() {
        $this->db->from($this->tableName);
        parent::__construct();
    }

    function get($id) {
        return $this->db->where('id', $id)->get()->row_array();
    }

    function getAll($params = []) {
        $data = [];
        $offset = @$params["offset"] ?: 0;
        $max = @$params["max"] ?: 10;
        $data["count"] = $this->db->count_all($this->tableName);
        $this->db->from($this->tableName)
                ->limit($max, $offset);
        $data["items"] = $this->db->get()->result_array();
        $data["size"] = count($data["items"]);

        return $data;
    }
    
    function getKeyValue($select, $exclude = []) {
        $data = [];
        $this->db->select($select)->from($this->tableName);
        $res = $this->db->get()->result_array();
        foreach ($res as $row) {
            array_push($data, [($row[0])=>$row[1]]);
        }
        return $data;
    }
    
    function save($params, $table = null) {
        if(!$table) {
            $table = $this->tableName;
        }
        $result = FALSE;
        unset($params["ajax"]);
        if ($params["id"]) {
            $result = $this->db->update($table, $params, array("id" => $params["id"]));
        } else {
            $result = $this->db->insert($table, $params);
        }
        return $result;
    }

}
