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

    public function get($id) {
        return $this->db->where('id', $id)->get()->row_array() ?: [];
    }

	public function getAll($params = []) {
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

	public function getKeyValue($select, $excludes = []) {
        $data = [""=>"None"];
        $this->db->select($select)
			->from($this->tableName);
        if($excludes) {
			$this->db->where_not_in("id", $excludes);
		}
        $res = $this->db->get()->result_array();
        foreach ($res as $row) {
        	$keys = array_keys($row);
			$data[$row[$keys[0]]] = $row[$keys[1]];
        }
        return $data;
    }

	public function save($params, $table = null) {
        if(!$table) {
            $table = $this->tableName;
        }
        $result = FALSE;
        unset($params["ajax"]);
        foreach ($params as $k=>$v) {
        	if($v == "") {
				$params[$k] = null;
			}
		}
        if ($params["id"]) {
            $result = $this->db->update($table, $params, array("id" => $params["id"]));
        } else {
            $result = $this->db->insert($table, $params);
        }
        return $result;
    }

	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete();
	}

}
