<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBData extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getAll($tableName) {
        $not_v_table_name = preg_replace("/^v_/", "", $tableName);
        $this->db->order_by('id_' . $not_v_table_name, 'ASC');
        $query = $this->db->get($tableName);
        return $query->result();
    }

    public function getById($id, $tableName) {
        $not_v_table_name = preg_replace("/^v_/", "", $tableName);
        $this->db->where('id_'.$not_v_table_name, $id);
        $query = $this->db->get($tableName);
        return $query->row();
    }

    public function getByColumnValues($columnNames, $values, $tableName, $order_by) {
        for ($i=0; $i < count($columnNames); $i++) {
            $this->db->where($columnNames[$i], $values[$i]);
        }
        if (isset($order_by)) {
            for ($i= 0; $i < count($order_by); $i++) {
                $this->db->order_by($order_by[$i]['column_name'], $order_by[$i]['way']);
            }
        }
        $not_v_table_name = preg_replace("/^v_/", "", $tableName);
        $this->db->order_by('id_' . $not_v_table_name, 'ASC');
        $query = $this->db->get($tableName);
        return $query->result();
    }

    public function getByColumnValuesOr($columnNames, $values, $tableName, $order_by) {
        $this->db->where($columnNames[0], $values[0]);
        for ($i=1; $i < count($columnNames); $i++) {
            $this->db->or_where($columnNames[$i], $values[$i]);
        }
        if (isset($order_by)) {
            for ($i= 0; $i < count($order_by); $i++) {
                $this->db->order_by($order_by[$i]['column_name'], $order_by[$i]['way']);
            }
        }
        $not_v_table_name = preg_replace("/^v_/", "", $tableName);
        $this->db->order_by('id_' . $not_v_table_name, 'ASC');
        $query = $this->db->get($tableName);
        return $query->result();
    }

    public function insert($columnNames, $values, $tableName) {
        $data = array();
        for ($i=0; $i < count($columnNames); $i++) {
            $data[$columnNames[$i]] = $values[$i];
        }
        return $this->db->insert($tableName, $data);
    }

    public function update($columnNames, $values, $tableName) {
        $data = array();
        for ($i=0; $i < count($columnNames); $i++) {
            $data[$columnNames[$i]] = $values[$i];
        }
        $this->db->where($columnNames[0], $values[0]);
        return $this->db->update($tableName, $data);
    }

    public function deleteById($id, $tableName) {
        $this->db->where("id_" . $tableName, $id);
        return $this->db->delete($tableName);
    }

}