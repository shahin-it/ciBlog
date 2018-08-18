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
        parent::__construct();
    }

    public function get($id) {
        return @$this->getRow([], ['id'=>$id]);
    }

    public function getBy($join = [], $where = []) {
		return @$this->getRow($join, $where);
	}

	public function getAllBy($join = [], $where = []) {
		return $this->getRows([], $join, $where);
	}

	public function getTableData($params = [], $join = [], $where = []) {
        $data = [];
		$params["offset"] = @$params["offset"] ?: 0;
		$params["max"] = @$params["max"] ?: 10;
        $data["count"] = $this->db->count_all($this->tableName);
        if($data["count"] && $data["count"] <= $params["offset"]) {
			$params["offset"] -= @$params["max"];
		}
        $data["items"] = $this->getRows($params, $join, $where);
        $data["size"] = count($data["items"]);
        return $data;
    }

    private function getRow($join, $where = []) {
    	return @$this->getRows(["max"=>1], $join, $where)[0] ?: array();
	}

    private function getRows($params = [], $join = [], $where = []) {
		$offset = @$params["offset"] ?: 0;
		$max = @$params["max"] ?: -1;
		$orderBy = @$params["orderBy"];
		$dir = @$params["dir"] ?: "asc";
		$q = $this->db->select($this->tableName.".*")->from($this->tableName);

		foreach ((is_string(@$join[0]) ? [$join] : $join) as $j) {
			$select = $j[0];
			$table = $j[1];
			$cond = $j[2];
			$type = @$j[3] ?: "inner";
			$q = $q->select($select)
				->join($table, $cond, $type);
		}
		foreach ($where as $k=>$v) {
			$this->db->where($k, $v);
		}

		if($orderBy) {
			$orderBy = $this->tableName.'.'.$orderBy;
			$q = $q->order_by($orderBy, $dir);
		}

		$q = $q->offset($offset);
		if($max > 0) {
			$q = $q->limit($max);
		}
		$res = $q->get()->result_array();
		foreach ($res as &$row) {
			@$row["created"] && $row["created"] = AppUtil::localTime($row["created"]);
			@$row["updated"] && $row["updated"] = AppUtil::localTime($row["updated"]);
		}

		return $res;
	}

	public function getKeyValue($select, $fillNone = true, $excludes = []) {
        $data = [];
        if($fillNone) {
        	$data[""] = "None";
		}
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
        	if($this->db->field_exists('updated', $table)) {
				$params["updated"] = AppUtil::now();
			}
            $result = $this->db->update($table, $params, array("id" => $params["id"]));
        } else {
			if($this->db->field_exists('created', $table)) {
				$params["created"] = AppUtil::now();
			}
			if($this->db->field_exists('updated', $table)) {
				$params["updated"] = AppUtil::now();
			}
			if($this->db->field_exists('created_by', $table)) {
				$params["created_by"] = $this->session->userdata("user");
			}

            $result = $this->db->insert($table, $params);
        }
        return $result;
    }

	public function delete($id) {
		$this->db->from($this->tableName)->where('id', $id);
		return $this->db->delete();
	}

}
